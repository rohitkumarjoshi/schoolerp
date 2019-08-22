<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * FacultyClassMappings Controller
 *
 * @property \App\Model\Table\FacultyClassMappingsTable $FacultyClassMappings
 *
 * @method \App\Model\Entity\FacultyClassMapping[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FacultyClassMappingsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $facultyClassMapping = $this->FacultyClassMappings->newEntity();

        $this->paginate = [
            'contain' => ['ClassMappings'=>['Mediums','StudentClasses','Streams','Sections'], 'Employees', 'Subjects']
        ];
        $facultyClassMappings = $this->paginate($this->FacultyClassMappings);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->request->is('post'))
                $facultyClassMapping->created_by = $this->Auth->user('id'); 
            else
                $facultyClassMapping->edited_by = $this->Auth->user('id');
            
            $facultyClassMapping->session_year_id = $this->Auth->user('session_year_id');

            $facultyClassMapping = $this->FacultyClassMappings->patchEntity($facultyClassMapping, $this->request->getData());
           
            if ($this->FacultyClassMappings->save($facultyClassMapping)) {
                $this->Flash->success(__('The faculty class mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The faculty class mapping could not be saved. Please, try again.'));
        }
        $data = $this->FacultyClassMappings->ClassMappings->find();
        $data->select(['id'=>'ClassMappings.id','Mname'=>'Mediums.name','Cname'=>'StudentClasses.name','Sname'=>'Streams.name','SCname'=>'Sections.name'])
            ->where(['ClassMappings.session_year_id'=>$this->Auth->user('session_year_id')])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        
        foreach ($data as $key => $d) {
            $name = '';
            foreach ($d->toArray() as $key2 => $value)
            {
                if(!empty($value) && $key2 != 'id')
                {
                    if($key2 != 'Mname')
                        $name.=" -> ";
                    $name.=$value;
                }
            }
            $classMappings[$d->id] = $name;
        }

        $employees = $this->FacultyClassMappings->Employees->find('list');
        $sessionYears = $this->FacultyClassMappings->SessionYears->find('list');
        $class_teacher_status = array('No'=>'No','Yes'=>'Yes');
        $this->set(compact('facultyClassMapping','facultyClassMappings', 'classMappings', 'employees', 'sessionYears','id','class_teacher_status'));
    }
    /**
     * View method
     *
     * @param string|null $id Faculty Class Mapping id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $facultyClassMapping = $this->FacultyClassMappings->get($id, [
    //         'contain' => ['ClassMappings', 'Employees', 'SessionYears']
    //     ]);

    //     $this->set('facultyClassMapping', $facultyClassMapping);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session_year_id = $this->Auth->user('session_year_id');
        $facultyClassMapping = $this->FacultyClassMappings->newEntity();
        if ($this->request->is('post')) {
            $subject_ids = array_filter($this->request->getData('subject_ids'));
            foreach ($subject_ids as $key => $subject_id) {
                $data[$key]=$this->request->getData();
                $data[$key]['subject_id'] = $subject_id[0];
                $data[$key]['session_year_id'] = $this->Auth->user('session_year_id');
            }
            $facultyClassMapping = $this->FacultyClassMappings->patchEntities($facultyClassMapping, $data);
            if ($this->FacultyClassMappings->saveMany($facultyClassMapping)) {
                $this->Flash->success(__('The faculty class mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The faculty class mapping could not be saved. Please, try again.'));
        }
        $classMappings = $this->FacultyClassMappings->ClassMappings->find('list')->where(['ClassMappings.session_year_id'=>$session_year_id]);
        $employees = $this->FacultyClassMappings->Employees->find('list');
        $sessionYears = $this->FacultyClassMappings->SessionYears->find('list');
        $this->set(compact('facultyClassMapping', 'classMappings', 'employees', 'sessionYears'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faculty Class Mapping id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $facultyClassMapping = $this->FacultyClassMappings->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $facultyClassMapping = $this->FacultyClassMappings->patchEntity($facultyClassMapping, $this->request->getData());
    //         if ($this->FacultyClassMappings->save($facultyClassMapping)) {
    //             $this->Flash->success(__('The faculty class mapping has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The faculty class mapping could not be saved. Please, try again.'));
    //     }
    //     $classMappings = $this->FacultyClassMappings->ClassMappings->find('list');
    //     $employees = $this->FacultyClassMappings->Employees->find('list');
    //     $sessionYears = $this->FacultyClassMappings->SessionYears->find('list');
    //     $this->set(compact('facultyClassMapping', 'classMappings', 'employees', 'sessionYears'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Faculty Class Mapping id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facultyClassMapping = $this->FacultyClassMappings->get($id);
        if ($this->FacultyClassMappings->delete($facultyClassMapping)) {
            $this->Flash->success(__('The faculty class mapping has been deleted.'));
        } else {
            $this->Flash->error(__('The faculty class mapping could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getSubjects()
    {
        $where['Subjects.is_deleted'] = 'N';
        $classMapping = $this->FacultyClassMappings->ClassMappings->get($this->request->getData('class_mapping_id'));

        if($classMapping->student_class_id != 0)
            $where['Subjects.student_class_id'] = $classMapping->student_class_id;
        if($classMapping->stream_id != 0)
            $where['Subjects.stream_id'] = $classMapping->stream_id;

        $response = $this->FacultyClassMappings->ClassMappings->StudentClasses->Subjects->find()
                    ->select(['id','name','parent_id','order_number','parent'=>'ParentSubjects.name'])
                    ->where([$where,'Subjects.rght-Subjects.lft'=>1])
                    ->order('Subjects.parent_id')
                    ->contain(['ParentSubjects']);

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response']);
    }
}
