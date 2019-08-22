<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HostelStudentAssets Controller
 *
 * @property \App\Model\Table\HostelStudentAssetsTable $HostelStudentAssets
 *
 * @method \App\Model\Entity\HostelStudentAsset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HostelStudentAssetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
     public function index($id = null)
    {
        
        $this->paginate = [
            'contain' => ['Students'=>function($q){
                    return $q->innerJoinWith('StudentInfos');
            }, 'SessionYears', 'HostelRoomAssets','HostelStudentAssetReturns']
        ];
        $data_exist='';
         if ($this->request->is(['post','put'])) {
            $student_id = $this->request->getData('student_id');
            if(!empty($student_id)){
                $conditions['HostelStudentAssets.student_id']=$student_id;
            }
            $conditions['HostelStudentAssets.is_deleted']='N';
            $conditions['HostelStudentAssets.status']='Issue';
            $hostelStudentAssets = $this->paginate($this->HostelStudentAssets->find()->where($conditions));
            if(!empty($hostelStudentAssets->toArray()))
              {
                $data_exist='data_exist';
              }
              else
              {
                $data_exist='No Record Found';
              }  
        }
        $students = $this->HostelStudentAssets->Students->find('list')->innerJoinWith('StudentInfos');
        $this->set(compact('hostelStudentAssets','students','data_exist'));
    }

    /**
     * View method
     *
     * @param string|null $id Hostel Student Asset id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hostelStudentAsset = $this->HostelStudentAssets->get($id, [
            'contain' => ['Students', 'SessionYears', 'HostelRoomAssets']
        ]);

        $this->set('hostelStudentAsset', $hostelStudentAsset);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function issueAssets()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $hostelStudentAsset = $this->HostelStudentAssets->newEntity();
        if ($this->request->is('post')) 
        {

           $hostelStudentAsset = $this->HostelStudentAssets->patchEntity($hostelStudentAsset, $this->request->getData());
           // pr($this->request->getData());exit;
           
            $error='';
            try 
            {
                $total_row = count($this->request->getData('hostel_room_asset_id'));///exit;
                $student_id = $this->request->getData('student_id');
                $hostel_room_asset_id=$this->request->getData('hostel_room_asset_id'); 
                $quantity=$this->request->getData('quantity');
               //pr($hostel_room_asset_id);exit;
                $hostelStudentAssetss=[];
                for ($i=0; $i<$total_row; $i++ ) 
                {
                    $hostelStudentAsset = $this->HostelStudentAssets->newEntity();
                    $hostelStudentAsset->student_id =$student_id;
                    $hostelStudentAsset->quantity = $quantity[$i];
                    $hostelStudentAsset->hostel_room_asset_id =$hostel_room_asset_id[$i];
                    $hostelStudentAsset->status = 'Issue'; 
                    $hostelStudentAsset->created_by = $user_id; 
                    $hostelStudentAsset->session_year_id =$session_year_id;
                    $hostelStudentAssetss[$i]=$hostelStudentAsset;
                }
                if ($this->HostelStudentAssets->saveMany($hostelStudentAssetss)) 
                {
                    //pr($hostelStudentAssetss); exit;
                    $this->Flash->success(__('The hostel student asset has been saved.'));
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
                $error_data='The hostel student asset could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $students = $this->HostelStudentAssets->Students->find('list')->innerJoinWith('StudentInfos');
        $sessionYears = $this->HostelStudentAssets->SessionYears->find('list');
        $hostelRoomAssets = $this->HostelStudentAssets->HostelRoomAssets->find()->select(['id','name','item_code'])->where(['HostelRoomAssets.default_item'=>'Yes']);
       
        
        $hostelRoomAssets_neww = $this->HostelStudentAssets->HostelRoomAssets->find('all')->select(['id','name','item_code'])->where(['HostelRoomAssets.default_item'=>'No']);
        $default_data_no=[];
        foreach($hostelRoomAssets_neww as $d)
        {
            $default_data_no[$d->id]=$d->name.'('.$d->item_code.')';
        }
        $this->set(compact('hostelStudentAsset', 'students', 'sessionYears', 'hostelRoomAssets','default_data_no'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hostel Student Asset id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
            $hostelStudentAsset=$this->HostelStudentAssets->find()
                ->where(['HostelStudentAssets.student_id' => $id,'HostelStudentAssets.status'=>'Issue'])
                ->contain(['HostelRoomAssets']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $error='';
            try 
            {
                $total_row = count($this->request->getData('hostel_room_asset_id'));
                $student_id = $this->request->getData('student_id');
                $hostel_room_asset_id=$this->request->getData('hostel_room_asset_id'); 
                $assets_row_id=$this->request->getData('id');
                $quantity=$this->request->getData('quantity');
                $hostelStudentAssetss=[];
                for ($i=0; $i<$total_row; $i++ ) 
                {
                    if(!empty(@$assets_row_id[$i]))
                    {
                       $hostelStudentAsset = $this->HostelStudentAssets->get($assets_row_id[$i]);
                    }
                    else
                    {
                        $hostelStudentAsset = $this->HostelStudentAssets->newEntity();    
                    }
                    $hostelStudentAsset->student_id =$student_id;
                    $hostelStudentAsset->quantity = $quantity[$i];
                    $hostelStudentAsset->hostel_room_asset_id =$hostel_room_asset_id[$i];
                    $hostelStudentAsset->status = 'Issue'; 
                    $hostelStudentAsset->edited_by = $user_id; 
                    $hostelStudentAsset->session_year_id = $session_year_id; 
                    $hostelStudentAssetss[$i]=$hostelStudentAsset;
                  
                }

                if($this->HostelStudentAssets->saveMany($hostelStudentAssetss))
                {
                    $this->Flash->success(__('The hostel student asset has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                pr($hostelStudentAssetss); exit;
                
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The hostel student asset could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $students = $this->HostelStudentAssets->Students->find('list')->innerJoinWith('StudentInfos');
        $sessionYears = $this->HostelStudentAssets->SessionYears->find('list');
        $hostelRoomAssets = $this->HostelStudentAssets->HostelRoomAssets->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('status','hostelStudentAsset', 'students', 'sessionYears', 'hostelRoomAssets','id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Hostel Student Asset id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hostelStudentAsset = $this->HostelStudentAssets->get($id);
        if ($this->HostelStudentAssets->delete($hostelStudentAsset)) {
            $this->Flash->success(__('The hostel student asset has been deleted.'));
        } else {
            $this->Flash->error(__('The hostel student asset could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function returnAssets($id=null)
    {
       $id = $this->EncryptingDecrypting->decryptData($id);
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        /*$hostelStudentAsset = $this->HostelStudentAssets->get($id, [
            'contain' => ['HostelRoomAssets','Students']
        ]);*/
            $hostelStudentAsset=$this->HostelStudentAssets->find()
                ->where(['HostelStudentAssets.student_id' => $id, 'HostelStudentAssets.status'=>'Issue'])
                ->contain(['HostelRoomAssets','Students','HostelStudentAssetReturns'])->toArray();
              
            //pr($hostelStudentAsset->toArray());exit;
        if ($this->request->is(['patch', 'post', 'put'])) {
           // $hostelStudentAsset = $this->HostelStudentAssets->patchEntity($hostelStudentAsset, $this->request->getData());
            //pr($this->request->getData());exit;
            $error='';
            try 
            {
                $total_row = count($this->request->getData('return_check'));
                $hostel_room_asset_id=$this->request->getData('hostel_room_asset_id'); 
                $quantity=$this->request->getData('quantity');
                $student_id=$this->request->getData('student_id');
              
                $hostelStudentAssetss=[];
                for ($i=0; $i<$total_row; $i++ ) 
                {
                    $hostelStudentAsset = $this->HostelStudentAssets->newEntity();
                    $hostelStudentAsset->student_id = $student_id[$i];
                    $hostelStudentAsset->quantity = $quantity[$i];
                    $hostelStudentAsset->hostel_room_asset_id =$hostel_room_asset_id[$i];
                    $hostelStudentAsset->status = 'Return'; 
                    $hostelStudentAsset->status_random = mt_rand(); 
                    $hostelStudentAsset->created_by = $user_id; 
                    $hostelStudentAsset->session_year_id =$session_year_id;
                    $hostelStudentAssetss[$i]=$hostelStudentAsset;
                }
                if ($this->HostelStudentAssets->saveMany($hostelStudentAssetss)) 
                {
                    $this->Flash->success(__('The hostel student asset has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                //pr($hostelStudentAssetss); exit;
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The hostel student asset could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $students = $this->HostelStudentAssets->Students->find('list');
        $hostelRoomAssets = $this->HostelStudentAssets->HostelRoomAssets->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('status','hostelStudentAsset', 'students', 'hostelRoomAssets','id'));
    }
     public function returnList($id = null)
    {
        $this->paginate = [
            'contain' => ['Students'=>function($q){
                    return $q->innerJoinWith('StudentInfos');
            }, 'SessionYears', 'HostelRoomAssets']
        ];
        $data_exist='';

         if ($this->request->is(['post','put'])) {
            $student_id = $this->request->getData('student_id');
            //$vehicle_station_id = $this->request->getData('vehicle_station_id');
            if(!empty($student_id)){
                $conditions['HostelStudentAssets.student_id']=$student_id;
            }
            $conditions['HostelStudentAssets.status']='Issue';
            //$conditions['HostelStudentAssets.status']='Return';
           /* if(!empty($vehicle_station_id)){
                $conditions['VehicleRoutes.vehicle_station_id']=$vehicle_station_id;   
            }*/
            $hostelStudentAssets = $this->paginate($this->HostelStudentAssets->find()->where($conditions)->contain(['HostelStudentAssetReturns']));
            if(!empty($hostelStudentAssets->toArray()))
            {
                $data_exist='data_exist';
            }
            else{
                $data_exist='No Record Found';
            }  
        }
        //pr($hostelStudentAssets->toArray()); exit;
        $students = $this->HostelStudentAssets->Students->find('list')->innerJoinWith('StudentInfos');
        $this->set(compact('hostelStudentAssets','students','data_exist'));
    }
}
