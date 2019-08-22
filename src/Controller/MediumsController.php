<?php
namespace App\Controller;

use App\Controller\AppController;
/**
 * Mediums Controller
 *
 * @property \App\Model\Table\MediumsTable $Mediums
 *
 * @method \App\Model\Entity\Medium[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediumsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $medium = $this->Mediums->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $medium = $this->Mediums->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $medium = $this->Mediums->patchEntity($medium, $this->request->getData());            
            if(!$id)
            {
                $medium->created_by =$user_id;
                $medium->session_year_id =$session_year_id;
            }
            else
            {
                $medium->edited_by =$user_id;
            }
            
            $error='';
            try 
            {
              if($this->Mediums->save($medium))
              {
                $this->Flash->success(__('The medium has been saved.'));
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
                 $error_data='The medium could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $mediums = $this->paginate($this->Mediums,['limit'=>10]);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('mediums','medium','id','status'));
    }

}
