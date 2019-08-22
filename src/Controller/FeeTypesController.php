<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * FeeTypes Controller
 *
 * @property \App\Model\Table\FeeTypesTable $FeeTypes
 *
 * @method \App\Model\Entity\FeeType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeeTypesController extends AppController
{
    public function promoteMasterSetup()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $next_session_year_id = $this->request->getData('next_session_year_id');
            $nextSessionExist=$this->FeeTypes->SessionYears->ClassMappings->find()->where(['session_year_id'=>$next_session_year_id])->count();
            if($nextSessionExist == 0)
            {
                $classMappings=$this->FeeTypes->SessionYears->ClassMappings->find()->where(['session_year_id'=>$session_year_id,'is_deleted'=>'N']);
                foreach ($classMappings as $classMapping) 
                {
                    $classMappingSave = $this->FeeTypes->SessionYears->ClassMappings->newEntity();
                    $classMappingSave->medium_id = $classMapping->medium_id;
                    $classMappingSave->student_class_id = $classMapping->student_class_id;
                    $classMappingSave->stream_id = $classMapping->stream_id;
                    $classMappingSave->section_id = $classMapping->section_id;
                    $classMappingSave->employee_id = $classMapping->employee_id;
                    $classMappingSave->session_year_id = $next_session_year_id;
                    $classMappingSave->is_deleted = $classMapping->is_deleted;
                    $classMappingSave->created_by = $user_id;
                    $this->FeeTypes->SessionYears->ClassMappings->save($classMappingSave);
                }
                $feeTypes = $this->FeeTypes->find()->contain(['FeeTypeMasters'=>['FeeTypeMasterRows']]);
                foreach ($feeTypes as $feeType)
                {
                    $feeTypeSave = $this->FeeTypes->newEntity();
                    $feeTypeSave->fee_category_id = $feeType->fee_category_id;
                    $feeTypeSave->session_year_id = $next_session_year_id;
                    $feeTypeSave->name = $feeType->name;
                    $feeTypeSave->fee_type_role_id = $feeType->fee_type_role_id;
                    $feeTypeSave->is_deleted = $feeType->is_deleted;
                    $feeTypeSave->created_by = $user_id;
                    $this->FeeTypes->save($feeTypeSave);

                    foreach ($feeType->fee_type_masters as $fee_type_master)
                    {
                        $feeTypeMasterSave = $this->FeeTypes->FeeTypeMasters->newEntity();
                        $feeTypeMasterSave->fee_category_id = $fee_type_master->fee_category_id;
                        $feeTypeMasterSave->session_year_id = $next_session_year_id;
                        $feeTypeMasterSave->fee_type_id = $feeTypeSave->id;
                        $feeTypeMasterSave->vehicle_station_id = $fee_type_master->vehicle_station_id;
                        $feeTypeMasterSave->gender_id = $fee_type_master->gender_id;
                        $feeTypeMasterSave->hostel_id = $fee_type_master->hostel_id;
                        $feeTypeMasterSave->medium_id = $fee_type_master->medium_id;
                        $feeTypeMasterSave->student_class_id = $fee_type_master->student_class_id;
                        $feeTypeMasterSave->stream_id = $fee_type_master->stream_id;
                        $feeTypeMasterSave->student_wise = $fee_type_master->student_wise;
                        $feeTypeMasterSave->is_deleted = $fee_type_master->is_deleted;
                        $feeTypeMasterSave->created_by = $user_id;
                        $this->FeeTypes->FeeTypeMasters->save($feeTypeMasterSave);
                        foreach ($fee_type_master->fee_type_master_rows as $fee_type_master_row) 
                        {
                            $feeTypeMasterRowSave = $this->FeeTypes->FeeTypeMasters->FeeTypeMasterRows->newEntity();
                            $feeTypeMasterRowSave->fee_type_master_id = $feeTypeMasterSave->id;
                            $feeTypeMasterRowSave->fee_month_id = $fee_type_master_row->fee_month_id;
                            $feeTypeMasterRowSave->amount = $fee_type_master_row->amount;
                            $this->FeeTypes->FeeTypeMasters->FeeTypeMasterRows->save($feeTypeMasterRowSave);
                        }
                    }
                }
                $this->Flash->success(__('The master setup has been prometed.'));
                return $this->redirect(['action' => 'promoteMasterSetup']);
            }
            else
            {
                $this->Flash->error(__('The master setup has been already prometed.'));
                return $this->redirect(['action' => 'promoteMasterSetup']);
            }
        }
        $sessionYears = $this->FeeTypes->SessionYears->find('list')->order(['id'=>'DESC'])->limit(1);
        $this->set(compact('sessionYears'));
    }
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $feeType = $this->FeeTypes->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $feeType = $this->FeeTypes->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $feeType = $this->FeeTypes->patchEntity($feeType, $this->request->getData());            
            if(!$id)
            {
                $feeType->created_by =$user_id;
                $feeType->session_year_id =$session_year_id;
            }
            else
            {
                $feeType->edited_by =$user_id;
            }
            $error='';
            
            try 
            {
              if($this->FeeTypes->save($feeType))
              {
                $this->Flash->success(__('The Fee Type has been saved.'));
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
                $error_data='The Fee Type could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $this->paginate = [
            'contain' => ['FeeCategories'],
            'limit' => 10
        ];
        if ($this->request->getQuery('search')) 
        { 
            $feeTypes = $this->FeeTypes->find();
            if(!empty($this->request->getQuery('fee_category_id')))
            {
                $fee_category_id = $this->request->getQuery('fee_category_id');
                $feeTypes->where(['FeeTypes.fee_category_id'=>$fee_category_id]);
                
            }
            if(!empty($this->request->getQuery('name')))
            {
                $name = $this->request->getQuery('name');
                $feeTypes->where(function (QueryExpression $exp, Query $q) use($name) {
                    return $exp->like('FeeTypes.name', '%'.$name.'%');
                });
            }
            $feeTypes = $this->paginate($feeTypes);
        }
        else
        {
            $feeTypes = $this->paginate($this->FeeTypes);
        }
        
        
        
        $feeCategories = $this->FeeTypes->FeeCategories->find('list')->where(['is_deleted'=>'N']);
        $feeTypeRoles = $this->FeeTypes->FeeTypeRoles->find('list');
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('feeCategories','feeType', 'feeTypes','id','status','feeTypeRoles','fee_category_id','name'));
    }
    
}
