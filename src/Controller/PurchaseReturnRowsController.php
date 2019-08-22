<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseReturnRows Controller
 *
 * @property \App\Model\Table\PurchaseReturnRowsTable $PurchaseReturnRows
 *
 * @method \App\Model\Entity\PurchaseReturnRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseReturnRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseReturns', 'Items']
        ];
        $purchaseReturnRows = $this->paginate($this->PurchaseReturnRows);

        $this->set(compact('purchaseReturnRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Return Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseReturnRow = $this->PurchaseReturnRows->get($id, [
            'contain' => ['PurchaseReturns', 'Items']
        ]);

        $this->set('purchaseReturnRow', $purchaseReturnRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseReturnRow = $this->PurchaseReturnRows->newEntity();
        if ($this->request->is('post')) {
            $purchaseReturnRow = $this->PurchaseReturnRows->patchEntity($purchaseReturnRow, $this->request->getData());
            if ($this->PurchaseReturnRows->save($purchaseReturnRow)) {
                $this->Flash->success(__('The purchase return row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase return row could not be saved. Please, try again.'));
        }
        $purchaseReturns = $this->PurchaseReturnRows->PurchaseReturns->find('list');
        $items = $this->PurchaseReturnRows->Items->find('list');
        $this->set(compact('purchaseReturnRow', 'purchaseReturns', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Return Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseReturnRow = $this->PurchaseReturnRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseReturnRow = $this->PurchaseReturnRows->patchEntity($purchaseReturnRow, $this->request->getData());
            if ($this->PurchaseReturnRows->save($purchaseReturnRow)) {
                $this->Flash->success(__('The purchase return row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase return row could not be saved. Please, try again.'));
        }
        $purchaseReturns = $this->PurchaseReturnRows->PurchaseReturns->find('list');
        $items = $this->PurchaseReturnRows->Items->find('list');
        $this->set(compact('purchaseReturnRow', 'purchaseReturns', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Return Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseReturnRow = $this->PurchaseReturnRows->get($id);
        if ($this->PurchaseReturnRows->delete($purchaseReturnRow)) {
            $this->Flash->success(__('The purchase return row has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase return row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
