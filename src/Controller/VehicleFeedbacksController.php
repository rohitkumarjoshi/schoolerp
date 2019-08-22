<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleFeedbacks Controller
 *
 * @property \App\Model\Table\VehicleFeedbacksTable $VehicleFeedbacks
 *
 * @method \App\Model\Entity\VehicleFeedback[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleFeedbacksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $user_id = $this->Auth->User('id');
        if(!$id)
        {
            $vehicleFeedback = $this->VehicleFeedbacks->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $vehicleFeedback = $this->VehicleFeedbacks->get($id, [
            'contain' => []
            ]);
        }
        if ($this->request->is(['post','put'])) 
        {
            $vehicleFeedback = $this->VehicleFeedbacks->patchEntity($vehicleFeedback, $this->request->getData());
            $vehicleFeedback->date=date('Y-m-d',strtotime($this->request->getData('date')));
            
            if(!$id)
            {
                $vehicleFeedback->created_by =$user_id;
            }
            else
            {
                $vehicleFeedback->edited_by =$user_id;
            }

            $error='';
            try 
            {
               if ($this->VehicleFeedbacks->save($vehicleFeedback))
               {
                    $this->Flash->success(__('The vehicle driver mapping has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The vehicle feedback could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
         
        $students = $this->VehicleFeedbacks->Students->find('list');
        $vehicles = $this->VehicleFeedbacks->Vehicles->find('list');
        $drivers = $this->VehicleFeedbacks->Drivers->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->paginate = [
            'contain' => ['Students', 'Vehicles', 'Drivers']
        ];
        $vehicleFeedbacks = $this->paginate($this->VehicleFeedbacks);
        $this->set(compact('vehicleFeedback','vehicleFeedbacks', 'students', 'vehicles', 'drivers','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle Feedback id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vehicleFeedback = $this->VehicleFeedbacks->get($id, [
            'contain' => ['Students', 'Vehicles', 'Drivers']
        ]);

        $this->set('vehicleFeedback', $vehicleFeedback);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id= null)
    {
        $user_id = $this->Auth->User('id');
        if(!$id)
        {
            $vehicleFeedback = $this->VehicleFeedbacks->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $vehicleFeedback = $this->VehicleFeedbacks->get($id, [
            'contain' => []
            ]);
        }
        if ($this->request->is(['post','put'])) 
        {
            $vehicleFeedback = $this->VehicleFeedbacks->patchEntity($vehicleFeedback, $this->request->getData());
            $vehicleFeedback->date=date('Y-m-d',strtotime($this->request->getData('date')));
            
            if(!$id)
            {
                $vehicleFeedback->created_by =$user_id;
                $vehicleFeedback->student_id =$user_id;
            }
            else
            {
                $vehicleFeedback->edited_by =$user_id;
                 $vehicleFeedback->student_id =$user_id;
            }
            $error='';
            try 
            {
               if ($this->VehicleFeedbacks->save($vehicleFeedback))
               {
                    $this->Flash->success(__('The vehicle feedback has been saved.'));
                    return $this->redirect(['action' => 'add']);
                }
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The vehicle feedback could not be saved. Please, try again.';
            }
             //pr($vehicleFeedback);exit;
            $this->Flash->error(__($error_data));
        }
         
        $students = $this->VehicleFeedbacks->Students->find('list');
        $vehicles = $this->VehicleFeedbacks->Vehicles->find('list');
        $drivers = $this->VehicleFeedbacks->Drivers->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->paginate = [
            'contain' => ['Students', 'Vehicles', 'Drivers']
        ];
        $vehicleFeedbacks = $this->paginate($this->VehicleFeedbacks->find());
        $this->set(compact('vehicleFeedback','vehicleFeedbacks', 'students', 'vehicles', 'drivers','id','status'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle Feedback id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vehicleFeedback = $this->VehicleFeedbacks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicleFeedback = $this->VehicleFeedbacks->patchEntity($vehicleFeedback, $this->request->getData());
            if ($this->VehicleFeedbacks->save($vehicleFeedback)) {
                $this->Flash->success(__('The vehicle feedback has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle feedback could not be saved. Please, try again.'));
        }
        $students = $this->VehicleFeedbacks->Students->find('list');
        $vehicles = $this->VehicleFeedbacks->Vehicles->find('list');
        $drivers = $this->VehicleFeedbacks->Drivers->find('list');
        $this->set(compact('vehicleFeedback', 'students', 'vehicles', 'drivers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle Feedback id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vehicleFeedback = $this->VehicleFeedbacks->get($id);
        if ($this->VehicleFeedbacks->delete($vehicleFeedback)) {
            $this->Flash->success(__('The vehicle feedback has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle feedback could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
        public function report()
    {
        $user_id = $this->Auth->User('id');
        $vehicleFeedback = $this->VehicleFeedbacks->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
        {
            
            foreach ($this->request->getQuery('data') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['VehicleFeedbacks.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
            $this->paginate = [
                'contain' => ['Students', 'Vehicles', 'Drivers']
            ];
            $vehicleFeedbacks = $this->paginate($this->VehicleFeedbacks->find()->where([$where,'VehicleFeedbacks.is_deleted'=>'N']));
             if(!empty($vehicleFeedbacks->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
        $students = $this->VehicleFeedbacks->Students->find('list');
        $vehicles = $this->VehicleFeedbacks->Vehicles->find('list');
        $drivers = $this->VehicleFeedbacks->Drivers->find('list');
        $this->set(compact('vehicleFeedback','vehicleFeedbacks', 'students', 'vehicles', 'drivers','data_exist'));
    }
    public function reportExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        
        $vehicleFeedbacks = $this->VehicleFeedbacks->find()->where($this->request->getData('VehicleFeedbacks'))->contain(['Students', 'Vehicles', 'Drivers']);

        $this->set(compact('vehicleFeedbacks'));
    }
}
