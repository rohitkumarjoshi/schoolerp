<?php
namespace App\Controller;

use App\Controller\AppController;
use  Cake\Event\Event;
/**
 * PurchaseOrders Controller
 *
 * @property \App\Model\Table\PurchaseOrdersTable $PurchaseOrders
 *
 * @method \App\Model\Entity\PurchaseOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseOrdersController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Security->setConfig('unlockedActions',['add','edit']); 
	}	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->paginate = [
            'contain' => ['Vendors']
        ];
        $purchaseOrders = $this->paginate($this->PurchaseOrders->find()->order(['PurchaseOrders.id'=>'ASC']));
		$this->set(compact('purchaseOrders'));
    }

    
    public function view($id = null)
    {
		$id = $this->EncryptingDecrypting->decryptData($id);
      	
		$purchaseOrdersLists = $this->PurchaseOrders->get($id,[
			'contain'=>['PurchaseOrderRows'=>['Items'],'Vendors']
		]);
								
		$this->set(compact('purchaseOrders','purchaseOrdersLists','purchaseOrder'));
    }

    
	
    public function add($id=null)
    {	
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		if(!$id)
		{				
			$purchaseOrder = $this->PurchaseOrders->newEntity();
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$purchaseOrder = $this->PurchaseOrders->get($id, ['contain' => ['PurchaseOrderRows']]);
		} 
		if ($this->request->is(['patch','post','put'])){	
			$data = $this->request->getData();
			
			$last_po_no = $this->PurchaseOrders->find()->select(['po_no'])
								->order(['po_no'=>'DESC'])->first();
			
			if($last_po_no){
			$purchaseOrder->po_no = $last_po_no->po_no+1;
				
			}else{
				$purchaseOrder->po_no = 1;
			}
			$data['po_no'] = $purchaseOrder->po_no; 
			$data['transaction_date']= date('Y-m-d',strtotime($this->request
										->getData('transaction_date')));
			
			$purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder,$data);
			
			if(!$id)
			{
				$purchaseOrder->created_by = $user_id;
				$purchaseOrder->session_year_id =$session_year_id;
			}
			else
			{
				$purchaseOrder->edited_by = $user_id;
			}
            if ($this->PurchaseOrders->save($purchaseOrder)) {
				 
				$this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
        }
		$this->paginate = [
            'contain' => ['PurchaseOrderRows']
        ];
		if($id)
        {
             $Vendors = $this->PurchaseOrders->Vendors->find('list')
						->where(['Vendors.id IN' => $purchaseOrder->vendor_id]);
		}
        else{
            $Vendors = $this->PurchaseOrders->Vendors->find('list');
        }
		 
		$items = $this->PurchaseOrders->PurchaseOrderRows->Items->find()
						->where(['Items.is_deleted'=>'N'])
						->order(['Items.name'=>'ASC']);
		$option =[];
		foreach($items as $item)
		{
           $option[] =  [
                            'value'=>$item->id,
                            'text' =>$item->name,
                        ];
		}
		
		$this->set(compact('purchaseOrder','Vendors','id','option','items','SessionYears'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		if(!$id)
		{				
			$purchaseOrder = $this->PurchaseOrders->newEntity();
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$purchaseOrder = $this->PurchaseOrders->get($id, ['contain' => ['PurchaseOrderRows']]);
		} 
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			$data['transaction_date']= date('Y-m-d',strtotime($this->request->getData('transaction_date')));
            $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $data);
			
			if(!$id)
			{
				$purchaseOrder->created_by = $user_id;
				$purchaseOrder->session_year_id =$session_year_id;
			}
			else
			{
				$purchaseOrder->edited_by = $user_id;
			}
            if ($this->PurchaseOrders->save($purchaseOrder)) {
                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
        }
		$this->paginate = [
            'contain' => ['PurchaseOrderRows']
        ];
		if($id)
        {
             $Vendors = $this->PurchaseOrders->Vendors->find('list')
						->where(['Vendors.id IN' => $purchaseOrder->vendor_id]);
		}
        else{
            $Vendors = $this->PurchaseOrders->Vendors->find('list');
        }
		 
		$items = $this->PurchaseOrders->PurchaseOrderRows->Items->find()
						->where(['Items.is_deleted'=>'N'])
						->order(['Items.name'=>'ASC']);
			
		$option =[];
		foreach($items as $item)
		{
           $option[] =  [
                            'value'=>$item->id,
                            'text' =>$item->name,
                         ];
		}
		
		$this->set(compact('purchaseOrder','Vendors','id','option','items','SessionYears'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   /* public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrder = $this->PurchaseOrders->get($id);
        if ($this->PurchaseOrders->delete($purchaseOrder)) {
            $this->Flash->success(__('The purchase order has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
