<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * HostelRegistrations Controller
 *
 * @property \App\Model\Table\HostelRegistrationsTable $HostelRegistrations
 *
 * @method \App\Model\Entity\HostelRegistration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HostelRegistrationsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
         
        $this->Security->setConfig('unlockedActions', ['getRoomno']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $this->paginate = [
            'contain' => ['SessionYears', 'Students', 'Hostels', 'Rooms']
        ];
        if(!$id)
        {
           $hostelRegistration = $this->HostelRegistrations->newEntity();
           $room_id=0;
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $hostelRegistration = $this->HostelRegistrations->get($id, [
            'contain' => []
            ]);
            $room_id = $hostelRegistration->room_id;
        }
        if ($this->request->is(['post','put']))
        {
            $hostelRegistration = $this->HostelRegistrations->patchEntity($hostelRegistration, $this->request->getData());
             $hostelRegistration->registration_date=date('Y-m-d',strtotime($this->request->getData('registration_date')));
            $last_reg_no = $this->HostelRegistrations->find()->select(['registration_no'])
                                ->order(['registration_no'=>'DESC'])->first();
            if(!$id)
            {
                if($last_reg_no){
                $hostelRegistration->registration_no = $last_reg_no->registration_no+1;
                
                }else{
                $hostelRegistration->registration_no = 1;
                }
                $hostelRegistration->created_by =$user_id;
                $hostelRegistration->session_year_id =$session_year_id;
            }
            else
            {
                $hostelRegistration->edited_by =$user_id;
            }
            $error='';
            try 
            {
                if ($this->HostelRegistrations->save($hostelRegistration)) 
                {
                    if(!$id)
                    {
                        $query = $this->HostelRegistrations->Students->StudentInfos->query();
                        $query->update()->set([
                                'hostel_facility' => 'Yes',
                                'hostel_this_year' => 'Yes'
                                ])
                          ->where(['session_year_id'=>$session_year_id,
                                    'student_id'=>$hostelRegistration->student_id])
                          ->execute();
                    }
                    else
                    {
                        $hostel_facility=($hostelRegistration->is_deleted=='Y')?'No':'Yes';
                        $query = $this->HostelRegistrations->Students->StudentInfos->query();
                        $query->update()->set([
                                'hostel_facility' => $hostel_facility
                                ])
                          ->where(['session_year_id'=>$session_year_id,
                                    'student_id'=>$hostelRegistration->student_id])
                          ->execute();
                    }
                    $this->Flash->success(__('The hostel registration has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
             if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The hostel registration could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $students = $this->HostelRegistrations->Students->find('list', [
                'keyField' => 'id',
                'valueField' => 'concatenated'
            ])->innerJoinWith('StudentInfos');
        $students->select(['id','concatenated' =>$students->func()->CONCAT_WS([' => ',
                'Students.name' => 'identifier',
                'Students.scholar_no' => 'identifier'
            ])]);

        $hostels = $this->HostelRegistrations->Hostels->find('list')->where(['Hostels.is_deleted'=>'N']);

        $rooms = $this->HostelRegistrations->Rooms->find('list');
            $rooms->select(['Rooms.id','room_capacity'])
            ->leftJoinWith('HostelRegistrations',function($q)use($room_id){
                $q->select(['total_room'=>$q->func()->count('HostelRegistrations.id')])
                ->where(['HostelRegistrations.is_deleted'=>'N']);
                if(!empty($room_id))
                {
                    $q->where(['HostelRegistrations.room_id !='=>$room_id]);
                }
                return $q;
            })
            ->group(['Rooms.id'])
            ->having(['room_capacity > total_room']);
           
            
        $hostelRegistrations = $this->paginate($this->HostelRegistrations);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('hostelRegistrations','hostelRegistration', 'students', 'hostels', 'rooms','id','status'));
    }
    public function getRoomno()
    {
        if ($this->request->is(['post','put']))
        {
            $hostel_id=$this->request->getData('hostel_id');
            $rooms = $this->HostelRegistrations->Rooms->find('list');
            $rooms->where(['Rooms.hostel_id'=>$hostel_id])
                ->select(['Rooms.id','room_capacity'])
                ->leftJoinWith('HostelRegistrations',function($q){
                    return $q->select(['total_room'=>$q->func()->count('HostelRegistrations.id')])
                    ->where(['HostelRegistrations.is_deleted'=>'N'])
                    ;
                })
                ->group(['Rooms.id'])
                ->having(['room_capacity > total_room']);
        }
        $this->set(compact('rooms'));
        
    }
    /**
     * View method
     *
     * @param string|null $id Hostel Registration id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
    public function nodues()
    {
        $session_year_id=$this->Auth->User('session_year_id');
        $hostelRegistration = $this->HostelRegistrations->newEntity();
        if ($this->request->is('post')) {
            $hostelRegistration = $this->HostelRegistrations->patchEntity($hostelRegistration, $this->request->getData());
            if ($this->HostelRegistrations->save($hostelRegistration)) {
                $this->Flash->success(__('The hostel registration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hostel registration could not be saved. Please, try again.'));
        }
         $students=$this->HostelRegistrations->Students->StudentInfos->find()->select(['id','student_id','session_year_id','hostel_tc_nodues','hostel_id'])->where(['StudentInfos.session_year_id'=>$session_year_id,'StudentInfos.hostel_tc_nodues'=>'No','StudentInfos.hostel_id !='=>' '])->contain(['Students']);
        // pr($students->toarray());exit;
        //$students = $this->HostelRegistrations->Students->find('list');
       
        //$student_list = $this->HostelRegistrations->Students->StudentInfos->find()->select(['id','hostel_tc_nodues','item_code'])->where(['StudentInfos.hostel_tc_nodues'=>'Yes']);
        

         /*$this->paginate = [
            'contain' => ['StudentInfos'=>function($q) use($session_year_id) {
                 return $q->where(['StudentInfos.session_year_id'=>$session_year_id]);
            }]
        ];*/
        $this->paginate = [
            'limit' => 10,
            'contain'=>['Students']
        ];
        $studentInfos=$this->HostelRegistrations->Students->StudentInfos->find()->where(['StudentInfos.session_year_id'=>$session_year_id,'StudentInfos.hostel_tc_nodues'=>'Yes']);
        $nodue_data_stu_info = $this->paginate($studentInfos);
       // pr($nodue_data_stu_info->toArray());exit;
        $status = array('No'=>'No','Yes'=>'Yes');
        $this->set(compact('hostelRegistration','students','status','nodue_data_stu_info'));
    }
     public function report()
    {
        $this->paginate = [
            'contain' => ['SessionYears', 'Students'=>function($q){
                return $q->innerJoinWith('StudentInfos');
            }, 'Hostels', 'Rooms']
        ];
        //-------Filter Box--------------//
        $data_exist='';
        // if ($this->request->is('post')) 
        //     {
                $student_id=$this->request->query('student_id');
                $gender=$this->request->query('gender');
                if(!empty($student_id))
                 {
                    $conditions['HostelRegistrations.student_id']=$student_id; 
                 }
                 if(!empty($gender))
                 {
                    $conditions['Students.gender_id']=$gender; 
                 }
                 $conditions['HostelRegistrations.is_deleted']='N';
                $HostelRegistrations = $this->paginate($this->HostelRegistrations->find()->where($conditions));
                //pr($HostelRegistrations->toArray());exit;
                if(!empty($HostelRegistrations->toArray()))
	              {
	                $data_exist='data_exist';
	              }
              else{
                	$data_exist='No Record Found';
              	}  
           // }
            $students = $this->HostelRegistrations->Students->find('list')->innerJoinWith('StudentInfos');
            $this->set(compact('HostelRegistrations','students','data_exist'));
    }
}
