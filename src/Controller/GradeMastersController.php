<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GradeMasters Controller
 *
 * @property \App\Model\Table\GradeMastersTable $GradeMasters
 *
 * @method \App\Model\Entity\GradeMaster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GradeMastersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Security->setConfig('unlockedActions', ['add','index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $gradeMaster = $this->GradeMasters->newEntity();
        
        $where['GradeMasters.session_year_id'] = $this->Auth->user('session_year_id');
        foreach(@$this->request->getData() as $key => $data)
            if(!empty($data))
                $where['GradeMasters.'.$key] = $data;
            
        $this->paginate = [
            'contain' => ['SessionYears', 'StudentClasses', 'Streams']
        ];
        $gradeMasters = $this->paginate($this->GradeMasters->find()->where($where));

        $studentClasses = $this->GradeMasters->StudentClasses->find('list');
        $streams = $this->GradeMasters->Streams->find('list');
        $this->set(compact('gradeMaster', 'gradeMasters', 'sessionYears', 'studentClasses', 'streams','id'));
    }

    /**
     * View method
     *
     * @param string|null $id Grade Master id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gradeMaster = $this->GradeMasters->get($id, [
            'contain' => ['SessionYears', 'StudentClasses', 'Streams']
        ]);

        $this->set('gradeMaster', $gradeMaster);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $grades = $this->request->getData('grades');
            foreach ($grades as $key => $grade) {
                $grades[$key]['created_by'] = $this->Auth->user('id');
                $grades[$key]['session_year_id'] = $this->Auth->user('session_year_id');
                $grades[$key]['student_class_id'] = $this->request->getData('student_class_id');
                if($this->request->getData('stream_id'))
                    $grades[$key]['stream_id'] = $this->request->getData('stream_id');
            }

            $gradeMaster = $this->GradeMasters->newEntities($grades);
            //pr($gradeMaster);exit;
            if ($this->GradeMasters->saveMany($gradeMaster)) {
                $this->Flash->success(__('The grade master has been saved.'));
            }
            else
            {
                pr($gradeMaster);exit;
                $this->Flash->error(__('The grade master could not be saved. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Grade Master id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gradeMaster = $this->GradeMasters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gradeMaster = $this->GradeMasters->patchEntity($gradeMaster, $this->request->getData());
            if ($this->GradeMasters->save($gradeMaster)) {
                $this->Flash->success(__('The grade master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grade master could not be saved. Please, try again.'));
        }
        $sessionYears = $this->GradeMasters->SessionYears->find('list', ['limit' => 200]);
        $studentClasses = $this->GradeMasters->StudentClasses->find('list', ['limit' => 200]);
        $streams = $this->GradeMasters->Streams->find('list', ['limit' => 200]);
        $this->set(compact('gradeMaster', 'sessionYears', 'studentClasses', 'streams'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Grade Master id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gradeMaster = $this->GradeMasters->get($id);
        if ($this->GradeMasters->delete($gradeMaster)) {
            $this->Flash->success(__('The grade master has been deleted.'));
        } else {
            $this->Flash->error(__('The grade master could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
