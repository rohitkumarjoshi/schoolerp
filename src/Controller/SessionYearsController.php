<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SessionYears Controller
 *
 * @property \App\Model\Table\SessionYearsTable $SessionYears
 *
 * @method \App\Model\Entity\SessionYear[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SessionYearsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
   
    public function changeSessionYear()
    {
        $sessionYear = $this->SessionYears->newEntity();
        if ($this->request->is('post')) {
                $session_year_id=$this->request->getData('session_year_id');
                $sessionYearName = $this->SessionYears->get($session_year_id);
                $this->Auth->user()->session_year_id = $session_year_id;
                $this->Auth->user()->session_name = $sessionYearName->session_name ;
                $this->Flash->success(__('The session year has been changed.'));
                return $this->redirect(['controller'=>'Students','action' => 'index']);
        }
        $sessionYears = $this->SessionYears->find('list');
        $this->set(compact('sessionYears','sessionYear'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        if(!$id){
            $sessionYear = $this->SessionYears->newEntity();
        }
        else{
             $id = $this->EncryptingDecrypting->decryptData($id);
             $sessionYear = $this->SessionYears->get($id, [
            'contain' => []
            ]);
            } 
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $sessionYear =  $this->SessionYears->patchEntity($sessionYear, $this->request->getData());
            if(!$id)
            {
                $sessionYear->created_by =$user_id;
            }
            else
            {
                $sessionYear->edited_by =$user_id;
            }
            $sessionYear->from_date=date('Y-m-d',strtotime($this->request->getData('from_date')));
            $sessionYear->to_date=date('Y-m-d',strtotime($this->request->getData('to_date')));
            $error='';
            try 
            {
                if ($this->SessionYears->save($sessionYear)) {
                    if($sessionYear->status=="Active")
                    {
                        $this->SessionYears->updateAll(
                            [ 
                                'status' => 'Deactive'
                            ],
                            [
                                'status' => 'Active'
                            ]
                        );
                        $query = $this->SessionYears->query();
                        $query->update()
                        ->set([
                            'status' => 'Active'       
                        ])
                        ->where(['id' => $sessionYear->id])
                        ->execute();
                    }
                    
                
                    $this->Flash->success(__('The session year has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                pr($sessionYear); exit;
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                 $error_data='The session year could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $status[]=['value'=>'Active','text'=>'Active'];
        $status[]=['value'=>'Deactive','text'=>'Deactive'];
        $sessionYears = $this->SessionYears->find();
        $this->set(compact('sessionYears','sessionYear','status','id'));
    }
}
