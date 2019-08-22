<?php
namespace App\Controller;
use Cake\I18n\Time;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * HostelOutPasses Controller
 *
 * @property \App\Model\Table\HostelOutPassesTable $HostelOutPasses
 *
 * @method \App\Model\Entity\HostelOutPass[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HostelOutPassesController extends AppController
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
        $user_id = $this->Auth->User('id');
        if ($this->request->is('post')) 
            {
                $hold_request_id=$this->request->getData('hold_request_id');
                $accept_request_id=$this->request->getData('accept_request_id');
                $reject_request_id=$this->request->getData('reject_request_id');
                if(!empty($hold_request_id))
                 {
                    $query = $this->HostelOutPasses->query();
                    $result = $query->update()
                    ->set(['status' => 'Hold','edited_by'=>$user_id])
                    ->where(['id' =>$hold_request_id ])
                    ->execute();
                    $this->Flash->success(__('The hostel out pass has been updated.'));
                     return $this->redirect(['action' => 'index']);
                 }
                  if(!empty($accept_request_id))
                 {
                    $query = $this->HostelOutPasses->query();
                    $result = $query->update()
                    ->set(['status' => 'Approved','edited_by'=>$user_id])
                    ->where(['id' =>$accept_request_id ])
                    ->execute();
                    $this->Flash->success(__('The hostel out pass has been updated.'));
                     return $this->redirect(['action' => 'index']);
                 }
                  if(!empty($reject_request_id))
                 {
                    $query = $this->HostelOutPasses->query();
                    $result = $query->update()
                    ->set(['status' => 'Rejected','edited_by'=>$user_id])
                    ->where(['id' =>$reject_request_id ])
                    ->execute();
                    $this->Flash->success(__('The hostel out pass has been updated.'));
                     return $this->redirect(['action' => 'index']);
                 }

            }
        $this->paginate = [
            'contain' => ['Students'=>function($q){
                return $q->innerJoinWith('StudentInfos');
            }]
        ];
        $data_exist='';
        //-------Filter Box--------------//
        if ($this->request->is('post')) 
        {
            $hostelOutPasses = $this->HostelOutPasses->find();
            $student_id=$this->request->getData('student_id');
            if(!empty($student_id))
            {
                $hostelOutPasses->where(['HostelOutPasses.student_id'=>$student_id]);
            }
           
           if(!empty($this->request->getData('daterange')))
            {
                $daterange=explode('/',$this->request->getData('daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $hostelOutPasses = $hostelOutPasses
                ->where(['OR'=>[function($exp) use($date_from,$date_to) {
                        return $exp->between('date_from', $date_from, $date_to, 'date');
                        },function($exp) use($date_from,$date_to) {
                         return $exp->between('date_to', $date_from, $date_to, 'date');
                    }
                ]]);
               
            }
            $hostelOutPasses->where(['HostelOutPasses.is_deleted'=>'N']);
            $hostelOutPasses = $this->paginate($hostelOutPasses);
            if(!empty($hostelOutPasses->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
        
        $students = $this->HostelOutPasses->Students->find('list')->innerJoinWith('StudentInfos');
        $status = array('Approve'=>'Approve','Reject'=>'Reject','Hold'=>'Hold');
        $this->set(compact('hostelOutPasses','students','status','data_exist'));
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
        $hostelOutPass = $this->HostelOutPasses->newEntity();
        if ($this->request->is('post')) {
            $hostelOutPass = $this->HostelOutPasses->patchEntity($hostelOutPass, $this->request->getData());
            $daterange=explode('/',$this->request->getData('daterange'));
            $hostelOutPass->date_from = date('Y-m-d',strtotime($daterange[0]));
            $hostelOutPass->date_to = date('Y-m-d',strtotime($daterange[1]));
            $hostelOutPass->out_time = date('H:i:s',strtotime($this->request->getData('out_time')));
            $hostelOutPass->in_time = date('H:i:s',strtotime($this->request->getData('in_time')));
            $hostelOutPass->session_year_id=$session_year_id;
            $hostelOutPass->status='Hold';
            $hostelOutPass->created_by =$user_id;
             $error='';
             try{
                if ($this->HostelOutPasses->save($hostelOutPass)) 
                {
                    $this->Flash->success(__('The hostel out pass has been saved.'));
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
                $error_data='The hostel out pass could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $students = $this->HostelOutPasses->Students->find('list')->innerJoinWith('StudentInfos');
        $status = array('Approve'=>'Approve','Reject'=>'Reject','Hold'=>'Hold');
        $this->set(compact('hostelOutPass', 'sessionYears', 'students','status'));
    }

    public function report()
    {
        $this->paginate = [
            'contain' => ['Students'=>function($q){
                return $q->innerJoinWith('StudentInfos');
            }]
        ];
        $data_exist='';
        //-------Filter Box--------------//
        if ($this->request->is('post')) 
        {
            $hostelOutPasses = $this->HostelOutPasses->find();
            $student_id=$this->request->getData('student_id');
            if(!empty($student_id))
            {
                $hostelOutPasses->where(['HostelOutPasses.student_id'=>$student_id]);
            }
           
           if(!empty($this->request->getData('daterange')))
            {
                $daterange=explode('/',$this->request->getData('daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $hostelOutPasses = $hostelOutPasses
                ->where(['OR'=>[function($exp) use($date_from,$date_to) {
                        return $exp->between('date_from', $date_from, $date_to, 'date');
                        },function($exp) use($date_from,$date_to) {
                         return $exp->between('date_to', $date_from, $date_to, 'date');
                    }
                ]]);
               
            }
            $hostelOutPasses->where(['HostelOutPasses.is_deleted'=>'N']);
            $hostelOutPasses = $this->paginate($hostelOutPasses);
            if(!empty($hostelOutPasses->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
        
        $students = $this->HostelOutPasses->Students->find('list')->innerJoinWith('StudentInfos');
        $this->set(compact('hostelOutPasses','students','data_exist'));
    }
}
