<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * SchoolNotices Controller
 *
 * @property \App\Model\Table\SchoolNoticesTable $SchoolNotices
 *
 * @method \App\Model\Entity\SchoolNotice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchoolNoticesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $schoolNotices = $this->SchoolNotices->find();
        //      $schoolNotices->where(['SchoolNotices.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $schoolNotices->where(function($exp) use($date_from,$date_to) {
                return $exp->between('valid_date', $date_from, $date_to, 'date');
            });
        } 
        if(!empty($this->request->getQuery('title'))){
            $title = $this->request->getQuery('title');
            $schoolNotices->where(['title LIKE'=>'%'.$title.'%']);
        }
        $schoolNotices->order(['id'=>'DESC']);
        $schoolNotices = $this->paginate($schoolNotices);
        $this->set(compact('schoolNotices'));
    }
    public function studentView()
    {
        $schoolNotices = $this->SchoolNotices->find();
        $schoolNotices->where(['SchoolNotices.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $schoolNotices->where(function($exp) use($date_from,$date_to) {
                return $exp->between('valid_date', $date_from, $date_to, 'date');
            });
        } 
        if(!empty($this->request->getQuery('title'))){
            $title = $this->request->getQuery('title');
            $schoolNotices->where(['title LIKE'=>'%'.$title.'%']);
        }
        $schoolNotices->order(['id'=>'DESC']);
        $schoolNotices = $this->paginate($schoolNotices);
        $this->set(compact('schoolNotices'));
    }
    
    /**
     * View method
     *
     * @param string|null $id School Notice id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schoolNotice = $this->SchoolNotices->get($id, [
            'contain' => []
        ]);

        $this->set('schoolNotice', $schoolNotice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $schoolNotice = $this->SchoolNotices->newEntity();
        if ($this->request->is('post')) {
            $schoolNotice = $this->SchoolNotices->patchEntity($schoolNotice, $this->request->getData());
            $schoolNotice->valid_date = date('Y-m-d',strtotime($this->request->getData('valid_date')));
            $schoolNotice->created_by = $user_id;
            $ImagesofEvent = $this->request->getData('doc_file');
            if(!empty($ImagesofEvent['tmp_name'])){
                $ext=explode('/',$ImagesofEvent['type']);
                $file_name='notice'.time().rand().'.'.$ext[1];
                $keynames = 'notice/'.$file_name;
                $schoolNotice->doc_file = $keynames;
            }
			
            if ($this->SchoolNotices->save($schoolNotice)) {
				
				// Notification Code 
		
				$user_type=['Employee','Student'];
				
				$Usersdatas=$this->SchoolNotices->Users->find()->where(['user_type IN'=>$user_type,'device_token !='=>'','is_deleted'=>'N'])->toArray();
				
				$Notifications=$this->SchoolNotices->Notifications->newEntity();
				$Notifications->title='Notice';
				$Notifications->message=$schoolNotice->title;
				$Notifications->df_link='Alok://Notice?id='.$schoolNotice->id;
				$Notifications->notify_date=date("Y-m-d");
				$Notifications->notify_time=date("h:i: A");
				$Notifications->status=0;
				$Notifications->created_by=$user_id;
				$this->SchoolNotices->Notifications->save($Notifications);
				
				foreach($Usersdatas as $Usersdata){
					$NotificationRows=$this->SchoolNotices->Notifications->NotificationRows->newEntity();
					$NotificationRows->notification_id=$Notifications->id;
					$NotificationRows->user_id=$Usersdata->id;
					$NotificationRows->sent=0;
					$NotificationRows->status=0;
					$this->SchoolNotices->Notifications->NotificationRows->save($NotificationRows);
				}
				
			// End Notification 
			 
				
                if(!empty($ImagesofEvent['tmp_name'])){
                $ext=explode('/',$ImagesofEvent['type']);
                $file_name='notice'.time().rand().'.'.$ext[1];
                $keynames = 'notice/'.$file_name;
                $schoolNotice->doc_file = $keynames;

                $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);
                
            }

                $this->Flash->success(__('The school notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The school notice could not be saved. Please, try again.'));
        }
        $this->set(compact('schoolNotice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id School Notice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $schoolNotice = $this->SchoolNotices->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $schoolNotice = $this->SchoolNotices->patchEntity($schoolNotice, $this->request->getData());
            $schoolNotice->valid_date = date('Y-m-d',strtotime($this->request->getData('valid_date')));
            $schoolNotice->edited_by = $user_id;
            $ImagesofEvent = $this->request->getData('doc_file');
            if(!empty($ImagesofEvent['tmp_name'])){
                $ext=explode('/',$ImagesofEvent['type']);
                $file_name='notice'.time().rand().'.'.$ext[1];
                $keynames = 'notice/'.$file_name;
                $schoolNotice->doc_file = $keynames;
            }
            else{
                unset($schoolNotice->doc_file);
            }
            if ($this->SchoolNotices->save($schoolNotice)) {
                $this->Flash->success(__('The school notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The school notice could not be saved. Please, try again.'));
        }
        $this->set(compact('schoolNotice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id School Notice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schoolNotice = $this->SchoolNotices->get($id);
        if ($this->SchoolNotices->delete($schoolNotice)) {
            $this->Flash->success(__('The school notice has been deleted.'));
        } else {
            $this->Flash->error(__('The school notice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
