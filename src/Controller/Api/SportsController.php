<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
/**
 * Sports Controller
 *
 * @property \App\Model\Table\SportsTable $Sports
 *
 * @method \App\Model\Entity\Sport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SportsController extends AppController
{
    public function infrastructureList()
    {
        $infrastructure = $this->Sports->find()
            ->contain(['SportRows'=>function($q){
                return $q->where(['SportRows.is_deleted'=>'N']);
            }])
            ->where(['Sports.is_deleted'=>'N'])
            ->order(['Sports.name'=>'ASC']);
        if($infrastructure->count()){
            $success=true;
            $message=''; 
        }else{
            $success=false;
            $message="No data found";
            $infrastructure=array();
        }
        $this->set(compact('success', 'message', 'infrastructure'));
        $this->set('_serialize', ['success', 'message', 'infrastructure']);
    }
}
