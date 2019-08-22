<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * StudentHealths Controller
 *
 * @property \App\Model\Table\StudentHealthsTable $StudentHealths
 *
 * @method \App\Model\Entity\StudentHealth[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentHealthsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
        $this->Security->setConfig('unlockedActions', ['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {

        $this->paginate = [
            'contain' => ['SessionYears', 'StudentInfos'=>'Students', 'HealthMasters']
        ];

        $studentHealths = $this->paginate($this->StudentHealths->find()->where(['StudentHealths.is_deleted'=>'N'])->order(['StudentHealths.id'=>'ASC']));

        $this->set(compact('studentHealths'));
    }

    /**
     * View method
     *
     * @param string|null $id Student Health id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $studentHealth = $this->StudentHealths->get($id, [
    //         'contain' => ['SessionYears', 'StudentInfos', 'HealthMasters']
    //     ]);

    //     $this->set('studentHealth', $studentHealth);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentHealth = $this->StudentHealths->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData('data');
            foreach ($data as $key => $st) {
                $data[$key]['created_by'] = $this->Auth->user('id');
                $data[$key]['session_year_id'] = $this->Auth->user('session_year_id');
            }
            $studentHealth = $this->StudentHealths->newEntities($data);

            $error='';
             try{
                    if ($this->StudentHealths->saveMany($studentHealth)) 
                    {
                        $this->Flash->success(__('The student health has been saved.'));
                        return $this->redirect(['action' => 'add']);
                    }
                } catch (\Exception $e) {
               $error = $e->getMessage();
                }
                 if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The student health could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }

        $data = $this->StudentHealths->ClassMappings->find();
        $data->select(['id'=>'ClassMappings.id','Mname'=>'Mediums.name','Cname'=>'StudentClasses.name','Sname'=>'Streams.name','SCname'=>'Sections.name'])
            ->where(['ClassMappings.session_year_id'=>$this->Auth->user('session_year_id')])
            ->group(['ClassMappings.medium_id','ClassMappings.student_class_id','ClassMappings.stream_id'])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        
        foreach ($data as $key => $clss) {
            $name = '';
            foreach ($clss->toArray() as $key2 => $value)
            {
                if(!empty($value) && $key2 != 'id')
                {
                    if($key2 != 'Mname')
                        $name.=" > ";
                    $name.=$value;
                }
            }
            $classMappings[$clss->id] = $name;
        }

        $studentInfos = $this->StudentHealths->StudentInfos->find('list');
        $mediums = $this->StudentHealths->ClassMappings->Mediums->find('list');
        $healthMasters = $this->StudentHealths->HealthMasters->find('list');
        $this->set(compact('studentHealth', 'studentHealths', 'sessionYears', 'studentInfos', 'healthMasters', 'mediums','classMappings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Health id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $studentHealth = $this->StudentHealths->get($id, [
            'contain' => ['StudentInfos'=>'Students', 'HealthMasters']
        ]);
        //pr($studentHealth);exit;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentHealth->edited_by = $this->Auth->user('id');
            $studentHealth = $this->StudentHealths->patchEntity($studentHealth, $this->request->getData());
            if ($this->StudentHealths->save($studentHealth)) {
                $this->Flash->success(__('The student health has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student health could not be saved. Please, try again.'));
        }
        $sessionYears = $this->StudentHealths->SessionYears->find('list');
        $studentInfos = $this->StudentHealths->StudentInfos->find('list');
        $healthMasters = $this->StudentHealths->HealthMasters->find('list');
        $this->set(compact('studentHealth', 'sessionYears', 'studentInfos', 'healthMasters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Health id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentHealth = $this->StudentHealths->get($id);
        $studentHealth->is_deleted = 'Y';
        if ($this->StudentHealths->save($studentHealth)) {
            $this->Flash->success(__('The student health has been deleted.'));
        } else {
            $this->Flash->error(__('The student health could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getClasses()
    { 
        $user_type = $this->Auth->User('login_type');
        $session_year_id = $this->Auth->user('session_year_id');
        $where=array();
        $where['StudentClasses.is_deleted'] = 'N';
        $where['ClassMappings.session_year_id'] = $session_year_id;
        //$where2[''];
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where['ClassMappings.'.$key] = $value;
        }
        
        $success = 0;
        $response = $this->StudentHealths->ClassMappings->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ]);

        $response->innerJoinWith('FacultyClassMappings')->select(['id'=>'ClassMappings.student_class_id','name'=>'StudentClasses.name'])->contain(['StudentClasses']);
        if ($user_type=='Employee') 
        {
            $response->where([$where,'FacultyClassMappings.employee_id'=>$this->Auth->user('id'),'student_class_id !='=>0])->distinct('student_class_id');
        }
        else
        {
           $response->where([$where,'student_class_id !='=>0])
            ->distinct('student_class_id');
        }
         
        
        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getStreams()
    {
        $session_year_id = $this->Auth->user('session_year_id');
        $where['ClassMappings.session_year_id'] = $session_year_id;
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where[$key] = $value;
        }
        $success = 0;
        $user_type = $this->Auth->User('login_type');
        $cond=array();
        if($user_type == "Employee"){
            $cond['FacultyClassMappings.employee_id']=$this->Auth->user('id');
        }
        $response = $this->StudentHealths->ClassMappings->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        $response->innerJoinWith('FacultyClassMappings')->select(['id'=>'ClassMappings.stream_id','name'=>'Streams.name'])->contain(['Streams'])
        ->where([$where,$cond,'stream_id !='=>0])
        ->distinct('stream_id');

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getSections()
    {
        $session_year_id = $this->Auth->user('session_year_id');
        $where['ClassMappings.session_year_id'] = $session_year_id;
        $where['section_id !='] = 0;
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where[$key] = $value;
        }
        //pr($where);exit;
        $user_type = $this->Auth->User('login_type');
        $cond=array();
        if($user_type == "Employee"){
            $cond['FacultyClassMappings.employee_id']=$this->Auth->user('id');
        }
        $success = 0;
        $response = $this->StudentHealths->ClassMappings->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        $response->innerJoinWith('FacultyClassMappings')->select(['id'=>'ClassMappings.section_id','name'=>'Sections.name'])->contain(['Sections'])
        ->where([$where,$cond])
        ->distinct('section_id');

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getSubjects()
    {
        $class_mapping = $this->StudentHealths->ClassMappings->get($this->request->getData('class_mapping_id'));
        $success = 0;

        $co_scholastic_subjects = [];

        if($class_mapping->employee_id != $this->Auth->user('id'))
        {
            $response = $this->StudentHealths->ClassMappings->FacultyClassMappings->Subjects->find();
            $response->innerJoinWith('FacultyClassMappings',function($q){
                                    return $q->innerJoinWith('ClassMappings');
                                })
            ->select(['id','name','parent_id','order_number','parent'=>'ParentSubjects.name'])
            ->order('Subjects.parent_id')
            ->contain(['ParentSubjects'])
            ->where(['Subjects.student_class_id'=>$class_mapping->student_class_id])
            ->where(['Subjects.stream_id'=>$class_mapping->stream_id])
            ->where(['Subjects.is_deleted'=>'N'])
            ->where(['Subjects.rght-Subjects.lft'=>1,'FacultyClassMappings.employee_id'=>$this->Auth->user('id')]);
        }
        else
        {
            $response = $this->StudentHealths->ClassMappings->FacultyClassMappings->Subjects->find()
                    ->select(['id','name','parent_id','order_number','parent'=>'ParentSubjects.name'])
                    ->where(['Subjects.rght-Subjects.lft'=>1])
                    ->where(['Subjects.student_class_id'=>$class_mapping->student_class_id])
                    ->where(['Subjects.stream_id'=>$class_mapping->stream_id])
                    ->where(['Subjects.is_deleted'=>'N'])
                    ->order('Subjects.parent_id')
                    ->contain(['ParentSubjects']);
        }

        if(!empty($response->toArray()) || $co_scholastic_subjects)
            $success = 1;

        $this->set(compact('success','response','co_scholastic_subjects'));
        $this->set('_serialize', ['response','success','co_scholastic_subjects']);
    }

    public function getStudents()
    {
        $class_mapping = $this->StudentHealths->ClassMappings->get($this->request->getData('class_mapping_id'));

        $success = 0;
        $response = $this->StudentHealths->StudentInfos->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ]);

        $response->select($this->StudentHealths->StudentInfos)
                    ->select(['name'=>'Students.name'])
                    ->contain(['Students'])
                    ->where(['StudentInfos.medium_id'=>$class_mapping->medium_id])
                    ->where(['StudentInfos.student_class_id'=>$class_mapping->student_class_id])
                    ->where(['StudentInfos.stream_id'=>$class_mapping->stream_id])
                    ->where(['StudentInfos.section_id'=>$class_mapping->section_id])
                    ->where(['is_deleted'=>'N'])
                    ->where(['StudentInfos.session_year_id'=>$this->Auth->user('session_year_id')]);

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }


    public function getErr($value)
    {
        pr($value);
        foreach ($value as $key => $error) {
            if (is_array($error))
                $this->getErr($error);
            else
                return $error;
        }
    }
    //-- DO NOT TOUCH HERE
    public function getStudentsAssignment()
    {
        $where = [];
        foreach ($this->request->getQuery() as $key => $value) {
            if(!empty($value))
                $where[$key] = $value;
        }
        $response=$this->StudentHealths->StudentInfos->find()
            ->select(['name'=>'Students.name','id'=>'Students.id'])
            ->contain(['Students'])
            ->where($where) 
            ->where(['is_deleted'=>'N'])
            ->where(['StudentInfos.session_year_id'=>$this->Auth->user('session_year_id')]);
        foreach ($response as $key => $value) {
            $option[$value->id]=$value->name;
        } 
        if(!empty($option)){
            foreach ($option as $key => $value) {
               echo "<option value='".$key."'>".$value."</option>";
            }
        }
        exit;
         
    }
}
