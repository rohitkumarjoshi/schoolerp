<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudentSiblings Controller
 *
 * @property \App\Model\Table\StudentSiblingsTable $StudentSiblings
 *
 * @method \App\Model\Entity\StudentSibling[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentSiblingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $studentSibling = $this->StudentSiblings->newEntity();
         }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $studentSibling = $this->StudentSiblings->get($id);
        }
        if ($this->request->is(['post','put']))
         {
            $studentSibling = $this->StudentSiblings->patchEntity($studentSibling, $this->request->getData());
            if(!$id)
            {
                $studentSibling->created_by =$user_id;
                $studentSibling->session_year_id =$session_year_id;
            }
            else
            {
                $studentSibling->edited_by =$user_id;
            }  
            $error='';
            try 
            {   
                if ($this->StudentSiblings->save($studentSibling)) {
                $this->Flash->success(__('The student sibling has been saved.'));
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
                $error_data='The student sibling could not be saved. Please, try again.';
            }
            //pr($studentRedDiary);exit;
            $this->Flash->error(__($error_data));
        }
        $students = $this->StudentSiblings->Students->find('list');
        $siblings = $this->StudentSiblings->Siblings->find('list');

        $this->paginate = [
            'contain' => ['Students', 'Siblings']
        ];
        $studentSiblings = $this->paginate($this->StudentSiblings);
        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('studentSiblings','studentSibling', 'students', 'siblings','id','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Student Sibling id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentSibling = $this->StudentSiblings->get($id, [
            'contain' => ['Students', 'Siblings', 'SessionYears']
        ]);

        $this->set('studentSibling', $studentSibling);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentSibling = $this->StudentSiblings->newEntity();
        if ($this->request->is('post')) {
            $studentSibling = $this->StudentSiblings->patchEntity($studentSibling, $this->request->getData());
            if ($this->StudentSiblings->save($studentSibling)) {
                $this->Flash->success(__('The student sibling has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student sibling could not be saved. Please, try again.'));
        }
        $students = $this->StudentSiblings->Students->find('list', ['limit' => 200]);
        $siblings = $this->StudentSiblings->Siblings->find('list', ['limit' => 200]);
        $sessionYears = $this->StudentSiblings->SessionYears->find('list', ['limit' => 200]);
        $this->set(compact('studentSibling', 'students', 'siblings', 'sessionYears'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Sibling id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentSibling = $this->StudentSiblings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentSibling = $this->StudentSiblings->patchEntity($studentSibling, $this->request->getData());
            if ($this->StudentSiblings->save($studentSibling)) {
                $this->Flash->success(__('The student sibling has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student sibling could not be saved. Please, try again.'));
        }
        $students = $this->StudentSiblings->Students->find('list', ['limit' => 200]);
        $siblings = $this->StudentSiblings->Siblings->find('list', ['limit' => 200]);
        $sessionYears = $this->StudentSiblings->SessionYears->find('list', ['limit' => 200]);
        $this->set(compact('studentSibling', 'students', 'siblings', 'sessionYears'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Sibling id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentSibling = $this->StudentSiblings->get($id);
        if ($this->StudentSiblings->delete($studentSibling)) {
            $this->Flash->success(__('The student sibling has been deleted.'));
        } else {
            $this->Flash->error(__('The student sibling could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
