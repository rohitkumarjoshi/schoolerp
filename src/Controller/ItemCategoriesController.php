<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemCategories Controller
 *
 * @property \App\Model\Table\ItemCategoriesTable $ItemCategories
 *
 * @method \App\Model\Entity\ItemCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemCategoriesController extends AppController
{

    public function add($id=null)
    {
		$user_id = $this->Auth->User('id');
		if(!$id)
		{
			$itemCategory = $this->ItemCategories->newEntity();
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$itemCategory = $this->ItemCategories->get($id, [
			'contain' => ['ItemSubcategories','Items'] ]);
		}
       if ($this->request->is(['patch', 'post', 'put'])) {
            $itemCategory = $this->ItemCategories->patchEntity($itemCategory, $this->request->getData());
		   if(!$id)
		   {
			   $itemCategory->created_by =$user_id;
		   }
		   else
		   {
			   $itemCategory->edited_by = $user_id;
		   }
			$error='';
            try 
            {
              if($this->ItemCategories->save($itemCategory))
              {
                $this->Flash->success(__('The item category has been saved.'));
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
		
		$itemCategories = $this->ItemCategories->find();
		$status = array('N'=>'Active','Y'=>'Deactive');
		
		$this->set(compact('itemCategory','itemCategories','id','status'));
    }

}
