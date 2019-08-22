<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Scalings Controller
 *
 * @property \App\Model\Table\ScalingsTable $Scalings
 *
 * @method \App\Model\Entity\Scaling[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ScalingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $where['Scalings.is_deleted'] = 'N';
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where[$key] = $value;
        }
        $this->paginate = [
            'contain' => ['Subjects'=>['StudentClasses','Streams']]
        ];
        $scalings = $this->paginate($this->Scalings->find()->where($where));

        $studentClasses = $this->Scalings->Subjects->StudentClasses->find('list');
        $streams = $this->Scalings->Subjects->find('list')
                ->select(['id'=>'Subjects.stream_id','name'=>'Streams.name'])
                ->contain(['Streams'])
                ->where(['student_class_id'=>@$where['student_class_id'],'stream_id !='=>0])->distinct('Subjects.stream_id');

        $this->set(compact('scalings', 'sessionYears', 'subjects','studentClasses','streams'));
    }

    /**
     * View method
     *
     * @param string|null $id Scaling id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $scaling = $this->Scalings->get($id, [
    //         'contain' => ['SessionYears', 'Subjects']
    //     ]);

    //     $this->set('scaling', $scaling);
    // }

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
            $scaling = $this->Scalings->get($id, [
            'contain' => ['Subjects'=>['StudentClasses','Streams']]
            ]);
        }
        else
            $scaling = $this->Scalings->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $scaling = $this->Scalings->patchEntity($scaling, $this->request->getData());
            $scaling->session_year_id = $this->Scalings->SessionYears->find()->where(['status'=>'Active'])->first()->id;

            if(!isset($id))
                $scaling->created_by = $this->Auth->user('id');
            else
                $scaling->edited_by = $this->Auth->user('id');

            if ($this->Scalings->save($scaling)) {
                $this->Flash->success(__('The scaling has been saved.'));

                if (isset($id))
                    return $this->redirect(['action' => 'index']);
                else
                    return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The scaling could not be saved. Please, try again.'));
        }
        
        $subjects = '';
        $studentClasses = $this->Scalings->Subjects->StudentClasses->find('list');
        $streams = $this->Scalings->Subjects->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])
                ->select(['id'=>'Subjects.stream_id','name'=>'Streams.name'])
                ->contain(['Streams'])
                ->where(['student_class_id'=>@$scaling->subject->student_class_id]);

        $this->set(compact('scaling', 'sessionYears', 'subjects','studentClasses','streams'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Scaling id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $scaling = $this->Scalings->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $scaling = $this->Scalings->patchEntity($scaling, $this->request->getData());
    //         if ($this->Scalings->save($scaling)) {
    //             $this->Flash->success(__('The scaling has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The scaling could not be saved. Please, try again.'));
    //     }
    //     $sessionYears = $this->Scalings->SessionYears->find('list');
    //     $subjects = $this->Scalings->Subjects->find('list');
    //     $this->set(compact('scaling', 'sessionYears', 'subjects'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Scaling id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $scaling = $this->Scalings->get($id);
        $scaling->is_deleted = 'Y';
        if ($this->Scalings->delete($scaling)) {
            $this->Flash->success(__('The scaling has been deleted.'));
        } else {
            $this->Flash->error(__('The scaling could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
