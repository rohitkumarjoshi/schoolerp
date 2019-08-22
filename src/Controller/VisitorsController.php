<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Visitors Controller
 *
 * @property \App\Model\Table\VisitorsTable $Visitors
 *
 * @method \App\Model\Entity\Visitor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisitorsController extends AppController
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
    public function checkout($id=null)
    {   
        $id = $this->EncryptingDecrypting->decryptData($id);
        //pr($id);exit;
         $out_date=date('Y-m-d');
         $out_time=date('H:i:s');
         if ($this->request->is(['post']))
         {
            if(!empty($id))
                 {
                    $query = $this->Visitors->query();
                    $result = $query->update()
                    ->set(['out_date' => $out_date,'out_time'=>$out_time])
                    ->where(['id' =>$id ])
                    ->execute();
                    $this->Flash->success(__('The visitor has been checked out successfully.'));
                     return $this->redirect(['action' => 'index']);
                 }

        }
    }
    public function index()
    {
            $this->paginate = [
                'contain' => ['Cities','Employees','Students']
            ];
            //$visitorss = $this->paginate($this->Visitors);
            //pr($visitorss);exit;
            $data_exist='';
            if ($this->request->is(['post','put'])) {
            $form_to_date=$this->request->getData('form_to_date');
            if(!empty($form_to_date)){
                $daterange=explode('/',$form_to_date);
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
                $conditions['Visitors.in_date >=']=$date_from;
                $conditions['Visitors.in_date <=']=$date_to;
            }
           
             $visitor_name=$this->request->getData('visitor_name');
            if(!empty($visitor_name)){
                $conditions['Visitors.name =']=$visitor_name;
            } 
            $conditions['Visitors.is_deleted <=']='N';
            $visitors = $this->paginate($this->Visitors->find()->where($conditions));
            if(!empty($visitors->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }  
        }
       
        $visitor_names= $this->Visitors->find('list',[
        'keyField' => 'name',
        'valueField' => 'name'
        ]);
        //pr($visitor_names->toArray());exit;
        $this->set(compact('visitors','visitor_names','data_exist'));
    }

    /**
     * View method
     *
     * @param string|null $id Visitor id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //$id = $this->EncryptingDecrypting->decryptData($id);
        $visitor = $this->Visitors->get($id, [
            'contain' => ['Cities']
        ]);

        $this->set('visitor', $visitor);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $visitor = $this->Visitors->newEntity();
        if ($this->request->is('post')) {
            $visitor = $this->Visitors->patchEntity($visitor, $this->request->getData());
            $visitor->in_date=date('Y-m-d');
            $visitor->in_time=date('H:i:s');
            $visitor->created_by = $user_id;
            $photo=$this->request->getData('photo');
           // pr($photo);exit;
           
            if ($this->Visitors->save($visitor)) {
            if(!empty($photo))
                {
                    $image_parts = explode(";base64,", $photo);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $file_name = 'photo.'.$image_type;
                    $keyname = 'visitor/'.$visitor->id.'/'.$file_name;
                    $this->AwsFile->putObjectBase64($keyname,$image_base64,$image_type);
                    $query = $this->Visitors->query();
                    $query->update()->set(['photo' => $keyname])
                          ->where(['id' => $visitor->id])->execute();
                    
                }
                $this->Flash->success(__('The visitor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visitor could not be saved. Please, try again.'));
        }
        $cities = $this->Visitors->Cities->find('list');
        $students = $this->Visitors->Students->find('list');
        $employees = $this->Visitors->Employees->find('list');
        //$departments = $this->Visitors->Departments->find('list');
        $visitor_types=['All'=>'All','Hostel'=>'Hostel','School'=>'School'];
        $this->set(compact('visitor', 'cities','visitor_types','students','employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Visitor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $visitor = $this->Visitors->get($id, [
            'contain' => []
        ]);
        $visitor_id=$visitor->id;
        $visitorDocumentPhotos = $this->Visitors->find()->select('photo')->where(['id'=>$visitor_id])->first();
        //pr($visitorDocumentPhotos);exit;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $visitor = $this->Visitors->patchEntity($visitor, $this->request->getData());
            if(!empty($in_date))
            {
                $visitor->in_date=date('Y-m-d');
            }
              if(!empty($in_time))
            {
                $visitor->in_time=date('H:i:s');
            }
            $photo=$this->request->getData('photos');
            if ($this->Visitors->save($visitor)) {
                if(!empty($photo))
                {
                    $image_parts = explode(";base64,", $photo);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $file_name = 'photo.'.$image_type;
               
                    $keyname = 'visitor/'.$visitor->id.'/'.$file_name;
                    $this->AwsFile->putObjectBase64($keyname,$image_base64,$image_type);
                    $query = $this->Visitors->query();
                    $query->update()->set(['photo' => $keyname])
                          ->where(['id' => $visitor->id])->execute();
                    
                }

                $this->Flash->success(__('The visitor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visitor could not be saved. Please, try again.'));
        }
        $cities = $this->Visitors->Cities->find('list');
        $students = $this->Visitors->Students->find('list');
        $employees = $this->Visitors->Employees->find('list');
        //$departments = $this->Visitors->Departments->find('list');
        $visitor_types=['All'=>'All','Hostel'=>'Hostel','School'=>'School'];
        $this->set(compact('visitor', 'cities','visitor_types','students','employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Visitor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visitor = $this->Visitors->get($id);
        if ($this->Visitors->delete($visitor)) {
            $this->Flash->success(__('The visitor has been deleted.'));
        } else {
            $this->Flash->error(__('The visitor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function report($value='')
    {
        $active_li='Visitors';
        $active_sub_li='report';

        $visitor = $this->Visitors->newEntity();
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
                        $where['Visitors.in_date >=']=$date_from;
                        $where['Visitors.in_date <=']=$date_to;

                    }
                    else
                    {
                        $where ['Visitors.'.$key] = $v;
                    }
                    
                }
            }
            $this->set(compact('where'));
            $this->paginate = [
                'contain' => ['Cities','Employees']
            ];
            $visitors = $this->paginate($this->Visitors->find()->where([$where,'Visitors.is_deleted'=>'N'])->contain(['Cities','Students','Employees']));
            if(!empty($visitors->toArray()))
              {
                $data_exist='data_exist';
              }
              else{
                $data_exist='No Record Found';
              }
            //pr($where);exit;
        }
       
       //pr($visitors->toarray());exit;
        $this->set(compact('active_li','active_sub_li','visitor','visitors','data_exist'));

    } 
   
   public function visitorExport()
    {
        $this->viewBuilder()->setLayout('pdf');
       //pr($this->request->getData('Visitors'));exit;
        foreach ($this->request->getData('Visitors') as $key => $v) {
                if(!empty($v))
                {
                    if ($key=='form_to_date' && !empty($v))
                    {
                        $daterange=explode('/',$v);
                        $date_from=date('Y-m-d',strtotime($daterange[0]));
                        $date_to=date('Y-m-d',strtotime($daterange[1]));
                        $where['Visitors.in_date >=']=$date_from;
                        $where['Visitors.in_date <=']=$date_to;

                    }
                    else
                    {
                        $where ['Visitors.'.$key] = $v;
                    }
                }
            }
        $this->set(compact('where'));
        $visitors = $this->paginate($this->Visitors->find()->where([$where,'Visitors.is_deleted '=>'N'])->contain(['Cities','Students','Employees']));

        $this->set(compact('visitors'));
    }


    
}
