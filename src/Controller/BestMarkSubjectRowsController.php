<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BestMarkSubjectRows Controller
 *
 * @property \App\Model\Table\BestMarkSubjectRowsTable $BestMarkSubjectRows
 *
 * @method \App\Model\Entity\BestMarkSubjectRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BestMarkSubjectRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['BestMarkSubjects', 'ExamMasters']
        ];
        $bestMarkSubjectRows = $this->paginate($this->BestMarkSubjectRows);

        $this->set(compact('bestMarkSubjectRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Best Mark Subject Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bestMarkSubjectRow = $this->BestMarkSubjectRows->get($id, [
            'contain' => ['BestMarkSubjects', 'ExamMasters']
        ]);

        $this->set('bestMarkSubjectRow', $bestMarkSubjectRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bestMarkSubjectRow = $this->BestMarkSubjectRows->newEntity();
        if ($this->request->is('post')) {
            $bestMarkSubjectRow = $this->BestMarkSubjectRows->patchEntity($bestMarkSubjectRow, $this->request->getData());
            if ($this->BestMarkSubjectRows->save($bestMarkSubjectRow)) {
                $this->Flash->success(__('The best mark subject row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The best mark subject row could not be saved. Please, try again.'));
        }
        $bestMarkSubjects = $this->BestMarkSubjectRows->BestMarkSubjects->find('list', ['limit' => 200]);
        $examMasters = $this->BestMarkSubjectRows->ExamMasters->find('list', ['limit' => 200]);
        $this->set(compact('bestMarkSubjectRow', 'bestMarkSubjects', 'examMasters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Best Mark Subject Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bestMarkSubjectRow = $this->BestMarkSubjectRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bestMarkSubjectRow = $this->BestMarkSubjectRows->patchEntity($bestMarkSubjectRow, $this->request->getData());
            if ($this->BestMarkSubjectRows->save($bestMarkSubjectRow)) {
                $this->Flash->success(__('The best mark subject row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The best mark subject row could not be saved. Please, try again.'));
        }
        $bestMarkSubjects = $this->BestMarkSubjectRows->BestMarkSubjects->find('list', ['limit' => 200]);
        $examMasters = $this->BestMarkSubjectRows->ExamMasters->find('list', ['limit' => 200]);
        $this->set(compact('bestMarkSubjectRow', 'bestMarkSubjects', 'examMasters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Best Mark Subject Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bestMarkSubjectRow = $this->BestMarkSubjectRows->get($id);
        if ($this->BestMarkSubjectRows->delete($bestMarkSubjectRow)) {
            $this->Flash->success(__('The best mark subject row has been deleted.'));
        } else {
            $this->Flash->error(__('The best mark subject row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
