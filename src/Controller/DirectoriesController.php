<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Directories Controller
 *
 * @property \App\Model\Table\DirectoriesTable $Directories
 *
 * @method \App\Model\Entity\Directory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DirectoriesController extends AppController
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
              $directory = $this->Directories->newEntity();
              }
          else
            {
                $id = $this->EncryptingDecrypting->decryptData($id);
                $directory = $this->Directories->get($id, [
                    'contain' => []
                ]);
            }
      
        if ($this->request->is(['patch', 'post', 'put'])) {

            $directory = $this->Directories->patchEntity($directory, $this->request->getData());
            if(!$id)
            {
                $directory->created_by =$user_id;
            }
            else
            {
                $directory->edited_by =$user_id;
            }
            $error='';
            try 
            {
                if ($this->Directories->save($directory)) {
                    $this->Flash->success(__('The directory has been saved.'));
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
                $error_data='The directory could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $employees = $this->Directories->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $this->paginate = [
            'contain' => ['Employees']
        ];
        $emp_id = $this->request->getQuery('emp_id');
        $where=[];
        if(!empty($emp_id)){
            $where['Directories.employee_id']=$emp_id;
        }
        $directories = $this->paginate($this->Directories->find()->where($where));
        $this->set(compact('directory', 'employees','directories','id'));
    }

    public function studentView()
    {
        $this->paginate = [
            'contain' => ['Employees']
        ];
        $employees = $this->Directories->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $emp_id = $this->request->getQuery('emp_id');
        $where=[];
        if(!empty($emp_id)){
            $where['Directories.employee_id']=$emp_id;
        }
        $directories = $this->paginate($this->Directories->find()->where($where));
        $this->set(compact('directories','employees'));
    }
    public function view($id = null)
    {
        $directory = $this->Directories->get($id, [
            'contain' => ['Employees']
        ]);

        $this->set('directory', $directory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $directory = $this->Directories->newEntity();
        if ($this->request->is('post')) {
            $directory = $this->Directories->patchEntity($directory, $this->request->getData());
            if ($this->Directories->save($directory)) {
                $this->Flash->success(__('The directory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The directory could not be saved. Please, try again.'));
        }
        $employees = $this->Directories->Employees->find('list', ['limit' => 200]);
        $this->set(compact('directory', 'employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Directory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $directory = $this->Directories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $directory = $this->Directories->patchEntity($directory, $this->request->getData());
            if ($this->Directories->save($directory)) {
                $this->Flash->success(__('The directory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The directory could not be saved. Please, try again.'));
        }
        $employees = $this->Directories->Employees->find('list', ['limit' => 200]);
        $this->set(compact('directory', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Directory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $directory = $this->Directories->get($id);
        if ($this->Directories->delete($directory)) {
            $this->Flash->success(__('The directory has been deleted.'));
        } else {
            $this->Flash->error(__('The directory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
