<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{
    public function taskList($id=null)
    {
        $user_id = $this->request->getData('user_id'); 
        $user_type = $this->request->getData('user_type');
        $page = $this->request->getData('page');
        $currentSession = $this->AwsFile->currentSession();
        
        $tasksData = $this->Tasks->find()->where(['Tasks.is_deleted'=>'N'])->contain(['Employees','Students']);
        if($user_type=='Employee'){
            $tasksData->where(['Tasks.employee_id'=> $user_id]);
        }
        else if($user_type=='Student'){
            $tasksData->where(['Tasks.student_id'=> $user_id]);
        }
        $tasksData->limit(10)->page($page);

        if($tasksData->count()>0){
            $success=true;
            $message='';
            $taskLists=$tasksData;
        }else{
            $success=false;
            $message="No data found";
            $taskLists=array();
        }
        $this->set(compact('success', 'message', 'taskLists'));
        $this->set('_serialize', ['success', 'message', 'taskLists']);  
    }

}
