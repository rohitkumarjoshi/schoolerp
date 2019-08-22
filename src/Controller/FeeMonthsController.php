<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FeeMonths Controller
 *
 * @property \App\Model\Table\FeeMonthsTable $FeeMonths
 *
 * @method \App\Model\Entity\FeeMonth[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeeMonthsController extends AppController
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
            $feeMonth = $this->FeeMonths->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $feeMonth = $this->FeeMonths->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $feeMonth = $this->FeeMonths->patchEntity($feeMonth, $this->request->getData());            
            if(!$id)
            {
                $feeMonth->created_by =$user_id;
                $feeMonth->session_year_id =$session_year_id;
            }
            else
            {
                $feeMonth->edited_by =$user_id;
            }
            $error='';
            
            try 
            {
              if($this->FeeMonths->save($feeMonth))
              {
                $this->Flash->success(__('The Month Name has been saved.'));
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
                $error_data='The Month Name could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
       
        $feeMonths = $this->paginate($this->FeeMonths,['limit'=>10]);
        
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('feeMonths', 'feeMonth','id','status'));
    }

   
}
