<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleServices Controller
 *
 * @property \App\Model\Table\VehicleServicesTable $VehicleServices
 *
 * @method \App\Model\Entity\VehicleService[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleServicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $head_title='View Vehicle Services';
        $title='View Services';
        $this->paginate = [
            'contain' => ['Vehicles', 'Vendors', 'Drivers']
        ];
        $data_exist='';
        if ($this->request->is(['post','put'])) {
            $vehicle_id = $this->request->getData('vehicle_id');
            //$vehicle_station_id = $this->request->getQuery['vehicle_station_id'];
             $conditions=[];
            if(!empty($vehicle_id)){
                $conditions['VehicleServices.vehicle_id']=$vehicle_id;
            }
           /* if(!empty($vehicle_station_id)){
                $conditions['vehicles.vehicle_station_id']=$vehicle_station_id;   
            }*/
            $vehicleServices = $this->paginate($this->VehicleServices->find()->where($conditions));
            if(!empty($vehicleServices->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }   
        }
        //pr($vehicleServices);exit;
       // $vehicleServices = $this->paginate($this->VehicleServices);
        $vehicles_list = $this->VehicleServices->Vehicles->find('list')->where(['Vehicles.is_deleted']);
        $this->set(compact('vehicleServices','head_title','title','vehicles_list','data_exist'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle Service id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vehicleService = $this->VehicleServices->get($id, [
            'contain' => ['Vehicles', 'Vendors', 'Drivers']
        ]);

        $this->set('vehicleService', $vehicleService);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $head_title='Add Vehicle Services';
        $user_id = $this->Auth->User('id');
        $vehicleService = $this->VehicleServices->newEntity();
        if ($this->request->is('post')) {
            $vehicleService = $this->VehicleServices->patchEntity($vehicleService, $this->request->getData());
            $vehicleService->service_date=date('Y-m-d',strtotime($this->request->getData('service_date')));
            $vehicleService->next_service=date('Y-m-d',strtotime($this->request->getData('next_service')));
             $vehicleService->created_by=$user_id;
            if ($this->VehicleServices->save($vehicleService)) {
                $this->Flash->success(__('The vehicle service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle service could not be saved. Please, try again.'));
        }
        $vehicles = $this->VehicleServices->Vehicles->find('list');
        $vendors = $this->VehicleServices->Vendors->find('list');
        $drivers = $this->VehicleServices->Drivers->find('list');
        $this->set(compact('vehicleService', 'vehicles', 'vendors', 'drivers','head_title'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle Service id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
    	$id = $this->EncryptingDecrypting->decryptData($id);
    	 $user_id = $this->Auth->User('id');
        $vehicleService = $this->VehicleServices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicleService = $this->VehicleServices->patchEntity($vehicleService, $this->request->getData());
             $vehicleService->service_date=date('Y-m-d',strtotime($this->request->getData('service_date')));
             $vehicleService->next_service=date('Y-m-d',strtotime($this->request->getData('next_service')));
              $vehicleService->edited_by=$user_id;
            if ($this->VehicleServices->save($vehicleService)) {
                $this->Flash->success(__('The vehicle service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle service could not be saved. Please, try again.'));
        }
        $vehicles = $this->VehicleServices->Vehicles->find('list');
        $vendors = $this->VehicleServices->Vendors->find('list');
        $drivers = $this->VehicleServices->Drivers->find('list');
         $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('vehicleService', 'vehicles', 'vendors', 'drivers','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle Service id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vehicleService = $this->VehicleServices->get($id);
        if ($this->VehicleServices->delete($vehicleService)) {
            $this->Flash->success(__('The vehicle service has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report()
    {
     
        $vehicleservice = $this->VehicleServices->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
        {
            
            foreach ($this->request->getQuery('data') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'service_date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['VehicleServices.'.$key] = $v;

                }

            }
            //$where['VehicleServices.is_deleted']='N';
            $this->set(compact('where'));
           
            //pr($where);
            $vehicleServices = $this->VehicleServices->find()
                ->where([$where,'VehicleServices.is_deleted'=>'N'])
                ->contain(['Vehicles', 'Vendors', 'Drivers']);
            //pr($vehicleDriverMappings->toArray());exit;
            if(!empty($vehicleServices->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
       // pr($vehicleDriverMappings->toArray());exit;
        $vehicles = $this->VehicleServices->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $this->set(compact('vehicleServices','vehicles','data_exist','vehicleservice'));
    }
     public function reportExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        //pr($this->request->getData('VehicleServices'));exit;
        if(!empty($this->request->getData('VehicleServices')))
        {
            foreach ($this->request->getData('VehicleServices') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'service_date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['VehicleServices.'.$key] = $v;
                    
                }
            }
        }
        $where['VehicleServices.is_deleted']='N';
        $vehicleServices = $this->VehicleServices->find()->where([$where])->contain(['Vehicles', 'Vendors', 'Drivers']);

        $this->set(compact('vehicleServices'));
        }
    }

