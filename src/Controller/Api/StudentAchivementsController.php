<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * StudentAchivements Controller
 *
 * @property \App\Model\Table\StudentAchivementsTable $StudentAchivements
 *
 * @method \App\Model\Entity\StudentAchivement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentAchivementsController extends AppController
{
    public function categoryList(){
        $category=$this->StudentAchivements->AchivementCategories->find()->where(['is_deleted'=>'N']);
        if ($category->count()>0){
            $success=true;
            $message=''; 
        }
        else
        {
            $success=false;
            $message='Something went wrong';
            $category=array(); 
        }
        $this->set(compact('success','message','category'));
        $this->set('_serialize', ['success','message','category']);
    }
    public function AchivementList()
    {
        $AchivementCategoryId = $this->request->getQuery('id');
        $Achivement = $this->StudentAchivements->SessionYears->find()
            ->contain(['StudentAchivements'=>function($q)use($AchivementCategoryId){
                return $q->where(['StudentAchivements.is_deleted'=>'N','StudentAchivements.achivement_type'=>'School','StudentAchivements.achivement_category_id'=>$AchivementCategoryId])
                ->contain(['AchivementCategories','Students'=>['StudentDocuments'=>function($q){
                    return $q->where(['StudentDocuments.document_class_mapping_id IS NULL']);
                }]])
                ->order(['StudentAchivements.id'=>'DESC']);
            }])
            ->order(['SessionYears.session_year_name'=>'DESC']);  
         
        if ($Achivement->count()>0){
            $success=true;
            $message=''; 
        }
        else
        {
            $success=false;
            $message='Something went wrong';
            $Achivement=array(); 
        }
        $this->set(compact('success','message','Achivement'));
        $this->set('_serialize', ['success','message','Achivement']);
    }
}
