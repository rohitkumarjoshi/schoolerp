<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HostelRoomAssets Controller
 *
 * @property \App\Model\Table\HostelRoomAssetsTable $HostelRoomAssets
 *
 * @method \App\Model\Entity\HostelRoomAsset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HostelRoomAssetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
     public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        if(!$id)
        {
            $HostelRoomAsset = $this->HostelRoomAssets->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $HostelRoomAsset = $this->HostelRoomAssets->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $HostelRoomAsset = $this->HostelRoomAssets->patchEntity($HostelRoomAsset, $this->request->getData());            
            if(!$id)
            {
                $HostelRoomAsset->created_by =$user_id;
            }
            else
            {
                $HostelRoomAsset->edited_by =$user_id;
            }
            
            $error='';
            try 
            {
              if($this->HostelRoomAssets->save($HostelRoomAsset))
              {
                $this->Flash->success(__('The Room Asset has been saved.'));
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
                $error_data='The Room Asset could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $HostelRoomAssets = $this->paginate($this->HostelRoomAssets,['limit'=>10]);
        $option = array('Yes'=>'Yes','No'=>'No');  
        $status = array('N'=>'Active','Y'=>'Deactive');  
        $this->set(compact('HostelRoomAsset','HostelRoomAssets','id','status','option'));
    }
}
