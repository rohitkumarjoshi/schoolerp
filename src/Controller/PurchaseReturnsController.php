<?php
namespace App\Controller;

use App\Controller\AppController;
use  Cake\Event\Event;
/**
 * PurchaseReturns Controller
 *
 * @property \App\Model\Table\PurchaseReturnsTable $PurchaseReturns
 *
 * @method \App\Model\Entity\PurchaseReturn[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseReturnsController extends AppController
{

    public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Security->setConfig('unlockedActions',['add','edit']); 
	}
    public function index()
    {
        $this->paginate = [
            'contain' => [  'Vendors', 'SessionYears','PurchaseReturnRows'=>['Items']]
        ];
        $purchaseReturns = $this->paginate($this->PurchaseReturns->find()->order(['PurchaseReturns.id'=>'ASC']));
		
        $this->set(compact('purchaseReturns'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Return id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
       
		$id = $this->EncryptingDecrypting->decryptData($id); 
		$purchaseReturns = $this->PurchaseReturns->get($id,[
			'contain'=>['Vendors','PurchaseReturnRows'=>['Items']]
		]);
							
		
        $this->set(compact('purchaseReturns'));
    }
	

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
        $purchaseReturn = $this->PurchaseReturns->newEntity();
        if ($this->request->is(['patch','post','put'])) {
			$data = $this->request->getData();
			$last_voucher_no = $this->PurchaseReturns->find()->select(['voucher_no'])
								->order(['voucher_no'=>'DESC'])->first();
			
			if($last_voucher_no){
			$purchaseReturn->voucher_no = $last_voucher_no->voucher_no+1;
				
			}else{
				$purchaseReturn->voucher_no = 1;
			}
			$data['voucher_no'] = $purchaseReturn->voucher_no; 
			$data['transaction_date']=date('Y-m-d',strtotime(	$this->request->getData('transaction_date')));	
			
            $purchaseReturn = $this->PurchaseReturns->patchEntity($purchaseReturn,$data);
			
			$purchaseReturn->session_year_id =$session_year_id;
			$purchaseReturn->created_by = $user_id;
			
			if ($this->PurchaseReturns->save($purchaseReturn)) {
				
			foreach($purchaseReturn->purchase_return_rows as $purchase_return_rows){
			$stockLedger = $this->PurchaseReturns->PurchaseReturnRows->Items->StockLedgers->newEntity();
					
					$stockLedger->session_year_id = $purchaseReturn->session_year_id;
					$stockLedger->purchase_return_id = $purchaseReturn->id;
					$stockLedger->purchase_return_row_id = $purchase_return_rows->id;
					$stockLedger->item_id  = $purchase_return_rows->item_id; 
					$stockLedger->location_id = $purchase_return_rows->location_id; 
					$stockLedger->quantity = $purchase_return_rows->quantity; 
					$stockLedger->transaction_date = $purchaseReturn->transaction_date; 
					$stockLedger->status = 'Out';
					$stockLedger->created_by = $purchaseReturn->created_by;
					
					$this->PurchaseReturns->PurchaseReturnRows->Items->StockLedgers->save($stockLedger);
			}
					
			
                $this->Flash->success(__('The purchase return has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase return could not be saved. Please, try again.'));
        }
        
      
        $vendors = $this->PurchaseReturns->Vendors->find('list');
		$items = $this->PurchaseReturns->PurchaseReturnRows->Items->find()
					->where(['Items.is_deleted'=>'N'])
					->order(['Items.name'=>'ASC']);
	
		$option =[];
		foreach($items as $item)
		{
           $option[] =  [
                            'value'=>$item->id,
                            'text'=>$item->name,
                         ];
			
		}
		$locations = $this->PurchaseReturns->PurchaseReturnRows->Items->StockLedgers->Locations->find()
						->where(['Locations.is_deleted'=>'N'])
						->order(['Locations.name'=>'ASC']);
		
		$Dropdown =[];
		foreach($locations as $location)
		{
           $Dropdown[] =  [
                            'value'=>$location->id,
                            'text'=>$location->name,
							];
			
		}
		
        $sessionYears = $this->PurchaseReturns->SessionYears->find('list');
        $this->set(compact('purchaseReturn',  'grns', 'vendors', 'sessionYears','option','Dropdown'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Return id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {	
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		if(!$id)
		{				
			$purchaseReturn = $this->PurchaseReturns->newEntity();
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$purchaseReturn = $this->PurchaseReturns->get($id, ['contain' => ['PurchaseReturnRows']]);
		} 
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			/*$last_voucher_no = $this->PurchaseReturns->find()->select(['voucher_no'])
								->order(['voucher_no'=>'DESC'])->first();
			
			if($last_voucher_no){
			$purchaseReturn->voucher_no = $last_voucher_no->voucher_no+1;
				
			}else{
				$purchaseReturn->voucher_no = 1;
			}
			$data['voucher_no'] = $purchaseReturn->voucher_no; */
			$data['transaction_date']=date('Y-m-d',strtotime(	$this->request->getData('transaction_date')));	
			$purchaseReturn = $this->PurchaseReturns->patchEntity($purchaseReturn, $data);
			
			if(!$id)
			{
				$purchaseReturn->created_by = $user_id;
				$purchaseReturn->session_year_id =$session_year_id;
			}
			else
			{
				$purchaseReturn->edited_by = $user_id;
			}
			
            if ($this->PurchaseReturns->save($purchaseReturn)) {
            	$this->PurchaseReturns->PurchaseReturnRows->Items->StockLedgers->deleteAll(['purchase_return_id' => $purchaseReturn->id]);
				foreach($purchaseReturn->purchase_return_rows as $purchase_return_rows){
				$stockLedger = $this->PurchaseReturns->PurchaseReturnRows->Items->StockLedgers->newEntity();
					
					$stockLedger->session_year_id = $purchaseReturn->session_year_id;
					$stockLedger->purchase_return_id = $purchaseReturn->id;
					$stockLedger->purchase_return_row_id = $purchase_return_rows->id;
					$stockLedger->item_id  = $purchase_return_rows->item_id; 
					$stockLedger->location_id = $purchase_return_rows->location_id; 
					$stockLedger->quantity = $purchase_return_rows->quantity; 
					$stockLedger->transaction_date = $purchaseReturn->transaction_date; 
					$stockLedger->status = 'Out';
					$stockLedger->created_by = $purchaseReturn->created_by;
					
					$this->PurchaseReturns->PurchaseReturnRows->Items->StockLedgers->save($stockLedger);
				}
                $this->Flash->success(__('The purchase return has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase return could not be saved. Please, try again.'));
        }
		
       $vendors = $this->PurchaseReturns->Vendors->find('list');
		$items = $this->PurchaseReturns->PurchaseReturnRows->Items->find()
					->where(['Items.is_deleted'=>'N'])
					->order(['Items.name'=>'ASC']);
	
		$option =[];
		foreach($items as $item)
		{
           $option[] =  [
                            'value'=>$item->id,
                            'text'=>$item->name,
                         ];
			
		}
		$locations = $this->PurchaseReturns->PurchaseReturnRows->Items->StockLedgers->Locations->find()
						->where(['Locations.is_deleted'=>'N'])
						->order(['Locations.name'=>'ASC']);
		
		$Dropdown =[];
		foreach($locations as $location)
		{
           $Dropdown[] =  [
                            'value'=>$location->id,
                            'text'=>$location->name,
							];
			
		}
		
        $sessionYears = $this->PurchaseReturns->SessionYears->find('list');
        $this->set(compact('purchaseReturn',  'grns', 'vendors', 'sessionYears','option','Dropdown'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Return id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
}
