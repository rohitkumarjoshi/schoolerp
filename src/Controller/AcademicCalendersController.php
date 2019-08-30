<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * AcademicCalenders Controller
 *
 * @property \App\Model\Table\AcademicCalendersTable $AcademicCalenders
 *
 * @method \App\Model\Entity\AcademicCalender[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AcademicCalendersController extends AppController
{
	 public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['sendeventall']);
    } 
	
	public function sendeventall(){
		
		$this->loadmodel('SessionYears');
		$SessionYear=$this->SessionYears->find()->where(['status'=>'Active'])->first();
		$session_year_id = $SessionYear->id;
		$AcademicCalenders=$this->AcademicCalenders->find()->where(['AcademicCalenders.session_year_id'=>$session_year_id,'AcademicCalenders.is_deleted'=>'N'])->contain(['AcademicCategories']);
		//pr($AcademicCalenders->toArray());
		
		foreach($AcademicCalenders as $AcademicCalender){
			$title=$AcademicCalender->academic_category->name;
			
			$event_date=date("Y-m-d",strtotime($AcademicCalender->date));
			$current_date=date("Y-m-d");
			$checkdate= date("Y-m-d", strtotime("-1 days",strtotime($event_date)));
			$message="".$AcademicCalender->date."  ".$AcademicCalender->description."";
			 if(strtotime($checkdate)==strtotime($current_date)){
				
				 $this->loadmodel('Users');
				 $Users=$this->Users->find()->where(['Users.is_deleted'=>'N','device_token !='=>''])->select(['device_token']);
				 
				 foreach($Users as $User){
					 $device_token=$User->device_token;
					 //$device_token='eSzCiyBARPw:APA91bGHMdjNT9qtAldwWUO-xmI8XqJsxcbaQ2MCas3JU08IMbYIOmaQ7dqqrv22HNFjYp_SAjHIAnAFkSXXxwfEDUkY925EA9o2b60suhugOraiJ0SDVMqddDmpXXS9A6HS08kdvQcJ';
							$tokens = array($device_token);

								$header = [
								'Content-Type:application/json',
								'Authorization: Key=AAAA8Hq2jLc:APA91bEz42EHdwNVDAF5SdL1oKqDQrnVWU2-kIJu_YsIjF93SSHeLWqajg3qyvaJRZ1l9P4QJJWiyvS51djw-Bc1nP_o4P8kfNqruRYIn_13dxWAEd8RkWGHkopgSQbHp1jt5AqW6hrs'
								];

								$msg = [
								'title'=> $title,
								'message' => $message,
								
								'link' =>'Alok://home'
								];

								$payload = array(
								'registration_ids' => $tokens,
								'data' => $msg
								);

								$curl = curl_init();
								curl_setopt_array($curl, array(
								CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_CUSTOMREQUEST => "POST",
								CURLOPT_POSTFIELDS => json_encode($payload),
								CURLOPT_HTTPHEADER => $header
								));
								$response = curl_exec($curl);
								$err = curl_error($curl);
								curl_close($curl);
								
								$final_result=json_decode($response);
								$sms_flag=$final_result->success;     
								if ($err) {
									//echo "cURL Error #:" . $err;
								} else {
									echo $response;
								}            
									
					// echo"hello"; exit;
					 
				 }
				 
			 }
			
		}
		exit;
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $Cid=$this->request->getQuery('CID');
        $this->paginate = [
            'contain' => ['AcademicCategories']
        ];
        $academicCalenders = $this->AcademicCalenders->find();
        //$academicCalenders->where(['AcademicCalenders.is_deleted'=>'N']);
        if(!empty($Cid)){
             $academicCalenders->where(['AcademicCalenders.academic_category_id'=>$Cid]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $academicCalenders->where(['AcademicCalenders.date >=' =>$date_from,'AcademicCalenders.date <=' =>$date_to]);
        }
        $academicCalenders->order(['AcademicCalenders.id'=>'DESC']);
        $academicCalenders = $this->paginate($academicCalenders);

        $academicCategories = $this->AcademicCalenders->AcademicCategories
            ->find('list', ['limit' => 200])
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCalenders','academicCategories'));
    }

    public function studentView()
    {
        $Cid=$this->request->getQuery('CID');
        $this->paginate = [
            'contain' => ['AcademicCategories']
        ];
        $academicCalenders = $this->AcademicCalenders->find();
        $academicCalenders->where(['AcademicCalenders.is_deleted'=>'N']);
        if(!empty($Cid)){
             $academicCalenders->where(['AcademicCalenders.academic_category_id'=>$Cid]);
        }
        $academicCalenders->order(['AcademicCalenders.id'=>'DESC']);
        $academicCalenders = $this->paginate($academicCalenders);

        $academicCategories = $this->AcademicCalenders->AcademicCategories
            ->find('list', ['limit' => 200])
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCalenders','academicCategories'));
    }
 
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $academicCalender = $this->AcademicCalenders->newEntity();
        if ($this->request->is('post')) {
            $academic_category_id = $this->request->getData('academic_category_id');
            $date = array_filter($this->request->getData('date'));
            $description = array_filter($this->request->getData('description'));
            $c=0;
            $result=0;
            foreach ($date as $newdate) {
                $academicCalender = $this->AcademicCalenders->newEntity();
                $academicCalender->date=date('Y-m-d',strtotime($newdate));
                $academicCalender->created_by=$user_id;
                $academicCalender->description=$description[$c];
                $academicCalender->session_year_id=$session_year_id;
                $academicCalender->academic_category_id=$academic_category_id;
                if ($this->AcademicCalenders->save($academicCalender)) {
                    $result=1;
                }
                $c++;
            }
            if($result==1){
                $this->Flash->success(__('The academic calender has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The academic calender could not be saved. Please, try again.'));
        }
        $academicCategories = $this->AcademicCalenders->AcademicCategories
            ->find('list', ['limit' => 200])
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCalender', 'academicCategories'));
    }
 
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $academicCalender = $this->AcademicCalenders->get($id, [
            'contain' => ['AcademicCategories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $academicCalender = $this->AcademicCalenders->patchEntity($academicCalender, $this->request->getData());
            $academicCalender->date=date('Y-m-d',strtotime($this->request->getData('date')));
            $academicCalender->edited_by=$user_id;
            $academicCalender->edited_on=date('Y-m-d h:i:s');
            if ($this->AcademicCalenders->save($academicCalender)) {
                $this->Flash->success(__('The academic calender has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The academic calender could not be saved. Please, try again.'));
        }
        $academicCategories = $this->AcademicCalenders->AcademicCategories
            ->find('list', ['limit' => 200])
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCalender','academicCategories'));
    }

    //---- Categories

    public function categoryAdd($id=null){
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if($id){
            $id = $this->EncryptingDecrypting->decryptData($id);
            $academicCategories = $this->AcademicCalenders->AcademicCategories->get($id);
        }
        else{
            $academicCategories = $this->AcademicCalenders->AcademicCategories->newEntity();  
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $academicCategories = $this->AcademicCalenders->AcademicCategories->patchEntity($academicCategories, $this->request->getData());
            if ($this->AcademicCalenders->AcademicCategories->save($academicCategories)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'categoryAdd']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $CategoriesList = $this->AcademicCalenders->AcademicCategories->find()
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCategories','CategoriesList','id'));
    }

     
}
