<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HostelAttendances Controller
 *
 * @property \App\Model\Table\HostelAttendancesTable $HostelAttendances
 *
 * @method \App\Model\Entity\HostelAttendance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HostelAttendancesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $hostelAttendance = $this->HostelAttendances->newEntity();
        if ($this->request->is('post')) {
            $hostelAttendance = $this->HostelAttendances->patchEntity($hostelAttendance, $this->request->getData());
            if ($this->HostelAttendances->save($hostelAttendance)) {
                $this->Flash->success(__('The hostel attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hostel attendance could not be saved. Please, try again.'));
        }
        $students = $this->HostelAttendances->Students->find('list')->where(['Students.is_deleted'=>'N']);
        
       // $hostelRegistrations =  $this->HostelAttendances->HostelRegistrations->find()
               // ->where(['HostelRegistrations.hostel_id'=>'1'])->contain(['Students']);

       // pr($hostelRegistrations->toArray());exit;
        $this->paginate = [
            'contain' => ['SessionYears', 'Students']
        ];
        $hostelAttendances = $this->paginate($this->HostelAttendances);

         $this->set(compact('hostelAttendance','hostelAttendances', 'students', 'hostelRegistrations'));
    }

    /**
     * View method
     *
     * @param string|null $id Hostel Attendance id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hostelAttendance = $this->HostelAttendances->get($id, [
            'contain' => ['SessionYears', 'Students', 'HostelRegistrations']
        ]);

        $this->set('hostelAttendance', $hostelAttendance);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hostelAttendance = $this->HostelAttendances->newEntity();
        if ($this->request->is('post')) {
            $hostelAttendance = $this->HostelAttendances->patchEntity($hostelAttendance, $this->request->getData());
            if ($this->HostelAttendances->save($hostelAttendance)) {
                $this->Flash->success(__('The hostel attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hostel attendance could not be saved. Please, try again.'));
        }
        $students = $this->HostelAttendances->Students->find('list');
        $hostelRegistrations = $this->HostelAttendances->HostelRegistrations->find('list');
        $this->set(compact('hostelAttendance', 'students', 'hostelRegistrations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hostel Attendance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hostelAttendance = $this->HostelAttendances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hostelAttendance = $this->HostelAttendances->patchEntity($hostelAttendance, $this->request->getData());
            if ($this->HostelAttendances->save($hostelAttendance)) {
                $this->Flash->success(__('The hostel attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hostel attendance could not be saved. Please, try again.'));
        }
        $sessionYears = $this->HostelAttendances->SessionYears->find('list', ['limit' => 200]);
        $students = $this->HostelAttendances->Students->find('list', ['limit' => 200]);
        $hostelRegistrations = $this->HostelAttendances->HostelRegistrations->find('list', ['limit' => 200]);
        $this->set(compact('hostelAttendance', 'sessionYears', 'students', 'hostelRegistrations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hostel Attendance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hostelAttendance = $this->HostelAttendances->get($id);
        if ($this->HostelAttendances->delete($hostelAttendance)) {
            $this->Flash->success(__('The hostel attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The hostel attendance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
