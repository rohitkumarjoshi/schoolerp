<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * Directories Controller
 *
 * @property \App\Model\Table\DirectoriesTable $Directories
 *
 * @method \App\Model\Entity\Directory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DirectoriesController extends AppController
{
    public function DirectoryList()
    {
        $where=[];
        if(!empty($emp_id)){
            $where['Directories.employee_id']=$emp_id;
        }
        $directoryList = $this->Directories->find() 
                         ->contain(['Employees'])
                         ->where($where);
        if($directoryList->count()>0){
            $success=true;
            $message='';
        }else{
            $success=false;
            $message="No data found";
            $directoryList=array();
        }
        $this->set(compact('success', 'message', 'directoryList'));
        $this->set('_serialize', ['success', 'message', 'directoryList']);
    
    }
}
