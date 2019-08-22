<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
        $this->Security->setConfig('unlockedActions', ['getEmployee']);
    } 
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function getEmployee()
    {
        $value = $this->request->getData('value');
        $response = $this->Employees->find()->select(['key'=>'Employees.id','text'=>'Employees.name'])->where(['name LIKE'=>'%'.$value.'%'])->distinct('name')->where(['name IS NOT NULL'])->where(['is_deleted'=>'N']);
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response']);
    }
    public function index1()
    {
        $this->paginate = [
            'contain' => ['Genders', 'Cities', 'States', 'SessionYears']
        ];
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
    }
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $employee = $this->Employees->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $employee = $this->Employees->get($id);
        }
        if ($this->request->is(['post','put'])) {
            $photo=$this->request->getData('photo'); 
			
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());            
            if(!$id)
            {
                $employee->created_by =$user_id;
                $employee->session_year_id =$session_year_id;
            }
            else
            {
                $employee->edited_by =$user_id;
            }
            $employee->dob=date('Y-m-d',strtotime($this->request->getData('dob')));
          
            $error='';
            try 
            {
              if($this->Employees->save($employee))
              {
                if(!$id)
                {
                    $users = $this->Employees->Users->newEntity();
                    $users->username='employee'.$employee->id;
                    $users->password='alokemployee'.$employee->id;
                    $users->user_type='Employee';
                    $users->session_year_id =$session_year_id;
                    $users->employee_id =$employee->id;
                    $this->Employees->Users->save($users);
                }
				if(!empty($photo['type'])){
					if(!empty($employee->photo)){
						$this->AwsFile->deleteObjectFile($employee->photo);
					}
					
					$ext=explode('/',$photo['type']);
					$setNewFileName = time().rand();
					$file_name = $setNewFileName.'.'.$ext[1];
					$keyname = 'employee/'.$employee->id.'/'.$setNewFileName.'.'.$ext[1];
					$this->AwsFile->putObjectFile($keyname,$photo['tmp_name'],$photo['type']);
					$query = $this->Employees->query();
					$query->update()->set(['photo' => $keyname])
					->where(['id' => $employee->id])->execute();
				}
                $this->Flash->success(__('The employees has been saved.'));
                return $this->redirect(['action' => 'index']);
              }
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry.';
            }
            else
            {
                 $error_data='The employees has not been saved.';
            }
            
            $this->Flash->error(__($error_data));
        }
        $this->paginate = [
            'contain' => ['Genders', 'Cities', 'States', 'Roles'],
            'limit' => 10
        ];
        $employees = $this->paginate($this->Employees);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $marital_statuses = array('Single'=>'Single','Married'=>'Married','Widowed'=>'Widowed','Divorced'=>'Divorced');
        $genders = $this->Employees->Genders->find('list');
        $cities = $this->Employees->Cities->find('list');
        $states = $this->Employees->States->find('list');
        $roles = $this->Employees->Roles->find('list');
        $this->set(compact('employees','employee','id','status','marital_statuses','genders','cities','states','roles'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Genders', 'Cities', 'States', 'SessionYears', 'Hostels', 'ItemIndents', 'ItemIssueReturns']
        ]);

        $this->set('employee', $employee);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $genders = $this->Employees->Genders->find('list', ['limit' => 200]);
        $cities = $this->Employees->Cities->find('list', ['limit' => 200]);
        $states = $this->Employees->States->find('list', ['limit' => 200]);
        $sessionYears = $this->Employees->SessionYears->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'genders', 'cities', 'states', 'sessionYears'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $genders = $this->Employees->Genders->find('list', ['limit' => 200]);
        $cities = $this->Employees->Cities->find('list', ['limit' => 200]);
        $states = $this->Employees->States->find('list', ['limit' => 200]);
        $sessionYears = $this->Employees->SessionYears->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'genders', 'cities', 'states', 'sessionYears'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
