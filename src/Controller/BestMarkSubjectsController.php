<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * BestMarkSubjects Controller
 *
 * @property \App\Model\Table\BestMarkSubjectsTable $BestMarkSubjects
 *
 * @method \App\Model\Entity\BestMarkSubject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BestMarkSubjectsController extends AppController
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
        if(is_null($id))
            $bestMarkSubject = $this->BestMarkSubjects->newEntity();
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $bestMarkSubject = $this->BestMarkSubjects->get($id, [
                'contain' => []
            ]);
        }

        $where['BestMarkSubjects.session_year_id'] = $this->Auth->user('session_year_id');
        $where['BestMarkSubjects.is_deleted'] = 'N';
        foreach(@$this->request->getData() as $key => $data)
            if(!empty($data))
                $where['BestMarkSubjects.'.$key] = $data;

        $this->paginate = [
            'contain' => ['SessionYears', 'StudentClasses', 'Streams', 'Subjects']
        ];
        $bestMarkSubjects = $this->paginate($this->BestMarkSubjects->find()->where($where));

        $studentClasses = $this->BestMarkSubjects->Subjects->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])
                ->select(['id'=>'Subjects.student_class_id','name'=>'StudentClasses.name'])->contain(['StudentClasses'])->where(['Subjects.is_deleted'=>'N','student_class_id !='=>0])->distinct('Subjects.student_class_id');
        $streams = '';
        $subjects = '';
        $this->set(compact('bestMarkSubject', 'bestMarkSubjects', 'sessionYears', 'studentClasses', 'streams', 'subjects','id'));
    }

    /**
     * View method
     *
     * @param string|null $id Best Mark Subject id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $bestMarkSubject = $this->BestMarkSubjects->get($id, [
    //         'contain' => ['SessionYears', 'StudentClasses', 'Streams', 'Subjects', 'BestMarkSubjectRows']
    //     ]);

    //     $this->set('bestMarkSubject', $bestMarkSubject);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if(is_null($id))
            $bestMarkSubject = $this->BestMarkSubjects->newEntity();
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $bestMarkSubject = $this->BestMarkSubjects->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {

            foreach ($this->request->getData('exam_masters') as $key => $value) {
                $a[]['exma_master_id'] = $value[0];
            }

            $bestMarkSubject->best_mark_subject_rows = $a;

            if($this->request->is('post'))
                $bestMarkSubject->created_by = $this->Auth->user('id'); 
            else
                $bestMarkSubject->edited_by = $this->Auth->user('id');

            $bestMarkSubject->session_year_id = $this->Auth->user('session_year_id');

            $bestMarkSubject = $this->BestMarkSubjects->patchEntity($bestMarkSubject, $this->request->getData());

            if ($this->BestMarkSubjects->save($bestMarkSubject)) {
                $this->Flash->success(__('The best mark subject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The best mark subject could not be saved. Please, try again.'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Best Mark Subject id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bestMarkSubject = $this->BestMarkSubjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bestMarkSubject = $this->BestMarkSubjects->patchEntity($bestMarkSubject, $this->request->getData());
            if ($this->BestMarkSubjects->save($bestMarkSubject)) {
                $this->Flash->success(__('The best mark subject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The best mark subject could not be saved. Please, try again.'));
        }
        $sessionYears = $this->BestMarkSubjects->SessionYears->find('list');
        $studentClasses = $this->BestMarkSubjects->StudentClasses->find('list');
        $streams = $this->BestMarkSubjects->Streams->find('list');
        $subjects = $this->BestMarkSubjects->Subjects->find('list');
        $this->set(compact('bestMarkSubject', 'sessionYears', 'studentClasses', 'streams', 'subjects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Best Mark Subject id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bestMarkSubject = $this->BestMarkSubjects->get($id);
        if ($this->BestMarkSubjects->delete($bestMarkSubject)) {
            $this->Flash->success(__('The best mark subject has been deleted.'));
        } else {
            $this->Flash->error(__('The best mark subject could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
