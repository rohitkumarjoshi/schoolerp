<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * LibraryStudentInOuts Controller
 *
 * @property \App\Model\Table\LibraryStudentInOutsTable $LibraryStudentInOuts
 *
 * @method \App\Model\Entity\LibraryStudentInOut[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LibraryStudentInOutsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $inout = $this->LibraryStudentInOuts->newEntity();
        $where = [];

        if($this->request->is('post'))
            //pr($this->request->getData());exit;
            foreach ($this->request->getData('data') as $key => $value) {
                if(!empty($value))
                {
                    if (strpos($key, 'in_date') !== false)
                        $value = date('Y-m-d',strtotime($value));

                    $where[$key] = $value;
                }
            }
        //pr($where);exit;

        $libraryStudentInOuts = $this->paginate($this->LibraryStudentInOuts->find()->where($where)->contain(['Students']));

        $students = $this->LibraryStudentInOuts->Students->find('list');
        $sessionYears = $this->LibraryStudentInOuts->SessionYears->find('list');

        $this->set(compact('libraryStudentInOuts','inout','students','sessionYears'));
    }

    /**
     * View method
     *
     * @param string|null $id Library Student In Out id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $libraryStudentInOut = $this->LibraryStudentInOuts->get($id, [
    //         'contain' => ['Students', 'SessionYears']
    //     ]);

    //     $this->set('libraryStudentInOut', $libraryStudentInOut);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $libraryStudentInOut = $this->LibraryStudentInOuts->newEntity();
        if ($this->request->is('post')) {
            
            if($this->LibraryStudentInOuts->exists([$this->request->getData(),'status'=>'In']))
            {
                $libraryStudentInOut = $this->LibraryStudentInOuts->find()->where([$this->request->getData(),'status'=>'In'])->first();
                $libraryStudentInOut->out_date = date('Y-m-d');
                $libraryStudentInOut->out_time = date('H:i:s');
                $libraryStudentInOut->status = 'Out';
            }
            else
            {
                $libraryStudentInOut->in_date = date('Y-m-d');
                $libraryStudentInOut->in_time = date('H:i:s');
                $libraryStudentInOut->status = 'In';
            }
            $libraryStudentInOut->session_year_id = $this->LibraryStudentInOuts->SessionYears->find()->where(['status'=>'Active'])->first()->id;

            $libraryStudentInOut = $this->LibraryStudentInOuts->patchEntity($libraryStudentInOut, $this->request->getData());
            if ($this->LibraryStudentInOuts->save($libraryStudentInOut)) {
                $response = 'Success.';
                $success = 1;
            }
            else
            {
                $response = 'Try Again';
                $success = 0;
            }
        }

        $this->set(compact('libraryStudentInOut','success','response'));
        $this->set('_serialize', ['success','response','libraryStudentInOut']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Library Student In Out id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $libraryStudentInOut = $this->LibraryStudentInOuts->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $libraryStudentInOut = $this->LibraryStudentInOuts->patchEntity($libraryStudentInOut, $this->request->getData());
    //         if ($this->LibraryStudentInOuts->save($libraryStudentInOut)) {
    //             $this->Flash->success(__('The library student in out has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The library student in out could not be saved. Please, try again.'));
    //     }
    //     $students = $this->LibraryStudentInOuts->Students->find('list');
    //     $sessionYears = $this->LibraryStudentInOuts->SessionYears->find('list');
    //     $this->set(compact('libraryStudentInOut', 'students', 'sessionYears'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Library Student In Out id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $libraryStudentInOut = $this->LibraryStudentInOuts->get($id);
    //     if ($this->LibraryStudentInOuts->delete($libraryStudentInOut)) {
    //         $this->Flash->success(__('The library student in out has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The library student in out could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
