<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * StudentParentProfessions Controller
 *
 * @property \App\Model\Table\StudentParentProfessionsTable $StudentParentProfessions
 *
 * @method \App\Model\Entity\StudentParentProfession[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentParentProfessionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $studentParentProfession = $this->StudentParentProfessions->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $studentParentProfession = $this->StudentParentProfessions->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $studentParentProfession = $this->StudentParentProfessions->patchEntity($studentParentProfession, $this->request->getData());            
            if(!$id)
            {
                $studentParentProfession->created_by =$user_id;
                $studentParentProfession->session_year_id =$session_year_id;
            }
            else
            {
                $studentParentProfession->edited_by =$user_id;
            }
            
            $error='';
            
            try 
            {
              if($this->StudentParentProfessions->save($studentParentProfession))
              {
                $this->Flash->success(__('The professions has been saved.'));
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
                $error_data='The professions could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $this->paginate = [
            'limit' => 10
        ];
        if ($this->request->getQuery('search')) 
        { 
            $studentParentProfessions = $this->StudentParentProfessions->find();
            if(!empty($this->request->getQuery('name')))
            {
                $name = $this->request->getQuery('name');
                $studentParentProfessions->where(function (QueryExpression $exp, Query $q) use($name) {
                    return $exp->like('StudentParentProfessions.name', '%'.$name.'%');
                });
            }
            $studentParentProfessions = $this->paginate($studentParentProfessions);
        }
        else
        {
            $studentParentProfessions = $this->paginate($this->StudentParentProfessions);
        }
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('studentParentProfessions','studentParentProfession','id','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Student Parent Profession id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentParentProfession = $this->StudentParentProfessions->get($id, [
            'contain' => ['StudentInfos']
        ]);

        $this->set('studentParentProfession', $studentParentProfession);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentParentProfession = $this->StudentParentProfessions->newEntity();
        if ($this->request->is('post')) {
            $studentParentProfession = $this->StudentParentProfessions->patchEntity($studentParentProfession, $this->request->getData());
            if ($this->StudentParentProfessions->save($studentParentProfession)) {
                $this->Flash->success(__('The student parent profession has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student parent profession could not be saved. Please, try again.'));
        }
        $this->set(compact('studentParentProfession'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Parent Profession id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentParentProfession = $this->StudentParentProfessions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentParentProfession = $this->StudentParentProfessions->patchEntity($studentParentProfession, $this->request->getData());
            if ($this->StudentParentProfessions->save($studentParentProfession)) {
                $this->Flash->success(__('The student parent profession has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student parent profession could not be saved. Please, try again.'));
        }
        $this->set(compact('studentParentProfession'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Parent Profession id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentParentProfession = $this->StudentParentProfessions->get($id);
        if ($this->StudentParentProfessions->delete($studentParentProfession)) {
            $this->Flash->success(__('The student parent profession has been deleted.'));
        } else {
            $this->Flash->error(__('The student parent profession could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
