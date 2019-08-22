<?php
namespace App\Controller;

use App\Controller\AppController;
use  Cake\Event\Event;
/**
 * Grns Controller
 *
 * @property \App\Model\Table\GrnsTable $Grns
 *
 * @method \App\Model\Entity\Grn[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GrnsController extends AppController
{
    public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Security->setConfig('unlockedActions',['add','edit']); 
	}	
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vendors']
        ];
        $grns = $this->paginate($this->Grns->find()->order(['Grns.id'=>'ASC']));
		
        $this->set(compact('grns'));
    }

    /**
     * View method
     *
     * @param string|null $id Grn id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$id = $this->EncryptingDecrypting->decryptData($id); 
		$grnsLists  =  $this->Grns->get($id,[
			'contain'=>['Vendors','GrnRows'=>['Items']]
		]);
		
		
        $this->set(compact('grnsLists'));
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
		
		$grn = $this->Grns->newEntity();
		 if ($this->request->is(['patch','post','put'])) {
			$data = $this->request->getData();
			$last_grn_no = $this->Grns->find()->select(['grn_no'])
								->order(['grn_no'=>'DESC'])->first();
			
			if($last_grn_no){
			$grn->grn_no = $last_grn_no->grn_no+1;
				
			}else{
				$grn->grn_no = 1;
			}
			$data['grn_no'] = $grn->grn_no; 
			$data['transaction_date']=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
			$grn = $this->Grns->patchEntity($grn, $data);
			
			$grn->created_by  	= $user_id;
			$grn->edited_on		= $user_id;
			
			$grn->session_year_id =$session_year_id;
			if ($this->Grns->save($grn)) { 
			
				foreach($grn->grn_rows as $grn_rows){
					$stockLedger = $this->Grns->GrnRows->Items->StockLedgers->newEntity();
					
					$stockLedger->session_year_id = $grn->session_year_id;
					$stockLedger->grn_id = $grn->id;
					$stockLedger->grn_row_id = $grn_rows->id; 
					$stockLedger->item_id  = $grn_rows->item_id; 
					$stockLedger->location_id = $grn_rows->location_id; 
					$stockLedger->quantity = $grn_rows->quantity; 
					$stockLedger->transaction_date = $grn->transaction_date; 
					$stockLedger->status = 'In';
					$stockLedger->created_by = $grn->created_by;
					
					$this->Grns->GrnRows->Items->StockLedgers->save($stockLedger);
				}
				$this->Flash->success(__('The stock-in voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock-in voucher could not be saved. Please, try again.'));
        }
		

        $Vendors = $this->Grns->Vendors->find('list');
		$items = $this->Grns->GrnRows->Items->find()
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
		$locations = $this->Grns->GrnRows->Items->StockLedgers->Locations->find()
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
								
        $this->set(compact('grn', 'purchaseOrders','Vendors','option','Dropdown'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Grn id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id=null)
    {
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		if(!$id)
		{				
			$grn = $this->Grns->newEntity();
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$grn = $this->Grns->get($id, ['contain' => ['GrnRows']]);
		} 
	   
		
		if ($this->request->is(['patch','post','put'])) {
			$data = $this->request->getData();
			/*$last_grn_no = $this->Grns->find()->select(['grn_no'])
								->order(['grn_no'=>'DESC'])->first();
			
			if($last_grn_no){
			$grn->grn_no = $last_grn_no->grn_no+1;
				
			}else{
				$grn->grn_no = 1;
			}
			$data['grn_no'] = $grn->grn_no; */
			$data['transaction_date']=date('Y-m-d',strtotime($this->request->getData('transaction_date')));
			$grn = $this->Grns->patchEntity($grn, $data);
			
			if(!$id)
			{
				$grn->created_by = $user_id;
				$grn->session_year_id =$session_year_id;
			}
			else
			{
				$grn->edited_by = $user_id;
			}
			
			if ($this->Grns->save($grn)) { 
				$this->Grns->GrnRows->Items->StockLedgers->deleteAll(['grn_id' => $grn->id]);
				foreach($grn->grn_rows as $grn_rows){
					$stockLedger = $this->Grns->GrnRows->Items->StockLedgers->newEntity();
					$stockLedger->session_year_id = $grn->session_year_id;
					$stockLedger->grn_id = $grn->id;
					$stockLedger->grn_row_id = $grn_rows->id; 
					$stockLedger->item_id = $grn_rows->item_id; 
					$stockLedger->location_id = $grn_rows->location_id; 
					$stockLedger->quantity = $grn_rows->quantity; 
					$stockLedger->transaction_date = $grn->transaction_date; 
					$stockLedger->status = 'In';
					$stockLedger->created_by = $grn->created_by;
					$this->Grns->GrnRows->Items->StockLedgers->save($stockLedger);
				}
				$this->Flash->success(__('The stock-in voucher has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock-in voucher could not be saved. Please, try again.'));
        }
		

        $Vendors = $this->Grns->Vendors->find('list');
		$items = $this->Grns->GrnRows->Items->find()
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
		$locations = $this->Grns->GrnRows->Items->StockLedgers->Locations->find()
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
								
        $this->set(compact('grn', 'purchaseOrders','Vendors','option','Dropdown'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Grn id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
}
