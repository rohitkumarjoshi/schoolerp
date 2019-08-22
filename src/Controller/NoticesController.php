<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Notices Controller
 *
 * @property \App\Model\Table\NoticesTable $Notices
 *
 * @method \App\Model\Entity\Notice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NoticesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
   public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');

        if(!$id)
        {
            $notice = $this->Notices->newEntity();
            $daterange='';
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $notice = $this->Notices->get($id);
            
            $valid_date[]=date('d-m-Y',strtotime($notice->valid_from)); 
            $valid_date[]=date('d-m-Y',strtotime($notice->valid_to)); 
            $daterange=implode('/',$valid_date);
            //$old_doc=$notice->getOriginal('doc');
        }
        if ($this->request->is(['post','put'])) 
            {
                $notice = $this->Notices->patchEntity($notice, $this->request->getData());

                $daterange=explode('/',$this->request->getData('daterange'));
                $notice->valid_from=date('Y-m-d',strtotime($daterange[0])); 
                $notice->valid_to=date('Y-m-d',strtotime($daterange[1])); 
                if(!$id)
                {
                    $notice->created_by =$user_id;
                    $notice->session_year_id =$session_year_id;
                }
                else
                {
                    $notice->edited_by =$user_id;
                }
              
                $error='';
                try 
                {
                    if ($this->Notices->save($notice))
                    {
                        $image = $this->request->getData('image_path_data');
                        if(empty($image['error']))
                        {
                            if(!empty($notice->doc))
                            {
                                if($this->AwsFile->doesObjectExistFile($notice->doc))
                                {
                                    $this->AwsFile->deleteObjectFile($notice->doc);
                                }
                            }
                            $ext=explode('/',$image['type']);
                            $file_name='notices'.time().rand().'.'.$ext[1]; 
                            $keyname = 'notices/'.$notice->id.'/'.$file_name;
                            $this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
                            $query = $this->Notices->query();
                            $query->update()->set(['doc'=>$keyname])->where(['id' => $notice->id])->execute();
                        }
                        $this->Flash->success(__('The notice has been saved.'));
                        return $this->redirect(['action' => 'index']);
                        /* $id=$notice->id;
                        if(empty($doc_file['error']))
                        {
                            $extt=explode('/',$doc_file['type']);
                            $ext=$extt[1];
                            $setNewFileName = time().rand();
                            $fullpath= WWW_ROOT."img".DS."notices".DS.$id;
                            $res1 = is_dir($fullpath);
                            if($res1 != 1) {
                                new Folder($fullpath, true, 0777);
                            }
                            move_uploaded_file($doc_file['tmp_name'],$fullpath.DS.$setNewFileName .'.'.$ext);
                            $photo = "img/notices/".$id.'/'.$setNewFileName .'.'.$ext;
                            $query2 = $this->Notices->query();
                                    $query2->update()
                                    ->set(['doc' => $photo])
                                    ->where(['id' => $id])
                                    ->execute();
                             $this->Flash->success(__('The notice has been saved.'));
                            return $this->redirect(['action' => 'index']);
                        }*/
                        
                    }
                }catch (\Exception $e) {
                $error = $e->getMessage();
                }
                
                if (strpos($error, '1062') !== false) 
                {
                    $error_data='Duplicate entry. Please, try again.';
                } else
                {
                    $error_data='The notice could not be saved. Please, try again.';
                }
                $this->Flash->error(__($error_data));
            }
        //$types = array('School'=>'School','Hostel'=>'Hostel');
        $this->paginate = [
            'contain' => ['SessionYears', 'NoticeCategories']
        ];
        $notices = $this->paginate($this->Notices);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $noticeCategories = $this->Notices->NoticeCategories->find('list');
        $this->set(compact('notices','noticeCategories','notice','id','status','daterange'));
    }
}
