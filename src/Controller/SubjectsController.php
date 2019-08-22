<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Subjects Controller
 *
 * @property \App\Model\Table\SubjectsTable $Subjects
 *
 * @method \App\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubjectsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }

        $this->Security->setConfig('unlockedActions', ['add','edit']);
    }

    public function index()
    {
        $subject = $this->Subjects->newEntity();

        $this->paginate = [
            'contain' => ['SessionYears', 'StudentClasses', 'Streams', 'ParentSubjects', 'SubjectTypes']
        ];

        $subjects = $this->Subjects->find()
            ->where(['Subjects.session_year_id'=>$this->Auth->user('session_year_id')])
            ->where(['Subjects.is_deleted'=>'N']);

        if($this->request->is('post'))
        {
            foreach ($this->request->getData() as $key => $value) {
                if(!empty($value) && $key != 'medium_id')
                    $subjects->where(['Subjects.'.$key => $value]);
            }
        }

        $subjects = $this->paginate($subjects);

        $mediums = $this->Subjects->Mediums->find('list');
        $streams = [];
        $this->set(compact('subject', 'mediums', 'streams','subjects'));
    }

    /**
     * View method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $subject = $this->Subjects->get($id, [
    //         'contain' => ['SessionYears', 'StudentClasses', 'Streams', 'ParentSubjects', 'SubjectTypes', 'Books', 'ChildSubjects']
    //     ]);

    //     $this->set('subject', $subject);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subject = $this->Subjects->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $subjects = $this->request->getData('subjects');
            foreach ($subjects as $key => $sub) {
                $subjects[$key]['session_year_id'] = $this->Auth->user('session_year_id');
                $subjects[$key]['created_by'] = $this->Auth->user('id');
                $subjects[$key]['student_class_id'] = $this->request->getData('student_class_id');
                $subjects[$key]['stream_id'] = @$this->request->getData('stream_id');
                 $data[] = array_filter($subjects[$key]);
            }
            $subjects = $this->Subjects->newEntities($data);
            
            if ($this->Subjects->saveMany($subjects)) {
                $this->Flash->success(__('The subject has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            pr($subjects);exit;
            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
        }

        $studentClasses = $this->Subjects->StudentClasses->find('list')->order('order_of_class');
        $streams = '';
        $parentSubjects = [];
        $subjectTypes = $this->Subjects->SubjectTypes->find('list');
        $this->set(compact('subject', 'sessionYears', 'studentClasses', 'streams', 'parentSubjects', 'subjectTypes','id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if(isset($id))
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $subject = $this->Subjects->get($id, [
                'contain' => []
            ]);
        }
        else
            $subject = $this->Subjects->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->getData());

            $subject->session_year_id = $this->Auth->user('session_year_id');

            if(!isset($id))
                $subject->created_by = $this->Auth->user('id');
            else
                $subject->edited_by = $this->Auth->user('id');

            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                if (isset($id))
                    return $this->redirect(['action' => 'index']);
                else
                    return $this->redirect(['action' => 'add']);
            }
            //pr($subject->errors());exit;
            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
        }

        $studentClasses = $this->Subjects->StudentClasses->find('list')->order('order_of_class');
        $streams = '';
        $parentSubjects = $this->Subjects->ParentSubjects->find('list')->where(['is_deleted'=>'N']);
        $subjectTypes = $this->Subjects->SubjectTypes->find('list');
        $this->set(compact('subject', 'sessionYears', 'studentClasses', 'streams', 'parentSubjects', 'subjectTypes','id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->Subjects->get($id);
        $subject->is_deleted = 'Y';
        if ($this->Subjects->save($subject)) {
            $this->Flash->success(__('The subject has been deleted.'));
        } else {
            $this->Flash->error(__('The subject could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getStreams()
    {
        $id = $this->request->getData('class_id');
        $success = 0;

        $response = $this->Subjects->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])
                ->select(['id'=>'Subjects.stream_id','name'=>'Streams.name'])->contain(['Streams'])->where(['Subjects.student_class_id'=>$id,'Subjects.is_deleted'=>'N','stream_id !='=>0])->distinct('Subjects.stream_id');

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getSubjects()
    {
        $where['Subjects.is_deleted'] = 'N';
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where['Subjects.'.$key] = $value;
        }
        $response = $this->Subjects->find();
        $response->select(['id','name','parent_id','parent'=>'ParentSubjects.name'])
                ->where([$where,'Subjects.rght-Subjects.lft'=>1])
                ->order('Subjects.parent_id')
                ->contain(['ParentSubjects']);

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response']);
    }

    public function getParent()
    {
        $where['Subjects.is_deleted'] = 'N';
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where['Subjects.'.$key] = $value;
        }
        $response = $this->Subjects->find();
        $response->select(['id','name','parent_id','parent'=>'ParentSubjects.name','order_number'])
                ->where([$where])
                ->order('Subjects.order_number')
                ->contain(['ParentSubjects']);

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response']);
    }
}
