<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * Leaves Controller
 *
 * @property \App\Model\Table\LeavesTable $Leaves
 *
 * @method \App\Model\Entity\Leave[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeavesController extends AppController
{
    public function leaveList()
    {
        $user_id = $this->request->getData('user_id'); 
        $user_type = $this->request->getData('user_type');
        $page = $this->request->getData('page');
        $currentSession = $this->AwsFile->currentSession();
        if(!empty($page)){$page=1;}
        $limit=10; 
        $leaves = $this->Leaves->find()->where(['Leaves.is_deleted'=>'N','Leaves.session_year_id'=>$currentSession]); 
        if($user_type=='Employee'){
            $leaves->contain(['Employees'])->where(['Leaves.employee_id'=> $user_id]);
        }
        else{
            $leaves->contain(['Students'])->where(['Leaves.student_id'=> $user_id]);
        }
        $leaves->limit($limit);
        $leaves->page($page);

        if($leaves->count()>0){
            $success=true;
            $message='';
            $leaveLists=$leaves;
        }else{
            $success=false;
            $message="No data found";
            $leaveLists=array();
        }
        $this->set(compact('success', 'message', 'leaveLists'));
        $this->set('_serialize', ['success', 'message', 'leaveLists']);  
    } 
    
    public function studentLeave()
    {
        $user_id = $this->request->getData('user_id');
        $session_year_id = $this->AwsFile->currentSession();
        $user_type   = $this->request->getData('user_type');
        $page   = $this->request->getData('page');
        if($user_type=='Employee'){
            $data = $this->Leaves->FacultyClassMappings->ClassMappings->find();
            $data->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.employee_id'=>$user_id]);
              
            $option=[];
            foreach ($data as $key => $d) {
                $option[]=[ 
                    'mid'=>$d->medium_id,
                    'cid'=>$d->student_class_id,
                    'stid'=>$d->stream_id,
                    'scid'=>$d->section_id,
                ];
            }
            $leaves = $this->Leaves->find()->contain(['Students'=>['StudentInfoApis'=>['StudentClassesApi','SectionsApi']]])->where(['Leaves.is_deleted'=>'N','Leaves.status'=>'Pending']);
        
            $StudentsIds=[];
            foreach ($option as $key => $value) {
                $stud = $this->Leaves->Students->StudentInfoApis->find()->where(['StudentInfoApis.session_year_id'=>$session_year_id]); 

                $medium_id='';
                if(!empty($value['mid'])){
                    $medium_id=$value['mid'];
                    $stud->where(['StudentInfoApis.medium_id'=>@$medium_id]);
                } 

                $section_id='';
                if(!empty($value['scid'])){
                    $section_id=$value['scid'];
                    $stud->where(['StudentInfoApis.section_id'=>@$section_id]);
                } 

                $class_id='';
                if(!empty($value['cid'])){
                    $class_id=$value['cid'];
                    $stud->where(['StudentInfoApis.student_class_id'=>@$class_id]);
                } 
                $stream_id='';
                if(!empty($value['stid'])){
                    $stream_id=$value['stid'];
                    $stud->where(['StudentInfoApis.stream_id'=>@$stream_id]);
                }   

                if(sizeof($stud->toArray())>0){
                    foreach ($stud as $stdRecod) {
                        $StudentsIds[]= $stdRecod->student_id;
                    }
                }  
            } 
            if(!empty($StudentsIds)){
                $leaves->where(['Leaves.student_id IN'=> $StudentsIds]);
            }
            else{
              $leaves->where(['Leaves.student_id'=> 0]);  
            }
        
            $leaves->order(['Leaves.id'=>'DESC'])->limit(10)->page($page);
            if($leaves->count()>0){
                $success=true;
                $message='';
                $leaveLists=$leaves;
            }else{
                $success=false;
                $message="No data found";
                $leaveLists=array();
            }
        }
        else{
            $success=false;
            $message="Invalid user type";
            $leaveLists=array();
        }
        $this->set(compact('success', 'message', 'leaveLists'));
        $this->set('_serialize', ['success', 'message', 'leaveLists']);
    }

    public function LeaveAdd()
    {
        $user_id = $this->request->getData('user_id');
        $session_year_id = $this->AwsFile->currentSession();
        $user_type   = $this->request->getData('user_type');

        $leave = $this->Leaves->newEntity(); 
        $leave = $this->Leaves->patchEntity($leave, $this->request->getData());
        $leave->date_from= date('Y-m-d',strtotime($this->request->getData('date_from')));
        $leave->date_to= date('Y-m-d',strtotime($this->request->getData('date_to')));
        if(!empty($this->request->getData('halfday_date'))){
             $leave->halfday_date= date('Y-m-d',strtotime($this->request->getData('halfday_date')));
        }
        if($user_type == 'Employee'){
            $leave->employee_id =$user_id;
			
			$count=$this->Leaves->find()->where(['employee_id'=>$user_id,'date_from'=>$leave->date_from,'date_to'=>$leave->date_to])->count();
			
        }
        else{
            $leave->student_id =$user_id;
			
			$count=$this->Leaves->find()->where(['student_id'=>$user_id,'date_from'=>$leave->date_from,'date_to'=>$leave->date_to])->count();
        }
       
        $leave->created_by =$user_id;
        $leave->session_year_id =$session_year_id;
        $leave->status ='Pending'; 
		
		if($count==0){
			if ($this->Leaves->save($leave)) { 
				$success=true;
				$message='The leave has been saved.';
			}
			else{
				$success=true;
				$message='The leave could not be saved. Please, try again.';
			}
		}else{
			$success=false;
			$message='Leave is already apply.';
		}
        $this->set(compact('success', 'message'));
        $this->set('_serialize', ['success', 'message']);    
    }
 
    public function leaveAction()
    {
        $user_id = $this->request->getData('user_id');
        $leave_id = $this->request->getData('leave_id');
        $session_year_id = $this->AwsFile->currentSession();
        $status  = $this->request->getData('status');
         
        $approved_on=date('Y-m-d'); 
        $query = $this->Leaves->query();
        $result = $query->update()
            ->set(['status' => $status,'action_by'=>$user_id,'action_date'=>$approved_on])
            ->where(['id' =>$leave_id])
            ->execute();
        $success=true;
        $message='Successfully Submitted';
        $this->set(compact('success', 'message'));
        $this->set('_serialize', ['success', 'message']);
    } 


    public function classSectionSubjects()
    {
        $user_id = $this->request->getData('user_id');
        $session_year_id = $this->AwsFile->currentSession();
        $user_type   = $this->request->getData('user_type'); 
        if($user_type=='Employee'){

            $data = $this->Leaves->FacultyClassMappings->ClassMappings->find()
                    ->contain(['StudentClassesApi','SectionsApi','StreamsApi','FacultyClassMappingsApi'=>['Subjects'=>['ParentSubjects']]])
                    ->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.employee_id'=>$user_id]);

            $classArray=[];
            $allarray=[];
            foreach ($data as $classsection) {
                $assambleValue = $classsection->student_classes_api->name;
                if (!empty($classsection->streams_api)) {
                    $assambleValue.= ' -> '.$classsection->streams_api->name;
                }
                if(!empty($classsection->sections_api)){
                     $assambleValue.= ' -> '.$classsection->sections_api->name;
                } 
               $classArray['class_section_id'] = $classsection->id;
               $classArray['clas_section_name'] = $assambleValue;

               
               $SubjectArray=[];
               if(!empty($classsection->faculty_class_mappings_api)){
                    $x=0;
                    foreach ($classsection->faculty_class_mappings_api as $SbujctData) {
                        $parentSub='';
                        if(!empty($SbujctData->subject->parent_subject)){
                            $parentSub=$SbujctData->subject->parent_subject->name.' -> ';
                        }
                        $SubjectArray[$x]['subject_id']=$SbujctData->subject->id;
                        $SubjectArray[$x]['elective']=$SbujctData->subject->elective;
                        $SubjectArray[$x]['subject_name']=$parentSub.$SbujctData->subject->name;
                        $x++;
                   }
               }
               $classArray['clas_section_subject'] =$SubjectArray;
               unset($SubjectArray);
               $allarray[]=$classArray;
                

            } 
             
            if($allarray){
                $success=true;
                $message='';
                $classSection=$allarray;
            }else{
                $success=false;
                $message="No data found";
                $classSection=array();
            }
        }
        else{
            $success=false;
            $message="Invalid user type";
            $classSection=array();
        }
        $this->set(compact('success', 'message', 'classSection'));
        $this->set('_serialize', ['success', 'message', 'classSection']);
    }

    public function studentList(){
       
        $class_section_id = $this->request->getQuery('class_section_id');
        $subject_id = $this->request->getQuery('subject_id');
        $elective = $this->request->getQuery('elective');
        $data = $this->Leaves->FacultyClassMappings->ClassMappings->find()->where(['ClassMappings.id'=>$class_section_id])->first();
         
        $medium_id = $data->medium_id;
        $student_class_id = $data->student_class_id;
        $stream_id = $data->stream_id;
        $section_id = $data->section_id;
        $session_year_id = $data->session_year_id;
        $condition=[];
        if(!empty($medium_id)){
            $condition['StudentInfoApis.medium_id']= $medium_id;
        } 

        if(!empty($section_id)){  
            $condition['StudentInfoApis.section_id']= $section_id;
        } 

        if(!empty($student_class_id)){  
            $condition['StudentInfoApis.student_class_id']= $student_class_id;
        } 

        if(!empty($stream_id))
        { 
            $condition['StudentInfoApis.stream_id']= $stream_id;
        } 
        $condition['StudentInfoApis.session_year_id']= $session_year_id; 

        $studentList = $this->Leaves->Students->StudentInfoApis->find();
		$studentList->contain('Students')->where($condition);
		if($elective=='Yes'){
			$studentList->contain(['StudentElectiveSubjects'=>function($q) use($session_year_id,$subject_id){
				return $q->where(['StudentElectiveSubjects.session_year_id'=>$session_year_id,'StudentElectiveSubjects.subject_id'=>$subject_id]);
			}]);
		
		}
		
        if($studentList->count()>0){
            $success=true;
            $message='';
            
        }else{
            $success=false;
            $message="No data found";
            $studentList=array();
        }
         
        $this->set(compact('success', 'message', 'studentList'));
        $this->set('_serialize', ['success', 'message', 'studentList']);

    }

}
