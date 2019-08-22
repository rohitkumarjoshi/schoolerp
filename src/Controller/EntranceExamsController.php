<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EntranceExams Controller
 *
 * @property \App\Model\Table\EntranceExamsTable $EntranceExams
 *
 * @method \App\Model\Entity\EntranceExam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EntranceExamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    /*public function index()
    {
        $this->paginate = [
            'contain' => ['SessionYears']
        ];
        $entranceExams = $this->paginate($this->EntranceExams);

        $this->set(compact('entranceExams'));
    }*/
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id=$this->Auth->User('session_year_id');
        if(!$id){
            $entranceExam = $this->EntranceExams->newEntity();
        }
        else{
             $id = $this->EncryptingDecrypting->decryptData($id);
             $entranceExam = $this->EntranceExams->get($id, [
            'contain' => []
            ]);
            } 
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $entranceExam =  $this->EntranceExams->patchEntity($entranceExam, $this->request->getData());
            if(!$id)
            {
                $entranceExam->created_by =$user_id;
                $entranceExam->session_year_id =$session_year_id;
            }
            else{
                $entranceExam->edited_by =$user_id;
            }
            $error='';
            try 
            {
                if ($this->EntranceExams->save($entranceExam)) {
                    $this->Flash->success(__('The subject has been saved.'));
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
                 $error_data='The entranceExam could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $status[]=['value'=>'N','text'=>'Active'];
        $status[]=['value'=>'Y','text'=>'Deactive'];
        $this->paginate = [
            'contain' => ['SessionYears'],
            'conditions'=>['EntranceExams.session_year_id'=>$session_year_id]
        ];
        $entranceExams = $this->paginate($this->EntranceExams->find()->order(['EntranceExams.id'=>'ASC']),['limit'=>20]);
        $this->set(compact('entranceExam','id','entranceExams','status'));
    }

    
}
