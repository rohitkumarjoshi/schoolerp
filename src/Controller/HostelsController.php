<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Hostels Controller
 *
 * @property \App\Model\Table\HostelsTable $Hostels
 *
 * @method \App\Model\Entity\Hostel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HostelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
    	$user_id = $this->Auth->User('id');
        $this->paginate = [
            'contain' => ['Wardens', 'AssistantWardens']
        ];
        if(!$id)
        {
            $hostel = $this->Hostels->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $hostel = $this->Hostels->get($id, [
            'contain' => []
            ]);
        }
        if ($this->request->is(['post','put']))
         {
          	$hostel = $this->Hostels->patchEntity($hostel, $this->request->getData());
	         if(!$id)
	        {
	            $hostel->created_by =$user_id;
	        }
	        else
	        {
	            $hostel->edited_by =$user_id;
	        }
	        
            $error='';
            try 
            {
              if($this->Hostels->save($hostel))
              {
                $this->Flash->success(__('The hostel has been saved.'));
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
                $error_data='The hostel could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $gg=$this->Hostels->find()->contain(['Wardens', 'AssistantWardens']);
        //pr($gg->toArray()); exit;
        $hostels = $this->paginate($this->Hostels);
        
        $wardens = $this->Hostels->Wardens->find('list');
        $assistantWardens = $this->Hostels->AssistantWardens->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('hostel','hostels','status','wardens','assistantWardens','id'));
    }
}
