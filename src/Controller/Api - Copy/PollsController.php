<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
/**
 * Polls Controller
 *
 * @property \App\Model\Table\PollsTable $Polls
 *
 * @method \App\Model\Entity\Poll[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PollsController extends AppController
{
    public function pollList()
    {
        $user_id = $this->request->getData('user_id'); 
        $user_type = $this->request->getData('user_type'); 
        $currentSession = $this->AwsFile->currentSession();
        $field_name='PollResults.student_id';
        if($user_type=='Employee'){
            $field_name='PollResults.employee_id';
        } 
        $where=[];
        if($user_type=='Employee'){
            $where['Polls.poll_type !=']='Student';
        }
        if($user_type=='Student'){
            $where['Polls.poll_type !=']='Teacher'; 
        }
        $polls = $this->Polls->find()->contain(['PollRows'])
                ->notMatching('PollResults', function ($q)use($user_id,$field_name) {
                    return $q->where([$field_name => $user_id]);
                })
                ->where(['Polls.is_deleted'=>'N',$where,'Polls.session_year_id'=>$currentSession])
                ->order(['Polls.id'=>'DESC'])->first();
        if($polls){
            $success=true;
            $message=''; 
        }else{
            $success=false;
            $message="No data found";
            $polls=array();
        }
        $this->set(compact('success', 'message', 'polls'));
        $this->set('_serialize', ['success', 'message', 'polls']);    
    } 

    public function submitAnswer()
    {
        $poll_id = $this->request->getData('poll_id'); 
        $poll_row_id = $this->request->getData('poll_row_id'); 
        $user_id = $this->request->getData('user_id'); 
        $user_type = $this->request->getData('user_type');   
        $currentSession = $this->AwsFile->currentSession();

        $pollResults = $this->Polls->PollResults->newEntity();
        $pollResults = $this->Polls->PollResults->patchEntity($pollResults, $this->request->getData());
        if($user_type=='Employee'){
            $pollResults->employee_id=$user_id;
        }
        if($user_type=='Student'){
            $pollResults->student_id=$user_id; 
        }
        $pollResults->created_by=$user_id;
        $error='';
        try 
        {
            if ($this->Polls->PollResults->save($pollResults)) {
                $success=true;
                $message='successfully Submitted';
            }
        }
        catch (\Exception $e) {
           $error = $e->getMessage();
        }
        if (strpos($error, '1062') !== false) 
        {
            $success=false;
            $message='Duplicate entry. Please, try again.';
        }
        else
        {
            $success=true;
            $message='successfully Submitted';
        } 

        $this->set(compact('success', 'message'));
        $this->set('_serialize', ['success', 'message']);      
    }
}
