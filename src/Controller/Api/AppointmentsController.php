<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
/**
 * Appointments Controller
 *
 * @property \App\Model\Table\AppointmentsTable $Appointments
 *
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppointmentsController extends AppController
{
    public function appintmentTeacher(){
        $appointmentList = $this->Appointments->AppointmentMasters->find()->contain(['Employees']);
        $appointmentMasters=[];
        foreach ($appointmentList as $emlist) {
           $appointmentMasters[]=['value'=>$emlist->id,'text'=>$emlist->employee->name];
        }
        $success=true;
        $message="";
        $appintmentTeacher=$appointmentMasters;
        
        $this->set(compact('success', 'message', 'appintmentTeacher'));
        $this->set('_serialize', ['success', 'message', 'appintmentTeacher']);
    }

    public function addAppointment()
    {
        $user_id = $this->request->getData('user_id');
        $user_type = $this->request->getData('user_type'); 
        $currentSession = $this->AwsFile->currentSession();

        $appointment = $this->Appointments->newEntity();
        $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
        $appointment->appointment_date= date('Y-m-d',strtotime($this->request->getData('appointment_date')));
        $appointment->appointment_time = date('H:i:s',strtotime($this->request->getData('appointment_time')));
        $appointment->created_by =$user_id;
        if($user_type=='Employee') {
             $appointment->employee_id =$user_id;
        }else{
            $appointment->student_id =$user_id;
        }
        $appointment->status ='Pending';
        $appointment->session_year_id =$currentSession;
        if ($this->Appointments->save($appointment)) {
            $success=true;
            $message='The appointment has been saved.';
        }
        else{
            $success=true;
            $message='The appointment could not be saved. Please, try again.';
        }
        $this->set(compact('success', 'message'));
        $this->set('_serialize', ['success', 'message']);   
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $login_type = $this->Auth->User('login_type');
        $session_year_id = $this->Auth->User('session_year_id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $appointment = $this->Appointments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
             $appointment->appointment_date= date('Y-m-d',strtotime($this->request->getData('appointment_date')));
            $appointment->appointment_time = date('H:i:s',strtotime($this->request->getData('appointment_time')));
            $appointment->edited_by =$user_id;
            if($login_type=='Employee') {
                 $appointment->employee_id =$user_id;
            }else{
                $appointment->student_id =$user_id;
            }
            $appointment->status ='Pending';
            $appointment->session_year_id =$session_year_id;
            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
        }
        $students = $this->Appointments->Students->find('list');
        $employees = $this->Appointments->Employees->find('list');
        $status=['Y'=>'Deactive','N'=>'Active'];
        $appointmentMasters = $this->Appointments->AppointmentMasters->Employees->find('list');
        $this->set(compact('appointment', 'students', 'employees', 'appointmentMasters','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appointment = $this->Appointments->get($id);
        if ($this->Appointments->delete($appointment)) {
            $this->Flash->success(__('The appointment has been deleted.'));
        } else {
            $this->Flash->error(__('The appointment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report($value= null)
    {
        $appointment = $this->Appointments->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['post']))
        {
            foreach ($this->request->getData('data') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'appointment_date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['Appointments.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
            $appointments = $this->Appointments->find()->contain(['Students', 'Employees', 'AppointmentMasters'=>['Employees']])->where([$where,'Appointments.is_deleted'=>'N'])->order(['Appointments.id'=>'DESC']);
            if(!empty($appointments->toArray()))
            {
                $data_exist='data_exist';
            }
            else{
                $data_exist='No Record Found';
            }  
        }
        
        $students = $this->Appointments->Students->find('list');
        $status=['Pending'=>'Pending','Approved'=>'Approved','Rejected'=>'Rejected'];
        $appointmentMasters = $this->Appointments->AppointmentMasters->find()->contain(['Employees']);
        $appointmentMasterArr=[];
        foreach ($appointmentMasters as $appointmentMaster) {
            $appointmentMasterArr[]=['value' => $appointmentMaster->employee->id,'text' => $appointmentMaster->employee->name];
        } 
        $this->set(compact('appointment','appointments','students','appointmentMasters','appointmentMasterArr','status','data_exist'));
    }
    public function appmtApproval($value= null)
    {
        $user_id = $this->Auth->User('id');
        $appointment = $this->Appointments->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['get']))
        {
            if(!empty($this->request->getQuery('data')))
            {
                foreach ($this->request->getQuery('data') as $key => $v) 
                {
                    if(!empty($v))
                    {
                        if (strpos($key, 'appointment_date') !== false)
                            $v = date('Y-m-d',strtotime($v));
                        $where ['Appointments.'.$key] = $v;
                    }
                }

            }
            //$this->set(compact('where'));
            $appointments = $this->Appointments->find()->contain(['Students', 'Employees', 'AppointmentMasters'=>['Employees']])->where([$where,'Appointments.is_deleted'=>'N','Appointments.appointment_master_id'=>$user_id])->order(['Appointments.id'=>'DESC']);
            if(!empty($appointments->toArray()))
            {
                $data_exist='data_exist';
            }
            else{
                $data_exist='No Record Found';
            }  
        }
        if($this->request->is(['post']))
        {
            if(isset($this->request->data['accept_request_id'])) 
            {
                $accept_request_id=$this->request->getData('accept_request_id');
                $approved_on=date('Y-m-d'); 
                $query = $this->Appointments->query();
                $result = $query->update()
                    ->set(['status' => 'Approved','action_date'=>$approved_on])
                    ->where(['id' =>$accept_request_id ])
                    ->execute();
                $this->Flash->success(__('This appointment has been approved.'));
                return $this->redirect(['action' => 'appmtApproval']);
            }
            if(isset($this->request->data['reject_request_id'])) 
            { 
                $reject_request_id=$this->request->getData('reject_request_id');
                $rejected_on=date('Y-m-d'); 
                $query = $this->Appointments->query();
                $result = $query->update()
                    ->set(['status' => 'Rejected','action_date'=>$rejected_on])
                    ->where(['id' =>$reject_request_id ])
                    ->execute();
                $this->Flash->error(__('The appointment has been rejected.'));
                return $this->redirect(['action' => 'appmtApproval']);
            }
        }
        //$students = $this->Appointments->Students->find('list');
        $creaters = $this->Appointments->Creaters->find('list');
        //pr($creaters->toArray());exit;
        $status=['Pending'=>'Pending','Approved'=>'Approved','Rejected'=>'Rejected'];
        /*$appointmentMasters = $this->Appointments->AppointmentMasters->find()->contain(['Employees']);
        $appointmentMasterArr=[];
        foreach ($appointmentMasters as $appointmentMaster) {
            $appointmentMasterArr[]=['value' => $appointmentMaster->employee->id,'text' => $appointmentMaster->employee->name];
        } */

        $this->set(compact('appointment','appointments','creaters','appointmentMasters','appointmentMasterArr','status','data_exist'));
    }
}
