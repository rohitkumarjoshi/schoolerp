<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        $login_type = $this->Auth->User('login_type');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id){
                $tasks = $this->Tasks->newEntity();
              }
          else
            {
                $id = $this->EncryptingDecrypting->decryptData($id);
                $tasks = $this->Tasks->get($id, [
                    'contain' => []
                ]);
            }
        if ($this->request->is(['patch', 'post', 'put'])) 
        {

            $tasks = $this->Tasks->patchEntity($tasks, $this->request->getData());
            $tasks->task_date = date('Y-m-d',strtotime($this->request->getData('task_date')));
            
            if(!$id)
            {
                $tasks->created_by =$user_id;
            }
            else
            {
                $tasks->edited_by =$user_id;
            } 
            $tasks->session_year_id =$session_year_id;
            $error='';
            try 
            {

                if ($this->Tasks->save($tasks))
                {
                    $this->Flash->success(__('The task has been saved.'));
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
                $error_data='The task master could not be saved. Please, try again.';
            }
           // pr($complaint);exit;
            $this->Flash->error(__($error_data));
        } 
        $employees = $this->Tasks->Employees->find('list')->where(['Employees.is_deleted'=>'N','Employees.session_year_id'=>$session_year_id]);
        $students = $this->Tasks->Students->find('list')->where(['Students.is_deleted'=>'N','Students.session_year_id'=>$session_year_id]);
        $this->paginate = ['contain'=>['Employees','Students']];
        $tasksData = $this->Tasks->find();
        $where = array();
        $tasksData->where($where);
        if(!empty($this->request->getQuery('empid'))){
            $tasksData->where(['Tasks.employee_id'=>$this->request->getQuery('empid')]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $tasksData->where(['task_date >=' =>$date_from,'task_date <=' =>$date_to]);
        }
        $tasksData = $this->paginate($tasksData);

        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('tasksData','tasks', 'employees','id','status','students'));
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function studentView()
    {
        $employees = $this->Tasks->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $this->paginate = ['contain'=>['Employees']];
        $tasksData = $this->Tasks->find();
        $tasksData->where(['Tasks.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('empid'))){
            $tasksData->where(['Tasks.employee_id'=>$this->request->getQuery('empid')]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $tasksData->where(['task_date >=' =>$date_from,'task_date <=' =>$date_to]);
        }
        $tasksData = $this->paginate($tasksData);
        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('tasksData','tasks', 'employees','id','status'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $employees = $this->Tasks->Employees->find('list', ['limit' => 200]);
        $this->set(compact('task', 'employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $employees = $this->Tasks->Employees->find('list', ['limit' => 200]);
        $this->set(compact('task', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
