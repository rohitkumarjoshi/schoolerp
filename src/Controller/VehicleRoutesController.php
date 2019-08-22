<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\View;
/**
 * VehicleRoutes Controller
 *
 * @property \App\Model\Table\VehicleRoutesTable $VehicleRoutes
 *
 * @method \App\Model\Entity\VehicleRoute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleRoutesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions',['add','edit']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
    	$head_title='Index';

        $this->paginate = [
            'contain' => ['Vehicles', 'VehicleStations']
        ];
        $data_exist='';
    	 if ($this->request->is(['post','put']))
        {
          
            $vehicle_id = $this->request->getData('vehicle_id');
            $vehicle_station_id = $this->request->getData('vehicle_station_id');
            if(!empty($vehicle_id)){
                $conditions['VehicleRoutes.vehicle_id']=$vehicle_id;
            }
            if(!empty($vehicle_station_id)){
                $conditions['VehicleRoutes.vehicle_station_id']=$vehicle_station_id;   
            }
            $conditions['Vehicles.is_deleted']='N';
            $vehicleRoutes = $this->paginate($this->VehicleRoutes->find()->where($conditions));
            if(!empty($vehicleRoutes->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }   
    	   }
         
         //r($vehicleRoutes->toArray());exit;
          /*else
          {
            $vehicleRoutes = $this->paginate($this->VehicleRoutes);
          }
		    */
       
        $vehicles = $this->VehicleRoutes->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $vehicleStations = $this->VehicleRoutes->VehicleStations->find('list')->where(['VehicleStations.is_deleted'=>'N']);
        $this->set(compact('vehicleRoutes','vehicles','vehicleStations','head_title','data_exist'));
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
            $vehicleRoute = $this->VehicleRoutes->patchEntities($vehicleRoute,$this->request->getData('vehicle_routes'));
            $randomno = mt_rand();
            foreach($vehicleRoute as $vehicleRoutes) {
                $vehicleRoutes->vehicle_id = $this->request->getData('vehicle_id');
                $vehicleRoutes->created_by = $user_id;
                $vehicleRoutes->randomno = $randomno;
                $vehicleRoutes->pickup_time = date('H:i:s',strtotime($vehicleRoutes->pickup_time));
                $vehicleRoutes->drop_time = date('H:i:s',strtotime($vehicleRoutes->drop_time));
            }
            $error='';
            try 
            {
               if ($this->VehicleRoutes->saveMany($vehicleRoute))
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
        }
        $vehicles = $this->VehicleRoutes->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $vehicles->notMatching('VehicleRoutes');
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
       
        $vehicleRoutes = $this->VehicleRoutes->Vehicles->get($vehicle_id, [
            'contain' => ['VehicleRoutes'=>['VehicleStations']]
        ]);
        foreach ($vehicleRoutes->vehicle_routes as $vehicleRoutese) {
             $old_randomno=$vehicleRoutese->randomno;
        }
       
        if ($this->request->is(['patch', 'post', 'put'])) {

            
            $vehicleRoute = $this->VehicleRoutes->newEntity();
            $vehicleRoute = $this->VehicleRoutes->patchEntities($vehicleRoute,$this->request->getData('vehicle_routes'));
            $randomno = mt_rand();
            foreach($vehicleRoute as $vehicleRoutess) {
                $vehicleRoutess->vehicle_id = $vehicle_id;
                $vehicleRoutess->created_by = $user_id;
                $vehicleRoutess->randomno = $randomno;
                $vehicleRoutess->pickup_time = date('H:i:s',strtotime($vehicleRoutess->pickup_time));
                $vehicleRoutess->drop_time = date('H:i:s',strtotime($vehicleRoutess->drop_time));
            }
            $error='';
            try 
            {
                if ($this->VehicleRoutes->saveMany($vehicleRoute))
                {
                    $this->VehicleRoutes->deleteAll(['vehicle_id' => $vehicle_id,'randomno'=>$old_randomno]);
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
                $error_data='Duplicate entry. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $vehicles = $this->VehicleRoutes->Vehicles->find('list');
        $vehicleStations = $this->VehicleRoutes->VehicleStations->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('status','vehicleRoutes', 'vehicles', 'vehicleStations','vehicle_id'));
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
            $vehicleRoutes =$this->VehicleRoutes->find()->where([$where,'VehicleRoutes.is_deleted'=>'N'])->contain(['Vehicles', 'VehicleStations']);
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
