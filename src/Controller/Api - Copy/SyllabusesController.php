<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * Syllabuses Controller
 *
 * @property \App\Model\Table\SyllabusesTable $Syllabuses
 *
 * @method \App\Model\Entity\Syllabus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SyllabusesController extends AppController
{
    public function syllabusList($id=null)
    {
        $user_id = $this->request->getData('user_id'); 
        $user_type = $this->request->getData('user_type'); 
        $class_section_id = $this->request->getData('class_section_id'); 
        $currentSession = $this->AwsFile->currentSession();
        if($user_type == 'Student'){
            $studentinfo = $this->Syllabuses->StudentInfos->find()
            ->where(['StudentInfos.student_id'=>$user_id,'StudentInfos.session_year_id'=>$currentSession])
            ->first();
            $medium_id = $studentinfo->medium_id;
            $student_class_id = $studentinfo->student_class_id;
            $stream_id = $studentinfo->stream_id;
            $section_id = $studentinfo->section_id;
            if(!empty($medium_id)){
                $condition['Syllabuses.medium_id']= $medium_id;
            } 
            if(!empty($section_id)){  
                $condition['Syllabuses.section_id']= $section_id;
            } 

            if(!empty($student_class_id)){  
                $condition['Syllabuses.student_class_id']= $student_class_id;
            } 

            if(!empty($stream_id))
            { 
                $condition['Syllabuses.stream_id']= $stream_id;
            } 
            $syllabusesList = $this->Syllabuses->find()
                ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects'])
                ->where([$condition,'Syllabuses.is_deleted'=>'N']);
            if($syllabusesList->count()>0){
                $success=true;
                $message=''; 
            }else{
                $success=false;
                $message="No data found";
                $syllabusesList=array();
            }
        }
        if($user_type == 'Employee'){
            $data = $this->Syllabuses->ClassMappings->find()->where(['ClassMappings.id'=>$class_section_id,'ClassMappings.employee_id'=>$user_id])->first(); 
            if(!empty($data)){
                $where=[];
                if(!empty($data->medium_id)){ 
                    $where['Syllabuses.medium_id']=$data->medium_id;
                } 

                if(!empty($data->section_id)){ 
                    $where['Syllabuses.section_id']=$data->section_id;
                } 

                if(!empty($data->student_class_id)){ 
                    $where['Syllabuses.student_class_id']=$data->student_class_id;
                } 

                if(!empty($data->stream_id)){ 
                    $where['Syllabuses.stream_id']=$data->stream_id;
                } 
                $where['Syllabuses.is_deleted']='N';
                $syllabusesList= $this->Syllabuses->find()
                     ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects'])
                     ->where(['Syllabuses.session_year_id'=>$currentSession,$where])->toArray();
            }
            else{
               $syllabusesList=array(); 
            }
            $success=true;
            $message='';  
        }
        $this->set(compact('success', 'message', 'syllabusesList'));
        $this->set('_serialize', ['success', 'message', 'syllabusesList']);  
    } 
}
