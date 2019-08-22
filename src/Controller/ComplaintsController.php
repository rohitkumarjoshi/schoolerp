<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Complaints Controller
 *
 * @property \App\Model\Table\ComplaintsTable $Complaints
 *
 * @method \App\Model\Entity\Complaint[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComplaintsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        $login_type = $this->Auth->User('login_type');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id){
                $complaint = $this->Complaints->newEntity();
              }
          else
            {
                $id = $this->EncryptingDecrypting->decryptData($id);
                $complaint = $this->Complaints->get($id, [
                    'contain' => []
                ]);
            }
        if ($this->request->is(['patch', 'post', 'put'])) 
        {

            $complaint = $this->Complaints->patchEntity($complaint, $this->request->getData());
             if($login_type=='Employee') {
                 $complaint->employee_id =$user_id;
            }else{
                $complaint->student_id =$user_id;
            }
            if(!$id)
            {
                $complaint->created_by =$user_id;
            }
            else
            {
                $complaint->edited_by =$user_id;
                
            }
            $complaint->status ='Pending';
            $complaint->session_year_id =$session_year_id;
            //pr($complaint);exit;
            $error='';
            try 
            {
                if ($this->Complaints->save($complaint))
                {
                    $this->Flash->success(__('The complaint has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The complaint master could not be saved. Please, try again.';
            }
           // pr($complaint);exit;
            $this->Flash->error(__($error_data));
        }
        $students = $this->Complaints->Students->find('list');
        $employees = $this->Complaints->Employees->find('list');
        
        $this->paginate = [
            'contain' => ['Students', 'Employees']
        ];
        $complaints = $this->paginate($this->Complaints->find()->where(['Complaints.created_by'=>$user_id,'Complaints.is_deleted'=>'N'])->order(['Complaints.id' => 'DESC']));
        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('complaints','complaint', 'students', 'employees','id','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $complaint = $this->Complaints->get($id, [
            'contain' => ['Students', 'Employees']
        ]);

        $this->set('complaint', $complaint);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $complaint = $this->Complaints->newEntity();
        if ($this->request->is('post')) {
            $complaint = $this->Complaints->patchEntity($complaint, $this->request->getData());
            if ($this->Complaints->save($complaint)) {
                $this->Flash->success(__('The complaint has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint could not be saved. Please, try again.'));
        }
        $students = $this->Complaints->Students->find('list', ['limit' => 200]);
        $employees = $this->Complaints->Employees->find('list', ['limit' => 200]);
        $this->set(compact('complaint', 'students', 'employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $complaint = $this->Complaints->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $complaint = $this->Complaints->patchEntity($complaint, $this->request->getData());
            if ($this->Complaints->save($complaint)) {
                $this->Flash->success(__('The complaint has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint could not be saved. Please, try again.'));
        }
        $students = $this->Complaints->Students->find('list', ['limit' => 200]);
        $employees = $this->Complaints->Employees->find('list', ['limit' => 200]);
        $this->set(compact('complaint', 'students', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $complaint = $this->Complaints->get($id);
        if ($this->Complaints->delete($complaint)) {
            $this->Flash->success(__('The complaint has been deleted.'));
        } else {
            $this->Flash->error(__('The complaint could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report()
    {
        $complaint = $this->Complaints->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
        {
            
            foreach ($this->request->getQuery('data') as $key => $v) {
                if(!empty($v))
                {
                    /*if (strpos($key, 'assign_date') !== false)
                        $v = date('Y-m-d',strtotime($v));*/
                    $where ['Complaints.'.$key] = $v;
                }
            }
            $this->set(compact('where'));
            $this->paginate = [
            'contain' => ['Students', 'Employees']
            ];
            //pr($where);
            $complaints = $this->paginate(
                $this->Complaints->find()
                ->where([$where]));
            //pr($vehicleDriverMappings->toArray());exit;
            if(!empty($complaints->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
       // pr($vehicleDriverMappings->toArray());exit;
        $students = $this->Complaints->Students->find('list')->where(['Students.is_deleted'=>'N']);
        $employees = $this->Complaints->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $this->set(compact('complaints','students','data_exist','complaint','employees'));
    }
}
