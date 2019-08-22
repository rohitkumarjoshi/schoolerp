<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleFuelEntries Controller
 *
 * @property \App\Model\Table\VehicleFuelEntriesTable $VehicleFuelEntries
 *
 * @method \App\Model\Entity\VehicleFuelEntry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleFuelEntriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
      
        $data_exist='';
        if ($this->request->is(['post','put'])) {
            $vehicle_id = $this->request->getData('vehicle_id');
            //pr($vehicle_id);exit;
            if(!empty($vehicle_id)){
                $conditions['VehicleFuelEntries.vehicle_id']=$vehicle_id;                
            }
            else
            {
                $conditions =[];
            }
            //$conditions['VehicleFuelEntries.is_deleted']='N';
            $this->paginate = [
                'contain' => ['Vehicles','Drivers']
            ];
            $vehicleFuelEntries = $this->paginate($this->VehicleFuelEntries->find()->where($conditions));
           // pr($vehicleFuelEntries);exit;
            if(!empty($vehicleFuelEntries->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }     
        }
       // $vehicleFuelEntries = $this->paginate($this->VehicleFuelEntries);
       // pr($vehicleFuelEntries->toArray());exit;
        $vehicles = $this->VehicleFuelEntries->Vehicles->find('list')->where(['Vehicles.is_deleted']);
        //$drivers = $this->VehicleFuelEntries->Drivers->find('list')->where(['Vehicles.is_deleted']);

        $this->set(compact('vehicleFuelEntries','vehicles','drivers','data_exist'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle Fuel Entry id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $vehicleFuelEntry = $this->VehicleFuelEntries->get($id, [
            'contain' => ['Vehicles']
        ]);

        $this->set('vehicleFuelEntry', $vehicleFuelEntry);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $head_title='Fuel Entries';
        $user_id = $this->Auth->User('id');
        $vehicleFuelEntry = $this->VehicleFuelEntries->newEntity();
        if ($this->request->is('post')) {
            $vehicleFuelEntry = $this->VehicleFuelEntries->patchEntity($vehicleFuelEntry, $this->request->getData());
              $vehicleFuelEntry->fill_date=date('Y-m-d',strtotime($this->request->getData('fill_date')));
              $vehicleFuelEntry->created_by=$user_id;
            if ($this->VehicleFuelEntries->save($vehicleFuelEntry)) {
                $this->Flash->success(__('The vehicle fuel entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle fuel entry could not be saved. Please, try again.'));
        }
        $vehicles = $this->VehicleFuelEntries->Vehicles->find('list');
        $drivers = $this->VehicleFuelEntries->Drivers->find('list');
        $this->set(compact('vehicleFuelEntry', 'vehicles','head_title','drivers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle Fuel Entry id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $head_title='Edit Fuel Entries';
        $user_id = $this->Auth->User('id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $vehicleFuelEntry = $this->VehicleFuelEntries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicleFuelEntry = $this->VehicleFuelEntries->patchEntity($vehicleFuelEntry, $this->request->getData());
             $vehicleFuelEntry->fill_date=date('Y-m-d',strtotime($this->request->getData('fill_date')));
              $vehicleFuelEntry->edited_by=$user_id;
            if ($this->VehicleFuelEntries->save($vehicleFuelEntry)) {
                $this->Flash->success(__('The vehicle fuel entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle fuel entry could not be saved. Please, try again.'));
        }
        $vehicles = $this->VehicleFuelEntries->Vehicles->find('list');
        $drivers = $this->VehicleFuelEntries->Drivers->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('vehicleFuelEntry', 'vehicles','drivers','head_title','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle Fuel Entry id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $vehicleFuelEntry = $this->VehicleFuelEntries->get($id);
        if ($this->VehicleFuelEntries->delete($vehicleFuelEntry)) {
            $this->Flash->success(__('The vehicle fuel entry has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle fuel entry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
      public function report()
    {
        $vehicleFuelEntry = $this->VehicleFuelEntries->newEntity();
        $where = [];
        $data_exist='';
        //pr($this->request->getQuery('data'));exit;
        if(!empty($this->request->getQuery('data')))
        {
            
            foreach ($this->request->getQuery('data') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'fill_date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['VehicleFuelEntries.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
            
            $vehicleFuelEntries = $this->VehicleFuelEntries->find()->where([$where,'VehicleFuelEntries.is_deleted'=>'N'])->contain(['Vehicles','Drivers']);
           // pr($vehicleFuelEntries);exit;
            if(!empty($vehicleFuelEntries->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }     
        }
       // $vehicleFuelEntries = $this->paginate($this->VehicleFuelEntries);
       // pr($vehicleFuelEntries->toArray());exit;
        $vehicles = $this->VehicleFuelEntries->Vehicles->find('list')->where(['Vehicles.is_deleted']);
        //$drivers = $this->VehicleFuelEntries->Drivers->find('list')->where(['Vehicles.is_deleted']);

        $this->set(compact('vehicleFuelEntries','vehicles','drivers','data_exist','vehicleFuelEntry'));
    }
    public function reportExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        
        $vehicleFuelEntries = $this->VehicleFuelEntries->find()->where($this->request->getData('VehicleFuelEntries'))->where(['VehicleFuelEntries.is_deleted'=>'N'])->contain(['Vehicles', 'Drivers']);

        $this->set(compact('vehicleFuelEntries'));
    }

}
