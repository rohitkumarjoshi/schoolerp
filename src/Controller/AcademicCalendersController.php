<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AcademicCalenders Controller
 *
 * @property \App\Model\Table\AcademicCalendersTable $AcademicCalenders
 *
 * @method \App\Model\Entity\AcademicCalender[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AcademicCalendersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $Cid=$this->request->getQuery('CID');
        $this->paginate = [
            'contain' => ['AcademicCategories']
        ];
        $academicCalenders = $this->AcademicCalenders->find();
        //$academicCalenders->where(['AcademicCalenders.is_deleted'=>'N']);
        if(!empty($Cid)){
             $academicCalenders->where(['AcademicCalenders.academic_category_id'=>$Cid]);
        }
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0])); 
            $date_to=date('Y-m-d',strtotime($daterange[1])); 
            $academicCalenders->where(['AcademicCalenders.date >=' =>$date_from,'AcademicCalenders.date <=' =>$date_to]);
        }
        $academicCalenders->order(['AcademicCalenders.id'=>'DESC']);
        $academicCalenders = $this->paginate($academicCalenders);

        $academicCategories = $this->AcademicCalenders->AcademicCategories
            ->find('list', ['limit' => 200])
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCalenders','academicCategories'));
    }

    public function studentView()
    {
        $Cid=$this->request->getQuery('CID');
        $this->paginate = [
            'contain' => ['AcademicCategories']
        ];
        $academicCalenders = $this->AcademicCalenders->find();
        $academicCalenders->where(['AcademicCalenders.is_deleted'=>'N']);
        if(!empty($Cid)){
             $academicCalenders->where(['AcademicCalenders.academic_category_id'=>$Cid]);
        }
        $academicCalenders->order(['AcademicCalenders.id'=>'DESC']);
        $academicCalenders = $this->paginate($academicCalenders);

        $academicCategories = $this->AcademicCalenders->AcademicCategories
            ->find('list', ['limit' => 200])
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCalenders','academicCategories'));
    }
 
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $academicCalender = $this->AcademicCalenders->newEntity();
        if ($this->request->is('post')) {
            $academic_category_id = $this->request->getData('academic_category_id');
            $date = array_filter($this->request->getData('date'));
            $description = array_filter($this->request->getData('description'));
            $c=0;
            $result=0;
            foreach ($date as $newdate) {
                $academicCalender = $this->AcademicCalenders->newEntity();
                $academicCalender->date=date('Y-m-d',strtotime($newdate));
                $academicCalender->created_by=$user_id;
                $academicCalender->description=$description[$c];
                $academicCalender->session_year_id=$session_year_id;
                $academicCalender->academic_category_id=$academic_category_id;
                if ($this->AcademicCalenders->save($academicCalender)) {
                    $result=1;
                }
                $c++;
            }
            if($result==1){
                $this->Flash->success(__('The academic calender has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The academic calender could not be saved. Please, try again.'));
        }
        $academicCategories = $this->AcademicCalenders->AcademicCategories
            ->find('list', ['limit' => 200])
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCalender', 'academicCategories'));
    }
 
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $academicCalender = $this->AcademicCalenders->get($id, [
            'contain' => ['AcademicCategories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $academicCalender = $this->AcademicCalenders->patchEntity($academicCalender, $this->request->getData());
            $academicCalender->date=date('Y-m-d',strtotime($this->request->getData('date')));
            $academicCalender->edited_by=$user_id;
            $academicCalender->edited_on=date('Y-m-d h:i:s');
            if ($this->AcademicCalenders->save($academicCalender)) {
                $this->Flash->success(__('The academic calender has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The academic calender could not be saved. Please, try again.'));
        }
        $academicCategories = $this->AcademicCalenders->AcademicCategories
            ->find('list', ['limit' => 200])
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCalender','academicCategories'));
    }

    //---- Categories

    public function categoryAdd($id=null){
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if($id){
            $id = $this->EncryptingDecrypting->decryptData($id);
            $academicCategories = $this->AcademicCalenders->AcademicCategories->get($id);
        }
        else{
            $academicCategories = $this->AcademicCalenders->AcademicCategories->newEntity();  
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $academicCategories = $this->AcademicCalenders->AcademicCategories->patchEntity($academicCategories, $this->request->getData());
            if ($this->AcademicCalenders->AcademicCategories->save($academicCategories)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'categoryAdd']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $CategoriesList = $this->AcademicCalenders->AcademicCategories->find()
            ->where(['AcademicCategories.is_deleted'=>'N']);
        $this->set(compact('academicCategories','CategoriesList','id'));
    }

     
}
