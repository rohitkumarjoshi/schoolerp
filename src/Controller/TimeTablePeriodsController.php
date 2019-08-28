<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * TimeTablePeriods Controller
 *
 * @property \App\Model\Table\TimeTablePeriodsTable $TimeTablePeriods
 *
 * @method \App\Model\Entity\TimeTablePeriod[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimeTablePeriodsController extends AppController
{
     public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','addImages']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $timeTablePeriods=[];
        if ($this->request->is('post')) {
            $medium_id= $this->request->getData('medium_id');
            $student_class_id= $this->request->getData('student_class_id');
            $stream_id= $this->request->getData('stream_id');
            $section_id= $this->request->getData('section_id');
            $day= $this->request->getData('day');
            $condition=[];
            if(!empty($medium_id)){
                $condition['TimeTablePeriods.medium_id']=$medium_id;
            }
            if(!empty($student_class_id)){
                $condition['TimeTablePeriods.student_class_id']=$student_class_id;
            }
            if(!empty($stream_id)){
                $condition['TimeTablePeriods.stream_id']=$stream_id;
            }
            if(!empty($section_id)){
                $condition['TimeTablePeriods.section_id']=$section_id;
            }
            if(!empty($day)){
                $condition['TimeTablePeriods.day']=$day;
            }
            $condition['TimeTablePeriods.is_deleted']='N';
            $timeTablePeriods = $this->TimeTablePeriods->find()
                ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees'])
                ->where($condition);
        }
        $mediums = $this->TimeTablePeriods->Mediums->find('list', ['limit' => 200])->where(['Mediums.is_deleted'=>'N']);
        $studentClasses = $this->TimeTablePeriods->StudentClasses->find('list', ['limit' => 200])->where(['StudentClasses.is_deleted'=>'N']);
        $streams = $this->TimeTablePeriods->Streams->find('list', ['limit' => 200])->where(['Streams.is_deleted'=>'N']);
        $sections = $this->TimeTablePeriods->Sections->find('list', ['limit' => 200])->where(['Sections.is_deleted'=>'N']);
        $subjects = $this->TimeTablePeriods->Subjects->find('list', ['limit' => 200])->where(['Subjects.is_deleted'=>'N']);
        $this->set(compact('timeTablePeriods','mediums','studentClasses','streams','sections','subjects'));
    }

    /**
     * View method
     *
     * @param string|null $id Time Table Period id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timeTablePeriod = $this->TimeTablePeriods->get($id, [
            'contain' => ['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'Employees']
        ]);
        $this->set('timeTablePeriod', $timeTablePeriod);
         
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');

        $timeTablePeriod = $this->TimeTablePeriods->newEntity();
        $option=[];
         $user_type = $this->Auth->User('login_type');
        if ($user_type=='Employee') {
             $data = $this->TimeTablePeriods->FacultyClassMappings->ClassMappings->find()->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.employee_id'=>$user_id,'ClassMappings.is_deleted'=>'N'])->contain(['StudentClasses','Mediums','Streams','Sections'])->first();
			 
				if($data){ 
					$student_class_id = $data->student_class_id;
					$stream_id = $data->stream_id;
					$section_id = $data->section_id;
					$medium_id = $data->medium_id;
					$name='';
					if(!empty($medium_id)){
						$name.=$data->medium->name;
					}
					if(!empty($student_class_id)){
						$name.=' -> '.$data->student_class->name;
					}
					if(!empty($section_id)){
						$name.=' -> '.$data->section->name;
					}
					
					if(!empty($stream_id)){
						$name.=' -> '.$data->stream->name;
					}
					$getSubject = $this->TimeTablePeriods->Subjects->find()->where(['Subjects.student_class_id'=>$student_class_id,'Subjects.stream_id'=>$stream_id,'Subjects.session_year_id'=>$session_year_id,'Subjects.is_deleted'=>'N']);
					if(!empty($getSubject->toArray())){
						foreach ($getSubject as $SubjectList) {
						  $option[]=['value'=>$SubjectList->id,
								'text'=>$name.' -> '.$SubjectList->name,
								'mid'=>$medium_id,
								'cid'=>$student_class_id,
								'stid'=>$stream_id,
								'scid'=>$section_id,
								'subid'=>$SubjectList->id,
							];  
						}
					}
				} 
		
        }
        else
        {
           $datas = $this->TimeTablePeriods->FacultyClassMappings->ClassMappings->find()->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.is_deleted'=>'N'])->contain(['StudentClasses','Mediums','Streams','Sections'])->order(['student_class_id'=>'ASC','section_id'=>'ASC'])->toArray();
			
			foreach($datas as $data){ 
				$student_class_id = $data->student_class_id;
				$stream_id = $data->stream_id;
				$section_id = $data->section_id;
				$medium_id = $data->medium_id;
				$name='';
				if(!empty($medium_id)){
					$name.=$data->medium->name;
				}
				if(!empty($student_class_id)){
					$name.=' -> '.$data->student_class->name;
				}
				if(!empty($section_id)){
					$name.=' -> '.$data->section->name;
				}
				
				if(!empty($stream_id)){
					$name.=' -> '.$data->stream->name;
				}
				$getSubject = $this->TimeTablePeriods->Subjects->find()->where(['Subjects.student_class_id'=>$student_class_id,'Subjects.stream_id'=>$stream_id,'Subjects.session_year_id'=>$session_year_id,'Subjects.is_deleted'=>'N']);
				if(!empty($getSubject->toArray())){
					foreach ($getSubject as $SubjectList) {
					  $option[]=['value'=>$SubjectList->id,
							'text'=>$name.' -> '.$SubjectList->name,
							'mid'=>$medium_id,
							'cid'=>$student_class_id,
							'stid'=>$stream_id,
							'scid'=>$section_id,
							'subid'=>$SubjectList->id,
						];  
					}
				}
			} 
        }
        
      
    
    //echo $user_type; exit;
       
        

        if ($this->request->is('post')) {
            $medium_id= $this->request->getData('medium_id');
            $student_class_id= $this->request->getData('student_class_id');
            $stream_id= $this->request->getData('stream_id');
            $section_id= $this->request->getData('section_id');
            $subject_id= $this->request->getData('subject_id');
            $day= $this->request->getData('day');
            //pr($day);exit;
            $time_from= $this->request->getData('time_from');
            $time_to= $this->request->getData('time_to');
            $employee_id= $this->request->getData('employee_id');
            //pr($employee_id); die();
            $x=0;

          //  pr($this->request->getData()); die();
            foreach ($subject_id as $singleSub) {
                $timeTablePeriod = $this->TimeTablePeriods->newEntity();
                $timeTablePeriod->medium_id = $medium_id[$x]; 
                $timeTablePeriod->student_class_id = $student_class_id[$x]; 
                $timeTablePeriod->stream_id = $stream_id[$x]; 
                $timeTablePeriod->section_id = $section_id[$x]; 
                $timeTablePeriod->subject_id = $singleSub; 
                foreach ($day as $days) 
                {
                    $timeTablePeriod[$i]['days'] = $days; 
                    $timeTablePeriod->day=$timeTablePeriod[$x]['days'];
                    $x++;
                }
                $timeTablePeriod->day = $day[$x]; 
                $timeTablePeriod->time_from = $time_from[$x]; 
                $timeTablePeriod->time_to = $time_to[$x]; 
                $timeTablePeriod->employee_id = $employee_id[$x]; 
                $timeTablePeriod->created_by = $user_id; 

                //pr($timeTablePeriod); die();
                $this->TimeTablePeriods->save($timeTablePeriod);
            $x++;
            }
            return $this->redirect(['action' => 'index']); 
        }

        $mediums = $this->TimeTablePeriods->Mediums->find('list', ['limit' => 200])->where(['Mediums.is_deleted'=>'N']);

        $user_type = $this->Auth->User('login_type');
         
        if($user_type=='Employee'){

            $employees = $this->TimeTablePeriods->Employees->find('list', ['limit' => 200])->Where(['Employees.id'=> $user_id,'Employees.is_deleted'=>'N' ]);
        }
        elseif ($user_type=='Admin') {
           $employees = $this->TimeTablePeriods->Employees->find('list', ['limit' => 200])->Where(['Employees.is_deleted'=>'N' ]);
        }

        
        $this->set(compact('timeTablePeriod', 'mediums','employees','option'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Time Table Period id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $timeTablePeriod = $this->TimeTablePeriods->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timeTablePeriod = $this->TimeTablePeriods->patchEntity($timeTablePeriod, $this->request->getData());
            if ($this->TimeTablePeriods->save($timeTablePeriod)) {
                $this->Flash->success(__('The time table period has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The time table period could not be saved. Please, try again.'));
        }
        $media = $this->TimeTablePeriods->Media->find('list', ['limit' => 200]);
        $studentClasses = $this->TimeTablePeriods->StudentClasses->find('list', ['limit' => 200]);
        $streams = $this->TimeTablePeriods->Streams->find('list', ['limit' => 200]);
        $sections = $this->TimeTablePeriods->Sections->find('list', ['limit' => 200]);
        $subjects = $this->TimeTablePeriods->Subjects->find('list', ['limit' => 200]);
        $employees = $this->TimeTablePeriods->Employees->find('list', ['limit' => 200]);
        $this->set(compact('timeTablePeriod', 'media', 'studentClasses', 'streams', 'sections', 'subjects', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Time Table Period id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $timeTablePeriod = $this->TimeTablePeriods->get($id, [
            'contain' => []
        ]); 
        $timeTablePeriod = $this->TimeTablePeriods->patchEntity($timeTablePeriod, $this->request->getData());
        $timeTablePeriod->is_deleted='Y';
        if ($this->TimeTablePeriods->save($timeTablePeriod)) {
            $this->Flash->success(__('The time table period has been deleted.'));
        } else {
            $this->Flash->error(__('The time table period could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function timetableView()
    {   
        $user_id = $this->Auth->User('id');
        $currentSession = $this->Auth->User('session_year_id');
        $user_type = $this->Auth->User('user_type');

        /*$user_id = $this->request->getData('user_id'); 
        $user_type = $this->request->getData('user_type'); 
        $currentSession = $this->AwsFile->currentSession();*/
         
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
        $TimeTablePeriodData=$recordArray;
        //pr($TimeTablePeriodData);exit;
        $this->set(compact('success', 'message', 'TimeTablePeriodData'));
        $this->set('_serialize', ['success', 'message', 'TimeTablePeriodData']);  
    } 
}
