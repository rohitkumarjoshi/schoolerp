<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleDriverMappings Controller
 *
 * @property \App\Model\Table\VehicleDriverMappingsTable $VehicleDriverMappings
 *
 * @method \App\Model\Entity\VehicleDriverMapping[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleDriverMappingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {

        $user_id = $this->Auth->User('id');
         if(!$id)
        {
            $vehicleDriverMapping = $this->VehicleDriverMappings->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $vehicleDriverMapping = $this->VehicleDriverMappings->get($id, [
            'contain' => []
            ]);
        }

       
       if ($this->request->is(['post','put'])) {
            $vehicleDriverMapping = $this->VehicleDriverMappings->patchEntity($vehicleDriverMapping, $this->request->getData());
            $vehicleDriverMapping->assign_date=date('Y-m-d',strtotime($this->request->getData('assign_date')));
            if(!$id)
            {
                $vehicleDriverMapping->created_by =$user_id;
            }
            else
            {
                $vehicleDriverMapping->edited_by =$user_id;
            }
            $error='';
              try 
            {
               if ($this->VehicleDriverMappings->save($vehicleDriverMapping)) 
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
                $error_data='The section could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $status = array('N'=>'Active','Y'=>'Deactive');
        $vehicles = $this->VehicleDriverMappings->Vehicles->find('list');
        $drivers = $this->VehicleDriverMappings->Drivers->find('list');
        $conductors = $this->VehicleDriverMappings->Conductors->find('list');

        $this->paginate = [
            'contain' => ['Vehicles', 'Drivers', 'Conductors']
        ];
        $vehicleDriverMappings = $this->paginate($this->VehicleDriverMappings);
        //pr($vehicleDriverMappings->toArray());exit;
         $this->set(compact('id','status','vehicleDriverMapping', 'vehicleDriverMappings','vehicles', 'drivers', 'conductors'));
    }
     public function report()
    {
     
        $vehicledrivermapping = $this->VehicleDriverMappings->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
        {
            
            foreach ($this->request->getQuery('data') as $key => $v) {
                if(!empty($v))
                {
                    if (strpos($key, 'assign_date') !== false)
                        $v = date('Y-m-d',strtotime($v));
                    $where ['VehicleDriverMappings.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
           
            //pr($where);
            $vehicleDriverMappings = $this->VehicleDriverMappings->find()
                ->contain(['Vehicles', 'Drivers', 'Conductors'])
                ->where([$where]);
            //pr($vehicleDriverMappings->toArray());exit;
            if(!empty($vehicleDriverMappings->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
       // pr($vehicleDriverMappings->toArray());exit;
        $vehicles = $this->VehicleDriverMappings->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $this->set(compact('vehicleDriverMappings','vehicles','data_exist','vehicledrivermapping'));
    }
    public function driverconductorExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        
        $vehicleDriverMappings = $this->VehicleDriverMappings->find()->where($this->request->getData('VehicleDriverMappings'))->contain(['Vehicles', 'Drivers', 'Conductors']);

        $this->set(compact('vehicleDriverMappings'));
    }

    
    /**
     * View method
     *
     * @param string|null $id Vehicle Driver Mapping id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
}
