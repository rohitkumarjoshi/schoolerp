<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ResultRows Controller
 *
 * @property \App\Model\Table\ResultRowsTable $ResultRows
 *
 * @method \App\Model\Entity\ResultRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResultRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Results', 'Subjects', 'ExamMasters']
        ];
        $resultRows = $this->paginate($this->ResultRows);

        $this->set(compact('resultRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Result Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resultRow = $this->ResultRows->get($id, [
            'contain' => ['Results', 'Subjects', 'ExamMasters']
        ]);

        $this->set('resultRow', $resultRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resultRow = $this->ResultRows->newEntity();
        if ($this->request->is('post')) {
            $resultRow = $this->ResultRows->patchEntity($resultRow, $this->request->getData());
            if ($this->ResultRows->save($resultRow)) {
                $this->Flash->success(__('The result row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The result row could not be saved. Please, try again.'));
        }
        $results = $this->ResultRows->Results->find('list', ['limit' => 200]);
        $subjects = $this->ResultRows->Subjects->find('list', ['limit' => 200]);
        $examMasters = $this->ResultRows->ExamMasters->find('list', ['limit' => 200]);
        $this->set(compact('resultRow', 'results', 'subjects', 'examMasters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Result Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resultRow = $this->ResultRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resultRow = $this->ResultRows->patchEntity($resultRow, $this->request->getData());
            if ($this->ResultRows->save($resultRow)) {
                $this->Flash->success(__('The result row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The result row could not be saved. Please, try again.'));
        }
        $results = $this->ResultRows->Results->find('list', ['limit' => 200]);
        $subjects = $this->ResultRows->Subjects->find('list', ['limit' => 200]);
        $examMasters = $this->ResultRows->ExamMasters->find('list', ['limit' => 200]);
        $this->set(compact('resultRow', 'results', 'subjects', 'examMasters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Result Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resultRow = $this->ResultRows->get($id);
        if ($this->ResultRows->delete($resultRow)) {
            $this->Flash->success(__('The result row has been deleted.'));
        } else {
            $this->Flash->error(__('The result row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
