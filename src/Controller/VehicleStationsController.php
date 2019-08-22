<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleStations Controller
 *
 * @property \App\Model\Table\VehicleStationsTable $VehicleStations
 *
 * @method \App\Model\Entity\VehicleStation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehicleStationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
       // $vehicleStations = $this->paginate($this->VehicleStations);
        //$vehicleStations = $this->VehicleStations;
        $user_id = $this->Auth->User('id');
        if(!$id){
                 $vehicleStation = $this->VehicleStations->newEntity();

              }
          else{
                $id = $this->EncryptingDecrypting->decryptData($id);
                 $vehicleStation = $this->VehicleStations->get($id, [
                'contain' => []
                ]);
             }

         if ($this->request->is(['patch', 'post', 'put'])){
            $vehicleStation =  $this->VehicleStations->patchEntity($vehicleStation, $this->request->getData());
            
            if(!$id)
            {
                $vehicleStation->created_by =$user_id;
            }
            else
            {
                $vehicleStation->edited_by =$user_id;
            }
              $error='';
            try 
            {
              if ($this->VehicleStations->save($vehicleStation))
              {
                 $this->Flash->success(__('The vehicle station has been saved.'));
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
                 $error_data='The vehicle station could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
         }
        $vehicleStations = $this->VehicleStations->find();
         $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('vehicleStation','id','vehicleStations','status'));

        //$this->set(compact('vehicleStations'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle Station id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vehicleStation = $this->VehicleStations->get($id, [
            'contain' => ['FeeTypeMasters', 'VehicleRoutes']
        ]);

        $this->set('vehicleStation', $vehicleStation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
		/*$user_id = $this->Auth->User('id');
		if(!$id){
		         $vehicleStation = $this->VehicleStations->newEntity();

	          }
	      else{
                $id = $this->EncryptingDecrypting->decryptData($id);
		         $vehicleStation = $this->VehicleStations->get($id, [
			    'contain' => []
			    ]);
		     }

         if ($this->request->is(['patch', 'post', 'put'])){
            $vehicleStation =  $this->VehicleStations->patchEntity($vehicleStation, $this->request->getData());
            if(!$id)
            {
                $vehicleStation->created_by =$user_id;
            }
            else
            {
                $vehicleStation->edited_by =$user_id;
            }
              $error='';
            try 
            {
              if ($this->VehicleStations->save($vehicleStation))
              {
                 $this->Flash->success(__('The vehicle station has been saved.'));
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
                 $error_data='The vehicle station could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
         }
		$vehicleStations = $this->VehicleStations->find();
        $this->set(compact('vehicleStation','id','vehicleStations'));*/
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle Station id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $id = $this->EncryptingDecrypting->decryptData($id);
        $vehicleStation = $this->VehicleStations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicleStation = $this->VehicleStations->patchEntity($vehicleStation, $this->request->getData());
            if ($this->VehicleStations->save($vehicleStation)) {
                $this->Flash->success(__('The vehicle station has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicle station could not be saved. Please, try again.'));
        }
        $this->set(compact('vehicleStation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle Station id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch','post', 'put']);
        $vehicleStation = $this->VehicleStations->get($id);
        $this->request->data['is_deleted']='Y';
        $vehicleStation = $this->VehicleStations->patchEntity($vehicleStation, $this->request->data());
        if ($this->VehicleStations->save($vehicleStation)) {
            $this->Flash->success(__('The vehicle station has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle station could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
