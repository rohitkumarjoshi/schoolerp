<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 *
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        if(!$id){
                    $role = $this->Roles->newEntity();
                }
          else{
                $id = $this->EncryptingDecrypting->decryptData($id);
                $role = $this->Roles->get($id, [
                    'contain' => []
                 ]);
            
             }
            if ($this->request->is(['patch', 'post', 'put']))
            {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if(!$id)
            {
                $role->created_by =$user_id;
            }
            else
            {
                $role->edited_by =$user_id;
            }
            $error='';
                try 
                {
                    if ($this->Roles->save($role)) 
                    {
                        $this->Flash->success(__('The role has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                }catch (\Exception $e) {
                   $error = $e->getMessage();
                }
                if (strpos($error, '1062') !== false) 
                {
                    $error_data='Duplicate entry. Please, try again.';
                }
                else
                {
                    $error_data='The role could not be saved. Please, try again.';
                }
                //pr($employee);exit;
                $this->Flash->error(__($error_data));
        }
        $roles = $this->paginate($this->Roles);
        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('role','roles','status','id'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Employees']
        ]);

        $this->set('role', $role);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
