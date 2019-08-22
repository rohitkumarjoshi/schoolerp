<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * TimeTables Controller
 *
 * @property \App\Model\Table\TimeTablesTable $TimeTables
 *
 * @method \App\Model\Entity\TimeTable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimeTablesController extends AppController
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
            $timeTable = $this->TimeTables->newEntity();
            $daterange='';
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $timeTable = $this->TimeTables->get($id);
            $valid_date[]=date('d-m-Y',strtotime($notice->valid_from)); 
            $valid_date[]=date('d-m-Y',strtotime($notice->valid_to)); 
            $daterange=implode('/',$valid_date);
   
        }
        if ($this->request->is(['post','put'])) 
            {
                $timeTable = $this->TimeTables->patchEntity($timeTable, $this->request->getData());
                $daterange=explode('/',$this->request->getData('daterange'));
                $timeTable->valid_from=date('Y-m-d',strtotime($daterange[0])); 
                $timeTable->valid_to=date('Y-m-d',strtotime($daterange[1])); 
                if(!$id)
                {
                    $timeTable->created_by =$user_id;
                    $timeTable->session_year_id =$session_year_id;
                }
                else
                {
                    $timeTable->edited_by =$user_id;
                }
              
                $error='';
                try 
                {
                    if ($this->TimeTables->save($timeTable))
                    {
                        $image = $this->request->getData('image_path_data');
                        if(empty($image['error']))
                        {
                            if(!empty($timeTable->doc))
                            {
                                if($this->AwsFile->doesObjectExistFile($timeTable->doc))
                                {
                                    $this->AwsFile->deleteObjectFile($timeTable->doc);
                                }
                            }
                            $ext=explode('/',$image['type']);
                            $file_name='notices'.time().rand().'.'.$ext[1]; 
                            $keyname = 'notices/'.$timeTable->id.'/'.$file_name;
                            $this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
                            $query = $this->TimeTables->query();
                            $query->update()->set(['doc'=>$keyname])->where(['id' => $timeTable->id])->execute();
                        }
                        $this->Flash->success(__('The time table has been saved.'));
                        return $this->redirect(['action' => 'index']);
                        /*$id=$timeTable->id;
                        if(empty($doc_file['error']))
                        {
                            $extt=explode('/',$doc_file['type']);
                            $ext=$extt[1];
                            $setNewFileName = time().rand();
                            $fullpath= WWW_ROOT."img".DS."timetables".DS.$id;
                            $res1 = is_dir($fullpath);
                            if($res1 != 1) {
                                new Folder($fullpath, true, 0777);
                            }
                            move_uploaded_file($doc_file['tmp_name'],$fullpath.DS.$setNewFileName .'.'.$ext);
                            $photo = "img/timetables/".$id.'/'.$setNewFileName .'.'.$ext;
                            $query2 = $this->TimeTables->query();
                                    $query2->update()
                                    ->set(['doc' => $photo])
                                    ->where(['id' => $id])
                                    ->execute();
                             $this->Flash->success(__('The time table has been saved.'));
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
                    $error_data='The time table could not be saved. Please, try again.';
                }
                $this->Flash->error(__($error_data));
                
            }
        $types = array('School'=>'School','Hostel'=>'Hostel');
        $this->paginate = [
            'contain' => []
        ];
        $TimeTables = $this->paginate($this->TimeTables);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('TimeTables','types','timeTable','id','status','daterange'));
    }

    /**
     * View method
     *
     * @param string|null $id Time Table id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timeTable = $this->TimeTables->get($id, [
            'contain' => ['SessionYears']
        ]);

        $this->set('timeTable', $timeTable);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $timeTable = $this->TimeTables->newEntity();
        if ($this->request->is('post')) {
            $timeTable = $this->TimeTables->patchEntity($timeTable, $this->request->getData());
            if ($this->TimeTables->save($timeTable)) {
                $this->Flash->success(__('The time table has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The time table could not be saved. Please, try again.'));
        }
        $sessionYears = $this->TimeTables->SessionYears->find('list', ['limit' => 200]);
        $this->set(compact('timeTable', 'sessionYears'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Time Table id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $timeTable = $this->TimeTables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timeTable = $this->TimeTables->patchEntity($timeTable, $this->request->getData());
            if ($this->TimeTables->save($timeTable)) {
                $this->Flash->success(__('The time table has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The time table could not be saved. Please, try again.'));
        }
        $sessionYears = $this->TimeTables->SessionYears->find('list', ['limit' => 200]);
        $this->set(compact('timeTable', 'sessionYears'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Time Table id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timeTable = $this->TimeTables->get($id);
        if ($this->TimeTables->delete($timeTable)) {
            $this->Flash->success(__('The time table has been deleted.'));
        } else {
            $this->Flash->error(__('The time table could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
