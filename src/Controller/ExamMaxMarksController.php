<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * ExamMaxMarks Controller
 *
 * @property \App\Model\Table\ExamMaxMarksTable $ExamMaxMarks
 *
 * @method \App\Model\Entity\ExamMaxMark[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExamMaxMarksController extends AppController
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
        $session_year_id = $this->Auth->user('session_year_id');
        if(isset($id))
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $examMaxMark = $this->ExamMaxMarks->get($id, [
                'contain' => []
            ]);
        }
        else
            $examMaxMark = $this->ExamMaxMarks->newEntity();

        $where['ExamMaxMarks.session_year_id'] = $this->Auth->user('session_year_id');
        $where['ExamMaxMarks.is_deleted'] = 'N';
        foreach(@$this->request->getData() as $key => $data)
            if(!empty($data))
                $where['ExamMasters.'.$key] = $data;
            //pr($where);exit;

        $this->paginate = [
            'contain' => ['ExamMasters'=>['StudentClasses','Streams'], 'Subjects']
        ];
        $examMaxMarks = $this->paginate($this->ExamMaxMarks->find()->where($where));
                //pr($examMaxMarks->toArray());exit;

        $studentClasses = $this->ExamMaxMarks->ExamMasters->StudentClasses->ClassMappings->find('list',[
                'keyField' => 'id',
                'valueField' => 'name'
            ])->where(['ClassMappings.session_year_id'=>$session_year_id]);
        $studentClasses->select(['id'=>'ClassMappings.student_class_id','name'=>'StudentClasses.name'])->contain(['StudentClasses'])
            ->where(['student_class_id !='=>0,'grade_type !='=>'Grade'])
            ->distinct('student_class_id');
        $mediums = $this->ExamMaxMarks->Mediums->find('list');       
        $this->set(compact('examMaxMark','examMaxMarks', 'examMasters', 'studentClasses', 'mediums','id'));
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
            $examMaxMark = $this->ExamMaxMarks->get($id, [
                'contain' => []
            ]);
        }
        else
            $examMaxMark = $this->ExamMaxMarks->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if(!isset($id))
                $examMaxMark->created_by = $this->Auth->user('id');
            else
                $examMaxMark->edited_by = $this->Auth->user('id');

            $examMaxMark = $this->ExamMaxMarks->patchEntity($examMaxMark, $data);
            //pr($examMaxMark);exit;
            if ($this->ExamMaxMarks->save($examMaxMark)) {
                $this->Flash->success(__('The exam max mark has been saved.'));
            }
            else
                $this->Flash->error(__('The exam max mark could not be saved. Please, try again.'));

            //pr($examMaxMark);exit;
            return $this->redirect(['action' => 'index']);
        }

        $mediums = $this->ExamMaxMarks->Mediums->find('list'); 
        $data = $this->ExamMaxMarks->ClassMappings->find();
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
              
        $this->set(compact('examMaxMark','examMaxMarks', 'examMasters', 'studentClasses', 'classMappings','id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Exam Max Mark id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $examMaxMark = $this->ExamMaxMarks->get($id);
        if ($this->ExamMaxMarks->updateAll(
                    [  // fields
                        'is_deleted' => 'Y'
                    ],
                    [  // conditions
                        'exam_master_id' => $examMaxMark->exam_master_id
                    ]
                )
            ) {
            $this->Flash->success(__('The exam max mark has been deleted.'));
        } else {
            $this->Flash->error(__('The exam max mark could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getMaxMarks()
    {
        $where['ExamMaxMarks.is_deleted'] = 'N';
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where['ExamMaxMarks.'.$key] = $value;
        }
        
        if($this->ExamMaxMarks->exists($where))
        {
            $success = 1;
            $response = $this->ExamMaxMarks->find()->where($where)->first()->max_marks;
        }
        elseif ($this->ExamMaxMarks->exists(['ExamMaxMarks.exam_master_id'=>$this->request->getData('exam_master_id')]))
        {
            $success = 1;
            $response = $this->ExamMaxMarks->find()->where(['ExamMaxMarks.exam_master_id'=>$this->request->getData('exam_master_id')])->first()->max_marks;
        }
        else
            $success = 0;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['success','response']);
    }

    public function getSubjects()
    {
        $class_mapping = $this->ExamMaxMarks->ClassMappings->get($this->request->getData('class_mapping_id'));

        $session_year_id = $this->Auth->user('session_year_id');
        $where['Subjects.is_deleted'] = 'N';
        $where['Subjects.session_year_id'] = $session_year_id;
        
        $exam_master_id = $this->request->getData('exam_master_id');
        $success = 0;

        $response = $this->ExamMaxMarks->Subjects->find()
                    ->select(['id','name','parent_id','order_number','parent'=>'ParentSubjects.name','max_marks'=>'ExamMaxMarks.max_marks'])
                    ->leftJoinWith('ExamMaxMarks',function($q)use($exam_master_id,$session_year_id){
                        return $q->where(['ExamMaxMarks.exam_master_id'=>$exam_master_id,'ExamMaxMarks.session_year_id'=>$session_year_id]);
                    })
                    ->where([$where,'Subjects.rght-Subjects.lft'=>1])
                    ->where(['Subjects.student_class_id'=>$class_mapping->student_class_id])
                    ->where(['Subjects.stream_id'=>$class_mapping->stream_id])
                    ->order('Subjects.order_number')
                    ->contain(['ParentSubjects']);

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function saveMarks()
    {
        $data = $this->request->getData();
        unset($data['max_marks']);
        $data['session_year_id'] = $this->Auth->user('session_year_id');
        if($this->ExamMaxMarks->exists([$data]))
        {
            $mark = $this->ExamMaxMarks->find()->where($data)->first();
            $mark->edited_by = $this->Auth->user('id');
        }
        else
        {
            $mark = $this->ExamMaxMarks->newEntity();
            $mark->session_year_id = $data['session_year_id'];
            $mark->created_by = $this->Auth->user('id');
        }

        $mark_patch = $this->ExamMaxMarks->patchEntity($mark,$this->request->getData());

        if($this->request->getData('max_marks'))
            $save = $this->ExamMaxMarks->save($mark_patch);
        else
            $save = $this->ExamMaxMarks->delete($mark);

        if($save)
            $success = true;
        else
            $success = false;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
}
