<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\View;
use Cake\View\Helper\FormHelper;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * FeeTypeMasters Controller
 *
 * @property \App\Model\Table\FeeTypeMastersTable $FeeTypeMasters
 *
 * @method \App\Model\Entity\FeeTypeMaster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeeTypeMastersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
        $this->Security->setConfig('unlockedActions', ['getFeeStructure','add']);
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['SessionYears', 'FeeCategories', 'FeeTypes', 'VehicleStations', 'Genders', 'StudentClasses', 'Mediums', 'Streams','Hostels'],
            'limit' => 10
        ];
        if ($this->request->getQuery('search')) 
        { 
            $feeTypeMasters = $this->FeeTypeMasters->find();
            if(!empty($this->request->getQuery('fee_category_id')))
            {
                $fee_category_id = $this->request->getQuery('fee_category_id');
                $feeTypeMasters->where(['FeeTypeMasters.fee_category_id'=>$fee_category_id]);
                
            }
            if(!empty($this->request->getQuery('fee_type_id')))
            {
                $fee_type_id = $this->request->getQuery('fee_type_id');
                $feeTypeMasters->where(['FeeTypeMasters.fee_type_id'=>$fee_type_id]);
                
            }
            if(!empty($this->request->getQuery('vehicle_station_id')))
            {
                $vehicle_station_id = $this->request->getQuery('vehicle_station_id');
                $feeTypeMasters->where(['FeeTypeMasters.vehicle_station_id'=>$vehicle_station_id]);
                
            }
            if(!empty($this->request->getQuery('student_class_id')))
            {
                $student_class_id = $this->request->getQuery('student_class_id');
                $feeTypeMasters->where(['FeeTypeMasters.student_class_id'=>$student_class_id]);
                
            }
            $feeTypeMasters = $this->paginate($feeTypeMasters);
        }
        else
        {
            $feeTypeMasters = $this->paginate($this->FeeTypeMasters);
        }

        $feeTypes = $this->FeeTypeMasters->FeeTypes->find('list');
        $feeCategories = $this->FeeTypeMasters->FeeCategories->find('list');
        $vehicleStations = $this->FeeTypeMasters->VehicleStations->find('list');
        $studentClasses = $this->FeeTypeMasters->StudentClasses->find('list');
        $this->set(compact('feeTypeMasters','feeCategories','feeTypes','fee_category_id','fee_type_id','vehicleStations','vehicle_station_id','studentClasses','student_class_id'));
    }
    
    /**
     * View method
     *
     * @param string|null $id Fee Type Master id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feeTypeMaster = $this->FeeTypeMasters->get($id, [
            'contain' => ['SessionYears', 'FeeCategories', 'FeeTypes', 'VehicleStations', 'Genders', 'StudentClasses', 'Mediums', 'Streams', 'FeeReceiptRows', 'FeeTypeMasterRows']
        ]);

        $this->set('feeTypeMaster', $feeTypeMaster);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $feeTypeMaster = $this->FeeTypeMasters->newEntity();
        if ($this->request->is('post')) {
            $feeTypeMaster = $this->FeeTypeMasters->patchEntity($feeTypeMaster, $this->request->getData());
            $feeTypeMaster->session_year_id=$session_year_id;
            $feeTypeMaster->created_by=$user_id;
             
            if ($this->FeeTypeMasters->save($feeTypeMaster)) {
                $this->Flash->success(__('The fee type master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //pr($feeTypeMaster);exit;
            $this->Flash->error(__('The fee type master could not be saved. Please, try again.'));
        }
        $feeCategories = $this->FeeTypeMasters->FeeCategories->find('list')->where(['is_deleted'=>'N']);
        $vehicleStations = $this->FeeTypeMasters->VehicleStations->find('list')->where(['is_deleted'=>'N']);
        $genders = $this->FeeTypeMasters->Genders->find('list')->where(['is_deleted'=>'N']);
        //$studentClasses = $this->FeeTypeMasters->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $mediums = $this->FeeTypeMasters->Mediums->find('list')->where(['is_deleted'=>'N']);
        $hostels = $this->FeeTypeMasters->Hostels->find('list');
        $this->set(compact('feeTypeMaster', 'sessionYears', 'feeCategories',  'vehicleStations', 'genders', 'mediums', 'studentClasses', 'hostels'));
    }
    public function getFeeStructure()
    {
        //
        $feeCategory=$this->FeeTypeMasters->FeeCategories->find()->select(['id','name'])->where(['FeeCategories.id'=>$this->request->getData('fee_category_id')])->first();
        //pr($feeCategory);exit;
        $feeType=$this->FeeTypeMasters->FeeTypes->find()->select(['id','name'])->where(['FeeTypes.id'=>$this->request->getData('fee_type_id')])->first();

        $feeMonths=$this->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find()->select(['id','name'])->order(['id'=>'ASC']);
        
        $this->set(compact('feeCategory','feeType','feeMonths')) ; 
         
    } 
    public function getFeeType()
    {
        $form = new FormHelper(new \Cake\View\View());
        $fee_category_id=$this->request->getData('fee_category_id');
        $success='1';
        $feeTypes = $this->FeeTypeMasters->FeeTypes->find('list')->where(['is_deleted'=>'N','fee_category_id'=>$fee_category_id]);
        $response=$form->control('fee_type_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Fee Type---','options'=>$feeTypes,'required'=>true,'id'=>'fee_type_id']);
        $this->set(compact('success','response'));
        $this->set('_serialize', ['success','response']);
    }
    public function getClass()
    {
        $form = new FormHelper(new \Cake\View\View());
        $medium_id=$this->request->getData('medium_id');
        $session_year_id = $this->Auth->user('session_year_id');
        $success='1';
        $classMappings = $this->FeeTypeMasters->Mediums->ClassMappings->find()
                    ->where(['ClassMappings.is_deleted'=>'N','medium_id'=>$medium_id,'ClassMappings.session_year_id'=>$session_year_id])
                    ->contain(['StudentClasses'=>function($q){
                        return $q->where(['StudentClasses.is_deleted'=>'N']);
                    }])
                    ->innerJoinWith('StudentClasses')
                    ->group(['ClassMappings.student_class_id']);
        $class=[];
        foreach ($classMappings as $classMapping) {
                $class[]=['value'=>$classMapping->student_class->id,'text'=>$classMapping->student_class->name];
        }
        $response=$form->control('student_class_id',[
                                'label' => false,'class'=>'form-control student_class_id','empty'=>'---Select Class---','options'=>$class,'id'=>'student_class_id']);
        $this->set(compact('success','response'));
        $this->set('_serialize', ['success','response']);
    }
    public function getStream()
    {
        $form = new FormHelper(new \Cake\View\View());
        $student_class_id=$this->request->getData('student_class_id');
        $session_year_id = $this->Auth->user('session_year_id');
       // $medium_id=$this->request->getData('medium_id');
        $success='1';
        $classMappings = $this->FeeTypeMasters->Streams->ClassMappings->find()
                    ->where(['ClassMappings.is_deleted'=>'N','student_class_id'=>$student_class_id,'ClassMappings.session_year_id'=>$session_year_id])
                    ->contain(['Streams'=>function($q){
                        return $q->where(['Streams.is_deleted'=>'N']);
                    }])
                    ->innerJoinWith('Streams')
                    ->group(['ClassMappings.stream_id']);
         $stream=[];
        foreach ($classMappings as $classMapping) {
                $stream[]=['value'=>$classMapping->stream->id,'text'=>$classMapping->stream->name];
        }
        $response=$form->control('stream_id',[
                                'label' => false,'class'=>'form-control stream_id','empty'=>'---Select Stream---','options'=>$stream,'id'=>'stream_id']);
        $this->set(compact('success','response','student_class_id'));
        $this->set('_serialize', ['success','response','student_class_id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fee Type Master id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $feeTypeMaster = $this->FeeTypeMasters->get($id, [
            'contain' => ['FeeTypeMasterRows','FeeCategories','FeeTypes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feeTypeMaster = $this->FeeTypeMasters->patchEntity($feeTypeMaster, $this->request->getData());
            // $feeTypeMaster->edited_on=date('Y-m-d h:i:s');
            $feeTypeMaster->edited_by=$user_id;
            
            if ($this->FeeTypeMasters->save($feeTypeMaster)) {
                
                $this->Flash->success(__('The fee type master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fee type master could not be saved. Please, try again.'));
        }
        //pr($feeTypeMaster); exit;
        $feeCategories = $this->FeeTypeMasters->FeeCategories->find('list')->where(['is_deleted'=>'N','FeeCategories.id'=>$feeTypeMaster->fee_category_id]);
        $vehicleStations = $this->FeeTypeMasters->VehicleStations->find('list')->where(['is_deleted'=>'N']);
        $genders = $this->FeeTypeMasters->Genders->find('list')->where(['is_deleted'=>'N']); 
        $mediums = $this->FeeTypeMasters->Mediums->find('list')->where(['is_deleted'=>'N']); 
        $feeMonths=$this->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find()->select(['id','name'])->order(['id'=>'ASC']);
        $feeTypes = $this->FeeTypeMasters->FeeTypes->find('list')->where(['FeeTypes.id'=>$feeTypeMaster->fee_type_id]);
        $hostels = $this->FeeTypeMasters->Hostels->find('list');
        //pr($feeTypeMaster); exit;
        $studentClasses = $this->FeeTypeMasters->StudentClasses->find('list')->where(['is_deleted'=>'N'])->order(['order_of_class'=>'ASC']);
        $status[]=['value'=>'N','text'=>'Active'];
        $status[]=['value'=>'Y','text'=>'Deactive'];
        $this->set(compact('feeTypeMaster', 'sessionYears', 'feeCategories',  'vehicleStations', 'genders', 'mediums', 'studentClasses', 'hostels','feeTypes','feeMonths','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fee Type Master id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $feeTypeMaster = $this->FeeTypeMasters->get($id, [
            'contain' => []
        ]);
        $feeTypeMaster = $this->FeeTypeMasters->patchEntity($feeTypeMaster, $this->request->getData());
        $feeTypeMaster->is_deleted=1;
        if ($this->FeeTypeMasters->save($feeTypeMaster)) {
            $this->Flash->success(__('Deleted successfully.'));
        } else {
            $this->Flash->error(__('Could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
