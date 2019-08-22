<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Locations Controller
 *
 * @property \App\Model\Table\LocationsTable $Locations
 *
 * @method \App\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LocationsController extends AppController
{

    public function add($id=null)
    {
		$user_id = $this->Auth->User('id');
		if(!$id)
		{
			$location = $this->Locations->newEntity();
			
		}
		else
		{
				$id = $this->EncryptingDecrypting->decryptData($id);
				$location = $this->Locations->get($id, [
					'contain' => ['StockLedgers']
				]);
		}
       if ($this->request->is(['patch', 'post', 'put'])) {	
			$location = $this->Locations->patchEntity($location, $this->request->getData());
			if(!$id)
		   {
			   $location->created_by =$user_id;
		   }
		   else
		   {
			   $location->edited_by = $user_id;
		   }
			$error='';
            try 
            {
              if($this->Locations->save($location))
              {
                $this->Flash->success(__('The location has been saved.'));
                return $this->redirect(['action' => 'add']);
              }
            } 
			catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if(strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                 $error_data='The location could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
			
		}
		$locations = $this->paginate($this->Locations);	
		$status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('location','locations','id','status'));
    }

    
}
