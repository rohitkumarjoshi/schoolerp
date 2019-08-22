<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * ClassTests Controller
 *
 * @property \App\Model\Table\ClassTestsTable $ClassTests
 *
 * @method \App\Model\Entity\ClassTest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClassTestsController extends AppController
{
     public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
         
        $this->Security->setConfig('unlockedActions', ['add','fillMarks','index','report']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if($this->request->is(['post']))
        {
            $classtest_id=$this->request->getData('classtest_id');
             if(!empty($classtest_id))
                 {
                    $query = $this->ClassTests->query();
                    $result = $query->update()
                    ->set(['is_deleted' => 'Y'])
                    ->where(['id' =>$classtest_id ])
                    ->execute();
                    $this->Flash->success(__('The class test has been deleted.'));
                     return $this->redirect(['action' => 'index']);
                 }
        }
        $this->paginate = [
            'contain' => ['SessionYears', 'Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects']
        ];

        $classTests = $this->ClassTests->find();
        $classTests->where(['ClassTests.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('medium_id'))){
            $classTests->where(['ClassTests.medium_id'=>$this->request->getQuery('medium_id')]);
        }
        if(!empty($this->request->getQuery('student_class_id'))){
            $classTests->where(['ClassTests.student_class_id'=>$this->request->getQuery('student_class_id')]);
        }
        if(!empty($this->request->getQuery('stream_id'))){
            $classTests->where(['ClassTests.stream_id'=>$this->request->getQuery('stream_id')]);
        }
        if(!empty($this->request->getQuery('section_id'))){
            $classTests->where(['ClassTests.section_id'=>$this->request->getQuery('section_id')]);
        }
        if(!empty($this->request->getQuery('subject_id'))){
            $classTests->where(['ClassTests.subject_id'=>$this->request->getQuery('subject_id')]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $classTests->where(['test_date >=' =>$date_from,'test_date <=' =>$date_to]);
        }
        $classTests->order(['ClassTests.id'=>'DESC']);
        $classTests = $this->paginate($classTests);

       
        $mediums = $this->ClassTests->Mediums->find('list', ['limit' => 200])->where(['Mediums.is_deleted'=>'N']);
        $studentClasses = $this->ClassTests->StudentClasses->find('list', ['limit' => 200])->where(['StudentClasses.is_deleted'=>'N']);
        $streams = $this->ClassTests->Streams->find('list', ['limit' => 200])->where(['Streams.is_deleted'=>'N']);
        $sections = $this->ClassTests->Sections->find('list', ['limit' => 200])->where(['Sections.is_deleted'=>'N']);
        $subjects = $this->ClassTests->Subjects->find('list', ['limit' => 200])->where(['Subjects.is_deleted'=>'N']);

        $this->set(compact('classTests', 'sessionYears', 'mediums', 'studentClasses', 'streams', 'sections', 'subjects'));
    
    }

    /**
     * View method
     *
     * @param string|null $id Class Test id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $classTest = $this->ClassTests->get($id, [
            'contain' => ['SessionYears', 'Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'ClassTestStudents']
        ]);

        $this->set('classTest', $classTest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $login_type = $this->Auth->User('login_type');
        $session_year_id = $this->Auth->User('session_year_id');
        $classTest = $this->ClassTests->newEntity();
        if ($this->request->is('post')) {
            //pr($this->request->getData());exit;
            $classTest = $this->ClassTests->patchEntity($classTest, $this->request->getData());
            $classTest->test_date=date('Y-m-d',strtotime($this->request->getData('test_date')));
            $classTest->session_year_id = $session_year_id;
            $classTest->created_by = $user_id;
            if ($this->ClassTests->save($classTest)) {
                $this->Flash->success(__('The class test has been saved.'));
                if(isset($this->request->data['fill_marks'])){

                    return $this->redirect(['action' => 'fillMarks',$this->EncryptingDecrypting->encryptData($classTest->id)]);
                }
                else{
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The class test could not be saved. Please, try again.'));
        } 
        //$mediums = $this->ClassTests->Mediums->find('list', ['limit' => 200]); 
        $option=[];
        $user_type = $this->Auth->User('login_type');
        if ($user_type=='Employee') {
             $data = $this->ClassTests->FacultyClassMappings->ClassMappings->find()->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.employee_id'=>$user_id,'ClassMappings.is_deleted'=>'N'])->contain(['StudentClasses','Mediums','Streams','Sections'])->first();

        }
        else
        {
             $data = $this->ClassTests->FacultyClassMappings->ClassMappings->find()->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.is_deleted'=>'N'])->contain(['StudentClasses','Mediums','Streams','Sections'])->first();

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
            $getSubject = $this->ClassTests->Subjects->find()->where(['Subjects.student_class_id'=>$student_class_id,'Subjects.stream_id'=>$stream_id,'Subjects.session_year_id'=>$session_year_id,'Subjects.is_deleted'=>'N']);
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
            //pr($option);
            
        $this->set(compact('classTest', 'sessionYears', 'mediums', 'studentClasses', 'streams', 'sections', 'subjects','option'));
    }

    public function fillMarks($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $user_id = $this->Auth->User('id');
        $login_type = $this->Auth->User('login_type');
        $session_year_id = $this->Auth->User('session_year_id');

        $classTest = $this->ClassTests->get($id, [
            'contain' => ['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects', 'ClassTestStudents']
        ]);
        //pr($classTest->toArray());exit; 
        $std_marks=[];
        foreach ($classTest->class_test_students as $class_testData) {
                $std_id=$class_testData->student_info_id;
                $std_marks[$std_id]=$class_testData->marks;

        }
        //pr($std_marks);exit;
        $medium_id = $classTest->medium_id;
        $student_class_id = $classTest->student_class_id;
        $stream_id = $classTest->stream_id;
        $section_id = $classTest->section_id;
        $condition=[];
        if(!empty($medium_id)){
            $condition['StudentInfos.medium_id']=$medium_id;
        }
        if(!empty($student_class_id)){
            $condition['StudentInfos.student_class_id']=$student_class_id;
        }
        if(!empty($stream_id)){
            $condition['StudentInfos.stream_id']=$stream_id;
        }
        if(!empty($section_id)){
            $condition['StudentInfos.section_id']=$section_id;
        }
        $studnetData = $this->ClassTests->ClassTestStudents->StudentInfos->find()->contain(['Students'])->where($condition)->order(['roll_no'=>'ASC']);

        if($this->request->is(['post']))
        {
            
            $student_id=$this->request->getData('student_id');
            $marks=$this->request->getData('marks');
            $x=0;
            foreach ($student_id as $student) {
                //$entity = $this->Articles->get(2);
                $this->ClassTests->ClassTestStudents->deleteAll(['ClassTestStudents.class_test_id'=>$id,'ClassTestStudents.student_info_id'=>$student]);
                 $classtestStudent = $this->ClassTests->ClassTestStudents->newEntity();
                 $classtestStudent->student_info_id = $student;
                 $classtestStudent->class_test_id = $id;
                 $classtestStudent->created_by = $user_id;
                 $classtestStudent->marks = $marks[$x];
                 //pr($classtestStudent);exit;
                 $this->ClassTests->ClassTestStudents->save($classtestStudent);
            $x++;
            }
            return $this->redirect(['action' => 'index']);

        } 
        $subject_id = $classTest->subject_id;
        $this->set(compact('classTest','studnetData','std_marks'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Class Test id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $classTest = $this->ClassTests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classTest = $this->ClassTests->patchEntity($classTest, $this->request->getData());
            if ($this->ClassTests->save($classTest)) {
                $this->Flash->success(__('The class test has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The class test could not be saved. Please, try again.'));
        }
        $sessionYears = $this->ClassTests->SessionYears->find('list', ['limit' => 200]);
        $media = $this->ClassTests->Media->find('list', ['limit' => 200]);
        $studentClasses = $this->ClassTests->StudentClasses->find('list', ['limit' => 200]);
        $streams = $this->ClassTests->Streams->find('list', ['limit' => 200]);
        $sections = $this->ClassTests->Sections->find('list', ['limit' => 200]);
        $subjects = $this->ClassTests->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('classTest', 'sessionYears', 'media', 'studentClasses', 'streams', 'sections', 'subjects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Class Test id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classTest = $this->ClassTests->get($id);
        if ($this->ClassTests->delete($classTest)) {
            $this->Flash->success(__('The class test has been deleted.'));
        } else {
            $this->Flash->error(__('The class test could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report()
    {
        $classTest = $this->ClassTests->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['post']))
        {
            //pr($this->request->getData('data'));exit;
            foreach ($this->request->getData('data') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'test_date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['ClassTests.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
           
            $classTests = $this->ClassTests->find()
                ->contain(['Mediums', 'StudentClasses', 'Streams', 'Sections', 'Subjects'])
                ->where([$where,'ClassTests.is_deleted'=>'N'])
                ->order(['ClassTests.id'=>'DESC']);
            if(!empty($classTests->toArray()))
            {
                $data_exist='data_exist';
            }
            else{
                $data_exist='No Record Found';
            }  

        }

        $mediums = $this->ClassTests->Mediums->find('list', ['limit' => 200])->where(['Mediums.is_deleted'=>'N']);
        $studentClasses = $this->ClassTests->StudentClasses->find('list', ['limit' => 200])->where(['StudentClasses.is_deleted'=>'N']);
        $streams = $this->ClassTests->Streams->find('list', ['limit' => 200])->where(['Streams.is_deleted'=>'N']);
        $sections = $this->ClassTests->Sections->find('list', ['limit' => 200])->where(['Sections.is_deleted'=>'N']);
        $subjects = $this->ClassTests->Subjects->find('list', ['limit' => 200])->where(['Subjects.is_deleted'=>'N']);

        $this->set(compact('classTests', 'classTest', 'mediums', 'studentClasses', 'streams', 'sections', 'subjects','data_exist'));
    
    }
}
