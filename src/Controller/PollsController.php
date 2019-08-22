<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Polls Controller
 *
 * @property \App\Model\Table\PollsTable $Polls
 *
 * @method \App\Model\Entity\Poll[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PollsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','addImages']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PollRows']
        ];
        $polls = $this->Polls->find();
        $polls->where(['Polls.is_deleted'=>'N']);
        $polls->order(['Polls.id'=>'DESC']);
        if(!empty($this->request->getQuery('role'))){
            $polls->where(['Polls.poll_type'=>$this->request->getQuery('role')]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $polls->where(['created_on >=' =>$date_from.'00:00:00','created_on <=' =>$date_to.'23:59:59']);
        }

        $polls = $this->paginate($polls);
        $this->set(compact('polls'));
    }

    /**
     * View method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        /*$pollresult = $this->Polls->PollResults->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
        {
            
            foreach ($this->request->getQuery('data') as $key => $v) {
                if(!empty($v))
                {
                    $where ['Polls.'.$key] = $v;
                }
            }
            
        }*/
        
        $id = $this->EncryptingDecrypting->decryptData($id);
       /* $pollData = $this->Polls->PollRows->get($id, [
            'contain' => ['Polls']
        ]);
        pr($pollData->toArray());exit;*/

        $polls = $this->Polls->get($id, [
            'contain' => ['PollRows'=>function($q){
                return $q->where(['PollRows.correct_answer'=>'Correct']);
            }
            ,'PollResults'=>['Students','Employees','PollRows']]
        ]);
        //pr($polls->toArray());exit;
        $employees=$this->Polls->PollResults->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $students=$this->Polls->PollResults->Students->find('list')->where(['Students.is_deleted'=>'N']);
        $this->set(compact('polls','employees','students','pollresult'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $poll = $this->Polls->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is('post')) {
            $poll = $this->Polls->patchEntity($poll, $this->request->getData());
            $poll->created_by=$user_id;
            $poll->session_year_id=$session_year_id; 
            if ($this->Polls->save($poll)) {
                $this->Flash->success(__('The poll has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The poll could not be saved. Please, try again.'));
        }
        $this->set(compact('poll'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $poll = $this->Polls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $poll = $this->Polls->patchEntity($poll, $this->request->getData());
            if ($this->Polls->save($poll)) {
                $this->Flash->success(__('The poll has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The poll could not be saved. Please, try again.'));
        }
        $this->set(compact('poll'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Poll id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $poll = $this->Polls->get($id, [
            'contain' => []
        ]);
        $poll = $this->Polls->patchEntity($poll, $this->request->getData());
        $poll->is_deleted = 'Y';
        if ($this->Polls->save($poll)) {
            $this->Flash->success(__('The poll has been deleted.'));
        } else {
            $this->Flash->error(__('The poll could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
