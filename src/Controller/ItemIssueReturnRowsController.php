<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemIssueReturnRows Controller
 *
 * @property \App\Model\Table\ItemIssueReturnRowsTable $ItemIssueReturnRows
 *
 * @method \App\Model\Entity\ItemIssueReturnRow[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemIssueReturnRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ItemIssueReturns', 'Items']
        ];
        $itemIssueReturnRows = $this->paginate($this->ItemIssueReturnRows);

        $this->set(compact('itemIssueReturnRows'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Issue Return Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemIssueReturnRow = $this->ItemIssueReturnRows->get($id, [
            'contain' => ['ItemIssueReturns', 'Items']
        ]);

        $this->set('itemIssueReturnRow', $itemIssueReturnRow);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemIssueReturnRow = $this->ItemIssueReturnRows->newEntity();
        if ($this->request->is('post')) {
            $itemIssueReturnRow = $this->ItemIssueReturnRows->patchEntity($itemIssueReturnRow, $this->request->getData());
            if ($this->ItemIssueReturnRows->save($itemIssueReturnRow)) {
                $this->Flash->success(__('The item issue return row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item issue return row could not be saved. Please, try again.'));
        }
        $itemIssueReturns = $this->ItemIssueReturnRows->ItemIssueReturns->find('list');
        $items = $this->ItemIssueReturnRows->Items->find('list');
        $this->set(compact('itemIssueReturnRow', 'itemIssueReturns', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Issue Return Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemIssueReturnRow = $this->ItemIssueReturnRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemIssueReturnRow = $this->ItemIssueReturnRows->patchEntity($itemIssueReturnRow, $this->request->getData());
            if ($this->ItemIssueReturnRows->save($itemIssueReturnRow)) {
                $this->Flash->success(__('The item issue return row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item issue return row could not be saved. Please, try again.'));
        }
        $itemIssueReturns = $this->ItemIssueReturnRows->ItemIssueReturns->find('list', ['limit' => 200]);
        $items = $this->ItemIssueReturnRows->Items->find('list', ['limit' => 200]);
        $this->set(compact('itemIssueReturnRow', 'itemIssueReturns', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Issue Return Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemIssueReturnRow = $this->ItemIssueReturnRows->get($id);
        if ($this->ItemIssueReturnRows->delete($itemIssueReturnRow)) {
            $this->Flash->success(__('The item issue return row has been deleted.'));
        } else {
            $this->Flash->error(__('The item issue return row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
