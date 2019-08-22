<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * Complaints Controller
 *
 * @property \App\Model\Table\ComplaintsTable $Complaints
 *
 * @method \App\Model\Entity\Complaint[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComplaintsController extends AppController
{
    public function addComplaint()
    {
        $user_id = $this->request->getData('user_id');
        $session_year_id = $this->AwsFile->currentSession();
        $user_type   = $this->request->getData('user_type');
        $complaint = $this->Complaints->newEntity();
        
        $complaint = $this->Complaints->patchEntity($complaint, $this->request->getData());
        if($user_type=='Employee') {
             $complaint->employee_id =$user_id;
        }else{
            $complaint->student_id =$user_id;
        }
        $complaint->created_by =$user_id;
        $complaint->status ='Pending';
        $complaint->session_year_id =$session_year_id;
         
        if ($this->Complaints->save($complaint))
        {
            $success=true;
            $message='The complaint has been saved.';
             
        }else{
            $success=false;
            $message="Something went wrong."; 
        }
        $this->set(compact('success', 'message'));
        $this->set('_serialize', ['success', 'message']);    
    }
}
