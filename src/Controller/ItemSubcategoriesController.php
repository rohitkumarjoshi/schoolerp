<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemSubcategories Controller
 *
 * @property \App\Model\Table\ItemSubcategoriesTable $ItemSubcategories
 *
 * @method \App\Model\Entity\ItemSubcategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemSubcategoriesController extends AppController
{

    public function add($id=null)
    {
        $user_id = $this->Auth->User('id');
		if(!$id)
		{				
			$itemSubCategory = $this->ItemSubcategories->newEntity();
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$itemSubCategory = $this->ItemSubcategories->get($id, [
				'contain' => ['ItemCategories']
			]);
		} 
        if ($this->request->is(['patch','post','put'])){
            $itemSubCategory = $this->ItemSubcategories->patchEntity($itemSubCategory, $this->request->getData());
			if(!$id)
			{
				$itemSubCategory->created_by = $user_id;
			}
			else
			{
				$itemSubCategory->edited_by	 = $user_id;
			}
			$error='';
            try 
            {
              if($this->ItemSubcategories->save($itemSubCategory))
              {
                $this->Flash->success(__('The item sub category has been saved.'));
                return $this->redirect(['action' => 'add']);
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
                 $error_data='The item category could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
			
            
        }
		$this->paginate = [
            'contain' => ['ItemCategories']
        ];
		
     
        $itemCategories = $this->ItemSubcategories->ItemCategories->find('list')
						->where(['OR'=>['ItemCategories.is_deleted'=>'N','ItemCategories.id'=>$itemSubCategory->item_category_id]]);
			
		
		$ItemSubCategoriesLists = $this->paginate($this->ItemSubcategories->find()->order(['ItemSubcategories.id'=>'ASC']));
		$status = array('N'=>'Active','Y'=>'Deactive');
		$this->set(compact('itemSubCategory', 'itemCategories','id','ItemSubCategoriesLists','status'));
    
	}

}
