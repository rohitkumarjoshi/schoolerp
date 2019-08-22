<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Feedbacks Controller
 *
 * @property \App\Model\Table\FeedbacksTable $Feedbacks
 *
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedbacksController extends AppController
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
        $this->paginate = [
            'contain' => ['Students', 'Employees']
        ];

        $user_type = $this->Auth->User('login_type');
         $feedbacks = $this->Feedbacks->find();
        if($user_type=='Employee'){
            
        $feedbacks->where(['Feedbacks.created_by'=>$user_id]);
        $feedbacks->order(['Feedbacks.id' => 'DESC']);

        }
        elseif ($user_type=='Admin') {
           
        $feedbacks->where(['Feedbacks.is_deleted'=>'N']);
        $feedbacks->order(['Feedbacks.id' => 'DESC']);

        }
        
        $feedbacks = $this->paginate($feedbacks);
        $this->set(compact('feedbacks','feedback'));
    }

    /**
     * View method
     *
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feedback = $this->Feedbacks->get($id, [
            'contain' => ['SessionYears', 'Students', 'Employees']
        ]);

        $this->set('feedback', $feedback);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $login_type = $this->Auth->User('user_type');

        
        $session_year_id = $this->Auth->User('session_year_id');
        $feedback = $this->Feedbacks->newEntity();
        if ($this->request->is('post')) 
        {
            $feedback = $this->Feedbacks->patchEntity($feedback, $this->request->getData());
            $feedback->created_by =$user_id;
            $feedback->session_year_id =$session_year_id;
            if($login_type=='Employee') {
                 $feedback->employee_id =$user_id;
            }else{
                $feedback->student_id =$user_id;
            };
             $error='';
            try 
            {
                if ($this->Feedbacks->save($feedback))
                {
                    $this->Flash->success(__('The feedback has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The feedback could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $this->set(compact('feedback'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        //$login_type = $this->Auth->User('login_type');
        $login_type = $this->Auth->User('user_type');
        $session_year_id = $this->Auth->User('session_year_id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $feedback = $this->Feedbacks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feedback = $this->Feedbacks->patchEntity($feedback, $this->request->getData());
            $feedback->edited_by =$user_id;
            $feedback->session_year_id =$session_year_id;
            if($login_type=='Employee') {
                 $feedback->employee_id =$user_id;
            }else{
                $feedback->student_id =$user_id;
            };
            $error='';
            try 
            {
                if ($this->Feedbacks->save($feedback))
                {
                    $this->Flash->success(__('The feedback has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The feedback could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
            
        }
        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('feedback','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feedback = $this->Feedbacks->get($id);
        if ($this->Feedbacks->delete($feedback)) {
            $this->Flash->success(__('The feedback has been deleted.'));
        } else {
            $this->Flash->error(__('The feedback could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report()
    {
     
        $feedback = $this->Feedbacks->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
        {
            
            foreach ($this->request->getQuery('data') as $key => $v) {
                if(!empty($v))
                {
                    /*if (strpos($key, 'assign_date') !== false)
                        $v = date('Y-m-d',strtotime($v));*/
                    $where ['Feedbacks.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
            $this->paginate = [
            'contain' => ['Students', 'Employees']
            ];
            //pr($where);
            $feedbacks = $this->paginate(
                $this->Feedbacks->find()
                ->where([$where]));
            //pr($vehicleDriverMappings->toArray());exit;
            if(!empty($feedbacks->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
       // pr($vehicleDriverMappings->toArray());exit;
        $students = $this->Feedbacks->Students->find('list')->where(['Students.is_deleted'=>'N']);
        $employees = $this->Feedbacks->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $this->set(compact('feedbacks','students','data_exist','feedback','employees'));
    }
}
