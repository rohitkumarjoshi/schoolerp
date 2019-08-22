<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * EntranceExamResults Controller
 *
 * @property \App\Model\Table\EntranceExamResultsTable $EntranceExamResults
 *
 * @method \App\Model\Entity\EntranceExamResult[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EntranceExamResultsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
         
        $this->Security->setConfig('unlockedActions', ['index']);
    }
    
    public function index($enquiry_form_student_id=null)
    {
        $user_id = $this->Auth->User('id');
         $enquiry_form_student_id = $this->EncryptingDecrypting->decryptData($enquiry_form_student_id);
         $entranceExamResults = $this->EntranceExamResults->newEntity();
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $entrance_exam_resulte=$this->request->getData('entrance_exam_resulte');
            $entrance_exam=$this->request->getData('entrance_exam');
            foreach ($entrance_exam as $key => $value) {
                $entranceExamResults = $this->EntranceExamResults->newEntity();
              
                $entranceExamResults->entrance_exam_id=$value['entrance_exam_id'];
                $entranceExamResults->obt_marks=$value['obt_marks'];
                
                $entranceExamResults->enquiry_form_student_id=$enquiry_form_student_id;
                
                if(!empty(@$value['id']))
                {
                    $entranceExamResults->id=$value['id'];
                    $entranceExamResults->edited_by=$user_id;
                }
                else
                {
                    $entranceExamResults->created_by=$user_id;
                    $entranceExamResults->session_year_id=$session_year_id;
                }
                $this->EntranceExamResults->save($entranceExamResults);
            }
            $query = $this->EntranceExamResults->EnquiryFormStudents->query();
                    $query->update()->set(['entrance_exam_resulte' => $entrance_exam_resulte])
                          ->where(['id' => $enquiry_form_student_id])->execute();
        }
        $entranceResults = $this->EntranceExamResults->find()->where(['enquiry_form_student_id'=>$enquiry_form_student_id])->contain(['EntranceExams']);
        $entranceExams=$this->EntranceExamResults->EntranceExams->find()->where(['is_deleted'=>'N']);
        $enquiryFormStudent=$this->EntranceExamResults->EnquiryFormStudents->find()->select(['entrance_exam_resulte','admission_generated'])->where(['id'=>$enquiry_form_student_id])->first();
        $this->set(compact('entranceResults','entranceExamResults','entranceExams','enquiryFormStudent'));
    }
    /**
     * View method
     *
     * @param string|null $id Entrance Exam Result id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    

    /**
     * Delete method
     *
     * @param string|null $id Entrance Exam Result id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
}
