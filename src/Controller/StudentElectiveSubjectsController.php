<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * StudentElectiveSubjects Controller
 *
 * @property \App\Model\Table\StudentElectiveSubjectsTable $StudentElectiveSubjects
 *
 * @method \App\Model\Entity\StudentElectiveSubject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentElectiveSubjectsController extends AppController
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
        $studentElectiveSubject = $this->StudentElectiveSubjects->newEntity();

        $this->paginate = [
            'contain' => ['StudentInfos', 'Subjects', 'SessionYears']
        ];
        $studentElectiveSubjects = $this->paginate($this->StudentElectiveSubjects);

        $studentInfos = $this->StudentElectiveSubjects->StudentInfos->find('list');
        $subjects = $this->StudentElectiveSubjects->Subjects->find('list');
        $mediums = $this->StudentElectiveSubjects->StudentInfos->Mediums->find('list');

        $this->set(compact('studentElectiveSubjects', 'studentElectiveSubject', 'studentInfos', 'subjects', 'sessionYears','mediums'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentElectiveSubject = $this->StudentElectiveSubjects->newEntity();
        if ($this->request->is('post')) {
            $studentElectiveSubject = $this->StudentElectiveSubjects->patchEntity($studentElectiveSubject, $this->request->getData());
            $studentElectiveSubject->session_year_id = $this->Auth->user('session_year_id');
            if ($this->StudentElectiveSubjects->save($studentElectiveSubject))
                $success = true;
            else
                $success = false;
        }
        $this->set(compact('success'));
        $this->set('_serialize', ['success']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Elective Subject id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        if ($this->request->is('post')) {
            $studentElectiveSubject = $this->StudentElectiveSubjects->find()->where($this->request->getData())->order(['id'=>'DESC'])->first();
            if ($this->StudentElectiveSubjects->delete($studentElectiveSubject))
                $success = true;
            else
                $success = false;
        }

        $this->set(compact('success'));
        $this->set('_serialize', ['success']);
    }

    public function getStudents()
    {
        $where['Students.is_deleted'] = 'N';
        $where2['Subjects.is_deleted'] = 'N';
        $where['StudentInfos.session_year_id'] = $this->Auth->user('session_year_id');
        $where2['Subjects.session_year_id'] = $this->Auth->user('session_year_id');
        $where2['Subjects.rght-Subjects.lft'] = 1;
        foreach ($this->request->getData('StudentInfos') as $key => $value) {
            if(!empty($value))
            {
                if($key == 'student_class_id')
                    $where2['Subjects.student_class_id'] = $value;

                if($key == 'stream')
                    $where2['Subjects.stream'] = $value;

                $where['StudentInfos.'.$key] = $value;
            }
        }

        $subject = $this->StudentElectiveSubjects->Subjects->find()->select(['Subjects.id','Subjects.name','Subjects.parent_id','parent'=>'ParentSubjects.name'])->where([$where2,'Subjects.elective'=>'Yes'])->contain(['ParentSubjects']);
        $success = 0;

        $response = $this->StudentElectiveSubjects->StudentInfos->find();
        $response->select(['StudentInfos.id','name'=>'Students.name','rollno'=>'StudentInfos.roll_no','scholer'=>'Students.scholar_no'])
        ->contain(['Students','StudentElectiveSubjects'])
        ->where([$where]);

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response','subject','vivek'));
        $this->set('_serialize', ['response','subject','success','vivek']);
    }
}
