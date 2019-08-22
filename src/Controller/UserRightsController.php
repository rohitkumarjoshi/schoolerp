<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\View;
use Cake\Event\Event;
/**
 * UserRights Controller
 *
 * @property \App\Model\Table\UserRightsTable $UserRights
 *
 * @method \App\Model\Entity\UserRight[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserRightsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
         $this->Security->setConfig('unlockedActions', ['employeeUserRight','roleUserRight']);
    } 
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'Roles']
        ];
        $userRights = $this->paginate($this->UserRights);

        $this->set(compact('userRights'));
    }

    /**
     * View method
     *
     * @param string|null $id User Right id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userRight = $this->UserRights->get($id, [
            'contain' => ['Employees', 'Roles']
        ]);

        $this->set('userRight', $userRight);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addEmployeeRights()
    {
       
        if ($this->request->is('post')) {
            
            $employee_id=$this->request->getData('employee_id');
            $userRights = $this->UserRights->find()->where(['employee_id'=>$employee_id])->first();
            if($userRights->id)
            {
                $userRight = $this->UserRights->get($userRights->id);
            }
            else
            {
                $userRight = $this->UserRights->newEntity();
            }
            
           
            $userRight = $this->UserRights->patchEntity($userRight, $this->request->getData());
            if(!empty($this->request->getData('menu_id')))
            {
                $userRight->menu_ids=implode(',',$this->request->getData('menu_id'));
            }
            else
            {
                $userRight->menu_ids='';
            }
            if ($this->UserRights->save($userRight)) {
                $this->Flash->success(__('The user right has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The user right could not be saved. Please, try again.'));
        }
    }
    public function addRoleRights()
    {
       
        if ($this->request->is('post')) {
            
            $role_id=$this->request->getData('role_id');
            $userRights = $this->UserRights->find()->where(['role_id'=>$role_id])->first();
            if($userRights->id)
            {
                $userRight = $this->UserRights->get($userRights->id);
            }
            else
            {
                $userRight = $this->UserRights->newEntity();
            }
            $userRight = $this->UserRights->patchEntity($userRight, $this->request->getData());
            if(!empty($this->request->getData('menu_id')))
            {
                $userRight->menu_ids=implode(',',$this->request->getData('menu_id'));
            }
            else
            {
                $userRight->menu_ids='';
            }
            if ($this->UserRights->save($userRight)) {
                $this->Flash->success(__('The user right has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The user right could not be saved. Please, try again.'));
        }
    }
    public function add()
    {
        $userRight = $this->UserRights->newEntity();
        $employees = $this->UserRights->Employees->find('list');
        $roles = $this->UserRights->Roles->find('list');
        $this->set(compact('userRight', 'employees', 'roles'));
    }
    public function employeeUserRight()
    {
        
        $employee_id=$this->request->getData('employee_id');
        $menus =  $this->UserRights->Menus->find('threaded');
        $employee =  $this->UserRights->Employees->get($employee_id);
        $role_id=$employee->role_id;
        $userRights = $this->UserRights->find()->where(['OR'=>['employee_id'=>$employee_id,'role_id'=>$role_id]]);
        $menu_ids=[];
        $userRightsIds=[];
        foreach ($userRights as $userRight) 
        {
                $menu_ids[]=explode(',',$userRight->menu_ids);
        }
        foreach ($menu_ids as $key => $value) 
        {
            foreach ($value as $key1 => $value1) 
            {
                $userRightsIds[]=$value1;
            }
        }
        $this->set(compact('menus','userRightsIds'));
    }
    
    public function roleUserRight()
    {
        $role_id=$this->request->getData('role_id');
        $menus =  $this->UserRights->Menus->find('threaded');
        $userRights = $this->UserRights->find()->where(['role_id'=>$role_id]);
        $menu_ids=[];
        $userRightsIds=[];
        foreach ($userRights as $userRight) 
        {
                $menu_ids[]=explode(',',$userRight->menu_ids);
        }
        foreach ($menu_ids as $key => $value) 
        {
            foreach ($value as $key1 => $value1) 
            {
                $userRightsIds[]=$value1;
            }
        }
        $this->set(compact('menus','userRightsIds'));
    }
    /**
     * Edit method
     *
     * @param string|null $id User Right id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userRight = $this->UserRights->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userRight = $this->UserRights->patchEntity($userRight, $this->request->getData());
            if ($this->UserRights->save($userRight)) {
                $this->Flash->success(__('The user right has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user right could not be saved. Please, try again.'));
        }
        $employees = $this->UserRights->Employees->find('list', ['limit' => 200]);
        $roles = $this->UserRights->Roles->find('list', ['limit' => 200]);
        $this->set(compact('userRight', 'employees', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Right id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userRight = $this->UserRights->get($id);
        if ($this->UserRights->delete($userRight)) {
            $this->Flash->success(__('The user right has been deleted.'));
        } else {
            $this->Flash->error(__('The user right could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
