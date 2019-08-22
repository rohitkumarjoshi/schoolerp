<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AppointmentMasters Controller
 *
 * @property \App\Model\Table\AppointmentMastersTable $AppointmentMasters
 *
 * @method \App\Model\Entity\AppointmentMaster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppointmentMastersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        if(!$id){
              $appointmentMaster = $this->AppointmentMasters->newEntity();
              }
          else
            {
                $id = $this->EncryptingDecrypting->decryptData($id);
                $appointmentMaster = $this->AppointmentMasters->get($id, [
                    'contain' => []
                ]);
            }
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $appointmentMaster = $this->AppointmentMasters->patchEntity($appointmentMaster, $this->request->getData());
            if(!$id)
            {
                $appointmentMaster->created_by =$user_id;
            }
            else
            {
                $appointmentMaster->edited_by =$user_id;
            }
            $error='';
            try 
            {
                if ($this->AppointmentMasters->save($appointmentMaster)) {
                $this->Flash->success(__('The appointment master has been saved.'));
                return $this->redirect(['action' => 'index']);
                }
            }
            catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The appointment master could not be saved. Please, try again.';
            }
            //pr($studentRedDiary);exit;
            $this->Flash->error(__($error_data));
        }

        $this->paginate = [
            'contain' => ['Employees']
        ];
        $employees = $this->AppointmentMasters->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $status=['Y'=>'Deactive','N'=>'Active'];
        $appointmentMasters = $this->paginate($this->AppointmentMasters);
        $this->set(compact('appointmentMasters','appointmentMaster', 'employees','id','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Appointment Master id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $appointmentMaster = $this->AppointmentMasters->get($id, [
            'contain' => ['Employees', 'Appointments']
        ]);

        $this->set('appointmentMaster', $appointmentMaster);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $appointmentMaster = $this->AppointmentMasters->newEntity();
        if ($this->request->is('post')) {
            $appointmentMaster = $this->AppointmentMasters->patchEntity($appointmentMaster, $this->request->getData());
            if ($this->AppointmentMasters->save($appointmentMaster)) {
                $this->Flash->success(__('The appointment master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appointment master could not be saved. Please, try again.'));
        }
        $employees = $this->AppointmentMasters->Employees->find('list', ['limit' => 200]);
        $this->set(compact('appointmentMaster', 'employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointment Master id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appointmentMaster = $this->AppointmentMasters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointmentMaster = $this->AppointmentMasters->patchEntity($appointmentMaster, $this->request->getData());
            if ($this->AppointmentMasters->save($appointmentMaster)) {
                $this->Flash->success(__('The appointment master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appointment master could not be saved. Please, try again.'));
        }
        $status=['Y'=>'Deactive','N'=>'Active'];
        $employees = $this->AppointmentMasters->Employees->find('list', ['limit' => 200]);
        $this->set(compact('appointmentMaster', 'employees','id','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Appointment Master id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appointmentMaster = $this->AppointmentMasters->get($id);
        if ($this->AppointmentMasters->delete($appointmentMaster)) {
            $this->Flash->success(__('The appointment master has been deleted.'));
        } else {
            $this->Flash->error(__('The appointment master could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
