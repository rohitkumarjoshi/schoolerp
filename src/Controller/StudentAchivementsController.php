<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudentAchivements Controller
 *
 * @property \App\Model\Table\StudentAchivementsTable $StudentAchivements
 *
 * @method \App\Model\Entity\StudentAchivement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentAchivementsController extends AppController
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

        $this->paginate = [
            'contain' => ['SessionYears', 'AchivementCategories', 'Students']
        ];
        if(!$id)
        {
            $studentAchivement = $this->StudentAchivements->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $studentAchivement = $this->StudentAchivements->get($id, [
            'contain' => []
        ]);
        }
        if ($this->request->is(['post','put'])) 
        {   

            $studentAchivement = $this->StudentAchivements->patchEntity($studentAchivement, $this->request->getData());
            $studentAchivement->achivement_date=date('Y-m-d',strtotime($this->request->getData('achivement_date')));
            if(!$id)
            {
                $studentAchivement->created_by =$user_id;
                $studentAchivement->session_year_id =$session_year_id;
            }
            else
            {
                $studentAchivement->edited_by =$user_id;
            }
            //pr($studentAchivement);exit;
            $error='';
            try 
            {
                if ($this->StudentAchivements->save($studentAchivement))
                     {
                    $this->Flash->success(__('The student achivement has been saved.'));
                    return $this->redirect(['action' => 'index']);
                    }
            }catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The student achivement could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $achivementCategories = $this->StudentAchivements->AchivementCategories->find('list');
        $students = $this->StudentAchivements->Students->find('list')->innerJoinWith('StudentInfos');
        $types = array('School'=>'School','Hostel'=>'Hostel');
        $studentAchivements = $this->paginate($this->StudentAchivements->find()->order(['StudentAchivements.id'=>'DESC']));
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('studentAchivements','studentAchivement', 'id', 'achivementCategories', 'students','types','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Student Achivement id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentAchivement = $this->StudentAchivements->get($id, [
            'contain' => ['SessionYears', 'AchivementCategories', 'Students']
        ]);

        $this->set('studentAchivement', $studentAchivement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentAchivement = $this->StudentAchivements->newEntity();
        if ($this->request->is('post')) {
            $studentAchivement = $this->StudentAchivements->patchEntity($studentAchivement, $this->request->getData());
            if ($this->StudentAchivements->save($studentAchivement)) {
                $this->Flash->success(__('The student achivement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student achivement could not be saved. Please, try again.'));
        }
        $sessionYears = $this->StudentAchivements->SessionYears->find('list', ['limit' => 200]);
        $achivementCategories = $this->StudentAchivements->AchivementCategories->find('list', ['limit' => 200]);
        $students = $this->StudentAchivements->Students->find('list', ['limit' => 200]);
        $this->set(compact('studentAchivement', 'sessionYears', 'achivementCategories', 'students'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Achivement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentAchivement = $this->StudentAchivements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentAchivement = $this->StudentAchivements->patchEntity($studentAchivement, $this->request->getData());
            if ($this->StudentAchivements->save($studentAchivement)) {
                $this->Flash->success(__('The student achivement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student achivement could not be saved. Please, try again.'));
        }
        $sessionYears = $this->StudentAchivements->SessionYears->find('list', ['limit' => 200]);
        $achivementCategories = $this->StudentAchivements->AchivementCategories->find('list', ['limit' => 200]);
        $students = $this->StudentAchivements->Students->find('list', ['limit' => 200]);
        $this->set(compact('studentAchivement', 'sessionYears', 'achivementCategories', 'students'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Achivement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentAchivement = $this->StudentAchivements->get($id);
        if ($this->StudentAchivements->delete($studentAchivement)) {
            $this->Flash->success(__('The student achivement has been deleted.'));
        } else {
            $this->Flash->error(__('The student achivement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
