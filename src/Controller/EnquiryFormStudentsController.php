<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use Cake\View\View;
use Cake\View\Helper\HtmlHelper;
use Cake\Event\Event;
/**
 * EnquiryFormStudents Controller
 *
 * @property \App\Model\Table\EnquiryFormStudentsTable $EnquiryFormStudents
 *
 * @method \App\Model\Entity\EnquiryFormStudent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnquiryFormStudentsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $enquiryFormStudents = $this->EnquiryFormStudents->find()->where(['EnquiryFormStudents.session_year_id'=>$session_year_id,'enquiry_no >'=>0])->contain(['Genders','Mediums','StudentClasses','Streams']);
        $studentClasses  = $this->EnquiryFormStudents->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        //$enquiryStatuses = array('Pending'=>'Pending','Approved'=>'Approved','Reject'=>'Reject','Hold'=>'Hold');
        $this->set(compact('enquiryFormStudents','studentClasses','enquiryStatuses'));
    }
    public function enquiryReport()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $enquiryFormStudents = $this->EnquiryFormStudents->find();
        if ($this->request->is(['post'])) {
            $student_class_id=$this->request->getData('student_class_id');
            if(!empty($student_class_id))
            {
                $enquiryFormStudents->where(['student_class_id' => $student_class_id]);
            }
            $enquiry_status=$this->request->getData('enquiry_status');
            if(!empty($enquiry_status))
            {
                $enquiryFormStudents->where(['enquiry_status' => $enquiry_status]);
            }
        }
        $enquiryFormStudents->where(['EnquiryFormStudents.session_year_id'=>$session_year_id,'enquiry_no >'=>0])->contain(['Genders','Mediums','StudentClasses']);
        $studentClasses  = $this->EnquiryFormStudents->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        /*$enquiryStatuses = array('Pending'=>'Pending','Approved'=>'Approved','Reject'=>'Reject','Hold'=>'Hold');*/
        $this->set(compact('enquiryFormStudents','studentClasses','enquiryStatuses'));
    }
    public function getEnquiryData()
    {
        $success = 0;
        $session_year_id=$this->Auth->User('session_year_id');
        $enquiryForms=$this->EnquiryFormStudents->find()->contain(['StudentClasses','Genders','Mediums','Streams']);
        $enquiryForms->where(['EnquiryFormStudents.session_year_id'=>$session_year_id]);

        $class_id=$this->request->getData('class_id');
        $enquiry_no=$this->request->getData('enquiry_no');
        $admission_form_no=$this->request->getData('admission_form_no');
        $name=$this->request->getData('name');
        $father_name=$this->request->getData('father_name');
        /*$enquiry_status=$this->request->getData('enquiry_status');*/
        $enquiryForms->where(['enquiry_mode !='=>'Form']);
        if(!empty($class_id))
        {
            $enquiryForms->where(['student_class_id'=>$class_id]);
        }
        /*if(!empty($enquiry_status))
        {
            $enquiryForms->where(['enquiry_status'=>$enquiry_status]);
        }*/
        if(!empty($enquiry_no))
        {
            $enquiryForms->where(['enquiry_no'=>$enquiry_no]);
        }
        if(!empty($admission_form_no))
        {
            $enquiryForms->where(['admission_form_no'=>$admission_form_no]);
        }
        if(!empty($name))
        {
            $enquiryForms->where(function (QueryExpression $exp, Query $q) use($name) {
                return $exp->like('EnquiryFormStudents.name', '%'.$name.'%');
            });
        }
        if(!empty($father_name))
        {
            $enquiryForms->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('father_name', '%'.$father_name.'%');
            });
        }
        $response=[];
        $sr_no=1;
        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($enquiryForms as $enquiryForm) {
            $success = 1;
            $enrance_exam = '';
            $id = $this->EncryptingDecrypting->encryptData($enquiryForm->id);
            

            $response[]='<tr>
                    <td style="text-align:center;">'.$sr_no++.'</td>
                    <td style="text-align:center;">'.$enquiryForm->enquiry_no.'</td>
                    <td style="text-align:center;">'.$enquiryForm->admission_form_no.'</td>
                    
                    <td>'.$enquiryForm->name.'</td>
                    <td style="text-align:center;">'.$enquiryForm->gender->name.'</td>
                    <td>'.$enquiryForm->father_name.'</td>
                    <td style="text-align:center;">'.$enquiryForm->medium->name.'</td>
                    <td style="text-align:center;">'.$enquiryForm->student_class->name.'</td>
                    <td style="text-align:center;">'.@$enquiryForm->stream->name.'</td>
                    <td class="actions">
                                '.$html->link(__('<i class="fa fa-eye"></i> '), ['controller'=>'EnquiryFormStudents','action'=>'view', $id],['class'=>'btn btn-info btn-xs viewbtn','escape'=>false, 'data-widget'=>'View Enquiry', 'data-toggle'=>'tooltip', 'data-original-title'=>'View Enquiry']).'</td>
                    </tr>';
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="11"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    /**
     * View method
     *
     * @param string|null $id Enquiry Form Student id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function view($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $enquiryFormStudent = $this->EnquiryFormStudents->get($id, [
            'contain' => ['Genders','Mediums','StudentClasses','Streams','LastMediums','LastClasses','LastStreams']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiryFormStudent = $this->EnquiryFormStudents->patchEntity($enquiryFormStudent, $this->request->getData());
            if ($this->EnquiryFormStudents->save($enquiryFormStudent)) {
                $this->Flash->success(__('The enquiry form student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enquiry form student could not be saved. Please, try again.'));
        }
        $enquiryStatuses = array('Pending'=>'Pending','Approved'=>'Approved','Reject'=>'Reject','Hold'=>'Hold');

        $this->set(compact('enquiryFormStudent','enquiryStatuses'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enquiry = $this->EnquiryFormStudents->get($id);
            $enquiry->is_deleted=1;
        if ($this->EnquiryFormStudents->save($enquiry)) {
            $this->Flash->success(__('The Enquiry is deleted.'));
        } else {
            $this->Flash->error(__('The Enquiry is not deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function add()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $enquiryFormStudent = $this->EnquiryFormStudents->newEntity();
        if ($this->request->is('post')) {
            $enquiryFormStudent = $this->EnquiryFormStudents->patchEntity($enquiryFormStudent, $this->request->getData());
            $first_name=$this->request->getData('first_name');
            $middle_name=$this->request->getData('middle_name');
            $last_name=$this->request->getData('last_name');
            $name='';
            if(!empty($first_name))
            {
                $name.=$first_name;
            }
            if(!empty($middle_name))
            {
                $name.=' '.$middle_name;
            }
            if(!empty($last_name))
            {
                $name.=' '.$last_name;
            }
            $name_separated[]=$first_name;
            $name_separated[]=$middle_name;
            $name_separated[]=$last_name;
            $name_separate=implode(',', $name_separated);
            $enquiryFormStudent->name =$name;
            $enquiryFormStudent->name_separate =$name_separate;
            $enquiryFormStudent->enquiry_mode="Offline";
            $enquiryFormStudent->created_by =$user_id;
            $enquiryFormStudent->session_year_id =$session_year_id;
            $enquiryFormStudent->enquiry_date =date('Y-m-d');
            $enquiryFormStudent->enquiry_status ='Pending';
            $enquiryFormStudent->entrance_exam_resulte ='';
           
            if ($this->EnquiryFormStudents->save($enquiryFormStudent)) {
                $enquiryFormStudents = $this->EnquiryFormStudents->find();
                $enquiryFormStudents->where(['session_year_id'=>$session_year_id])
                    ->select(['enquiry_no'=>$enquiryFormStudents->func()->max('enquiry_no')]);
                $enquiryFormStudents = $enquiryFormStudents->first();
                $enquiry_no=$enquiryFormStudents->enquiry_no+1;  
                
                $query = $this->EnquiryFormStudents->query();
                    $query->update()
                    ->set([
                        'enquiry_no' => $enquiry_no        
                    ])
                    ->where(['id' => $enquiryFormStudent->id])
                    ->execute();
                $this->Flash->success(__('The enquiry form student has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The enquiry form student could not be saved. Please, try again.'));
        }
        $genders = $this->EnquiryFormStudents->Genders->find('list')->where(['is_deleted'=>'N']);
        $studentClass = $this->EnquiryFormStudents->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $mediums = $this->EnquiryFormStudents->Mediums->find('list')->where(['is_deleted'=>'N']);
        $stream = $this->EnquiryFormStudents->Streams->find('list')->where(['is_deleted'=>'N']);

        $this->set(compact('enquiryFormStudent', 'genders', 'mediums', 'studentClass', 'stream'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Enquiry Form Student id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*public function edit($id = null)
    {
        $enquiryFormStudent = $this->EnquiryFormStudents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiryFormStudent = $this->EnquiryFormStudents->patchEntity($enquiryFormStudent, $this->request->getData());
            if ($this->EnquiryFormStudents->save($enquiryFormStudent)) {
                $this->Flash->success(__('The enquiry form student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enquiry form student could not be saved. Please, try again.'));
        }
        $genders = $this->EnquiryFormStudents->Genders->find('list');
        $lastClasses = $this->EnquiryFormStudents->LastClasses->find('list');
        $sessionYears = $this->EnquiryFormStudents->SessionYears->find('list');
        $enquiryStatuses = $this->EnquiryFormStudents->EnquiryStatuses->find('list');
        $this->set(compact('enquiryFormStudent', 'genders',  'sessionYears', 'enquiryStatuses'));
    }*/
}
