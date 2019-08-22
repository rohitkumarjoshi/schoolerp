<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;
use Cake\Event\Event;

/**
 * Vehicles Controller
 *
 * @property \App\Model\Table\VehiclesTable $Vehicles
 *
 * @method \App\Model\Entity\Vehicle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehiclesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit','index']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$title = 'Vehicle Detail';
        $head_title = 'Vehicle Detail';
        $active_li = 'Vehicles';
        $active_sub_li = 'Detail';
        $head_title='Index';
        $data_exist='';
        $conditions=[]; 
        if (!empty($this->request->getQuery('vehicle_no'))) {
            $vehicle_id = $this->request->getQuery('vehicle_no');
            //$vehicle_station_id = $this->request->getQuery['vehicle_station_id'];
             
            if(!empty($vehicle_id)){
                $conditions['Vehicles.vehicle_no']=$vehicle_id;
            }
        }
        $vehicles = $this->paginate($this->Vehicles->find()->where($conditions));
       
        if(!empty($vehicles->toArray()))
          {
            $data_exist='data_exist';
          }
          else{
            $data_exist='No Record Found';
          }     
        

        //$vehicles = $this->paginate($this->Vehicles);
        $vehicles_list = $this->Vehicles->find('list',[
        'keyField' => 'vehicle_no',
        'valueField' => 'vehicle_no'])->where(['Vehicles.is_deleted']);
        $this->set(compact('vehicles','title','head_title','active_li','active_sub_li','vehicles_list','data_exist'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$title='Details';
		$id = $this->EncryptingDecrypting->decryptData($id);
        //pr($id);exit;
		/* $vehicle = $this->Vehicles->get($id, [
            'contain' => ['Expenses', 'StudentInfos', 'VehicleDriverMappings', 'VehicleFeedbacks', 'VehicleFuelEntries', 'VehicleRoutes', 'VehicleServices', 'VehicleStudentAttendances']
        ]); */
		  $vehicle = $this->Vehicles->get($id, [
            'contain' => []
        ]);
		$this->set(compact('title','head_title','active_li','active_sub_li'));
        $this->set('vehicle', $vehicle);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		 $title = 'Add New Vehicle';
        $head_title = 'Add Vehicle';
        $active_li = 'Vehicles';
        $active_sub_li = 'Add';
		$user_id = $this->Auth->User('id');
        $vehicle = $this->Vehicles->newEntity();
        if ($this->request->is('post')) {
			
            $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());
			//pr($vehicle);exit;
			if(!empty($this->request->getData('insurance_daterange')))
            {
                $daterange=explode('/',$this->request->getData('insurance_daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $vehicle->insurance_date = date('Y-m-d',strtotime($date_from));
                $vehicle->insurance_expiry_date = date('Y-m-d',strtotime($date_from));
            } 
            if(!empty($this->request->getData('poc_daterange')))
            {
                $daterange=explode('/',$this->request->getData('poc_daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $vehicle->poc_date = date('Y-m-d',strtotime($date_from));
                $vehicle->poc_expiry_date = date('Y-m-d',strtotime($date_from));
            } 
            if(!empty($this->request->getData('permit_daterange')))
            {
                $daterange=explode('/',$this->request->getData('permit_daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $vehicle->permit_date = date('Y-m-d',strtotime($date_from));
                $vehicle->permit_expiry_date = date('Y-m-d',strtotime($date_from));
            } 
			
			$vehicle->created_by =$user_id;
			$insurance_doc = $this->request->getData('insurance_doc');
			$poc_doc = $this->request->getData('poc_doc');
			$permit_doc = $this->request->getData('permit_doc');
		
            if ($this->Vehicles->save($vehicle)) {
				$id=$vehicle->id;
                if(empty($insurance_doc['error']))
                {
                    $extt=explode('/',$insurance_doc['type']);
                    $ext=$extt[1];
                    $setNewFileName = time().rand();
                    
                    $keyname = 'vehicles/insurance_doc/'.$vehicle->id.'/'.$setNewFileName.'.'.$ext;
                    $this->AwsFile->putObjectFile($keyname,$insurance_doc['tmp_name'],$insurance_doc['type']);  
                    $query2 = $this->Vehicles->query();
                            $query2->update()
                                ->set(['insurance_doc' => $keyname])
                                ->where(['id' => $id])
                                ->execute();
                }
				if(empty($poc_doc['error']))
                {
                    $extt=explode('/',$poc_doc['type']);
                    $ext=$extt[1];
                    $setNewFileName = time().rand();
                
                    $keyname = 'vehicles/poc_doc/'.$vehicle->id.'/'.$setNewFileName.'.'.$ext;
                    $this->AwsFile->putObjectFile($keyname,$poc_doc['tmp_name'],$poc_doc['type']);  

                    $query2 = $this->Vehicles->query();
                            $query2->update()
                                ->set(['poc_doc' => $keyname])
                                ->where(['id' => $id])
                                ->execute();
                }
				
				if(empty($permit_doc['error']))
                {
                    $extt=explode('/',$permit_doc['type']);
                    $ext=$extt[1];
                    $setNewFileName = time().rand();
                
                    $keyname = 'vehicles/permit_doc/'.$vehicle->id.'/'.$setNewFileName.'.'.$ext;
                    $this->AwsFile->putObjectFile($keyname,$permit_doc['tmp_name'],$permit_doc['type']); 
                    $query2 = $this->Vehicles->query();
                            $query2->update()
                                ->set(['permit_doc' => $keyname])
                                ->where(['id' => $id])
                                ->execute();
                }
				
                $this->Flash->success(__('The vehicle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
        }
        $this->set(compact('vehicle','title','head_title','active_li','active_sub_li'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$title = 'Edit Vehicle Detail';
        $head_title = 'Edit Vehicle Detail';
		$id = $this->EncryptingDecrypting->decryptData($id);
		$user_id = $this->Auth->User('id');
        $vehicle = $this->Vehicles->get($id, [
            'contain' => []
        ]);
		$old_insurance_doc=$vehicle->insurance_doc;
		$old_poc_doc=$vehicle->poc_doc;
		$old_permit_doc=$vehicle->permit_doc;
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());
			if(!empty($this->request->getData('insurance_daterange')))
            {
                $daterange=explode('/',$this->request->getData('insurance_daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $vehicle->insurance_date = date('Y-m-d',strtotime($date_from));
                $vehicle->insurance_expiry_date = date('Y-m-d',strtotime($date_from));
            } 
            if(!empty($this->request->getData('poc_daterange')))
            {
                $daterange=explode('/',$this->request->getData('poc_daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $vehicle->poc_date = date('Y-m-d',strtotime($date_from));
                $vehicle->poc_expiry_date = date('Y-m-d',strtotime($date_from));
            } 
            if(!empty($this->request->getData('permit_daterange')))
            {
                $daterange=explode('/',$this->request->getData('permit_daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $vehicle->permit_date = date('Y-m-d',strtotime($date_from));
                $vehicle->permit_expiry_date = date('Y-m-d',strtotime($date_from));
            } 
			$vehicle->edited_by =$user_id;
			$insurance_doc = $this->request->getData('insurance_doc1');
			$poc_doc = $this->request->getData('poc_doc1');
			$permit_doc = $this->request->getData('permit_doc1');
			
            if ($this->Vehicles->save($vehicle)) {
				//start code for update image

                if(empty($insurance_doc['error']))
                {
                    if(!empty($vehicle->insurance_doc))
                    {
                       $this->AwsFile->deleteObjectFile($vehicle->insurance_doc); 
                    }
                    $extt=explode('/',$insurance_doc['type']);
                    $ext=$extt[1];
                    $setNewFileName = time().rand();
                    
                    $keyname = 'vehicles/insurance_doc/'.$vehicle->id.'/'.$setNewFileName.'.'.$ext;
                    $this->AwsFile->putObjectFile($keyname,$insurance_doc['tmp_name'],$insurance_doc['type']);  
                    $query2 = $this->Vehicles->query();
                            $query2->update()
                                ->set(['insurance_doc' => $keyname])
                                ->where(['id' => $id])
                                ->execute();
                }
                if(empty($poc_doc['error']))
                {
                    if(!empty($vehicle->poc_doc))
                    {
                       $this->AwsFile->deleteObjectFile($vehicle->poc_doc); 
                    }
                    $extt=explode('/',$poc_doc['type']);
                    $ext=$extt[1];
                    $setNewFileName = time().rand();
                
                    $keyname = 'vehicles/poc_doc/'.$vehicle->id.'/'.$setNewFileName.'.'.$ext;
                    $this->AwsFile->putObjectFile($keyname,$poc_doc['tmp_name'],$poc_doc['type']);  

                    $query2 = $this->Vehicles->query();
                            $query2->update()
                                ->set(['poc_doc' => $keyname])
                                ->where(['id' => $id])
                                ->execute();
                }
                
                if(empty($permit_doc['error']))
                {
                    if(!empty($vehicle->permit_doc))
                    {
                       $this->AwsFile->deleteObjectFile($vehicle->permit_doc); 
                    }
                    $extt=explode('/',$permit_doc['type']);
                    $ext=$extt[1];
                    $setNewFileName = time().rand();
                
                    $keyname = 'vehicles/permit_doc/'.$vehicle->id.'/'.$setNewFileName.'.'.$ext;
                    $this->AwsFile->putObjectFile($keyname,$permit_doc['tmp_name'],$permit_doc['type']); 
                    $query2 = $this->Vehicles->query();
                            $query2->update()
                                ->set(['permit_doc' => $keyname])
                                ->where(['id' => $id])
                                ->execute();
                }
				
                $this->Flash->success(__('The vehicle has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
        }
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('vehicle','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vehicle = $this->Vehicles->get($id);
        if ($this->Vehicles->delete($vehicle)) {
            $this->Flash->success(__('The vehicle has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
