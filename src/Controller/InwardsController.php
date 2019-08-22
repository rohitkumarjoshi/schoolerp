<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Inwards Controller
 *
 * @property \App\Model\Table\InwardsTable $Inwards
 *
 * @method \App\Model\Entity\Inward[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InwardsController extends AppController
{
  public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit','index','report']);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $title='Inwards Details';
        $this->paginate = [
                'contain' => ['Departments']
            ];
        $data_exist='';
         if ($this->request->is(['post','put'])) {
            $department_id=$this->request->getData('department_id');
             $form_to_date=$this->request->getData('form_to_date');
            if(!empty($form_to_date)){
                $daterange=explode('/',$form_to_date);
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $conditions['Inwards.in_date >=']=$date_from;
                $conditions['Inwards.in_date <=']=$date_to;
            }
            
            $departments_id=$this->request->getData('departments_id');
            if(!empty($department_id)){
                $conditions['Inwards.department_id =']=$department_id;
            } 
            
            $conditions['Inwards.is_deleted <=']='N';
            $inwards = $this->paginate($this->Inwards->find()->where($conditions));
            if(!empty($inwards->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
        $departments = $this->Inwards->Departments->find('list');
        $this->set(compact('inwards','departments','title','data_exist'));
    }

    /**
     * View method
     *
     * @param string|null $id Inward id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inward = $this->Inwards->get($id, [
            'contain' => ['InwardDetails']
        ]);

        $this->set('inward', $inward);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $inward = $this->Inwards->newEntity();
        if ($this->request->is('post')) 
        {
            $inward = $this->Inwards->patchEntity($inward, $this->request->getData());
            $inward->in_date = date('Y-m-d');
            $inward->in_time = date('H:i:s');
            $inward->created_by =$user_id;
            //pr($inward);exit;
             $error='';
             try{
                    if ($this->Inwards->save($inward)) 
                    {
                        $this->Flash->success(__('The inward has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    } 

                }   catch (\Exception $e) 
                    {
                        $error = $e->getMessage();
                    }
                    if (strpos($error, '1062') !== false) 
                    {
                        $error_data='Duplicate entry. Please, try again.';
                    }
                    else
                    {
                        $error_data='The inward could not be saved. Please, try again.';
                    }
                    //pr($inward);exit;   
                 $this->Flash->error(__($error_data));

        }
        $departments = $this->Inwards->Departments->find('list');
        $status = array('Y'=>'Deactive','N'=>'Active');
        $this->set(compact('inward','departments','status'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inward id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user_id = $this->Auth->User('id');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $inward = $this->Inwards->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inward = $this->Inwards->patchEntity($inward, $this->request->getData());
            /*$inward->date = date('Y-m-d');
            $inward->in_time = date('H:i:s');*/
            $inward->edited_by =$user_id;
            $error='';
             try{
                    if ($this->Inwards->save($inward)) 
                    {
                        $this->Flash->success(__('The inward has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    } 

                }   catch (\Exception $e) 
                    {
                        $error = $e->getMessage();
                    }
                    if (strpos($error, '1062') !== false) 
                    {
                        $error_data='Duplicate entry. Please, try again.';
                    }
                    else
                    {
                        $error_data='The inward could not be saved. Please, try again.';
                    }
                 $this->Flash->error(__($error_data));
        }
        $departments = $this->Inwards->Departments->find('list');
        $status = array('Y'=>'Deactive','N'=>'Active');
        $this->set(compact('inward','departments','status','id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inward id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inward = $this->Inwards->get($id);
        if ($this->Inwards->delete($inward)) {
            $this->Flash->success(__('The inward has been deleted.'));
        } else {
            $this->Flash->error(__('The inward could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report($value='')
    {
        $active_li='Inwards';
        $active_sub_li='report';

        $inward = $this->Inwards->newEntity();
        $where = [];
        $data_exist='';
        if($this->request->is(['post']))
        {
            //pr($this->request->getData('data'));exit;
            foreach ($this->request->getData('data') as $key => $v) {
                if(!empty($v))
                {
                    if ($key=='form_to_date' && !empty($v))
                    {
                        $daterange=explode('/',$v);
                        $date_from=date('Y-m-d',strtotime($daterange[0]));
                        $date_to=date('Y-m-d',strtotime($daterange[1]));
                        $where['Inwards.in_date >=']=$date_from;
                        $where['Inwards.in_date <=']=$date_to;
                    }
                    else
                    {
                        $where ['Inwards.'.$key] = $v;
                    }
                }
            }
            $this->set(compact('where'));
            //pr($where);exit;
        }
        $inwards = $this->paginate($this->Inwards->find()->where([$where,'Inwards.is_deleted'=>'N'])->contain(['Departments']));
        if(!empty($inwards->toArray()))
            {
              $data_exist='data_exist';
            }
            else{
              $data_exist='No Record Found';
            } 
       //pr($inwards->toarray());exit;
        $this->set(compact('active_li','active_sub_li','inward','inwards','data_exist'));

    } 
   
   public function inwardExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        if(!empty($this->request->getData('Inwards'))) 
        {
           foreach ($this->request->getData('Inwards') as $key => $v) 
          {
                if(!empty($v))
                {
                    if ($key=='form_to_date' && !empty($v))
                    {
                        $daterange=explode('/',$v);
                        $date_from=date('Y-m-d',strtotime($daterange[0]));
                        $date_to=date('Y-m-d',strtotime($daterange[1]));
                        $where['Inwards.in_date >=']=$date_from;
                        $where['Inwards.in_date <=']=$date_to;
                    }
                    else
                    {
                        $where ['Inwards.'.$key] = $v;
                    }
              }
                  
          }

        }
        else{
          $where[]='';
        }
       
        $this->set(compact('where'));
        $inwards = $this->paginate($this->Inwards->find()->where([$where,'Inwards.is_deleted '=>'N'])->contain(['Departments']));

        $this->set(compact('inwards'));
    }
}
