<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\View;
use Cake\View\Helper\FormHelper;
/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions',['add','edit']);
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['ItemCategories', 'ItemSubcategories']
        ];
		
        $items = $this->paginate($this->Items);
		$ItemLists = $this->paginate($this->Items->find()->order(['Items.id'=>'ASC']));
        $this->set(compact('items','ItemLists'));
    }
    public function add($id=null)
    {
		$user_id = $this->Auth->User('id');
		$session_year_id = $this->Auth->User('session_year_id');
		$item = $this->Items->newEntity();
		
        if ($this->request->is(['post'])) {
			
			$items = $this->Items->patchEntities($item,$this->request->getData('items'));
			
			foreach($items as $item) {
			   $item->created_by = $user_id;
			}
			$error='';
            try 
            {
              if($this->Items->saveMany($items))
              {
                $this->Flash->success(__('The item has been saved.'));
                return $this->redirect(['action' => 'index']);
              }
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                 $error_data='The item could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
			
		}
		$this->paginate = [
            'contain' => ['ItemCategories','ItemSubcategories']
        ];
		
        $itemSubCategories = $this->Items->ItemSubcategories->find('list')
								->where(['ItemSubcategories.is_deleted'=>'N']);
						
        $itemCategories    = $this->Items->ItemCategories->find('list')
								->where(['ItemCategories.is_deleted'=>'N'])
								->order(['ItemCategories.id'=>'ASC']);
		$ItemLists = $this->paginate($this->Items->find()->order(['Items.id'=>'ASC']));
		
		$status = array('N'=>'Active','Y'=>'Deactive');
	
		$this->set(compact('item', 'itemCategories', 'itemSubCategories','id','ItemLists','status'));
    }
    public function childCategories()   
    {
        $itemSubcategories = $this->Items->ItemSubCategories->find();

        if(sizeof($itemSubcategories->toArray())>0)
        {
            $option = [];
            foreach($itemSubcategories as $itemSubcategorie)
            {
                $option[] = ['value'=>$itemSubcategorie->id,'text'=>$itemSubcategorie->name];
                
            }
        
        }
        
        $this->set(compact('itemSubcategories','option'));
    }
    public function getItemSubCategory()
    {
        $form = new FormHelper(new \Cake\View\View());
        $item_category_id=$this->request->getData('item_category_id');
        $success='1';
        $itemSubcategories = $this->Items->ItemSubCategories->find('list')->where(['item_category_id'=>$item_category_id]);
        $response=$form->control('item_subcategory_id',['options' =>$itemSubcategories,'label' => false,'class'=>'selectState','empty'=> 'Select...','name'=>'item_subcategory_id','required','style'=>'width:100%']);
        $this->set(compact('success','response'));
        $this->set('_serialize', ['success','response']);
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user_id = $this->Auth->User('id');
		if(!$id)
		{				
			return $this->redirect(['action' => 'index']);
		}
		$id = $this->EncryptingDecrypting->decryptData($id);
		$item = $this->Items->get($id, [
		'contain' => ['ItemCategories', 'ItemSubcategories']
		]);
		if ($this->request->is(['patch','post','put'])) {
			
			$items = $this->Items->patchEntity($item,$this->request->getData());
			$items->edited_by = $user_id;
			$error='';
            try 
            {
              if($this->Items->save($items))
              {
                $this->Flash->success(__('The item has been saved.'));
                return $this->redirect(['action' => 'index']);
              }
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                 $error_data='The item could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
			
		}
		$this->paginate = [
            'contain' => ['ItemCategories','ItemSubcategories']
        ];
		
        $itemSubCategories = $this->Items->ItemSubCategories->find('list')->where(['item_category_id'=>$item->item_category_id]);
								
        $itemCategories = $this->Items->ItemCategories->find('list')
								->order(['ItemCategories.id'=>'ASC']);
		$ItemLists = $this->paginate($this->Items->find()->order(['Items.id'=>'ASC']));
		
		$status = array('N'=>'Active','Y'=>'Deactive');
		$this->set(compact('item', 'itemCategories', 'itemSubCategories','id','ItemLists','status','items'));
    }
}
