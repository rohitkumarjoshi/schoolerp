<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\Helper\HtmlHelper;
use Cake\Routing\Router;
use Cake\Event\Event;
/**
 * TransferCertificates Controller
 *
 * @property \App\Model\Table\TransferCertificatesTable $TransferCertificates
 *
 * @method \App\Model\Entity\TransferCertificate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransferCertificatesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['tcCancel']);
    } 
    public function view($id)
    {
        $this->viewBuilder()->setLayout('');
        $id = $this->EncryptingDecrypting->decryptData($id);
        $transferCertificate = $this->TransferCertificates->get($id, [
            'contain' => ['PromotedStudentClasses','LastStudiedStudentClasses','Students'=>['StudentInfos'=>function($q){
                return $q->order(['StudentInfos.session_year_id'=>'DESC'])
                        ->group(['StudentInfos.student_id'])
                    ->contain(['ReservationCategories','StudentClasses']);
            },'LastClasses','AdmissionClasses'], 'SessionYears']
        ]);
        $school = $this->TransferCertificates->Students->Schools->find()->first();
        $this->set(compact('school','transferCertificate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($student_info_id)
    {
        $student_info_id = $this->EncryptingDecrypting->decryptData($student_info_id);
         $studentInfo = $this->TransferCertificates->Students->StudentInfos->get($student_info_id,[
            'contain'=>['ReservationCategories','StudentClasses','Students'=>['LastClasses','AdmissionClasses','StudentFatherProfessions','StudentMotherProfessions']]
        ]);
        $session_year_id = $this->Auth->User('session_year_id');
        $user_id = $this->Auth->User('user_id');
        $transferCertificate = $this->TransferCertificates->newEntity();
        $transferCertificates = $this->TransferCertificates->find();
        $transferCertificates->select(['tc_serial_no'=>$transferCertificates->func()->max('tc_serial_no')]);
        $tc_serial_no=$transferCertificates->first()->tc_serial_no+1;
        if ($this->request->is('post')) {
            $transferCertificate = $this->TransferCertificates->patchEntity($transferCertificate, $this->request->getData());
            $transferCertificate->student_id=$studentInfo->student_id;
            $transferCertificate->tc_serial_no = $tc_serial_no;
            $transferCertificate->tc_status = 'Success';
            $transferCertificate->session_year_id = $session_year_id;
            $transferCertificate->created_by = $user_id;
            if ($this->TransferCertificates->save($transferCertificate)) {
                $this->Flash->success(__('The transfer certificate has been success.'));
                $transfer_certificate_id = $this->EncryptingDecrypting->encryptData($transferCertificate->id);
                $html = new HtmlHelper(new \Cake\View\View());
                $url = Router::Url(['controller' => 'TransferCertificates', 'action' => 'view',$transfer_certificate_id], true);
                $url_same = Router::Url(['controller' => 'Students', 'action' => 'transferCertificate'], true);
                print $html->scriptBlock('window.open("'.$url.'", "_blank");');
                print $html->scriptBlock('window.open("'.$url_same.'", "_self");');
                //return $this->redirect(['action' => 'view',$transfer_certificate_id]);
            }
            $this->Flash->error(__('The transfer certificate could not be saved. Please, try again.'));
        }
        $school = $this->TransferCertificates->Students->Schools->find()->first();
        $studentClasses = $this->TransferCertificates->Students->StudentInfos->StudentClasses->find('list')->order(['id'=>'ASC']);
        $studentClassesHigher = $this->TransferCertificates->PromotedStudentClasses->find('list')->order(['id'=>'ASC']);
        $this->set(compact('studentInfo','school','transferCertificate','tc_serial_no','studentClasses','studentClassesHigher'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transfer Certificate id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        
        $session_year_id = $this->Auth->User('session_year_id');
        $user_id = $this->Auth->User('user_id');
        $transferCertificate = $this->TransferCertificates->get($id, [
            'contain' => ['Students'=>['LastClasses','AdmissionClasses','StudentFatherProfessions','StudentMotherProfessions','StudentInfos'=>['ReservationCategories','StudentClasses']]]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transferCertificate = $this->TransferCertificates->patchEntity($transferCertificate, $this->request->getData());
            $transferCertificate->edited_by = $user_id;
            if ($this->TransferCertificates->save($transferCertificate)) {
                $this->Flash->success(__('The transfer certificate has been saved.'));

                $transfer_certificate_id = $this->EncryptingDecrypting->encryptData($transferCertificate->id);
                $html = new HtmlHelper(new \Cake\View\View());
                $url = Router::Url(['controller' => 'TransferCertificates', 'action' => 'view',$transfer_certificate_id], true);
                $url_same = Router::Url(['controller' => 'Students', 'action' => 'transferCertificate'], true);
                print $html->scriptBlock('window.open("'.$url.'", "_blank");');
                print $html->scriptBlock('window.open("'.$url_same.'", "_self");');
            }
            $this->Flash->error(__('The transfer certificate could not be saved. Please, try again.'));
        }
        //pr($transferCertificate->toArray()); exit;
        $school = $this->TransferCertificates->Students->Schools->find()->first();
        $studentClasses = $this->TransferCertificates->Students->StudentInfos->StudentClasses->find('list')->order(['id'=>'ASC']);
        $studentClassesHigher = $this->TransferCertificates->PromotedStudentClasses->find('list')->order(['id'=>'ASC']);
        $this->set(compact('transferCertificate', 'school', 'studentClasses','studentClassesHigher'));
    }

    public function tcCancel($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->EncryptingDecrypting->decryptData($id);
        $transferCertificate = $this->TransferCertificates->get($id);
        $transferCertificate->tc_status = 'Cancel';
        if ($this->TransferCertificates->save($transferCertificate)) {
            $this->Flash->success(__('The transfer certificate has been cancelled.'));
        } else {
            $this->Flash->error(__('The transfer certificate could not be cancelled. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Students','action'=>'transferCertificate']);
    }
}
