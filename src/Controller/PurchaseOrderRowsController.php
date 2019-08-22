<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseOrderRows Controller
 *
 * @property \App\Model\Table\PurchaseOrderRowsTable $PurchaseOrderRows
 *
 * @method \App\Model\Entity\PurchaseOrderRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseOrderRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseOrders', 'Items']
        ];
        $purchaseOrderRows = $this->paginate($this->PurchaseOrderRows);

        $this->set(compact('purchaseOrderRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Order Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseOrderRow = $this->PurchaseOrderRows->get($id, [
            'contain' => ['PurchaseOrders', 'Items']
        ]);

        $this->set('purchaseOrderRow', $purchaseOrderRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseOrderRow = $this->PurchaseOrderRows->newEntity();
        if ($this->request->is('post')) {
            $purchaseOrderRow = $this->PurchaseOrderRows->patchEntity($purchaseOrderRow, $this->request->getData());
            if ($this->PurchaseOrderRows->save($purchaseOrderRow)) {
                $this->Flash->success(__('The purchase order row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase order row could not be saved. Please, try again.'));
        }
        $purchaseOrders = $this->PurchaseOrderRows->PurchaseOrders->find('list');
        $items = $this->PurchaseOrderRows->Items->find('list');
        $this->set(compact('purchaseOrderRow', 'purchaseOrders', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Order Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOrderRow = $this->PurchaseOrderRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOrderRow = $this->PurchaseOrderRows->patchEntity($purchaseOrderRow, $this->request->getData());
            if ($this->PurchaseOrderRows->save($purchaseOrderRow)) {
                $this->Flash->success(__('The purchase order row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase order row could not be saved. Please, try again.'));
        }
        $purchaseOrders = $this->PurchaseOrderRows->PurchaseOrders->find('list');
        $items = $this->PurchaseOrderRows->Items->find('list');
        $this->set(compact('purchaseOrderRow', 'purchaseOrders', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Order Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrderRow = $this->PurchaseOrderRows->get($id);
        if ($this->PurchaseOrderRows->delete($purchaseOrderRow)) {
            $this->Flash->success(__('The purchase order row has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase order row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
