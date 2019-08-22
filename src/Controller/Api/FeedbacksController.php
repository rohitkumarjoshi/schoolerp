<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * Feedbacks Controller
 *
 * @property \App\Model\Table\FeedbacksTable $Feedbacks
 *
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedbacksController extends AppController
{   
    public function addFeedback()
    {
        $user_id = $this->request->getData('user_id');
        $session_year_id = $this->AwsFile->currentSession();
        $user_type   = $this->request->getData('user_type');

        $feedback = $this->Feedbacks->newEntity();
        $feedback = $this->Feedbacks->patchEntity($feedback, $this->request->getData());
        $feedback->created_by =$user_id;
        $feedback->session_year_id =$session_year_id;
        if($user_type=='Employee') {
            $feedback->employee_id =$user_id;
        }else if($user_type=='Student'){
            $feedback->student_id =$user_id;
        }
        else{}
        if ($this->Feedbacks->save($feedback)){
            $success=true;
            $message='The feedback has been saved.';
        }else{
            $success=false;
            $message="Something went wrong."; 
        }
        $this->set(compact('success', 'message'));
        $this->set('_serialize', ['success', 'message']);  
    } 
}
