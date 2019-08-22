<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Syllabuses Controller
 *
 * @property \App\Model\Table\SyllabusesTable $Syllabuses
 *
 * @method \App\Model\Entity\Syllabus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SyllabusesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['index']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type = $this->Auth->User('login_type');
        $syllabus = $this->Syllabuses->newEntity();
        if ($this->request->is('post'))
         {
           //pr($this->request->getData()); exit;
           // $syllabus = $this->Syllabuses->patchEntity($syllabus, $this->request->getData());
            $faculty_class_mapping_id=$this->request->getData('faculty_class_mapping_id');
            $medium_id=$this->request->getData('medium_id');
            $student_class_id=$this->request->getData('student_class_id');
            $stream_id=$this->request->getData('stream_id');
            $section_id=$this->request->getData('section_id');
            $subject_id=$this->request->getData('subject_id');
            $files=$this->request->getData('file_path');
			
            $x=0;
             $save=0;
            foreach ($faculty_class_mapping_id as $faculty_class_mapping) {
                $syllabus=$this->Syllabuses->newEntity();
                $syllabus->session_year_id=$session_year_id;
                $syllabus->created_by =$user_id;
                $syllabus->medium_id =@$medium_id[$x];
                $syllabus->student_class_id =@$student_class_id[$x];
                $syllabus->stream_id =@$stream_id[$x];
                $syllabus->section_id =@$section_id[$x];
                $syllabus->subject_id =@$subject_id[$x];
                $files = $this->request->getData('file_path');
                $ext=explode('/',$files[$x]['type']);
                $file_name='syllabus'.time().rand().'.'.$ext[1];
                $keyname = 'syllabus/'.$file_name;
                $syllabus->file_path = $keyname;
                /// pr($syllabus); exit;
                $this->AwsFile->putObjectFile($keyname,$files[$x]['tmp_name'],$files[$x]['type']);
               
                if($this->Syllabuses->save($syllabus)){
                    $save=1;
					$str_id=$stream_id[$x];
					$this->loadmodel('Notifications');
				// Notifications Code Start
				if(empty($str_id)){
					$str_id=0;
				}
				$StudentInfos=$this->Syllabuses->StudentInfos->find()->where(['student_class_id'=>$student_class_id[$x],'medium_id'=>$medium_id[$x],'stream_id'=>$str_id,'section_id'=>$section_id[$x],'StudentInfos.session_year_id'=>$session_year_id])->contain(['Students'=>['Users']])->toArray();
	
			
				$Notifications=$this->Notifications->newEntity();
				$Notifications->title='Syllabus';
				$Notifications->message='New syllabus added';
				//$Notifications->df_link='Alok://Event?id='.$gallery->id;
				$Notifications->notify_date=date("Y-m-d");
				$Notifications->notify_time=date("h:i: A");
				$Notifications->status=0;
				$Notifications->created_by=$user_id;
				$this->Notifications->save($Notifications);
				
			foreach($StudentInfos as $StudentInfo){
				$id=$StudentInfo->student->users[0]->id;
				
				$NotificationRows=$this->Notifications->NotificationRows->newEntity();
				$NotificationRows->notification_id=$Notifications->id;
				$NotificationRows->user_id=$id;
				$NotificationRows->df_link='Alok://syllabus?user_id='.$id.'&class_section_id='.$faculty_class_mapping;
				
				$NotificationRows->sent=0;
				$NotificationRows->status=0;
				$this->Notifications->NotificationRows->save($NotificationRows);				
				
			}
		// End 
					
                }
                $x++;
            }
            if($save==1){
                return $this->redirect(['action' => 'view']);
            } 
        }

        $data = $this->Syllabuses->FacultyClassMappings->find();
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
        } 

        $media = $this->Syllabuses->Mediums->find('list')->where(['Mediums.is_deleted'=>'N']);
        $this->set(compact('syllabuses','syllabus', 'media', 'studentClasses', 'streams','option'));
    }

    public function studentView()
    {   
        $user_id = $this->Auth->User('id');
        $currentSession = $this->Auth->User('session_year_id');
        $user_type = $this->Auth->User('user_type');
        $syllabuses=array();
        if($user_type=='Student'){
            $studentinfo = $this->Syllabuses->StudentInfos->find()
                ->where(['StudentInfos.student_id'=>$user_id,'StudentInfos.session_year_id'=>$currentSession])->first();
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
            $this->paginate = [
                'contain' => ['Mediums', 'StudentClasses', 'Streams','Sections','Subjects'=>['ParentSubjects']]
            ];
            $syllabuses = $this->Syllabuses->find();
            $syllabuses->where(['Syllabuses.is_deleted'=>'N',$condition]);
            //pr(['Syllabuses.is_deleted'=>'N',$condition]);exit;
            if(!empty($this->request->getQuery('subject_id'))){
                $syllabuses->where(['Syllabuses.subject_id'=>$this->request->getQuery('subject_id')]);
            } 
            $syllabuses = $this->paginate($syllabuses);
        } 
         $this->set(compact('syllabuses'));
    } 

    /**
     * View method
     *
     * @param string|null $id Syllabus id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $media = $this->Syllabuses->Mediums->find('list');
        $studentClasses = $this->Syllabuses->StudentClasses->find('list');
        $streams = $this->Syllabuses->Streams->find('list');
        $this->paginate = [
            'contain' => ['Mediums', 'StudentClasses', 'Streams','Sections','Subjects'=>['ParentSubjects']]
        ];
        $syllabuses = $this->Syllabuses->find();
        $syllabuses->where(['Syllabuses.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('medium_id'))){
            $syllabuses->where(['Syllabuses.medium_id'=>$this->request->getQuery('medium_id')]);
        }
        if(!empty($this->request->getQuery('student_class_id'))){
            $syllabuses->where(['Syllabuses.student_class_id'=>$this->request->getQuery('student_class_id')]);
        }
        if(!empty($this->request->getQuery('stream_id'))){
            $syllabuses->where(['Syllabuses.stream_id'=>$this->request->getQuery('stream_id')]);
        }
        if(!empty($this->request->getQuery('section_id'))){
            $syllabuses->where(['Syllabuses.section_id'=>$this->request->getQuery('section_id')]);
        }
        if(!empty($this->request->getQuery('subject_id'))){
            $syllabuses->where(['Syllabuses.subject_id'=>$this->request->getQuery('subject_id')]);
        } 
        $syllabuses = $this->paginate($syllabuses);
        

        $studentClasses = $this->Syllabuses->StudentClasses->find('list')->where(['StudentClasses.is_deleted'=>'N']);
        $streams = $this->Syllabuses->Streams->find('list')->where(['Streams.is_deleted'=>'N']);
        $sections = $this->Syllabuses->Sections->find('list')->where(['Sections.is_deleted'=>'N']);
        $this->set(compact('syllabuses','sections', 'media', 'studentClasses', 'streams'));  
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $syllabus = $this->Syllabuses->newEntity();
        if ($this->request->is('post')) {
            $syllabus = $this->Syllabuses->patchEntity($syllabus, $this->request->getData());
            if ($this->Syllabuses->save($syllabus)) {
                $this->Flash->success(__('The syllabus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The syllabus could not be saved. Please, try again.'));
        }
        $sessionYears = $this->Syllabuses->SessionYears->find('list', ['limit' => 200]);
        $media = $this->Syllabuses->Media->find('list', ['limit' => 200]);
        $studentClasses = $this->Syllabuses->StudentClasses->find('list', ['limit' => 200]);
        $streams = $this->Syllabuses->Streams->find('list', ['limit' => 200]);
        $this->set(compact('syllabus', 'sessionYears', 'media', 'studentClasses', 'streams'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Syllabus id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $syllabus = $this->Syllabuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $syllabus = $this->Syllabuses->patchEntity($syllabus, $this->request->getData());
            if ($this->Syllabuses->save($syllabus)) {
                $this->Flash->success(__('The syllabus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The syllabus could not be saved. Please, try again.'));
        }
        $sessionYears = $this->Syllabuses->SessionYears->find('list', ['limit' => 200]);
        $media = $this->Syllabuses->Media->find('list', ['limit' => 200]);
        $studentClasses = $this->Syllabuses->StudentClasses->find('list', ['limit' => 200]);
        $streams = $this->Syllabuses->Streams->find('list', ['limit' => 200]);
        $this->set(compact('syllabus', 'sessionYears', 'media', 'studentClasses', 'streams'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Syllabus id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch','post', 'put']);
        $syllabus = $this->Syllabuses->get($id);
        $syllabus = $this->Syllabuses->patchEntity($syllabus, $this->request->getData());
        $syllabus->is_deleted='Y';
        if ($this->Syllabuses->delete($syllabus)) {
            $this->Flash->success(__('The syllabus has been deleted.'));
        } else {
            $this->Flash->error(__('The syllabus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view']);
    }
}
