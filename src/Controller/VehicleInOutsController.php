<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * VehicleInOuts Controller
 *
 * @property \App\Model\Table\VehicleInOutsTable $VehicleInOuts
 *
 * @method \App\Model\Entity\VehicleInOut[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleInOutsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit','index','report']);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vehicles']
        ];

        $vehicleInOuts = $this->paginate($this->VehicleInOuts);

        $this->set(compact('vehicleInOuts'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle In Out id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vehicleInOut = $this->VehicleInOuts->get($id, [
            'contain' => ['Vehicles']
        ]);

        $this->set('vehicleInOut', $vehicleInOut);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $user_id = $this->Auth->User('id');
        if(!$id)
            {
               $vehicleInOut = $this->VehicleInOuts->newEntity();
            }
             else{
                    $id = $this->EncryptingDecrypting->decryptData($id);
                    $vehicleInOut = $this->VehicleInOuts->get($id, [
                    'contain' => []
                    ]);
                }
        if ($this->request->is(['patch', 'post', 'put'])){
            $vehicleInOut = $this->VehicleInOuts->patchEntity($vehicleInOut, $this->request->getData());
           
            if(!$id)
            {
                $vehicleInOut->created_by = $user_id;
                $vehicleInOut->in_date=date('Y-m-d');
                $vehicleInOut->in_time=date('H:i:s');
            }
            else
            {
                $vehicleInOut->edited_by = $user_id;
               /* $vehicleInOut->in_date=date('Y-m-d');
                $vehicleInOut->in_time=date('H:i:s');*/
            }
           
            
            $error='';
            try 
            {
              if($this->VehicleInOuts->save($vehicleInOut))
              {
                $this->Flash->success(__('The Vehicle Checked In Successfully.'));
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
                $error_data='The Vehicle Checked In could not be saved. Please, try again.';
            }
           // pr($vehicleInOut);exit;
            $this->Flash->error(__($error_data));
        }
         $this->paginate = [
            'contain' => ['Vehicles']
        ];

        /* if ($this->request->is(['post','put']))
        {
            $vehicle_id = $this->request->getData('vehicle_id');
            //$vehicle_station_id = $this->request->getData('vehicle_station_id');
            if(!empty($vehicle_id)){
                $conditions['VehicleInOuts.vehicle_id']=$vehicle_id;
                $conditions['VehicleInOuts.vehicle_id']=$vehicle_id;
            }
            if(!empty($vehicle_station_id)){
                $conditions['VehicleRoutes.vehicle_station_id']=$vehicle_station_id;   
            }
            $vehicleInOuts = $this->paginate($this->VehicleInOuts->find()->where($conditions));
           }*/
        $vehicleInOuts = $this->paginate($this->VehicleInOuts->find()->where(['VehicleInOuts.out_time ='=>' ']));
        $status = array('N'=>'Active','Y'=>'Deactive');
        $vehicles = $this->VehicleInOuts->Vehicles->find('list');
        $this->set(compact('vehicleInOut', 'vehicles','vehicleInOuts','status','id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle In Out id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vehicleInOut = $this->VehicleInOuts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicleInOut = $this->VehicleInOuts->patchEntity($vehicleInOut, $this->request->getData());
            if ($this->VehicleInOuts->save($vehicleInOut)) {
                $this->Flash->success(__('The vehicle in out has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle in out could not be saved. Please, try again.'));
        }
        $vehicles = $this->VehicleInOuts->Vehicles->find('list', ['limit' => 200]);
        $this->set(compact('vehicleInOut', 'vehicles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle In Out id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vehicleInOut = $this->VehicleInOuts->get($id);
        if ($this->VehicleInOuts->delete($vehicleInOut)) {
            $this->Flash->success(__('The vehicle in out has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle in out could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function checkout($id=null)
    {   
        $id = $this->EncryptingDecrypting->decryptData($id);
        //pr($id);exit;
         $out_date=date('Y-m-d');
         $out_time=date('H:i:s');
         if ($this->request->is(['post']))
         {
            if(!empty($id))
                 {
                    $query = $this->VehicleInOuts->query();
                    $result = $query->update()
                    ->set(['out_date' => $out_date,'out_time'=>$out_time])
                    ->where(['id' =>$id ])
                    ->execute();
                    $this->Flash->success(__('The Vehicle has been checked out successfully.'));
                     return $this->redirect(['action' => 'add']);
                 }

        }
    }
       public function report($value='')
    {
        $active_li='Vehicle In-Out';
        $active_sub_li='report';

        $vehicleInOut = $this->VehicleInOuts->newEntity();
        $where = [];
        $data_exist ='';
        if($this->request->is(['post']))
        {
            //pr($this->request->getData('data'));exit;
            foreach ($this->request->getData('data') as $key => $v) {
                if(!empty($v))
                {
                    if ($key=='form_to_date' && !empty($v))
                    {
                        $daterange=explode('/',$v);
                        $date_from=date('Y-m-d',strtotime($daterange[0]));
                        $date_to=date('Y-m-d',strtotime($daterange[1]));
                        $where['VehicleInOuts.in_date >=']=$date_from;
                        $where['VehicleInOuts.in_date <=']=$date_to;
                    }
                    else
                    {
                        $where ['VehicleInOuts.'.$key] = $v;
                    }
                }

            }
            $this->set(compact('where'));
            $this->paginate = [
            'contain' => ['Vehicles']
            ];
            $vehicleInOuts = $this->paginate($this->VehicleInOuts->find()->where([$where,'VehicleInOuts.is_deleted'=>'N']));
           // $inwards = $this->paginate($this->Inwards->find()->where($conditions));

            if(!empty($vehicleInOuts->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              } 
            //pr($where);exit;
        }
       //pr($vehicleInOuts->toarray());exit;
        $this->set(compact('where','active_li','active_sub_li','vehicleInOut','vehicleInOuts','data_exist'));

    } 
   
   public function vehicleinoutExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        foreach ($this->request->getData('VehicleInOuts') as $key => $v) {
                if(!empty($v))
                {
                    if ($key=='form_to_date' && !empty($v))
                    {
                        $daterange=explode('/',$v);
                        $date_from=date('Y-m-d',strtotime($daterange[0]));
                        $date_to=date('Y-m-d',strtotime($daterange[1]));
                        $where['VehicleInOuts.in_date >=']=$date_from;
                        $where['VehicleInOuts.in_date <=']=$date_to;
                    }
                    else
                    {
                        $where ['VehicleInOuts.'.$key] = $v;
                    }
                }
            }
        $this->set(compact('where'));
        $vehicleInOuts = $this->VehicleInOuts->find()->where([$where,'VehicleInOuts.is_deleted '=>'N'])->contain(['Vehicles']);

        $this->set(compact('vehicleInOuts'));
    }

}
