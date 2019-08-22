<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * StudentClasses Controller
 *
 * @property \App\Model\Table\StudentClassesTable $StudentClasses
 *
 * @method \App\Model\Entity\StudentClass[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentClassesController extends AppController
{
    public function getstreams()
    {
        $response = $this->StudentClasses->find();

        if($response){
			$response_object = $response;
			$success=true;
			$error='';
		}else{
			$response_object = array();
			$success=false;
			$error='Something Went Wrong';
		}
        $this->set(compact('success','error','response_object'));
        $this->set('_serialize', ['success','error','response_object']);
    }
}
