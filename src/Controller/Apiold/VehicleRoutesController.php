<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * VehicleRoutes Controller
 *
 * @property \App\Model\Table\VehicleRoutesTable $VehicleRoutes
 *
 * @method \App\Model\Entity\VehicleRoute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleRoutesController extends AppController
{
    public function busRoute()
    {
    	  $this->paginate = [
            'contain' => ['Vehicles', 'VehicleStations']
        ];
         
        $vehicleRoutesResponse = $this->VehicleRoutes->Vehicles->find()
            ->contain(['VehicleRoutes'=>function($q){
                return $q->where(['VehicleRoutes.is_deleted'=>'N'])->contain('VehicleStations')->order(['VehicleRoutes.station_order_by'=>'ASC']);
              }
            ])
            ->where(['Vehicles.is_deleted'=>'N']);
        if($vehicleRoutesResponse->count()>0){
            $success=true;
            $message='';
             
        }else{
            $success=false;
            $message="No data found";
            $vehicleRoutesResponse=array();
        }
        $this->set(compact('success', 'message', 'vehicleRoutesResponse'));
        $this->set('_serialize', ['success', 'message', 'vehicleRoutesResponse']); 
       
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle Route id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
    	$id = $this->EncryptingDecrypting->decryptData($id);
        $vehicleRoute = $this->VehicleRoutes->get($id, [
            'contain' => ['Vehicles', 'VehicleStations']
        ]);

        $this->set('vehicleRoute', $vehicleRoute);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vehicleRoute = $this->VehicleRoutes->newEntity();
        $user_id = $this->Auth->User('id');
        if ($this->request->is('post')) 
        {
        	//pr($this->request->getData());exit;
        	$total_row = count($this->request->getData('vehicle_station_id'));///exit;
			
        	$vehicle_id = $this->request->getData('vehicle_id');
        	$this->request->getData('vehicle_station_id');
        	$vehicleRoutes=[];
        	for ($i=0; $i<$total_row; $i++ ) 
            {
          		$vehicleRoute = $this->VehicleRoutes->newEntity();
          		$vehicleRoute->vehicle_id = $vehicle_id;
          		$vehicleRoute->created_by = $user_id;
          		$vehicleRoute->vehicle_station_id = $this->request->getData('vehicle_station_id')[$i];
          		$vehicleRoute->pickup_time = date('H:i:s',strtotime($this->request->getData('pickup_time')[$i]));
          		$vehicleRoute->drop_time = date('H:i:s',strtotime($this->request->getData('drop_time')[$i]));
          		$vehicleRoute->station_order_by = $this->request->getData('station_order_by')[$i];
          		$vehicleRoutes[$i]=$vehicleRoute;
        	 }
        	
           // pr($vehicleRoutes);exit;
            if ($this->VehicleRoutes->saveMany($vehicleRoutes)) {
                $this->Flash->success(__('The vehicle route has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle route could not be saved. Please, try again.'));
        }
        $vehicles = $this->VehicleRoutes->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $vehicleStations = $this->VehicleRoutes->VehicleStations->find('list')->where(['VehicleStations.is_deleted'=>'N']);
        $this->set(compact('vehicleRoute','vehicles', 'vehicleStations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle Route id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

    	$vehicle_id = $this->EncryptingDecrypting->decryptData($id);
        $user_id = $this->Auth->User('id');
        //$vehicle_id = $this->request->getData('vehicle_id');
    	/*$vehicleRoute = $this->VehicleRoutes->find()
                    ->where(['VehicleRoutes.vehicle_id'=>$vehicle_id])
                    ->contain(['Vehicles','VehicleStations']);
      */
    	
        $vehicleRoute = $this->VehicleRoutes->Vehicles->get($vehicle_id, [
            'contain' => ['VehicleRoutes'=>['VehicleStations']]
        ]);
        //pr($vehicleRoute->toArray());exit;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicleRoute = $this->VehicleRoutes->patchEntity($vehicleRoute, $this->request->getData());
            
            $total_row = count($this->request->getData('vehicle_station_id'));///exit;
            $vehicle_id = $this->request->getData('vehicle_id');
            $this->request->getData('vehicle_station_id');            
            $vehicleRoutes=[];
            for ($i=0; $i<$total_row; $i++ ) 
            {
                $vehicleRoute = $this->VehicleRoutes->newEntity();
                $vehicleRoute->vehicle_id = $vehicle_id;
                $vehicleRoute->edited_by = $user_id;
                $vehicleRoute->vehicle_station_id = $this->request->getData('vehicle_station_id')[$i];
                $vehicleRoute->pickup_time = date('H:i:s',strtotime($this->request->getData('pickup_time')[$i]));
                $vehicleRoute->drop_time = date('H:i:s',strtotime($this->request->getData('drop_time')[$i]));
                $vehicleRoute->station_order_by = $this->request->getData('station_order_by')[$i];
                $vehicleRoute->is_deleted = $this->request->getData('is_deleted')[$i];
                $vehicleRoutes[$i]=$vehicleRoute;
            }
             $error='';
            try 
            {
               if ($this->VehicleRoutes->saveMany($vehicleRoutes))
                {
                $this->Flash->success(__('The vehicle route has been saved.'));
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
                $error_data='The vehicle route could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $vehicles = $this->VehicleRoutes->Vehicles->find('list');
        $vehicleStations = $this->VehicleRoutes->VehicleStations->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('status','vehicleRoute', 'vehicles', 'vehicleStations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle Route id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $vehicleRoute = $this->VehicleRoutes->get($id);
        if ($this->VehicleRoutes->delete($vehicleRoute)) {
            $this->Flash->success(__('The vehicle route has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle route could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report()
    {
        $head_title='Route-wise Report';
       
        $vehicle_route = $this->VehicleRoutes->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
          {
           foreach ($this->request->getQuery('data') as $key => $v) {
                if(!empty($v))
                {
                    /*if (strpos($key, 'assign_date') !== false)
                        $v = date('Y-m-d',strtotime($v));*/
                    $where ['VehicleRoutes.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
             $this->paginate = [
            'contain' => ['Vehicles', 'VehicleStations']
            ];
            $vehicleRoutes =$this->paginate($this->VehicleRoutes->find()->where([$where,'VehicleRoutes.is_deleted'=>'N']));
            if(!empty($vehicleRoutes->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
            }
           // $conditions['VehicleRoutes.is_deleted']='N';
            
       
        $vehicles = $this->VehicleRoutes->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $vehicleStations = $this->VehicleRoutes->VehicleStations->find('list')->where(['VehicleStations.is_deleted'=>'N']);
        $this->set(compact('vehicleRoutes','vehicles','vehicleStations','head_title','data_exist','vehicle_route'));
    }
    public function reportExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        
        $vehicleRoutes = $this->VehicleRoutes->find()->where($this->request->getData('VehicleRoutes'))->contain(['Vehicles', 'VehicleStations']);

        $this->set(compact('vehicleRoutes'));
    }

}
