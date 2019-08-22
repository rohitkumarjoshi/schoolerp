<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
/**
 * SchoolNotices Controller
 *
 * @property \App\Model\Table\SchoolNoticesTable $SchoolNotices
 *
 * @method \App\Model\Entity\SchoolNotice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchoolNoticesController extends AppController
{
    public function noticeList()
    {
        $schoolNotices = $this->SchoolNotices->find();
        $schoolNotices->where(['SchoolNotices.is_deleted'=>'N']);
        $schoolNotices->order(['id'=>'DESC']); 
        if($schoolNotices->count()>0){
            $success=true;
            $message=''; 
        }else{
            $success=false;
            $message="No data found";
            $schoolNotices=array();
        }
        $this->set(compact('success', 'message', 'schoolNotices'));
        $this->set('_serialize', ['success', 'message', 'schoolNotices']); 
    }
    
}
