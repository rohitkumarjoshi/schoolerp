<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Assignments Controller
 *
 * @property \App\Model\Table\AssignmentsTable $Assignments
 *
 * @method \App\Model\Entity\Assignment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssignmentsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type = $this->Auth->User('login_type');

        $this->paginate = [
            'contain' => ['SessionYears', 'Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects'=>['ParentSubjects'],'AssignmentStudents'=>['Students']]
        ];
        $assignments = $this->Assignments->find();
        $assignments->where(['Assignments.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('medium_id'))){
            $assignments->where(['Assignments.medium_id'=>$this->request->getQuery('medium_id')]);
        }
        if(!empty($this->request->getQuery('student_class_id'))){
            $assignments->where(['Assignments.student_class_id'=>$this->request->getQuery('student_class_id')]);
        }
        if(!empty($this->request->getQuery('stream_id'))){
            $assignments->where(['Assignments.stream_id'=>$this->request->getQuery('stream_id')]);
        }
        if(!empty($this->request->getQuery('section_id'))){
            $assignments->where(['Assignments.section_id'=>$this->request->getQuery('section_id')]);
        }
        if(!empty($this->request->getQuery('subject_id'))){
            $assignments->where(['Assignments.subject_id'=>$this->request->getQuery('subject_id')]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $assignments->where(['date >=' =>$date_from,'date <=' =>$date_to]);
        }
        if(!empty($this->request->getQuery('employee_id'))){
            $assignments->where(['Assignments.created_by'=>$this->request->getQuery('employee_id')]);
        }
        if(!empty($login_type!='Admin')){
            $assignments->where(['Assignments.created_by'=>$user_id]);
        }
        $assignments->order(['Assignments.id'=>'DESC']);
        $assignments = $this->paginate($assignments);

        $mediums = $this->Assignments->Mediums->find('list', ['limit' => 200])->where(['Mediums.is_deleted'=>'N']);
        $studentClasses = $this->Assignments->StudentClasses->find('list', ['limit' => 200])->where(['StudentClasses.is_deleted'=>'N']);
        $streams = $this->Assignments->Streams->find('list', ['limit' => 200])->where(['Streams.is_deleted'=>'N']);
        $sections = $this->Assignments->Sections->find('list', ['limit' => 200])->where(['Sections.is_deleted'=>'N']);
        $subjects = $this->Assignments->Subjects->find('list', ['limit' => 200])->where(['Subjects.is_deleted'=>'N']);
        if($login_type=='Admin'){
          $employees = $this->Assignments->Employees->find('list', ['limit' => 200])->where(['Employees.is_deleted'=>'N']);  
        }
        else
        {
           $employees = $this->Assignments->Employees->find('list', ['limit' => 200])->where(['Employees.is_deleted'=>'N','Employees.id'=>$user_id]);  
        }

        $this->set(compact('assignments', 'sessionYears', 'mediums', 'studentClasses', 'streams', 'sections', 'subjects','employees'));
    }

    public function studentView()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type = $this->Auth->User('login_type');

        $this->paginate = [
            'contain' => ['SessionYears', 'Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects'=>['ParentSubjects'],'AssignmentStudents'=>['Students']]
        ];
        $assignments = $this->Assignments->find();
        $assignments->where(['Assignments.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('medium_id'))){
            $assignments->where(['Assignments.medium_id'=>$this->request->getQuery('medium_id')]);
        }
        if(!empty($this->request->getQuery('student_class_id'))){
            $assignments->where(['Assignments.student_class_id'=>$this->request->getQuery('student_class_id')]);
        }
        if(!empty($this->request->getQuery('stream_id'))){
            $assignments->where(['Assignments.stream_id'=>$this->request->getQuery('stream_id')]);
        }
        if(!empty($this->request->getQuery('section_id'))){
            $assignments->where(['Assignments.section_id'=>$this->request->getQuery('section_id')]);
        }
        if(!empty($this->request->getQuery('subject_id'))){
            $assignments->where(['Assignments.subject_id'=>$this->request->getQuery('subject_id')]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $assignments->where(['date >=' =>$date_from,'date <=' =>$date_to]);
        }
        if(!empty($this->request->getQuery('employee_id'))){
            $assignments->where(['Assignments.created_by'=>$this->request->getQuery('employee_id')]);
        } 
        $assignments->order(['Assignments.id'=>'DESC']);
        
        $assignments->matching('AssignmentStudents', function ($q)use($user_id) {
            return $q->where(['AssignmentStudents.student_id'=>$user_id]);
        }); 
        $assignments = $this->paginate($assignments);
       // pr($assignments);exit;
        $mediums = $this->Assignments->Mediums->find('list', ['limit' => 200])->where(['Mediums.is_deleted'=>'N']);
        $studentClasses = $this->Assignments->StudentClasses->find('list', ['limit' => 200])->where(['StudentClasses.is_deleted'=>'N']);
        $streams = $this->Assignments->Streams->find('list', ['limit' => 200])->where(['Streams.is_deleted'=>'N']);
        $sections = $this->Assignments->Sections->find('list', ['limit' => 200])->where(['Sections.is_deleted'=>'N']);
        $subjects = $this->Assignments->Subjects->find('list', ['limit' => 200])->where(['Subjects.is_deleted'=>'N']);
         
        $employees = $this->Assignments->Employees->find('list', ['limit' => 200])->where(['Employees.is_deleted'=>'N']);  

        $this->set(compact('assignments', 'sessionYears', 'mediums', 'studentClasses', 'streams', 'sections', 'subjects','employees'));
    }
    /**
     * View method
     *
     * @param string|null $id Assignment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $assignment = $this->Assignments->get($id, [
            'contain' => ['SessionYears', 'Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'AssignmentStudents']
        ]);
        $this->set('assignment', $assignment);
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
        $login_type = $this->Auth->User('login_type');

		$this->loadmodel('Notifications');
		$this->loadmodel('Users');
		
        $assignment = $this->Assignments->newEntity();
        if ($this->request->is('post')) {
            $faculty_class_mapping_id = $this->request->getData('faculty_class_mapping_id');
            $assignment = $this->Assignments->patchEntity($assignment, $this->request->getData());
            $assignment->date=date('Y-m-d',strtotime($this->request->getData('date')));

            $ImagesofEvent = $this->request->getData('document');
            $ext=explode('/',$ImagesofEvent['type']);
            $file_name='assignment'.time().rand().'.'.$ext[1];
            $keynames = 'assignments/'.$file_name;
            $assignment->document = $keynames;

            $assignment->session_year_id = $session_year_id;
            $assignment->created_by = $user_id;

            $assignment_type=$this->request->getData('assignment_type');
            $assignment->assignment_students = [];
            if($assignment_type == 'Class'){
                $condition=array();
                $student_class_id=$this->request->getData('student_class_id');
                if($student_class_id){
                   $condition['StudentInfos.student_class_id']= $student_class_id; 
                }
                $section_id=$this->request->getData('section_id');
                if($section_id){
                   $condition['StudentInfos.section_id']= $section_id; 
                }
                $medium_id=$this->request->getData('medium_id');
                if($medium_id){
                   $condition['StudentInfos.medium_id']= $medium_id; 
                }
                $stream_id=$this->request->getData('stream_id');
                if($stream_id){
                   $condition['StudentInfos.stream_id']= $stream_id; 
                }
                //pr($condition);exit;
                $studentInfos=$this->Assignments->AssignmentStudents->Students->StudentInfos->find()
                    ->where($condition);
				foreach ($studentInfos as $studentInfo) {
                   
                     $assignmentStudents = $this->Assignments->AssignmentStudents->newEntity();
                     $assignmentStudents->student_id=$studentInfo->student_id;

                     $assignment->assignment_students[]=$assignmentStudents;
					
                }
            }
            else{
                $students = $this->request->getData('students');
                foreach ($students as $studentInfo) {
                     $assignmentStudents = $this->Assignments->AssignmentStudents->newEntity();
                     $assignmentStudents->student_id=$studentInfo;
                     $assignment->assignment_students[]=$assignmentStudents;
                }
            }
            //pr($assignment); exit;
			

			
            if ($this->Assignments->save($assignment)) {
				
				//pr($assignment); exit;
				/// Notifications Code
				
					$Notifications=$this->Notifications->newEntity();
					$Notifications->title='Assignment';
					$Notifications->message=$assignment->topic;

					$Notifications->notify_date=date("Y-m-d");
					$Notifications->notify_time=date("h:i: A");
					$Notifications->status=0;
					$Notifications->created_by=$user_id;
					$this->Notifications->save($Notifications);
					foreach($assignment->assignment_students as $assignment_student){
						$stud_id=$assignment_student->student_id;
						$Usersdata=$this->Users->find()->where(['student_id'=>$stud_id])->first();
						$NotificationRows=$this->Notifications->NotificationRows->newEntity();
						$NotificationRows->notification_id=$Notifications->id;
						$NotificationRows->user_id=$Usersdata->id;
						$NotificationRows->df_link='Alok://assignment?user_id='.$Usersdata->id.'&id='.$assignment->id;
						$NotificationRows->sent=0;
						$NotificationRows->status=0;
						$this->Notifications->NotificationRows->save($NotificationRows);
						
					}
				// end 
                $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);                    
                $this->Flash->success(__('The assignment has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
        }
        $option=[];
        if ($login_type=='Employees') {
             $data = $this->Assignments->FacultyClassMappings->ClassMappings->find()->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.employee_id'=>$user_id,'ClassMappings.is_deleted'=>'N'])->contain(['StudentClasses','Mediums','Streams','Sections'])->first();
        }
        else
        {
             $data = $this->Assignments->FacultyClassMappings->ClassMappings->find()->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.is_deleted'=>'N'])->contain(['StudentClasses','Mediums','Streams','Sections'])->first();
        }
       
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
            $getSubject = $this->Assignments->Subjects->find()->where(['Subjects.student_class_id'=>$student_class_id,'Subjects.stream_id'=>$stream_id,'Subjects.session_year_id'=>$session_year_id,'Subjects.is_deleted'=>'N']);
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
         
        //--
        /*$data = $this->Assignments->FacultyClassMappings->find();
        if($login_type != 'Admin'){
           $data->where(['FacultyClassMappings.employee_id'=>$user_id]); 
        }
        $data->select(['id'=>'FacultyClassMappings.id','Subname'=>'Subjects.name','Subid'=>'Subjects.id']);
        $data->contain(['Subjects','ClassMappings'=>function($q)use($session_year_id){
            return $q->select(['Mname'=>'Mediums.name','Mid'=>'Mediums.id','Cname'=>'StudentClasses.name','Cid'=>'StudentClasses.id','Sname'=>'Streams.name','STid'=>'Streams.id','SCname'=>'Sections.name','SCid'=>'Sections.id'])
            ->where(['ClassMappings.session_year_id'=>$session_year_id])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        }]);
         
        $option=[];
        foreach ($data as $key => $d) {
            $name = '';
            foreach ($d->toArray() as $key2 => $value)
            {
                if(!empty($value) && ( ($key2 != 'id') && ($key2 != 'Subname') && ($key2 != 'Mid') && ($key2 != 'Cid') && ($key2 != 'STid') && ($key2 != 'SCid') && ($key2 != 'Subid') ) )
                { 
                        if($key2 != 'Mname')
                        $name.=" -> ";
                        $name.=$value;
                     
                }
            } 
            $classMappings[$d->id] = $name.' -> '.$d->Subname;
            $option[]=['value'=>$d->id,
                'text'=>$name.' -> '.$d->Subname,
                'mid'=>$d->Mid,
                'cid'=>$d->Cid,
                'stid'=>$d->STid,
                'scid'=>$d->SCid,
                'subid'=>$d->Subid,
            ];
        } */
        //pr($option);exit;
        //-- 
        $this->set(compact('assignment','option'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Assignment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $assignment = $this->Assignments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $assignment = $this->Assignments->patchEntity($assignment, $this->request->getData());
            if ($this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assignment could not be saved. Please, try again.'));
        }
        $sessionYears = $this->Assignments->SessionYears->find('list', ['limit' => 200]);
        $Mediums = $this->Assignments->Mediums->find('list', ['limit' => 200]);
        $studentClasses = $this->Assignments->StudentClasses->find('list', ['limit' => 200]);
        $streams = $this->Assignments->Streams->find('list', ['limit' => 200]);
        $sections = $this->Assignments->Sections->find('list', ['limit' => 200]);
        $subjects = $this->Assignments->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('assignment', 'sessionYears', 'Mediums', 'studentClasses', 'streams', 'sections', 'subjects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Assignment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $assignment = $this->Assignments->get($id, [
            'contain' => []
        ]);
        $assignment = $this->Assignments->patchEntity($assignment, $this->request->getData());
        $assignment->is_deleted = 'Y';
        if ($this->Assignments->save($assignment)) {
            $this->Flash->success(__('The assignment has been deleted.'));
        } else {
            $this->Flash->error(__('The assignment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
