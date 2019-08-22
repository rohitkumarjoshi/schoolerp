<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Sports Controller
 *
 * @property \App\Model\Table\SportsTable $Sports
 *
 * @method \App\Model\Entity\Sport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SportsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','addImages']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $searchData=[];
        if ($this->request->is('post')) {

            $searchData=$this->Sports->SportRows->find()->contain(['Sports']); 
            $sport_id=$this->request->getData('sport_id');
            //echo $sport_id; exit;
            if(!empty($sport_id))
            {       

                $searchData->where(['SportRows.sport_id'=>$sport_id]);
            }
            
            $searchData->where(['SportRows.is_deleted'=>'N']);
            $searchData->order(['SportRows.id'=>'DESC']);
        }

        $CategoriesList = $this->Sports->find('list')
            ->where(['Sports.is_deleted'=>'N']);
        $this->set(compact('sports','CategoriesList','searchData'));
    }
    
    public function studentView()
    {
        $searchData=[];
        if ($this->request->is('post')) {
            $searchData=$this->Sports->SportRows->find(); 
            $sport_id=$this->request->getData('sport_id');
            if(!empty($gallery_id))
            {
                $searchData->where(['SportRows.sport_id'=>$sport_id]);
            }
            $searchData->where(['SportRows.is_deleted'=>'N']);
            $searchData->order(['id'=>'DESC']);
        }

        $CategoriesList = $this->Sports->find('list')
            ->where(['Sports.is_deleted'=>'N']);
        $this->set(compact('sports','CategoriesList','searchData'));
    }
    

    /**
     * View method
     *
     * @param string|null $id Sport id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sport = $this->Sports->get($id, [
            'contain' => ['SportRows']
        ]);

        $this->set('sport', $sport);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if($id){
            $id = $this->EncryptingDecrypting->decryptData($id);
            $sports = $this->Sports->get($id);
        }
        else{
            $sports = $this->Sports->newEntity();  
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sports = $this->Sports->patchEntity($sports, $this->request->getData());
            $ImagesofEvent = $this->request->getData('sport_image');
            if(!empty($ImagesofEvent)){unset($sports->sport_image);}
            if (!empty($ImagesofEvent['tmp_name'])) {
                $ext=explode('/',$ImagesofEvent['type']);
                $file_name='icon'.time().rand().'.'.$ext[1];
                $keynames = 'sports/sports_icon/'.$file_name;
                $sports->sport_image = $keynames;

            }
            
            if ($this->Sports->save($sports)) {

                if (!empty($ImagesofEvent['tmp_name'])) {

                    $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);

                }
                
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $CategoriesList = $this->Sports->find();
        $this->set(compact('sports','CategoriesList','id'));
    }

    public function addImages()
    {
        $sportRows = $this->Sports->SportRows->newEntity();
        if ($this->request->is('post')) {
           
            $eventImage = $this->request->getData('eventImage');
            $sport_id = $this->request->getData('sport_id');
            foreach ($eventImage as $ImagesofEvent) {
                if(!empty($ImagesofEvent['tmp_name'])){
                    $ext=explode('/',$ImagesofEvent['type']);
                    $file_name='sport'.time().rand().'.'.$ext[1];
                    $keynames = 'sports/sport_image/'.$sport_id.'/'.$file_name;
                    $this->AwsFile->putObjectFile($keynames,$ImagesofEvent['tmp_name'],$ImagesofEvent['type']);

                    $sportRows = $this->Sports->SportRows->newEntity();
                    $sportRows->file_path=$keynames; 
                    $sportRows->sport_id=$sport_id;
                    $sportRows->is_deleted='N';
                    $this->Sports->SportRows->save($sportRows);
                } 
            }   
            return $this->redirect(['action' => 'index']);
        }
        $CategoriesList = $this->Sports->find('list')
            ->where(['Sports.is_deleted'=>'N']);
        $this->set(compact('sportRows','CategoriesList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sport id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sport = $this->Sports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sport = $this->Sports->patchEntity($sport, $this->request->getData());
            if ($this->Sports->save($sport)) {
                $this->Flash->success(__('The sport has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sport could not be saved. Please, try again.'));
        }
        $this->set(compact('sport'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sport id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $SportRows = $this->Sports->SportRows->get($id);
        $this->AwsFile->deleteObjectFile($SportRows->file_path);
        if ($this->Sports->SportRows->delete($SportRows)) {
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
