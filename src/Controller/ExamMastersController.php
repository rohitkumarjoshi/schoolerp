<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * ExamMasters Controller
 *
 * @property \App\Model\Table\ExamMastersTable $ExamMasters
 *
 * @method \App\Model\Entity\ExamMaster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExamMastersController extends AppController
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
    public function index()
    {
        $examMaster = $this->ExamMasters->newEntity();
        $where['ExamMasters.is_deleted'] = 'N';

        if($this->request->is('post'))
        {
            foreach ($this->request->getData() as $key => $value) {
                if(!empty($value) && $key != 'medium_id')
                    $where['ExamMasters.'.$key] = $value;
            }
        }

        $this->paginate = [
            'contain' => ['SessionYears', 'StudentClasses', 'Streams', 'ParentExamMasters']
        ];
        $examMasters = $this->paginate($this->ExamMasters->find()->where($where));

        $mediums = $this->ExamMasters->Mediums->find('list');

        $streams = '';
        $this->set(compact('examMaster', 'examMasters',  'sessionYears', 'mediums', 'streams', 'parentExamMasters'));
    }

    /**
     * View method
     *
     * @param string|null $id Exam Master id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $examMaster = $this->ExamMasters->get($id, [
            'contain' => ['SessionYears', 'StudentClasses', 'Streams', 'ParentExamMasters', 'ChildExamMasters', 'StudentMarks']
        ]);

        $this->set('examMaster', $examMaster);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if(isset($id))
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $examMaster = $this->ExamMasters->get($id, [
            'contain' => []
            ]);
        }
        else
            $examMaster = $this->ExamMasters->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $data = array_filter($data);

            $examMaster = $this->ExamMasters->patchEntity($examMaster, $data);
            $examMaster->session_year_id = $this->Auth->user('session_year_id');

            if(!isset($id))
                $examMaster->created_by = $this->Auth->user('id');
            else
                $examMaster->edited_by = $this->Auth->user('id');

            if ($this->ExamMasters->save($examMaster)) {
                $this->Flash->success(__('The exam master has been saved.'));

                if (isset($id))
                    return $this->redirect(['action' => 'index']);
                else
                    return $this->redirect(['action' => 'add']);
            }
            pr($examMaster);exit;
            $this->Flash->error(__('The exam master could not be saved. Please, try again.'));
        }
        $sessionYears = $this->ExamMasters->SessionYears->find('list');
        $studentClasses = $this->ExamMasters->StudentClasses->find('list')->where(['is_deleted'=>'N'])->order('order_of_class');
        $streams = $this->ExamMasters->Streams->find('list');
        $parentExamMasters = $this->ExamMasters->ParentExamMasters->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('examMaster', 'sessionYears', 'studentClasses', 'streams', 'parentExamMasters','id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Exam Master id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $examMaster = $this->ExamMasters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $examMaster = $this->ExamMasters->patchEntity($examMaster, $this->request->getData());
            if ($this->ExamMasters->save($examMaster)) {
                $this->Flash->success(__('The exam master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam master could not be saved. Please, try again.'));
        }
        $sessionYears = $this->ExamMasters->SessionYears->find('list');
        $studentClasses = $this->ExamMasters->StudentClasses->find('list');
        $streams = $this->ExamMasters->Streams->find('list');
        $parentExamMasters = $this->ExamMasters->ParentExamMasters->find('list');
        $this->set(compact('examMaster', 'sessionYears', 'studentClasses', 'streams', 'parentExamMasters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Exam Master id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $examMaster = $this->ExamMasters->get($id);
        $examMaster->is_deleted = 'Y';
        if ($this->ExamMasters->save($examMaster)) {
            $this->Flash->success(__('The exam master has been deleted.'));
        } else {
            $this->Flash->error(__('The exam master could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getExams()
    {
        $where['ExamMasters.is_deleted'] = 'N';
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where['ExamMasters.'.$key] = $value;
        }
        $response = $this->ExamMasters->find()->select(['id','name','parent_id','order_number'])->where($where)->order('order_number');

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response']);
    }

    public function getExamsThreaded()
    {
        $class_mapping = $this->ExamMasters->StudentMarks->ClassMappings->get($this->request->getData('class_mapping_id'));
        $where['ExamMasters.is_deleted'] = 'N';
        $where['ExamMasters.student_class_id'] = $class_mapping->student_class_id;
        $where['ExamMasters.stream_id'] = $class_mapping->stream_id;


        $response = $this->ExamMasters->find('threaded')->select(['ExamMasters.id','ExamMasters.name','parent_id','order_number','SubExams.id'])->leftJoinWith('SubExams')->where([$where,'SubExams.id IS NULL','ExamMasters.rght-ExamMasters.lft'=>1])->order('order_number');
        $sub_exams = $this->ExamMasters->find('All')->where($where)->contain(['SubExams'])->order('order_number');

        $this->set(compact('success','response','sub_exams'));
        $this->set('_serialize', ['response','sub_exams']);
    }

    public function getParentExams()
    {
        $where['ExamMasters.is_deleted'] = 'N';
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where['ExamMasters.'.$key] = $value;
        }
        $response = $this->ExamMasters->find('threaded')->where([$where])->order('order_number');

        $this->set(compact('success','response','sub_exams'));
        $this->set('_serialize', ['response','sub_exams']);
    }
}
