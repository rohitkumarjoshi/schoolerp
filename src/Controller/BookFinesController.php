<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BookFines Controller
 *
 * @property \App\Model\Table\BookFinesTable $BookFines
 *
 * @method \App\Model\Entity\BookFine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookFinesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $user_id = $this->Auth->User('id');
        $head_title = 'Book Categories';
        $fines = $this->paginate($this->BookFines);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookFine = $this->BookFines->get($this->request->getData('id'));
            $bookFine = $this->BookFines->patchEntity($bookFine, $this->request->getData());
            $bookFine->edited_by = $user_id;
            if ($this->BookFines->save($bookFine)) {
                $this->Flash->success(__('The book fine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book fine could not be saved. Please, try again.'));
        }

        $this->set(compact('fines'));
    }

    /**
     * View method
     *
     * @param string|null $id Book Fine id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookFine = $this->BookFines->get($id, [
            'contain' => []
        ]);

        $this->set('bookFine', $bookFine);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookFine = $this->BookFines->newEntity();
        if ($this->request->is('post')) {
            $bookFine = $this->BookFines->patchEntity($bookFine, $this->request->getData());
            if ($this->BookFines->save($bookFine)) {
                $this->Flash->success(__('The book fine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book fine could not be saved. Please, try again.'));
        }
        $this->set(compact('bookFine'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book Fine id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookFine = $this->BookFines->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookFine = $this->BookFines->patchEntity($bookFine, $this->request->getData());
            if ($this->BookFines->save($bookFine)) {
                $this->Flash->success(__('The book fine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book fine could not be saved. Please, try again.'));
        }
        $this->set(compact('bookFine'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book Fine id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookFine = $this->BookFines->get($id);
        if ($this->BookFines->delete($bookFine)) {
            $this->Flash->success(__('The book fine has been deleted.'));
        } else {
            $this->Flash->error(__('The book fine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
