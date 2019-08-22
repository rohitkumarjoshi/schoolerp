<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleStudentAttendances Controller
 *
 * @property \App\Model\Table\VehicleStudentAttendancesTable $VehicleStudentAttendances
 *
 * @method \App\Model\Entity\VehicleStudentAttendance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleStudentAttendancesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Vehicles','Conductors']
        ];
        $vehicleStudentAttendances = $this->paginate($this->VehicleStudentAttendances);
        
        $this->set(compact('vehicleStudentAttendances'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle Student Attendance id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vehicleStudentAttendance = $this->VehicleStudentAttendances->get($id, [
            'contain' => ['Students', 'Vehicles']
        ]);

        $this->set('vehicleStudentAttendance', $vehicleStudentAttendance);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vehicleStudentAttendance = $this->VehicleStudentAttendances->newEntity();
        if ($this->request->is('post')) {
            $vehicleStudentAttendance = $this->VehicleStudentAttendances->patchEntity($vehicleStudentAttendance, $this->request->getData());
            if ($this->VehicleStudentAttendances->save($vehicleStudentAttendance)) {
                $this->Flash->success(__('The vehicle student attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle student attendance could not be saved. Please, try again.'));
        }
        $students = $this->VehicleStudentAttendances->Students->find('list');
        $vehicles = $this->VehicleStudentAttendances->Vehicles->find('list');
        $this->set(compact('vehicleStudentAttendance', 'students', 'vehicles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle Student Attendance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vehicleStudentAttendance = $this->VehicleStudentAttendances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicleStudentAttendance = $this->VehicleStudentAttendances->patchEntity($vehicleStudentAttendance, $this->request->getData());
            if ($this->VehicleStudentAttendances->save($vehicleStudentAttendance)) {
                $this->Flash->success(__('The vehicle student attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle student attendance could not be saved. Please, try again.'));
        }
        $students = $this->VehicleStudentAttendances->Students->find('list');
        $vehicles = $this->VehicleStudentAttendances->Vehicles->find('list');
        $this->set(compact('vehicleStudentAttendance', 'students', 'vehicles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle Student Attendance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vehicleStudentAttendance = $this->VehicleStudentAttendances->get($id);
        if ($this->VehicleStudentAttendances->delete($vehicleStudentAttendance)) {
            $this->Flash->success(__('The vehicle student attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle student attendance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
