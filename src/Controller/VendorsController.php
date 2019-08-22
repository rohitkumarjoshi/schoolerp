<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vendors Controller
 *
 * @property \App\Model\Table\VendorsTable $Vendors
 *
 * @method \App\Model\Entity\Vendor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VendorsController extends AppController
{

    
    public function add($id=null)
    {

		$user_id = $this->Auth->User('id');
			if(!$id){
			  $vendor = $this->Vendors->newEntity();
			 
		      }
		  else
            {
                $id = $this->EncryptingDecrypting->decryptData($id);
                $vendor = $this->Vendors->get($id, [
                'contain' => []
			     ]);
			}
         if ($this->request->is(['patch', 'post', 'put'])){
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->getData());
            if(!$id)
            {
                $vendor->created_by =$user_id;
            }
            else
            {
                $vendor->edited_by =$user_id;
            }
            $error='';
            try 
            {
                if ($this->Vendors->save($vendor)) {
                    $this->Flash->success(__('The vendor has been saved.'));
                    return $this->redirect(['action' => 'add']);
                }
            }catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The vendor could not be saved. Please, try again.';
            }
            //pr($studentRedDiary);exit;
            $this->Flash->error(__($error_data));
        }

		$vendors = $this->paginate($this->Vendors);
        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('vendor','vendors','id','status'));

    }

}
