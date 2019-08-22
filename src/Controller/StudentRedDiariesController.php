<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudentRedDiaries Controller
 *
 * @property \App\Model\Table\StudentRedDiariesTable $StudentRedDiaries
 *
 * @method \App\Model\Entity\StudentRedDiary[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentRedDiariesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id= null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
             $studentRedDiary = $this->StudentRedDiaries->newEntity();
         }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $studentRedDiary = $this->StudentRedDiaries->get($id);
        }
        if ($this->request->is(['post','put']))
         {
            $studentRedDiary = $this->StudentRedDiaries->patchEntity($studentRedDiary, $this->request->getData());
            $form_to_date=$this->request->getData('form_to_date');
            $daterange=explode('/',$form_to_date);
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
           
            $studentRedDiary->punished_from=$date_from;
            $studentRedDiary->punished_to=$date_to;
            if(!$id)
            {
                $studentRedDiary->created_by =$user_id;
                $studentRedDiary->session_year_id =$session_year_id;
            }
            else
            {
                $studentRedDiary->edited_by =$user_id;
            }
           // pr($studentRedDiary);exit;
            $error='';
            try 
            {
                if ($this->StudentRedDiaries->save($studentRedDiary)) 
                {
                    $this->Flash->success(__('The student red diary has been saved.'));
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
                $error_data='The student red diary could not be saved. Please, try again.';
            }
            //pr($studentRedDiary);exit;
            $this->Flash->error(__($error_data));
        }
         $this->paginate = [
            'contain' => ['Students', 'Employees']
        ];
        $studentRedDiaries = $this->paginate($this->StudentRedDiaries);
        $students = $this->StudentRedDiaries->Students->find('list')->innerJoinWith('StudentInfos');
        $punishers = $this->StudentRedDiaries->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $this->set(compact('studentRedDiary', 'students', 'sessionYears','punishers'));
        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('studentRedDiaries','students','punishers','status','id'));
    }

    /**
     * View method
     *
     * @param string|null $id Student Red Diary id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentRedDiary = $this->StudentRedDiaries->get($id, [
            'contain' => ['Students', 'SessionYears']
        ]);

        $this->set('studentRedDiary', $studentRedDiary);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentRedDiary = $this->StudentRedDiaries->newEntity();
        if ($this->request->is('post')) {
            $studentRedDiary = $this->StudentRedDiaries->patchEntity($studentRedDiary, $this->request->getData());
            if ($this->StudentRedDiaries->save($studentRedDiary)) {
                $this->Flash->success(__('The student red diary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student red diary could not be saved. Please, try again.'));
        }
        $students = $this->StudentRedDiaries->Students->find('list');
        $punishers = $this->StudentRedDiaries->Employees->find('list');
        $this->set(compact('studentRedDiary', 'students', 'sessionYears','punishers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Red Diary id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentRedDiary = $this->StudentRedDiaries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentRedDiary = $this->StudentRedDiaries->patchEntity($studentRedDiary, $this->request->getData());
            if ($this->StudentRedDiaries->save($studentRedDiary)) {
                $this->Flash->success(__('The student red diary has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student red diary could not be saved. Please, try again.'));
        }
        $students = $this->StudentRedDiaries->Students->find('list', ['limit' => 200]);
        $sessionYears = $this->StudentRedDiaries->SessionYears->find('list', ['limit' => 200]);
        $this->set(compact('studentRedDiary', 'students', 'sessionYears'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Red Diary id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentRedDiary = $this->StudentRedDiaries->get($id);
        if ($this->StudentRedDiaries->delete($studentRedDiary)) {
            $this->Flash->success(__('The student red diary has been deleted.'));
        } else {
            $this->Flash->error(__('The student red diary could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
