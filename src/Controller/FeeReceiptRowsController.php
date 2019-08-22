<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FeeReceiptRows Controller
 *
 * @property \App\Model\Table\FeeReceiptRowsTable $FeeReceiptRows
 *
 * @method \App\Model\Entity\FeeReceiptRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeeReceiptRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FeeReceipts', 'FeeTypeMasters', 'FeeTypeMasterRows', 'FeeTypeStudentMasters', 'FeeMonths']
        ];
        $feeReceiptRows = $this->paginate($this->FeeReceiptRows);

        $this->set(compact('feeReceiptRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Fee Receipt Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feeReceiptRow = $this->FeeReceiptRows->get($id, [
            'contain' => ['FeeReceipts', 'FeeTypeMasters', 'FeeTypeMasterRows', 'FeeTypeStudentMasters', 'FeeMonths']
        ]);

        $this->set('feeReceiptRow', $feeReceiptRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feeReceiptRow = $this->FeeReceiptRows->newEntity();
        if ($this->request->is('post')) {
            $feeReceiptRow = $this->FeeReceiptRows->patchEntity($feeReceiptRow, $this->request->getData());
            if ($this->FeeReceiptRows->save($feeReceiptRow)) {
                $this->Flash->success(__('The fee receipt row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fee receipt row could not be saved. Please, try again.'));
        }
        $feeReceipts = $this->FeeReceiptRows->FeeReceipts->find('list', ['limit' => 200]);
        $feeTypeMasters = $this->FeeReceiptRows->FeeTypeMasters->find('list', ['limit' => 200]);
        $feeTypeMasterRows = $this->FeeReceiptRows->FeeTypeMasterRows->find('list', ['limit' => 200]);
        $feeTypeStudentMasters = $this->FeeReceiptRows->FeeTypeStudentMasters->find('list', ['limit' => 200]);
        $feeMonths = $this->FeeReceiptRows->FeeMonths->find('list', ['limit' => 200]);
        $this->set(compact('feeReceiptRow', 'feeReceipts', 'feeTypeMasters', 'feeTypeMasterRows', 'feeTypeStudentMasters', 'feeMonths'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fee Receipt Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feeReceiptRow = $this->FeeReceiptRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feeReceiptRow = $this->FeeReceiptRows->patchEntity($feeReceiptRow, $this->request->getData());
            if ($this->FeeReceiptRows->save($feeReceiptRow)) {
                $this->Flash->success(__('The fee receipt row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fee receipt row could not be saved. Please, try again.'));
        }
        $feeReceipts = $this->FeeReceiptRows->FeeReceipts->find('list', ['limit' => 200]);
        $feeTypeMasters = $this->FeeReceiptRows->FeeTypeMasters->find('list', ['limit' => 200]);
        $feeTypeMasterRows = $this->FeeReceiptRows->FeeTypeMasterRows->find('list', ['limit' => 200]);
        $feeTypeStudentMasters = $this->FeeReceiptRows->FeeTypeStudentMasters->find('list', ['limit' => 200]);
        $feeMonths = $this->FeeReceiptRows->FeeMonths->find('list', ['limit' => 200]);
        $this->set(compact('feeReceiptRow', 'feeReceipts', 'feeTypeMasters', 'feeTypeMasterRows', 'feeTypeStudentMasters', 'feeMonths'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fee Receipt Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feeReceiptRow = $this->FeeReceiptRows->get($id);
        if ($this->FeeReceiptRows->delete($feeReceiptRow)) {
            $this->Flash->success(__('The fee receipt row has been deleted.'));
        } else {
            $this->Flash->error(__('The fee receipt row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
