<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Galleries Controller
 *
 * @property \App\Model\Table\GalleriesTable $Galleries
 *
 * @method \App\Model\Entity\Gallery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GalleriesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','newsAdd','galleryAdd','edit']);
		$this->Auth->allow(['sendnotification']);
    }

	
	
    public function index()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type = $this->Auth->User('login_type');
        $this->paginate = [
            'contain' => ['EventSchedules']
        ];
        $galleries = $this->Galleries->find();
       $galleries->where(['Galleries.function_type'=>'Event']);
        
        if(!empty($this->request->getQuery('role'))){
            $galleries->where(['Galleries.role_type'=>$this->request->getQuery('role')]);
        }
        if($login_type != "Admin"){
           $galleries->where(['Galleries.role_type'=>'Teacher']); 
        }

        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $galleries->where(function($exp) use($date_from,$date_to) {
                return $exp->between('date_from', $date_from, $date_to, 'date');
            })
            ->orWhere(function($exp) use($date_from,$date_to) {
                 return $exp->between('date_to', $date_from, $date_to, 'date');
            });
        }
        $galleries->order(['Galleries.id'=>'DESC']);
        $galleries = $this->paginate($galleries);
        $this->set(compact('galleries'));
    }

    public function studentEvents()
    {
        $this->paginate = [
            'contain' => ['EventSchedules']
        ];
        $galleries = $this->Galleries->find();
        $galleries->where(['Galleries.function_type'=>'Event','Galleries.is_deleted'=>'N','Galleries.role_type'=>'Student']);
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $galleries->where(function($exp) use($date_from,$date_to) {
                return $exp->between('date_from', $date_from, $date_to, 'date');
            })
            ->orWhere(function($exp) use($date_from,$date_to) {
                 return $exp->between('date_to', $date_from, $date_to, 'date');
            });
        }
        $galleries->order(['Galleries.id'=>'DESC']);
        $galleries = $this->paginate($galleries);
        $this->set(compact('galleries'));
    }

    public function newsIndex()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type = $this->Auth->User('login_type');

        $galleries = $this->Galleries->find();
        $galleries->where(['Galleries.function_type'=>'News']);
        if(!empty($this->request->getQuery('role'))){
            $galleries->where(['Galleries.role_type'=>$this->request->getQuery('role')]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $galleries->where(function($exp) use($date_from,$date_to) {
                        return $exp->between('date_from', $date_from, $date_to, 'date');
                    })
                    ->orWhere(function($exp) use($date_from,$date_to) {
                         return $exp->between('date_to', $date_from, $date_to, 'date');
                    });
        }
        if($login_type != "Admin"){
           $galleries->where(['Galleries.role_type'=>'Teacher']); 
        }
        $galleries->order(['Galleries.id' => 'DESC']);
        $galleries = $this->paginate($galleries);

        $this->set(compact('galleries'));
    }

    public function studentNews()
    {
        $galleries = $this->Galleries->find();
        $galleries->where(['Galleries.function_type'=>'News','Galleries.is_deleted'=>'N','Galleries.role_type'=>'Student']);
        
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $galleries->where(function($exp) use($date_from,$date_to) {
                        return $exp->between('date_from', $date_from, $date_to, 'date');
                    })
                    ->orWhere(function($exp) use($date_from,$date_to) {
                         return $exp->between('date_to', $date_from, $date_to, 'date');
                    });
        }
        $galleries->order(['Galleries.id' => 'DESC']);
        $galleries = $this->paginate($galleries);
        $this->set(compact('galleries'));
    }

    public function galleryIndex()
    {   
        $user_type = $this->Auth->User('login_type'); 
         
        
        $eventsList =  $this->Galleries->find()->where(['gallery_type'=>'Image','is_deleted'=>'N']) ->order(['id'=>'DESC']);
        if($user_type != "Admin"){
           $eventsList->where(['Galleries.role_type'=>'Teacher']); 
        }
        //pr($eventsList->toArray());exit;
        $events=[];
        foreach ($eventsList as $key => $data) { 
            $date_from=date('d-M-Y',strtotime($data->date_from));
            $date_to=date('d-M-Y',strtotime($data->date_to));
            $text=$data->title;

            if($data->function_type=='Event'){
               $text = $data->title.' ('.$date_from.' - '.$date_to.')';
            } 
            if($data->function_type=='News'){
               $text = $data->title.' ('.$date_from.')';
            }     
            $events[]=['value'=>$data->id,'text'=>$text];  
        }
        $galleryData=[];
        if ($this->request->is('post')) {
            $galleryData=$this->Galleries->GalleryRows->find(); 
            $gallery_id=$this->request->getData('gallery_id');
            if(!empty($gallery_id))
            {
                $galleryData->where(['GalleryRows.gallery_id'=>$gallery_id]);
            }
            $galleryData->order(['id'=>'DESC']);
        }
         
        $this->set(compact('events','news','galleryData','user_type'));
    }

    public function studentGallery()
    { 
        $eventsList =  $this->Galleries->find()->where(['gallery_type'=>'Image','is_deleted'=>'N','role_type'=>'Student']) ->order(['id'=>'DESC']);
        $events=[];
        foreach ($eventsList as $key => $data) { 
            $date_from=date('d-M-Y',strtotime($data->date_from));
            $date_to=date('d-M-Y',strtotime($data->date_to));
            $text=$data->title;
            if($data->function_type=='Event'){
               $text = $data->title.' ('.$date_from.' - '.$date_to.')';
            } 
            if($data->function_type=='News'){
               $text = $data->title.' ('.$date_from.')';
            }     
            $events[]=['value'=>$data->id,'text'=>$text];  
        }
        $galleryData=[];
        if ($this->request->is('post')) {
            $galleryData=$this->Galleries->GalleryRows->find(); 
            $gallery_id=$this->request->getData('gallery_id');
            if(!empty($gallery_id))
            {
                $galleryData->where(['GalleryRows.gallery_id'=>$gallery_id]);
            }
            $galleryData->order(['id'=>'DESC']);
        }
         
        $this->set(compact('events','news','galleryData'));
    }

    public function indexAudio()
    {
        $galleries = $this->paginate($this->Galleries->find()->where(['function_type'=>'Gallery','is_deleted'=>'N','gallery_type'=>'Audio'])->order(['id'=>'DESC']));
        $this->set(compact('galleries'));
    }
    public function indexVideo()
    {
        $galleries = $this->paginate($this->Galleries->find()->where(['function_type'=>'Gallery','is_deleted'=>'N','gallery_type'=>'Video'])->order(['id'=>'DESC']));
        $this->set(compact('galleries'));
    }

    /**
     * View method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gallery = $this->Galleries->get($id, [
            'contain' => ['EventSchedules', 'GalleryRows']
        ]);

        $this->set('gallery', $gallery);
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
        $gallery = $this->Galleries->newEntity();
        if ($this->request->is('post')) {
            
            $event_shedules = $this->request->getData('event_schedules');
            $x=0;
            // foreach ($event_shedules as $SingleEvent) {
            //     $shedule_date = $SingleEvent['schedule_date'];
            //     $this->request->data['event_schedules'][$x]['schedule_date'] = date('Y-m-d',strtotime($shedule_date));
            //     $x++;
            // }
            $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
            $gallery->date_from = date('Y-m-d',strtotime($this->request->getData('date_from')));
            $gallery->date_to = date('Y-m-d',strtotime($this->request->getData('date_to')));
            $gallery->created_by=$user_id;
            $eventImage = $this->request->getData('eventImage');
            
            //-- Cover Image
            $image = $this->request->getData('cover_image');
            $ext=explode('/',$image['type']);
            $file_name='event'.time().rand().'.'.$ext[1];
            $gallery->cover_image=$file_name;             
            $gallery->gallery_type='Image';             
            $gallery->function_type='Event';  
			
		
		
            if ($this->Galleries->save($gallery)) {
				
				
				// Notification Code 
		
				$role_type=$gallery->role_type;
				if($role_type=='All'){
					$user_type=['Employee','Student'];
				}elseif($role_type=='Teacher'){
					$user_type=['Employee'];
				}elseif($role_type=='Student'){
					$user_type=['Student'];
				}
				
				$Usersdatas=$this->Galleries->Users->find()->where(['user_type IN'=>$user_type,'device_token !='=>'','is_deleted'=>'N'])->toArray();
				
				$Notifications=$this->Galleries->Notifications->newEntity();
				$Notifications->title='Event';
				$Notifications->message=$gallery->title;
				$Notifications->df_link='Alok://Event?id='.$gallery->id;
				$Notifications->notify_date=date("Y-m-d");
				$Notifications->notify_time=date("h:i: A");
				$Notifications->status=0;
				$Notifications->created_by=$user_id;
				$this->Galleries->Notifications->save($Notifications);
				
				foreach($Usersdatas as $Usersdata){
					$NotificationRows=$this->Galleries->Notifications->NotificationRows->newEntity();
					$NotificationRows->notification_id=$Notifications->id;
					$NotificationRows->user_id=$Usersdata->id;
					$NotificationRows->sent=0;
					$NotificationRows->status=0;
					$this->Galleries->Notifications->NotificationRows->save($NotificationRows);
				}
				
				
				
			// End Notification 
			

                $keyname = 'events/'.$gallery->id.'/'.$file_name;
                $this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
                $query = $this->Galleries->query();
                $query->update()->set(['cover_image'=>$keyname])->where(['id' => $gallery->id])->execute();;

                foreach ($eventImage as $ImagesofEvent) {
                    if(!empty($ImagesofEvent['tmp_name'])){
                        $ext=explode('/',$ImagesofEvent['type']);
                        $file_name='event'.time().rand().'.'.$ext[1];
                        $keynames = 'events/'.$gallery->id.'/'.$file_name;
                        $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);

                        $galleryRows = $this->Galleries->GalleryRows->newEntity();
                        $galleryRows->file_path=$keynames; 
                        $galleryRows->gallery_id=$gallery->id;
                        $this->Galleries->GalleryRows->save($galleryRows);
                    } 
                }   
		
                $this->Flash->success(__('The Event has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Event could not be saved. Please, try again.'));
        }
        $this->set(compact('gallery'));
    }

	
	public function sendnotification(){
		
		$NotificationRows=$this->Galleries->Notifications->NotificationRows->find()
		->where(['NotificationRows.status'=>0])
		->contain(['Notifications','Users'])
		->limit(50);
		
		foreach($NotificationRows as $NotificationRow){
			$notificationRow_id=$NotificationRow->id;
			$device_token=$NotificationRow->user->device_token;
			$title=$NotificationRow->notification->title;
			$message=$NotificationRow->notification->message;
			$link=$NotificationRow->notification->df_link;
					if(!empty($device_token)){
							
								$tokens = array($device_token);

								$header = [
								'Content-Type:application/json',
								'Authorization: Key=AAAABVEB0FY:APA91bGo3Y-hslS9_ztp95KFdzgfkf_IR-KR1K9WJlPo5wGYtWFunp_LK3zy8Dom3DJo2UV9IXBbcO_hDeLFRf6hUHt-QelMevoA0O4b_DC3VpH_POvBM2NG0_z20Iztzp7lE1FtTV8e'
								];

								$msg = [
								'title'=> $title,
								'message' => $message,
								
								'link' =>$link
								];

								$payload = array(
								'registration_ids' => $tokens,
								'data' => $msg
								);

								$curl = curl_init();
								curl_setopt_array($curl, array(
								CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_CUSTOMREQUEST => "POST",
								CURLOPT_POSTFIELDS => json_encode($payload),
								CURLOPT_HTTPHEADER => $header
								));
								$response = curl_exec($curl);
								$err = curl_error($curl);
								curl_close($curl);
								
								$final_result=json_decode($response);
								$sms_flag=$final_result->success;     
								if ($err) {
									echo "cURL Error #:" . $err;
								} else {
									echo $response;
								}            
		
							if($sms_flag>0){
								$query = $this->Galleries->Notifications->NotificationRows->query();
								$query->update()
								->set(['sent' => 1])
								->where(['id' => $notificationRow_id])
								->execute();
							}else{
								$query = $this->Galleries->Notifications->NotificationRows->query();
								$query->update()
								->set(['sent' => 2])
								->where(['id' => $notificationRow_id])
								->execute();
							}							
						} 
					$query = $this->Galleries->Notifications->NotificationRows->query();
					$query->update()
					->set(['status' => 1])
					->where(['id' => $notificationRow_id])
					->execute();
		}
		exit;
	}
	
	
    public function newsAdd()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $gallery = $this->Galleries->newEntity();
        if ($this->request->is('post')) {
            
            
            $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
            $gallery->date_from = date('Y-m-d',strtotime($this->request->getData('date_from')));
            $gallery->date_to = date('Y-m-d',strtotime($this->request->getData('date_from')));
            $eventImage = $this->request->getData('eventImage');
            
            //-- Cover Image
            $image = $this->request->getData('cover_image');
            $ext=explode('/',$image['type']);
            $file_name='news'.time().rand().'.'.$ext[1];
            $gallery->cover_image=$file_name;             
            $gallery->gallery_type='Image';             
            $gallery->function_type='News'; 
            $gallery->created_by=$user_id; 
            //pr($gallery);exit;
            if ($this->Galleries->save($gallery)) {
				
				// Notification Code 
		
				$role_type=$gallery->role_type;
				if($role_type=='All'){
					$user_type=['Employee','Student'];
				}elseif($role_type=='Teacher'){
					$user_type=['Employee'];
				}elseif($role_type=='Student'){
					$user_type=['Student'];
				}
				
				$Usersdatas=$this->Galleries->Users->find()->where(['user_type IN'=>$user_type,'device_token !='=>'','is_deleted'=>'N'])->toArray();
				
				$Notifications=$this->Galleries->Notifications->newEntity();
				$Notifications->title='News';
				$Notifications->message=$gallery->title;
				$Notifications->df_link='Alok://News?id='.$gallery->id;
				$Notifications->notify_date=date("Y-m-d");
				$Notifications->notify_time=date("h:i: A");
				$Notifications->status=0;
				$Notifications->created_by=$user_id;
				$this->Galleries->Notifications->save($Notifications);
				
				foreach($Usersdatas as $Usersdata){
					$NotificationRows=$this->Galleries->Notifications->NotificationRows->newEntity();
					$NotificationRows->notification_id=$Notifications->id;
					$NotificationRows->user_id=$Usersdata->id;
					$NotificationRows->sent=0;
					$NotificationRows->status=0;
					$this->Galleries->Notifications->NotificationRows->save($NotificationRows);
				}
				
				
				
			// End Notification 
			
			

                $keyname = 'news/'.$gallery->id.'/'.$file_name;
                $this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
                $query = $this->Galleries->query();
                $query->update()->set(['cover_image'=>$keyname])->where(['id' => $gallery->id])->execute();;

                foreach ($eventImage as $ImagesofEvent) {
                    if(!empty($ImagesofEvent['tmp_name'])){
                        $ext=explode('/',$ImagesofEvent['type']);
                        $file_name='news'.time().rand().'.'.$ext[1];
                        $keynames = 'news/'.$gallery->id.'/'.$file_name;
                        $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);

                        $galleryRows = $this->Galleries->GalleryRows->newEntity();
                        $galleryRows->file_path=$keynames; 
                        $galleryRows->gallery_id=$gallery->id;
                        $this->Galleries->GalleryRows->save($galleryRows);
                    } 
                }    
                $this->Flash->success(__('The Event has been saved.'));
                return $this->redirect(['action' => 'newsIndex']);
            }
            $this->Flash->error(__('The Event could not be saved. Please, try again.'));
        }
        $this->set(compact('gallery'));
    }
    
    public function galleryAdd()
    {
        $user_id = $this->Auth->User('id');
        $user_type = $this->Auth->User('login_type');
        $session_year_id = $this->Auth->User('session_year_id');
        $gallery = $this->Galleries->newEntity();
        if ($this->request->is('post')) {

            if(isset($this->request->data['newGallery']))
            { 
                $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
                $eventImage = $this->request->getData('eventImage');
                //-- Cover Image
                $image = $this->request->getData('cover_image');
                $ext=explode('/',$image['type']);
                $file_name='gallery'.time().rand().'.'.$ext[1];
                $gallery->cover_image=$file_name;             
                $gallery->gallery_type='Image';             
                $gallery->role_type='All';             
                $gallery->function_type='Gallery';
                $gallery->created_by=$user_id;  
                //pr($gallery);exit;
                if ($this->Galleries->save($gallery)) {
					
					
					// Notification Code 
		
				
				$user_type=['Employee','Student'];
				
				$Usersdatas=$this->Galleries->Users->find()->where(['user_type IN'=>$user_type,'device_token !='=>'','is_deleted'=>'N'])->toArray();
				
				$Notifications=$this->Galleries->Notifications->newEntity();
				$Notifications->title='Gallery';
				$Notifications->message=$gallery->title;
				$Notifications->df_link='Alok://Gallery?id='.$gallery->id;
				$Notifications->notify_date=date("Y-m-d");
				$Notifications->notify_time=date("h:i: A");
				$Notifications->status=0;
				$Notifications->created_by=$user_id;
				$this->Galleries->Notifications->save($Notifications);
				
				foreach($Usersdatas as $Usersdata){
					$NotificationRows=$this->Galleries->Notifications->NotificationRows->newEntity();
					$NotificationRows->notification_id=$Notifications->id;
					$NotificationRows->user_id=$Usersdata->id;
					$NotificationRows->sent=0;
					$NotificationRows->status=0;
					$this->Galleries->Notifications->NotificationRows->save($NotificationRows);
				}
				
			// End Notification 
			
                    $keyname = 'gallery/'.$gallery->id.'/'.$file_name;
                    $this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
                    $query = $this->Galleries->query();
                    $query->update()->set(['cover_image'=>$keyname])->where(['id' => $gallery->id])->execute();;

                    foreach ($eventImage as $ImagesofEvent) {
                        if(!empty($ImagesofEvent['tmp_name'])){
                            $ext=explode('/',$ImagesofEvent['type']);
                            $file_name='gallery'.time().rand().'.'.$ext[1];
                            $keynames = 'gallery/'.$gallery->id.'/'.$file_name;
                            $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);

                            $galleryRows = $this->Galleries->GalleryRows->newEntity();
                            $galleryRows->file_path=$keynames; 
                            $galleryRows->gallery_id=$gallery->id;
                            $this->Galleries->GalleryRows->save($galleryRows);
                        } 
                    }    
                    $this->Flash->success(__('The Event has been saved.'));
                    return $this->redirect(['action' => 'galleryIndex']);
                }
                $this->Flash->error(__('The Event could not be saved. Please, try again.'));
            }
            if(isset($this->request->data['oldGallery']))
            { 
                
                $gallery_id=0;
                $event_id = $this->request->getData('event_id');
                if(!empty($event_id)){
                   $gallery_id=$event_id; 
                }
                $news_id = $this->request->getData('news_id');
                if(!empty($news_id)){
                   $gallery_id=$news_id; 
                }
                $eventImage = $this->request->getData('eventImage');
                foreach ($eventImage as $ImagesofEvent) {
                    if(!empty($ImagesofEvent['tmp_name'])){
                        $ext=explode('/',$ImagesofEvent['type']);
                        if(!empty($event_id)){
                            $file_name='event'.time().rand().'.'.$ext[1];
                            $keynames = 'events/'.$gallery_id.'/'.$file_name;
                        }
                        if(!empty($news_id)){
                            $file_name='news'.time().rand().'.'.$ext[1];
                            $keynames = 'news/'.$gallery_id.'/'.$file_name;
                        }
                        $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);

                        $galleryRows = $this->Galleries->GalleryRows->newEntity();
                        $galleryRows->file_path=$keynames; 
                        $galleryRows->gallery_id=$gallery_id;
                        $this->Galleries->GalleryRows->save($galleryRows);
                    } 
                }
                if(!empty($event_id)){
                    return $this->redirect(['action' => 'index']);  
                } 
                if(!empty($news_id)){
                    return $this->redirect(['action' => 'newsIndex']);  
                } 
            }

        }
        $eventsList =  $this->Galleries->find()->where(['Galleries.is_deleted'=>'N'])->order(['id'=>'DESC']); 
        if($user_type != "Admin"){
           $eventsList->where(['Galleries.role_type'=>'Teacher']); 
        }
        $events=[];
        $news=[];
        foreach ($eventsList as $key => $data) { 
            $date_from=date('d-M-Y',strtotime($data->date_from));
            $date_to=date('d-M-Y',strtotime($data->date_to));
            $text=$data->title;
            if($data->function_type=='Event'){
               $text = $data->title.' ('.$date_from.' - '.$date_to.')';
               $events[]=['value'=>$data->id,'text'=>$text];
            } 
            if($data->function_type=='News'){
               $text = $data->title.' ('.$date_from.')';
               $news[]=['value'=>$data->id,'text'=>$text];
            }     
        }

        $this->set(compact('gallery','events','news'));
    }

    public function addAudioVideo()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $gallery = $this->Galleries->newEntity();
        if ($this->request->is('post')) {

            if(isset($this->request->data['newGallery']))
            {
                $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
                $gallery->gallery_type='Video';             
                $gallery->role_type='All';             
                $gallery->function_type='Gallery';
                $gallery->created_by=$user_id; 
                if ($this->Galleries->save($gallery)) {
                    $this->Flash->success(__('The Video has been saved.'));
                    return $this->redirect(['action' => 'indexVideo']);
                }
                $this->Flash->error(__('The Video could not be saved. Please, try again.'));
            }
            if(isset($this->request->data['oldGallery']))
            {  
                $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
                //-- Cover Image
                $image = $this->request->getData('cover_image');
                $ext=explode('/',$image['type']);
                $file_name='audio'.time().rand().'.'.$ext[1];
                $gallery->cover_image=$file_name;             
                $gallery->gallery_type='Audio';             
                $gallery->role_type='All';             
                $gallery->function_type='Gallery';
                $gallery->created_by=$user_id;   
                if ($this->Galleries->save($gallery)) {
                    $keyname = 'audio/'.$gallery->id.'/'.$file_name;
                    $this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
                    $query = $this->Galleries->query();
                    $query->update()->set(['cover_image'=>$keyname])->where(['id' => $gallery->id])->execute();;
     
                    $this->Flash->success(__('The audio has been saved.'));
                    return $this->redirect(['action' => 'indexAudio']);
                }
                $this->Flash->error(__('The audio could not be saved. Please, try again.'));
            }

        }
        $events =  $this->Galleries->find('list')->where(['function_type'=>'Event'])->order(['id'=>'DESC']);
        $news =  $this->Galleries->find('list')->where(['function_type'=>'News'])->order(['id'=>'DESC']);
        $this->set(compact('gallery','events','news'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($Eid = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $id = $this->EncryptingDecrypting->decryptData($Eid);
        $gallery = $this->Galleries->get($id, [
            'contain' => ['EventSchedules']
        ]);
        $Oldgallery = $this->Galleries->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event_shedules = $this->request->getData('event_schedules');
            $x=0;
            // foreach ($event_shedules as $SingleEvent) {
            //     $shedule_date = $SingleEvent['schedule_date'];
            //     $this->request->data['event_schedules'][$x]['schedule_date'] = date('Y-m-d',strtotime($shedule_date));
            //     $x++;
            // }
            $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
            $gallery->date_from = date('Y-m-d',strtotime($this->request->getData('date_from')));
            $gallery->date_to = date('Y-m-d',strtotime($this->request->getData('date_to')));
            $gallery->edited_by=$user_id;

            $cover_image = $this->request->getData('cover_image');
            if(!empty($cover_image['tmp_name'])){
                $this->AwsFile->deleteObjectFile($Oldgallery->cover_image);
                $image = $this->request->getData('cover_image');
                $ext=explode('/',$image['type']);
                $file_name='event'.time().rand().'.'.$ext[1];
                $keyname = 'events/'.$id.'/'.$file_name;
                $gallery->cover_image=$keyname;
                $this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
            }
            else{
                unset($gallery->cover_image);
            }
            if ($this->Galleries->save($gallery)) {
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
        }
        $this->set(compact('gallery'));
    }

    public function newsEdit($Eid = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $id = $this->EncryptingDecrypting->decryptData($Eid);
        $gallery = $this->Galleries->get($id);
        $Oldgallery = $this->Galleries->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
            $gallery->date_from = date('Y-m-d',strtotime($this->request->getData('date_from')));
            $gallery->date_to = date('Y-m-d',strtotime($this->request->getData('date_from')));
             
            $cover_image = $this->request->getData('cover_image');
            if(!empty($cover_image['tmp_name'])){
                $this->AwsFile->deleteObjectFile($Oldgallery->cover_image);
                $image = $this->request->getData('cover_image');
                $ext=explode('/',$image['type']);
                $file_name='news'.time().rand().'.'.$ext[1];
                $keyname = 'news/'.$id.'/'.$file_name;
                $gallery->cover_image=$keyname;
                $this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
            }
            else{
                unset($gallery->cover_image);
            }             ; 
            $gallery->edited_by=$user_id; 
            if ($this->Galleries->save($gallery)) {
                $this->Flash->success(__('The Event has been saved.'));
                return $this->redirect(['action' => 'newsIndex']);
            }
            $this->Flash->error(__('The Event could not be saved. Please, try again.'));
        }
        $this->set(compact('gallery'));
    }
 
    /**
     * Delete method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $GalleryRows = $this->Galleries->GalleryRows->get($id);
        $this->AwsFile->deleteObjectFile($GalleryRows->file_path);
        if ($this->Galleries->GalleryRows->delete($GalleryRows)) {
            $this->Flash->success(__('The gallery has been deleted.'));
        } else {
            $this->Flash->error(__('The gallery could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'galleryIndex']);
    }
    public function audioDelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $Galleries = $this->Galleries->get($id);
        $this->AwsFile->deleteObjectFile($Galleries->cover_image);
        if ($this->Galleries->delete($Galleries)) {
            $this->Flash->success(__('The audio has been deleted.'));
        } else {
            $this->Flash->error(__('The audio could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'indexAudio']);
    }
}
