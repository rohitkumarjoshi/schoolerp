<?php
namespace App\Controller;

use App\Controller\AppController;
use  Cake\Event\Event;

/**
 * ItemIssueReturns Controller
 *
 * @property \App\Model\Table\ItemIssueReturnsTable $ItemIssueReturns
 *
 * @method \App\Model\Entity\ItemIssueReturn[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemIssueReturnsController extends AppController
{

    public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Security->setConfig('unlockedActions',['itmeIssue','itemReturn','editIssue','editReturn']); 
	}
	 
	 
    public function index()
    {
        $this->paginate = [
            'contain' => ['SessionYears', 'Students', 'Employees']
        ];
        $itemIssueReturns = $this->paginate($this->ItemIssueReturns);

        $this->set(compact('itemIssueReturns'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Issue Return id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemIssueReturn = $this->ItemIssueReturns->get($id, [
            'contain' => ['SessionYears', 'Students', 'Employees', 'ItemIssueReturnRows']
        ]);
		
        $this->set('itemIssueReturn', $itemIssueReturn);
    }

	
	
	
	public function indexIssue()
	{
        $this->paginate = [
            'contain' => ['SessionYears', 'Students', 'Employees','ItemIssueReturnRows'=>['Items']]
        ];
        $itemIssues = $this->paginate($this->ItemIssueReturns->find()->order(['ItemIssueReturns.id'=>'ASC'])->where(['ItemIssueReturns.status'=>'Issue']));
		
		$this->set(compact('itemIssues'));
    }
   
    
	public function itmeIssue()
	{
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		$itemIssue = $this->ItemIssueReturns->newEntity();
	
       if ($this->request->is(['patch','post','put'])){
			$data = $this->request->getData();
			$data['transaction_date']= date('Y-m-d',strtotime($this->request
										->getData('transaction_date')));
            $itemIssue= $this->ItemIssueReturns->patchEntity($itemIssue, $data);
			
			$itemIssue->status = 'Issue';
			$itemIssue->created_by = $user_id;
			$itemIssue->session_year_id =$session_year_id;
            if ($this->ItemIssueReturns->save($itemIssue)) {
				foreach($itemIssue->item_issue_return_rows as $item_issue_return_rows){
				
				$stockLedger = $this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->newEntity();
				$stockLedger->session_year_id = $itemIssue->session_year_id;
				$stockLedger->item_issue_return_id = $itemIssue->id;
				$stockLedger->item_issue_return_row_id = $item_issue_return_rows->id;
				$stockLedger->item_id  = $item_issue_return_rows->item_id; 
				$stockLedger->location_id = $item_issue_return_rows->location_id;
				$stockLedger->quantity = $item_issue_return_rows->quantity; 
				$stockLedger->transaction_date = $itemIssue->transaction_date; 
				$stockLedger->status = 'Out';
				$stockLedger->created_by = $itemIssue->created_by;
				
				$this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->save($stockLedger);
			}
				
                $this->Flash->success(__('The item issue  has been saved.'));

                return $this->redirect(['action' => 'index_issue']);
            }
            $this->Flash->error(__('The item issue  could not be saved. Please, try again.'));
        }

        $sessionYears = $this->ItemIssueReturns->SessionYears->find('list');
        $students = $this->ItemIssueReturns->Students->find('list');
		
        $employees = $this->ItemIssueReturns->Employees->find('list');
		$items = $this->ItemIssueReturns->ItemIssueReturnRows->Items->find()
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
		$locations = $this->ItemIssueReturns->ItemIssueReturnRows->Locations->find()
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
        $this->set(compact('itemIssue', 'sessionYears', 'students', 'employees','option','Dropdown'));
		
	}
	public function editIssue($id=null)
	{
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		if(!$id)
		{				
			$itemIssue = $this->ItemIssueReturns->newEntity();
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$itemIssue = $this->ItemIssueReturns->get($id, ['contain' => ['ItemIssueReturnRows']]);
		} 
		if ($this->request->is(['patch','post','put'])){
			$data = $this->request->getData();
			$data['transaction_date']= date('Y-m-d',strtotime($this->request
										->getData('transaction_date')));
            $itemIssue = $this->ItemIssueReturns->patchEntity($itemIssue, $data);
			$itemIssue->status = 'Issue';
			$itemIssue->edited_by = $user_id;
			$itemIssue->created_by = $user_id;
			$itemIssue->session_year_id =$session_year_id;
			
            if ($this->ItemIssueReturns->save($itemIssue)) {	
				$this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->deleteAll(['item_issue_return_id' => $itemIssue->id]);
				foreach($itemIssue->item_issue_return_rows as $item_issue_return_rows){
				
				$stockLedger = $this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->newEntity();
					$stockLedger->session_year_id = $itemIssue->session_year_id;
					$stockLedger->item_issue_return_id = $itemIssue->id;
					$stockLedger->item_issue_return_row_id = $item_issue_return_rows->id;
					$stockLedger->item_id  = $item_issue_return_rows->item_id; 
					$stockLedger->location_id = $item_issue_return_rows->location_id;
					$stockLedger->quantity = $item_issue_return_rows->quantity; 
					$stockLedger->transaction_date = $itemIssue->transaction_date; 
					$stockLedger->status = 'Out';
					$stockLedger->created_by = $itemIssue->created_by;
					
					$this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->save($stockLedger);
			}
				
                $this->Flash->success(__('The item issue  has been updated.'));

                return $this->redirect(['action' => 'index_issue']);
            }
            $this->Flash->error(__('The item issue  could not be saved. Please, try again.'));
        }

        $sessionYears = $this->ItemIssueReturns->SessionYears->find('list');
        $students = $this->ItemIssueReturns->Students->find('list');
		
        $employees = $this->ItemIssueReturns->Employees->find('list');
		$items = $this->ItemIssueReturns->ItemIssueReturnRows->Items->find()
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
		$locations = $this->ItemIssueReturns->ItemIssueReturnRows->Locations->find()
						->order(['Locations.name'=>'ASC']);
				
		$Dropdown =[];
		foreach($locations as $location)
		{
           $Dropdown[] =  [
                            'value'=>$location->id,
                            'text'=>$location->name,
						];
			
		}
        $this->set(compact('itemIssue', 'sessionYears', 'students', 'employees','option','Dropdown'));
		
	}
	public function itemReturn()
	{
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		$itemReturn = $this->ItemIssueReturns->newEntity();
		
       if ($this->request->is(['patch','post','put'])){
		   $data = $this->request->getData();
			$data['transaction_date']= date('Y-m-d',strtotime($this->request
										->getData('transaction_date')));
            $itemReturn= $this->ItemIssueReturns->patchEntity($itemReturn,  $data);
			$itemReturn->status = 'Return';
			$itemReturn->created_by = $user_id;
			$itemReturn->session_year_id =$session_year_id;
            if ($this->ItemIssueReturns->save($itemReturn)) {
				foreach($itemReturn->item_issue_return_rows as $item_issue_return_rows){
				
				$stockLedger = $this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->newEntity();
					$stockLedger->session_year_id = $itemReturn->session_year_id;
					$stockLedger->item_issue_return_id = $itemReturn->id;
					$stockLedger->item_issue_return_row_id = $item_issue_return_rows->id;
					$stockLedger->item_id  = $item_issue_return_rows->item_id; 
					$stockLedger->location_id = $item_issue_return_rows->location_id;
					$stockLedger->quantity = $item_issue_return_rows->quantity; 
					$stockLedger->transaction_date = $itemReturn->transaction_date; 
					$stockLedger->status = 'In';
					$stockLedger->created_by = $itemReturn->created_by;
					
					$this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->save($stockLedger);
			}
				
				
				$this->Flash->success(__('The item  return has been saved.'));


                return $this->redirect(['action' => 'index_return']);
            }
            $this->Flash->error(__('The item  return could not be saved. Please, try again.'));
        }
        $sessionYears = $this->ItemIssueReturns->SessionYears->find('list');
        $students = $this->ItemIssueReturns->Students->find('list');
		
        $employees = $this->ItemIssueReturns->Employees->find('list');
		$items = $this->ItemIssueReturns->ItemIssueReturnRows->Items->find()
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
		$locations = $this->ItemIssueReturns->ItemIssueReturnRows->Locations->find()
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
        $this->set(compact('itemReturn', 'sessionYears', 'students', 'employees','option','Dropdown'));
		
	}
	
	public function editReturn($id=null)
	{
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		if(!$id)
		{				
			$itemReturn = $this->ItemIssueReturns->newEntity();
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$itemReturn = $this->ItemIssueReturns->get($id, ['contain' => ['ItemIssueReturnRows']]);
		} 
		if ($this->request->is(['patch','post','put'])){
			$data = $this->request->getData();
			$data['transaction_date']= date('Y-m-d',strtotime($this->request
										->getData('transaction_date')));
            $itemReturn = $this->ItemIssueReturns->patchEntity($itemReturn, $data);
			
			$itemReturn->status = 'Return';
			
			$itemReturn->created_by = $user_id;
			$itemReturn->session_year_id =$session_year_id;
			
            if ($this->ItemIssueReturns->save($itemReturn)) {
            	$this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->deleteAll(['item_issue_return_id' => $itemReturn->id]);
				foreach($itemReturn->item_issue_return_rows as $item_issue_return_rows){
				
				$stockLedger = $this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->newEntity();
					$stockLedger->session_year_id = $itemReturn->session_year_id;
					$stockLedger->item_issue_return_id = $itemReturn->id;
					$stockLedger->item_issue_return_row_id = $item_issue_return_rows->id;
					$stockLedger->item_id  = $item_issue_return_rows->item_id; 
					$stockLedger->location_id = $item_issue_return_rows->location_id;
					$stockLedger->quantity = $item_issue_return_rows->quantity; 
					$stockLedger->transaction_date = $itemReturn->transaction_date; 
					$stockLedger->status = 'In';
					$stockLedger->created_by = $itemReturn->created_by;
					
					$this->ItemIssueReturns->ItemIssueReturnRows->Items->StockLedgers->save($stockLedger);
			}
				
                $this->Flash->success(__('The item return has been updated.'));

                return $this->redirect(['action' => 'indexReturn']);
            }
            $this->Flash->error(__('The item issue  could not be saved. Please, try again.'));
        }

        $sessionYears = $this->ItemIssueReturns->SessionYears->find('list');
        $students = $this->ItemIssueReturns->Students->find('list');
		
        $employees = $this->ItemIssueReturns->Employees->find('list');
		$items = $this->ItemIssueReturns->ItemIssueReturnRows->Items->find()
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
		$locations = $this->ItemIssueReturns->ItemIssueReturnRows->Locations->find()
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
        $this->set(compact('itemReturn', 'sessionYears', 'students', 'employees','option','Dropdown'));
		
	}
	
	
	public function  indexReturn()
	{
		$this->paginate = [
            'contain' => ['SessionYears', 'Students', 'Employees','ItemIssueReturnRows'=>['Items']]
        ];
        $itemReturns = $this->paginate($this->ItemIssueReturns->find()->order(['ItemIssueReturns.id'=>'ASC'])->where(['ItemIssueReturns.status'=>'Return']));
			
        $this->set(compact('itemReturns'));
	}
    /**
     * Edit method
     *
     * @param string|null $id Item Issue Return id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*public function edit($id = null)
    {
        $itemIssueReturn = $this->ItemIssueReturns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemIssueReturn = $this->ItemIssueReturns->patchEntity($itemIssueReturn, $this->request->getData());
            if ($this->ItemIssueReturns->save($itemIssueReturn)) {
                $this->Flash->success(__('The item issue return has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item issue return could not be saved. Please, try again.'));
        }
		$items = $this->ItemIssueReturns->Items->find('list');
        $sessionYears = $this->ItemIssueReturns->SessionYears->find('list');
        $students = $this->ItemIssueReturns->Students->find('list');
        $employees = $this->ItemIssueReturns->Employees->find('list');
        $this->set(compact('itemIssueReturn', 'sessionYears', 'students', 'employees'));

    }*/

    
   /* public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemIssueReturn = $this->ItemIssueReturns->get($id);
        if ($this->ItemIssueReturns->delete($itemIssueReturn)) {
            $this->Flash->success(__('The item issue return has been deleted.'));
        } else {
            $this->Flash->error(__('The item issue return could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
