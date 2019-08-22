<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
/**
 * Assignments Controller
 *
 * @property \App\Model\Table\AssignmentsTable $Assignments
 *
 * @method \App\Model\Entity\Assignment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssignmentsController extends AppController
{

    public function AssignmentList()
    {
        $student_id = $this->request->getData('student_id');
        $employee_id = $this->request->getData('employee_id');
        $assignments=array(); 
        if(!empty($student_id)){
            $assignments = $this->Assignments->find()->where(['Assignments.is_deleted'=>'N']);
            $assignments->contain(['StudentClasses','Sections','Subjects','SubmittedBy']);
            $assignments->matching('AssignmentStudents', function ($q)use($student_id) {
                return $q->where(['AssignmentStudents.student_id'=>$student_id]);
            });
        }
        if(!empty($employee_id)){
            $assignments = $this->Assignments->find()->where(['Assignments.is_deleted'=>'N','Assignments.created_by'=>$employee_id]);
            $assignments->contain(['StudentClasses','Sections','Subjects','SubmittedBy']);
        } 
        $assignments->order(['Assignments.id'=>'DESC']);
        if(sizeof($assignments->toArray())>0){
            $success=true;
            $message='';
            $assignmentList=$assignments;
        }else{
            $success=false;
            $message="No data found";
            $assignmentList=array();
        }
        $this->set(compact('success', 'message', 'assignmentList'));
        $this->set('_serialize', ['success', 'message', 'assignmentList']);
    }
 
    public function assignmentAdd()
    {
        $user_type = $this->request->getData('user_type');
        if($user_type=='Employee'){
            $assignment = $this->Assignments->newEntity();

            $currentSession = $this->AwsFile->currentSession();
            $user_id = $this->request->getData('user_id'); 
            $class_section_id = $this->request->getData('class_section_id'); 
            $data = $this->Assignments->FacultyClassMappings->ClassMappings->find()->where(['ClassMappings.id'=>$class_section_id])->first();
            $medium_id = $data->medium_id;
            $student_class_id = $data->student_class_id;
            $stream_id = $data->stream_id;
            $section_id = $data->section_id;

            $assignment = $this->Assignments->patchEntity($assignment, $this->request->getData());
            $assignment->date=date('Y-m-d',strtotime($this->request->getData('date')));

            $ImagesofEvent = $this->request->getData('document');
            $ext=explode('/',$ImagesofEvent['type']);
            $file_name='assignment'.time().rand().'.'.$ext[1];
            $keynames = 'assignments/'.$file_name;
            $assignment->document = $keynames;
            if($medium_id){
                $assignment->medium_id = $medium_id;
            }
            if($student_class_id){
                $assignment->student_class_id = $student_class_id;
            }
            if($stream_id){
                $assignment->stream_id = $stream_id;
            }
            if($section_id){
                $assignment->section_id = $section_id;
            } 

            $assignment->session_year_id = $currentSession;
            $assignment->created_by = $user_id;

            $assignment_type=$this->request->getData('assignment_type');
            $assignment->assignment_students = [];
            if($assignment_type == 'Class'){
                $condition=array();
                if($student_class_id){
                   $condition['StudentInfos.student_class_id']= $student_class_id; 
                }
                if($section_id){
                   $condition['StudentInfos.section_id']= $section_id; 
                }
                if($medium_id){
                   $condition['StudentInfos.medium_id']= $medium_id; 
                }
                if($stream_id){
                   $condition['StudentInfos.stream_id']= $stream_id; 
                }
                $studentInfos=$this->Assignments->AssignmentStudents->StudentInfos->find()
                    ->where($condition);
                foreach ($studentInfos as $studentInfo) {
                   
                     $assignmentStudents = $this->Assignments->AssignmentStudents->newEntity();
                     $assignmentStudents->student_id=$studentInfo->id;

                     $assignment->assignment_students[]=$assignmentStudents;
                }
            }
            else{
                $students = $this->request->getData('student_id');
                foreach ($students as $studentInfo) {
                     $assignmentStudents = $this->Assignments->AssignmentStudents->newEntity();
                     $assignmentStudents->student_id=$studentInfo;
                     $assignment->assignment_students[]=$assignmentStudents;
                }
            } 
             
            if ($this->Assignments->save($assignment)) {
                $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);                    
                $success=true;
                $message="The assignment has been saved.";
            }
             
        }
        else{
            $success=false;
            $message="Something went wrong.";
        }
        $this->set(compact('success', 'message'));
        $this->set('_serialize', ['success', 'message']);
    }
 
     
}
