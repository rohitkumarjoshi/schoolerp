<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
/**
 * TimeTablePeriods Controller
 *
 * @property \App\Model\Table\TimeTablePeriodsTable $TimeTablePeriods
 *
 * @method \App\Model\Entity\TimeTablePeriod[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimeTablePeriodsController extends AppController
{ 
    public function timeTable()
    { 
        $user_id = $this->request->getData('user_id'); 
        $user_type = $this->request->getData('user_type'); 
        $currentSession = $this->AwsFile->currentSession();
         
        if($user_type=='Employee'){
           $monday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where(['TimeTablePeriods.employee_id'=>$user_id,'TimeTablePeriods.day'=>'Monday']);

            $tuesday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where(['TimeTablePeriods.employee_id'=>$user_id,'TimeTablePeriods.day'=>'Tuesday']);

            $wednesday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where(['TimeTablePeriods.employee_id'=>$user_id,'TimeTablePeriods.day'=>'Wednesday']);

            $thursday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where(['TimeTablePeriods.employee_id'=>$user_id,'TimeTablePeriods.day'=>'Thursday']);

            $friday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where(['TimeTablePeriods.employee_id'=>$user_id,'TimeTablePeriods.day'=>'Friday']);

            $saturday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where(['TimeTablePeriods.employee_id'=>$user_id,'TimeTablePeriods.day'=>'Saturday']);
        }
        if($user_type=='Student'){
            $studentinfo = $this->TimeTablePeriods->StudentInfos->find()
                ->where(['StudentInfos.student_id'=>$user_id,'StudentInfos.session_year_id'=>$currentSession])->first();
            $medium_id = $studentinfo->medium_id;  
            $student_class_id = $studentinfo->student_class_id;  
            $stream_id = $studentinfo->stream_id;  
            $section_id = $studentinfo->section_id; 
            if(!empty($medium_id)){
                $condition['TimeTablePeriods.medium_id']= $medium_id;
            }
            else{ 
                //$condition['TimeTablePeriods.medium_id IS NULL'];
            }

            if(!empty($section_id)){  
                $condition['TimeTablePeriods.section_id']= $section_id;
            }
            else{ 
                //$condition['TimeTablePeriods.section_id IS NULL'=>];
            }
 
            if(!empty($student_class_id)){  
                $condition['TimeTablePeriods.student_class_id']= $student_class_id;
            }
            else{ 
                //$condition['TimeTablePeriods.student_class_id IS NULL'];
            }

            if(!empty($stream_id))
            { 
                $condition['TimeTablePeriods.stream_id']= $stream_id;
            }
            else{ 
                //$condition['TimeTablePeriods.stream_id IS NULL'];
            }
            
            $monday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where([$condition,'TimeTablePeriods.day'=>'Monday']);

            $tuesday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where([$condition,'TimeTablePeriods.day'=>'Tuesday']);

            $wednesday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where([$condition,'TimeTablePeriods.day'=>'Wednesday']);

            $thursday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where([$condition,'TimeTablePeriods.day'=>'Thursday']);

            $friday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where([$condition,'TimeTablePeriods.day'=>'Friday']);

            $saturday = $this->TimeTablePeriods->find()
            ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
            ->where([$condition,'TimeTablePeriods.day'=>'Saturday']);
        }
        $success=true;
        $message ='';
        $recordArray[]=array('dayName'=>'Monday','dayData'=>$monday);
        $recordArray[]=array('dayName'=>'Tuesday','dayData'=>$tuesday);
        $recordArray[]=array('dayName'=>'Wednesday','dayData'=>$wednesday);
        $recordArray[]=array('dayName'=>'Thursday','dayData'=>$thursday);
        $recordArray[]=array('dayName'=>'Friday','dayData'=>$friday);
        $recordArray[]=array('dayName'=>'Saturday','dayData'=>$saturday);
        $TimeTablePeriod=$recordArray;

        $this->set(compact('success', 'message', 'TimeTablePeriod'));
        $this->set('_serialize', ['success', 'message', 'TimeTablePeriod']);  
    } 
}
