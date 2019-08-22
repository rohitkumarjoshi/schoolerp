<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * Galleries Controller
 *
 * @property \App\Model\Table\GalleriesTable $Galleries
 *
 * @method \App\Model\Entity\Gallery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GalleriesController extends AppController
{
	public function notification()
    { 
		$id = $this->request->getQuery('user_id');
		$Notifications=$this->Galleries->Notifications->NotificationRows->find()->where(['NotificationRows.user_id'=>$id])->contain(['Notifications']);
		
		 //$Notifications->where(['NotificationRows.user_id'=>8]);  
        if($Notifications->toArray()){
            $success=true;
            $message='';
           
        }else{
            $success=false;
            $message="No data found";
            $Notifications=array();
        }
        $this->set(compact('success', 'message', 'Notifications'));
        $this->set('_serialize', ['success', 'message', 'Notifications']);   
	
	}
	
    public function eventList()
    { 
        $userType = $this->request->getData('user_type');
        $page = $this->request->getData('page');
        if(empty($page)){$page=1;}
        $limit=10;
        $role_type='Teacher';
        if($userType=='Employee'){
            $role_type='Student';
        } 
        $galleries = $this->Galleries->find()->contain(['EventSchedules']);
        $galleries->where(['Galleries.function_type'=>'Event','Galleries.is_deleted'=>'N']);
        $galleries->where(['Galleries.role_type !='=>$role_type]); 
        $galleries->order(['Galleries.id'=>'DESC']);
        $galleries->limit($limit);
        $galleries->page($page);
        
        if($galleries->count()>0){
            $success=true;
            $message='';
            $EventLists=$galleries;
        }else{
            $success=false;
            $message="No data found";
            $EventLists=array();
        }
        $this->set(compact('success', 'message', 'EventLists'));
        $this->set('_serialize', ['success', 'message', 'EventLists']);   
    }
    
    public function details()
    { 
        $id = $this->request->getQuery('id');
        $galleryCount=$this->Galleries->find()->where(['id'=>$id])->count(); 
        if($galleryCount>0){
            $galleries = $this->Galleries->get($id, [
                'contain' => ['EventSchedules']
            ]);
             
            $success=true;
            $message='';
            $details=$galleries;
        }
        else{
            $success=false;
            $message="No data found";
            $details=array();
        }
         
        $this->set(compact('success', 'message', 'details'));
        $this->set('_serialize', ['success', 'message', 'details']);   
    }

    public function newsList()
    { 
        $userType = $this->request->getData('user_type');
        $page = $this->request->getData('page');
        if(empty($page)){$page=1;}
        $limit=10;
        $role_type='Teacher';
        if($userType=='Employee'){
            $role_type='Student';
        } 
        $galleries = $this->Galleries->find();
        $galleries->where(['Galleries.function_type'=>'News','Galleries.is_deleted'=>'N']);
        $galleries->where(['Galleries.role_type !='=>$role_type]); 
        $galleries->order(['Galleries.created_on'=>'DESC']);
        $galleries->limit($limit);
        $galleries->page($page); 

        if($galleries->count()>0){
            $success=true;
            $message='';
            $NewsLists=$galleries;
        }else{
            $success=false;
            $message="No data found";
            $NewsLists=array();
        }
        $this->set(compact('success', 'message', 'NewsLists'));
        $this->set('_serialize', ['success', 'message', 'NewsLists']);   
    }
     
    public function galleryList()
    { 
        $userType = $this->request->getData('user_type');
        $page = $this->request->getData('page');
        if(empty($page)){$page=1;}
        $limit=10;
        $role_type='Teacher';
        if($userType=='Employee'){
            $role_type='Student';
        } 

        $GalleryLists =  $this->Galleries->find()
            ->contain(['EventSchedules','GalleryRows'])
            ->where(['gallery_type'=>'Image','is_deleted'=>'N','role_type !='=>$role_type])
            ->order(['id'=>'DESC'])
            ->limit($limit)
            ->page($page);  
        if($GalleryLists->count()>0){
            $success=true;
            $message='';
            $GalleryLists=$GalleryLists;
        }else{
            $success=false;
            $message="No data found";
            $GalleryLists=array();
        }
        $this->set(compact('success', 'message', 'GalleryLists'));
        $this->set('_serialize', ['success', 'message', 'GalleryLists']); 
    }
    public function galleryDetails()
    { 
        $gallery_id = $this->request->getQuery('id');
        $galleryData=$this->Galleries->GalleryRows->find()->where(['GalleryRows.gallery_id'=>$gallery_id])->order(['GalleryRows.id'=>'DESC']);
        if($galleryData->count()>0){
            $success=true;
            $message='';
            $galleryData=$galleryData;
        }else{
            $success=false;
            $message="No data found";
            $galleryData=array();
        } 
        $this->set(compact('success', 'message', 'galleryData'));
        $this->set('_serialize', ['success', 'message', 'galleryData']); 
    } 

    public function audioList()
    {
        $galleries = $this->paginate($this->Galleries->find()->where(['function_type'=>'Gallery','is_deleted'=>'N','gallery_type'=>'Audio'])->order(['id'=>'DESC']));
        if($galleries->count()>0){
            $success=true;
            $message='';
            $audioLists=$galleries;
        }else{
            $success=false;
            $message="No data found";
            $audioLists=array();
        } 
        $this->set(compact('success', 'message', 'audioLists'));
        $this->set('_serialize', ['success', 'message', 'audioLists']); 
    }
    public function videoList()
    {
        $galleries = $this->paginate($this->Galleries->find()->where(['function_type'=>'Gallery','is_deleted'=>'N','gallery_type'=>'Video'])->order(['id'=>'DESC']));
        if($galleries->count()>0){
            $success=true;
            $message='';
            $videoLists=$galleries;
        }else{
            $success=false;
            $message="No data found";
            $videoLists=array();
        } 
        $this->set(compact('success', 'message', 'videoLists'));
        $this->set('_serialize', ['success', 'message', 'videoLists']); 
    } 
}
