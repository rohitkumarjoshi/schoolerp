<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\View\View;
use Cake\View\Helper\HtmlHelper;
use Cake\Routing\Router;
/**
 * FeeReceipts Controller
 *
 * @property \App\Model\Table\FeeReceiptsTable $FeeReceipts
 *
 * @method \App\Model\Entity\FeeReceipt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeeReceiptsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
         
        $this->Security->setConfig('unlockedActions', ['getFeeStructure','monthlyFee','formFee','delete','invoiceEdit','getFormFee','admissionFee','hostelFee','adhocFee','annualFee','oldFee','adhocFeeNonscholar']);
    }

    public function index()
    {
        /*$this->paginate = [
            'contain' => ['SessionYears', 'Students', 'StudentInfos']
        ];
        $feeReceipts = $this->paginate($this->FeeReceipts);

        $this->set(compact('feeReceipts'));*/
    }
    /**
     * View method
     *
     * @param string|null $id Fee Receipt id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function oldFee($student_info_id = null, $old_fee_id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($student_info_id);
        $old_fee_id = $this->EncryptingDecrypting->decryptData($old_fee_id);
        $feeReceipt = $this->FeeReceipts->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        
        $FeeReturnData=$this->FeeReceipts->OldFees->get($old_fee_id,[
            'contain'=>['FeeCategories','FeeTypeRoles','FeeReceipts'=>function($q){
                return $q->select(['FeeReceipts.old_fee_id','total_submit_amount'=>$q->func()->sum('amount')]);
            },'Students'=>['StudentInfos'=>['StudentClasses','Mediums','Sections','Streams']]]
        ]);
        $fee_type_role_id = $FeeReturnData->fee_type_role_id;
        $feeReceipts = $this->FeeReceipts->find();
        $feeReceipts->where(['session_year_id'=>$session_year_id]);
        $feeReceipts->where(['fee_category_id'=>$FeeReturnData->fee_category_id]);
        if($fee_type_role_id)
        {
            $feeReceipts->where(['fee_type_role_id'=>$fee_type_role_id]);
        }
        $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
        $feeReceipts = $feeReceipts->first();
        $ReceiptNo=$feeReceipts->receipt_no+1;

        $FeeData = $FeeReturnData;
        $SubmittedFee = $FeeReturnData->fee_receipts;
        $studentInfos = $FeeReturnData->student->student_infos[0];
        $students = $FeeReturnData->student;
        if ($this->request->is('post')) {
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData(),[ 'associated' => ['FeeReceiptRows'] ]);
            $feeReceipt->receipt_no=$ReceiptNo;
            $feeReceipt->student_info_id=$id;
            $feeReceipt->created_by=$user_id;
            $feeReceipt->session_year_id=$session_year_id;
            $feeReceipt->old_fee_id=$old_fee_id;
            $feeReceipt->fee_category_id=$FeeReturnData->fee_category_id;
            if(!empty($this->request->getData('cheque_date')))
            {
                $feeReceipt->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
            }
            $feeReceipt->receipt_date=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
            $feeReceipt->fee_receipt_rows = [];
            $feeReceiptRows = $this->FeeReceipts->FeeReceiptRows->newEntity();
            $feeReceiptRows->amount=$this->request->getData('amount_row');
            $feeReceiptRows->student_info_id=$id;
            $feeReceipt->fee_receipt_rows[]=$feeReceiptRows;

            if ($this->FeeReceipts->save($feeReceipt)) {
                $receipt_id=$this->EncryptingDecrypting->encryptData($feeReceipt->id);
                $this->Flash->success(__('The old fee receipt has been saved.'));
                 
                if($this->request->getData('save')=='print')
                {
                    return $this->redirect(['controller'=>'FeeReceipts','action' => 'receiptPrint','Students','searchOldFeeStudent',$receipt_id,$student_info_id]);
                }
                else
                {
                    return $this->redirect(['controller'=>'Students','action' => 'searchOldFeeStudent']);
                }
            }

            $this->Flash->error(__('The fee receipt has not been saved.'));
        }
        ///////   Warning Message ///////
        $this->warningMsg($id,$session_year_id);
        ////////////////////////////////
        $feeReceiptAmounts=$this->FeeReceipts->find()->where(['old_fee_id'=>$old_fee_id,'fee_category_id'=>$FeeReturnData->fee_category_id])->where(['FeeReceipts.is_deleted'=>'N']);
        if($fee_type_role_id)
        {
            $feeReceiptAmounts->where(['fee_type_role_id'=>$fee_type_role_id]);
        }
        $this->set(compact('FeeData', 'students', 'studentInfos','feeMonths','ReceiptNo','feeReceipt','SubmittedFee','id','fee_type_role_id','feeReceiptAmounts'));
    }
    public function monthlyFee($student_info_id = null, $fee_type_role_id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($student_info_id);


        if($fee_type_role_id)
        {
            $fee_type_role_ids=$fee_type_role_id;
            $fee_type_role_id = $this->EncryptingDecrypting->decryptData($fee_type_role_id);
        }
        else
        {
            $fee_type_role_ids='';
        }
        
        $feeReceipt = $this->FeeReceipts->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        
        

        $feeReceipts = $this->FeeReceipts->find();
        $feeReceipts->where(['session_year_id'=>$session_year_id]);
        $feeReceipts->where(['fee_category_id'=>1]);
        if($fee_type_role_id)
        {
            $feeReceipts->where(['fee_type_role_id'=>$fee_type_role_id]);
        }
        $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
        $feeReceipts = $feeReceipts->first();
        $ReceiptNo=$feeReceipts->receipt_no+1; 
        
        $FeeReturnData=$this->FeeReceipt->feeGenerate($id,$session_year_id,$fee_type_role_id);
        $FeeData = $FeeReturnData['FeeData'];
        $studentInfos = $FeeReturnData['studentInfos'];
        $students = $FeeReturnData['students'];
        $sessionYears = $this->FeeReceipts->SessionYears->get($session_year_id);
        $start    = (new \DateTime($sessionYears->from_date))->modify('first day of this month');
        $end      = (new \DateTime(date('Y-m-d')))->modify('first day of next month');
        $interval = \DateInterval::createFromDateString('1 month');
        $period   = new \DatePeriod($start, $interval, $end);
        $month_mapping=[];
        foreach ($period as $dt) 
        {
            $month_mapping[]=$dt->format("M");
        } 
        $SubmittedFee=$this->FeeReceipts->find();
        $SubmittedFee->contain(['FeeReceiptRows'=>['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes']]]]);
        $SubmittedFee->where(['FeeReceipts.student_info_id'=>$id,'FeeReceipts.fee_category_id'=>1,'FeeReceipts.is_deleted'=>'N']);
        if($fee_type_role_id)
        {
            $SubmittedFee->where(['FeeReceipts.fee_type_role_id'=>$fee_type_role_id]);
        }
        $fee_card=sizeof($SubmittedFee->toArray());
        if ($this->request->is('post')) {
            //pr($this->request->getData()); exit;
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData(),[ 'associated' => ['FeeReceiptRows'] ]);
            $feeReceipt->receipt_no=$ReceiptNo;
            $feeReceipt->student_info_id=$id;
            $feeReceipt->created_by=$user_id;
            $feeReceipt->session_year_id=$session_year_id;
            if(!empty($this->request->getData('cheque_date')))
            {
                $feeReceipt->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
            }
            $feeReceipt->receipt_date=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
            $feeReceipt->fee_receipt_rows = [];
             
            foreach ($this->request->getData('fee_type_master_rows') as $Multiple) {
                foreach ($Multiple as $key => $value) {
                    if(!empty($value['fee_month_id']) && !empty($value['amount'])){
                        $feeReceiptRows = $this->FeeReceipts->FeeReceiptRows->newEntity();
                        $feeReceiptRows->fee_month_id=$value['fee_month_id'];
                        $feeReceiptRows->fee_type_master_row_id=$value['fee_type_master_row_id'];
                        $feeReceiptRows->amount=$value['amount'];
                        $feeReceiptRows->student_info_id=$id;
                        if(@$value['fee_type_student_master_id']){
                          $feeReceiptRows->fee_type_student_master_id=$value['fee_type_student_master_id'];  
                        }
                        $feeReceipt->fee_receipt_rows[]=$feeReceiptRows;
                    }
                }
            }
            if ($this->FeeReceipts->save($feeReceipt)) {
                $receipt_id=$this->EncryptingDecrypting->encryptData($feeReceipt->id);
                $this->Flash->success(__('The fee receipt has been saved.'));
                if($this->request->getData('save')=='print')
                {
                    if($fee_card == 0)
                    {
                        $html = new HtmlHelper(new \Cake\View\View());
                        $url = Router::Url(['controller' => 'Students', 'action' => 'feeStructureView',$student_info_id], true);
                        print $html->scriptBlock('if(confirm("Do you want to print Fee Card?") == true){window.open("'.$url.'", "_blank")}');
                        $url_same = Router::Url(['controller' => 'FeeReceipts', 'action' => 'receiptPrint','Students','searchStudent',$receipt_id,$student_info_id,$fee_type_role_ids], true);
                        print $html->scriptBlock('window.open("'.$url_same.'", "_self");');
                    }
                    else
                    {
                        return $this->redirect(['controller'=>'FeeReceipts','action' => 'receiptPrint','Students','searchStudent',$receipt_id,$student_info_id,$fee_type_role_ids]);
                    }
                }
                else
                {
                    return $this->redirect(['controller'=>'Students','action' => 'searchStudent']);
                }
                
                
            }

            $this->Flash->error(__('The fee receipt has not been saved.'));
        }

        ///////   Warning Message ///////
        $this->warningMsg($id,$session_year_id);
        ////////////////////////////////

        $feeMonths=$this->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find()->select(['id','name'])->order(['id'=>'ASC']);
         
        $this->set(compact('FeeData', 'students', 'studentInfos','feeMonths','ReceiptNo','feeReceipt','SubmittedFee','id','fee_type_role_id','month_mapping'));
    }
    public function warningMsg($id,$session_year_id)
    {
        ///////   Pending Fees ///////
        $pendingDocuments=$this->FeeReceipt->pendingDocument($id,$session_year_id);
        $html = new HtmlHelper(new \Cake\View\View());
        print $html->scriptBlock('alert("Pending Document'.$pendingDocuments.'")');
        //////////////////////////////

        ///////   Pending Fees ///////  
        $pendingFees=$this->FeeReceipt->pendingFee($id,$session_year_id);
        $html = new HtmlHelper(new \Cake\View\View());
        print $html->scriptBlock('alert("Due Fees'.$pendingFees.'")');
        //////////////////////////////////////
    }
    
    public function invoiceEdit($student_info_id = null,$fee_type_role_id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($student_info_id);
        if(!empty($fee_type_role_id))
        {
            $fee_type_role_ids = $this->EncryptingDecrypting->decryptData($fee_type_role_id);
        }
        else
        {
            $fee_type_role_ids='';
        }
        $feeReceipt = $this->FeeReceipts->FeeTypeStudentMasters->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $FeeReturnData=$this->FeeReceipt->feeGenerate($id,$session_year_id,$fee_type_role_ids);
        $FeeData = $FeeReturnData['FeeData'];
        $studentInfos = $FeeReturnData['studentInfos'];
        $students = $FeeReturnData['students'];
        //-- Form Submit Query

        if ($this->request->is('post')) {
            foreach ($this->request->getData('fee_type_master_rows') as $Multiple) {
                foreach ($Multiple as $key => $value) {
                    if(!empty($value['fee_month_id']) && isset($value['amount'])){
                        $feeTypeStudentMasters = $this->FeeReceipts->FeeTypeStudentMasters->newEntity();
                        $feeTypeStudentMasters->fee_type_master_row_id=$value['fee_type_master_row_id'];
                        $amt = $value['amount'];
                        $actual_amount = $value['actual_amount'];
                        if(empty($amt)){ $amt = 0; }
                        if(@$value['id']){
                          $feeTypeStudentMasters->id=$value['id'];  
                        }
                        $feeTypeStudentMasters->amount=$amt;
                        $feeTypeStudentMasters->actual_amount=$actual_amount;
                        $feeTypeStudentMasters->concession_amount=$actual_amount-$amt;
                        $feeTypeStudentMasters->student_info_id=$id; 
                        $feeTypeStudentMasters->created_by=$user_id;
                        $feeTypeStudentMasters->session_year_id=$session_year_id;
                        $feeTypeStudentMasters->remarks=$this->request->getData('remark');
                       $this->FeeReceipts->FeeTypeStudentMasters->save($feeTypeStudentMasters);  
                    }
                }
            }
            return $this->redirect(['controller'=>'FeeReceipts','action' => 'monthlyFee',$student_info_id,$fee_type_role_id]);
        }

        $feeMonths=$this->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find()->select(['id','name'])->order(['id'=>'ASC']);
        
        $SubmittedFee=$this->FeeReceipts->find()
                    ->contain(['FeeReceiptRows'=>['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes']]]])
                    ->where(['FeeReceipts.student_info_id'=>$id,'FeeReceipts.fee_category_id'=>1,'FeeReceipts.is_deleted'=>'N']);
                    
        $this->set(compact('FeeData', 'students', 'studentInfos','feeMonths','feeReceipt','SubmittedFee','id'));
    }

    public function formFee($enquiry_id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!empty($enquiry_id))
        {
            $id = $this->EncryptingDecrypting->decryptData($enquiry_id);
            $enquiryFormStudent = $this->FeeReceipts->EnquiryFormStudents->get($id,[
                'contain'=>['StudentFatherProfessions','StudentMotherProfessions']
            ]
            );
            $student_mother=[];
            foreach ($enquiryFormStudent->student_mother_professions as $student_mother_profession) 
            {
                $student_mother[]=$student_mother_profession->student_parent_profession_id;
            }
            $student_father=[];
            foreach ($enquiryFormStudent->student_father_professions as $student_father_profession) 
            {
                $student_father[]=$student_father_profession->student_parent_profession_id;
            }
            //pr($student_father); exit;
        }
        else
        {
            $enquiryFormStudent = $this->FeeReceipts->EnquiryFormStudents->newEntity();
        }
        if(!empty($enquiry_id))
        {
            $FeeReturnData=$this->FeeReceipt->enquiryFee($id,$session_year_id);
            $FeeData = $FeeReturnData['FeeData'];
            $studentInfos = $FeeReturnData['studentInfos'];
        }
        //-- Form Submit Query
        $SubmittedFee=[];
        if(!empty(@$id))
        {
            $SubmittedFee=$this->FeeReceipts->find()
            ->contain(['FeeReceiptRows'=>['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes']]]])
            ->where(['FeeReceipts.fee_category_id'=>2,'FeeReceipts.is_deleted'=>'N']);
             $SubmittedFee->where(['FeeReceipts.enquiry_form_student_id'=>$id]);
        } 
        if ($this->request->is(['POST','PUT'])) 
        {
            if($enquiryFormStudent->admission_form_no == 0)
            {
                $EnquiryFormStudents = $this->FeeReceipts->EnquiryFormStudents->find();
                $EnquiryFormStudents->where(['EnquiryFormStudents.session_year_id'=>$session_year_id])
                    ->select(['admission_form_no'=>$EnquiryFormStudents->func()->max('admission_form_no')]);
                $EnquiryFormStudents = $EnquiryFormStudents->first();
                $AdmissionFormNo=$EnquiryFormStudents->admission_form_no+1;  
            }
            else
            {
                $AdmissionFormNo=$enquiryFormStudent->admission_form_no;
            }
             
            if($enquiryFormStudent->admission_form_no == 0)
            {
                $feeReceipts = $this->FeeReceipts->find();
                $feeReceipts->where(['session_year_id'=>$session_year_id]);
                $feeReceipts->where(['fee_category_id'=>2]);
                
                $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
                $feeReceipts = $feeReceipts->first();
                $ReceiptNo=$feeReceipts->receipt_no+1; 
            }
            
            
            $enquiryFormStudent = $this->FeeReceipts->EnquiryFormStudents->patchEntity($enquiryFormStudent, $this->request->getData());
            $enquiryFormStudent->created_by=$user_id;
            $enquiryFormStudent->dob=date('Y-m-d',strtotime($this->request->getData('dob')));
            if(empty($enquiry_id))
            {
                $enquiryFormStudent->enquiry_status="";
                $enquiryFormStudent->session_year_id =$session_year_id;
                $enquiryFormStudent->enquiry_mode="Form";
            }
            
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
            
            if ($this->FeeReceipts->EnquiryFormStudents->save($enquiryFormStudent)) 
            {
                $student_father_professions=$this->request->getData('student_father_professions');
                $student_mother_professions=$this->request->getData('student_mother_professions');
                if(empty($student_father_professions))
                {
                    $student_father_professions=[];
                }
                if(empty($student_mother_professions))
                {
                    $student_mother_professions=[];
                }
                if($enquiryFormStudent->admission_form_no != 0)
                {
                    
                    $student_father_result = array_merge(array_diff($student_father_professions, $student_father), array_diff($student_father, $student_father_professions));
                    
                    foreach ($student_father_result as $key => $value) {
                         $query = $this->FeeReceipts->EnquiryFormStudents->StudentFatherProfessions->query();
                        $query->delete()
                            ->where(['enquiry_form_student_id' => $id,
                                        'student_parent_profession_id'=>$value
                                    ])
                            ->execute();
                    }
                    
                    $student_mother_result = array_merge(array_diff($student_mother_professions, $student_mother), array_diff($student_mother, $student_mother_professions));
                    foreach ($student_mother_result as $key => $value) {
                         $query = $this->FeeReceipts->EnquiryFormStudents->StudentMotherProfessions->query();
                        $query->delete()
                            ->where(['enquiry_form_student_id' => $id,
                                        'student_parent_profession_id'=>$value
                                    ])
                            ->execute();
                    }
                   
                    foreach ($student_father_professions as $key => $value) 
                    {
                        $studentFatherProfessions = $this->FeeReceipts->EnquiryFormStudents->StudentFatherProfessions->find()->where(['enquiry_form_student_id'=>$id,'student_parent_profession_id'=>$value])->first();
                        if(empty($studentFatherProfessions))
                        {
                            $query = $this->FeeReceipts->EnquiryFormStudents->StudentFatherProfessions->query();
                            $query->insert(['enquiry_form_student_id', 'student_parent_profession_id'])
                                ->values([
                                    'enquiry_form_student_id' => $id,
                                    'student_parent_profession_id' => $value
                                ])
                                ->execute();
                        }

                    }
                    foreach ($student_mother_professions as $key => $value) 
                    {
                        $studentMotherProfessions = $this->FeeReceipts->EnquiryFormStudents->StudentMotherProfessions->find()->where(['enquiry_form_student_id'=>$id,'student_parent_profession_id'=>$value])->first();
                        if(empty($studentMotherProfessions))
                        {
                            $query = $this->FeeReceipts->EnquiryFormStudents->StudentMotherProfessions->query();
                            $query->insert(['enquiry_form_student_id', 'student_parent_profession_id'])
                                ->values([
                                    'enquiry_form_student_id' => $id,
                                    'student_parent_profession_id' => $value
                                ])
                                ->execute();
                        }
                    }
                }
                else
                {
                    foreach ($student_father_professions as $key => $value) 
                    {
                        $query = $this->FeeReceipts->EnquiryFormStudents->StudentFatherProfessions->query();
                        $query->insert(['enquiry_form_student_id', 'student_parent_profession_id'])
                            ->values([
                                'enquiry_form_student_id' => $enquiryFormStudent->id,
                                'student_parent_profession_id' => $value
                            ])
                            ->execute();

                    }
                    foreach ($student_mother_professions as $key => $value) 
                    {
                        
                        $query = $this->FeeReceipts->EnquiryFormStudents->StudentMotherProfessions->query();
                        $query->insert(['enquiry_form_student_id', 'student_parent_profession_id'])
                            ->values([
                                'enquiry_form_student_id' => $enquiryFormStudent->id,
                                'student_parent_profession_id' => $value
                            ])
                            ->execute();
                    }
                }
                $studentDocumentPhotos = $this->FeeReceipts->EnquiryFormStudents->StudentDocuments->find()->where(['enquiry_form_student_id'=>$enquiryFormStudent->id,'document_class_mapping_id Is'=>null])->first();
                $student_photo=$this->request->getData('student_photo');
                if(!empty($student_photo))
                {
                    $image_parts = explode(";base64,", $student_photo);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $file_name = 'photo.'.$image_type;
                    if(empty(@$studentDocumentPhotos))
                    {
                        $studentDocuments = $this->FeeReceipts->EnquiryFormStudents->StudentDocuments->newEntity();
                        $studentDocuments->enquiry_form_student_id = $enquiryFormStudent->id;
                        $studentDocuments->image_path = $file_name;
                        $studentDocuments->session_year_id = $session_year_id;
                        $studentDocuments->created_by=$user_id;
                        if($this->FeeReceipts->EnquiryFormStudents->StudentDocuments->save($studentDocuments))
                        {
                            $keyname = 'document/'.$studentDocuments->id.'/'.$file_name;
                            $this->AwsFile->putObjectBase64($keyname,$image_base64,$image_type);
                            $query = $this->FeeReceipts->EnquiryFormStudents->StudentDocuments->query();
                            $query->update()->set(['image_path' => $keyname])
                                  ->where(['id' => $studentDocuments->id])->execute();
                        }
                    }
                    else
                    {
                        $this->AwsFile->deleteObjectFile($studentDocumentPhotos->image_path);
                        $keyname = 'document/'.$studentDocumentPhotos->id.'/'.$file_name;
                        $this->AwsFile->putObjectBase64($keyname,$image_base64,$image_type);
                        $query = $this->FeeReceipts->EnquiryFormStudents->StudentDocuments->query();
                            $query->update()->set(['image_path' => $keyname])
                                  ->where(['id' => $studentDocumentPhotos->id])->execute();
                    }
                }
                $documents=$this->request->getData('document');
                $sr=0;
                if(!empty($documents))
                {
                    foreach ($documents as $documentFile) 
                    {
                        if(empty($documentFile['error']))
                        {
                            $ext=explode('/',$documentFile['type']);
                            $setNewFileName = time().rand();
                            $studentDocuments = $this->FeeReceipts->EnquiryFormStudents->StudentDocuments->newEntity();
                            $existStudentDocuments = $this->FeeReceipts->EnquiryFormStudents->StudentDocuments->find()->where(['enquiry_form_student_id'=>$enquiryFormStudent->id,'document_class_mapping_id'=>$this->request->getData('document_class_mapping')[$sr]])->first();
                            if(empty($existStudentDocuments))
                            {
                                $studentDocuments->session_year_id = $session_year_id;
                                $studentDocuments->created_by=$user_id;
                            }
                            else
                            {
                                $studentDocuments->id = $existStudentDocuments->id;
                                $studentDocuments->edited_by=$user_id;
                                $this->AwsFile->deleteObjectFile($existStudentDocuments->image_path);
                            }
                            $file_name = $setNewFileName.'.'.$ext[1];
                            $studentDocuments->enquiry_form_student_id = $enquiryFormStudent->id;
                            $studentDocuments->image_path = $file_name;
                            $studentDocuments->document_class_mapping_id = $this->request->getData('document_class_mapping')[$sr];
                            if($this->FeeReceipts->EnquiryFormStudents->StudentDocuments->save($studentDocuments))
                            {
                                $keyname = 'document/'.$studentDocuments->id.'/'.$setNewFileName.'.'.$ext[1];
                                $this->AwsFile->putObjectFile($keyname,$documentFile['tmp_name'],$documentFile['type']);
                                $query = $this->FeeReceipts->EnquiryFormStudents->StudentDocuments->query();
                                $query->update()->set(['image_path' => $keyname])
                                      ->where(['id' => $studentDocuments->id])->execute();
                            }
                        }
                        $sr++;
                    }
                }
                $enquiry_gen_id = $this->EncryptingDecrypting->encryptData($enquiryFormStudent->id);
                if($enquiryFormStudent->admission_form_no == 0)
                {
                    $feeReceipt = $this->FeeReceipts->newEntity();
                    $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData(),[ 'associated' => ['FeeReceiptRows'] ]);
                    $feeReceipt->receipt_no=$ReceiptNo;
                    $feeReceipt->enquiry_form_student_id=$enquiryFormStudent->id;
                    $feeReceipt->created_by=$user_id;
                    $feeReceipt->session_year_id=$session_year_id;
                    if(!empty($this->request->getData('cheque_date')))
                    {
                        $feeReceipt->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
                    }
                    $feeReceipt->receipt_date=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
                    $feeReceipt->fee_receipt_rows = [];
                    
                    $x=0;

                    foreach ($this->request->getData('fee_type_master_rows') as $key => $value) {
                        $feeReceiptRows = $this->FeeReceipts->FeeReceiptRows->newEntity();
                        $feeReceiptRows['fee_type_master_row_id']=$value['fee_type_master_row_id'];
                        $feeReceiptRows['amount']=$value['amount'];
                        $feeReceiptRows['enquiry_form_student_id']=$enquiryFormStudent->id;
                        $feeReceipt->fee_receipt_rows[]=$feeReceiptRows;
                        $x++;
                    }
                   
                    if ($this->FeeReceipts->save($feeReceipt))
                    {
                        if($enquiryFormStudent->admission_form_no == 0)
                        {
                            $receiptDate=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
                            $query = $this->FeeReceipts->EnquiryFormStudents->query();
                            $query->update()->set(['admission_form_no' => $AdmissionFormNo,'admission_form_date' => $receiptDate])
                              ->where(['id' => $enquiryFormStudent->id])->execute();
                        }
                        

                        $this->Flash->success(__('The fee receipt has been saved.'));
                        return $this->redirect(['controller'=>'Students','action' => 'admissionFormView',$enquiry_gen_id]);
                    }
                }
                else
                {
                    $this->Flash->success(__('The admission form edit successfull.'));
                    return $this->redirect(['controller'=>'Students','action' => 'admissionFormView',$enquiry_gen_id]);
                }
                $this->Flash->error(__('The fee receipt has not been saved.'));
            }
              
        }
 
        $genders = $this->FeeReceipts->EnquiryFormStudents->Genders->find('list')->where(['is_deleted'=>'N']);
        $studentClasse = $this->FeeReceipts->EnquiryFormStudents->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $mediums = $this->FeeReceipts->EnquiryFormStudents->Mediums->find('list')->where(['is_deleted'=>'N']);
        $stream = $this->FeeReceipts->EnquiryFormStudents->Streams->find('list')->where(['is_deleted'=>'N']);
        
        $studentParentProfessions = $this->FeeReceipts->EnquiryFormStudents->StudentParentProfessions->find('list')->where(['is_deleted'=>'N']);
        $reservationCategories = $this->FeeReceipts->EnquiryFormStudents->ReservationCategories->find('list')->where(['is_deleted'=>'N']);
        $vehicles = $this->FeeReceipts->EnquiryFormStudents->Vehicles->find('list');
        $vehicleStations = $this->FeeReceipts->EnquiryFormStudents->VehicleStations->find('list');
        $admission_form_no=$enquiryFormStudent->admission_form_no;
        $this->set(compact('FeeData','studentInfos','feeMonths','ReceiptNo','enquiryFormStudent','enquiry_id','genders','mediums','studentClasse','stream','SubmittedFee','studentParentProfessions','reservationCategories','student_mother','student_father','admission_form_no','vehicles','vehicleStations'));
    }
    public function getFormFee()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is('post')) {
            $medium_id=$this->request->getData('medium_id');
            $student_class_id=$this->request->getData('student_class_id');
            $stream_id=$this->request->getData('stream_id');
            $gender_id=$this->request->getData('gender_id');
            $FeeReturnData=$this->FeeReceipt->formFee($medium_id,$student_class_id,$stream_id,$gender_id,$session_year_id);
            $FeeData = $FeeReturnData['FeeData'];
            $this->set(compact('FeeData'));
        }
    }
 

    public function convertToAdmission($enquiry_id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $enquiry_id = $this->EncryptingDecrypting->decryptData($enquiry_id);
        $enquiryFormStudents=$this->FeeReceipts->EnquiryFormStudents->find()->where(['EnquiryFormStudents.id'=>$enquiry_id])->first();
        if($enquiryFormStudents->admission_form_no > 0 && $enquiryFormStudents->admission_generated == 'N')
        {
            $Students = $this->FeeReceipts->StudentInfos->Students->find();
            $Students->select(['scholar_no'])
                ->order(['id'=>'DESC']);
            $Students = $Students->first();
            $NewScholarNo=$Students->scholar_no+1; 
            
            $student = $this->FeeReceipts->StudentInfos->Students->newEntity();
            $StudentData['name']=$enquiryFormStudents->name;
            $StudentData['name_separate']=$enquiryFormStudents->name_separate;
            
            $StudentData['gender_id']=$enquiryFormStudents->gender_id;
            $StudentData['father_name']=$enquiryFormStudents->father_name;
            $StudentData['mother_name']=$enquiryFormStudents->mother_name;
            $StudentData['parent_mobile_no']=$enquiryFormStudents->mobile_no;
            $StudentData['session_year_id']=$enquiryFormStudents->session_year_id;
            $StudentData['admission_class_id']=$enquiryFormStudents->student_class_id;
            $StudentData['admission_medium_id']=$enquiryFormStudents->medium_id;
            $StudentData['admission_stream_id']=$enquiryFormStudents->stream_id;
            
            $StudentData['enquiry_form_student_id']=$enquiryFormStudents->id;
            $StudentData['last_school']=$enquiryFormStudents->last_school;
            $StudentData['last_medium_id']=$enquiryFormStudents->last_medium_id;
            $StudentData['last_class_id']=$enquiryFormStudents->last_class_id;
            $StudentData['last_stream_id']=$enquiryFormStudents->last_stream_id;
            $StudentData['percentage_in_last_class']=$enquiryFormStudents->percentage_in_last_class;
            $StudentData['board']=$enquiryFormStudents->board;
            if($enquiryFormStudents->enquiry_no > 0)
            {
                $StudentData['admission_by']='Enquiry';
            }
            else
            {
                $StudentData['admission_by']='Direct';
            }
            $StudentData['scholar_no']=$NewScholarNo;
            $StudentData['registration_date']=date('Y-m-d');
            //$StudentData['admission_date']=date('Y-m-d');
            $StudentData['dob']=$enquiryFormStudents->dob;
            $StudentData['created_by']=$user_id;

            $student = $this->FeeReceipts->StudentInfos->Students->patchEntity($student, $StudentData);
            if($this->FeeReceipts->StudentInfos->Students->save($student))
            {
                $users = $this->FeeReceipts->StudentInfos->Students->Users->newEntity();
                $users->username='student'.$student->id;
                $users->password='alokstudent'.$student->id;
                $users->user_type='Student';
                $users->session_year_id =$session_year_id;
                $users->student_id =$student->id;
                $this->FeeReceipts->StudentInfos->Students->Users->save($users);

                $studentInfos = $this->FeeReceipts->StudentInfos->newEntity();
                $StudentInfoData['student_id']=$student->id;
                $StudentInfoData['student_parent_profession_id']=$enquiryFormStudents->student_parent_profession_id;
                $StudentInfoData['email']=$enquiryFormStudents->email;
                $StudentInfoData['hostel_facility']=$enquiryFormStudents->hostel_facility;
                if($enquiryFormStudents->transportation=='School Bus')
                {
                    $bus_facility='Yes';
                }
                else
                {
                    $bus_facility='No';
                }
                $StudentInfoData['bus_facility']=$bus_facility;
                $StudentInfoData['vehicle_id']=$enquiryFormStudents->vehicle_id;
                $StudentInfoData['vehicle_station_id']=$enquiryFormStudents->vehicle_station_id;
                $StudentInfoData['hostel_this_year']=$enquiryFormStudents->hostel_facility;
                $StudentInfoData['reservation_category_id']=$enquiryFormStudents->reservation_category_id;

                $StudentInfoData['student_class_id']=$enquiryFormStudents->student_class_id;
                $StudentInfoData['medium_id']=$enquiryFormStudents->medium_id;
                $StudentInfoData['stream_id']=$enquiryFormStudents->stream_id;
                $StudentInfoData['rte']=$enquiryFormStudents->rte;
                $StudentInfoData['permanent_address']=$enquiryFormStudents->permanent_address;
                $StudentInfoData['correspondence_address']=$enquiryFormStudents->correspondence_address;
                $StudentInfoData['minority']=$enquiryFormStudents->minority;
                $StudentInfoData['living']=$enquiryFormStudents->living;
                $StudentInfoData['local_guardian']=$enquiryFormStudents->local_guardian;
                $StudentInfoData['guardian_address']=$enquiryFormStudents->guardian_address;
                $StudentInfoData['guardian_pincode']=$enquiryFormStudents->guardian_pincode;
                $StudentInfoData['guardian_mobile_no']=$enquiryFormStudents->guardian_mobile_no;
                $StudentInfoData['session_year_id']=$enquiryFormStudents->session_year_id;
                $StudentInfoData['created_by']=$user_id; 
                $studentInfos = $this->FeeReceipts->StudentInfos->patchEntity($studentInfos, $StudentInfoData);
                if ($this->FeeReceipts->StudentInfos->save($studentInfos)) 
                {
                    $query = $this->FeeReceipts->EnquiryFormStudents->query();
                    $query->update()->set(['admission_generated' => 'Y',
                                            'entrance_exam_resulte' => 'Passed'
                                        ])
                          ->where(['id' => $enquiry_id])->execute();

                    $query = $this->FeeReceipts->EnquiryFormStudents->StudentDocuments->query();
                    $query->update()->set(['student_id' => $student->id])
                          ->where(['enquiry_form_student_id' => $enquiry_id])->execute();

                    $query = $this->FeeReceipts->EnquiryFormStudents->StudentFatherProfessions->query();
                    $query->update()->set(['student_id' => $student->id])
                          ->where(['enquiry_form_student_id' => $enquiry_id])->execute();

                    $query = $this->FeeReceipts->EnquiryFormStudents->StudentMotherProfessions->query();
                    $query->update()->set(['student_id' => $student->id])
                          ->where(['enquiry_form_student_id' => $enquiry_id])->execute();

                    $student_info_id = $this->EncryptingDecrypting->encryptData($studentInfos->id);
                    return $this->redirect(array("controller" => "FeeReceipts","action" => "admissionFee",$student_info_id));
                } 
               
            }
        }
        exit;
    }

    public function admissionFee($student_info_id= null)
    {
        $id = $this->EncryptingDecrypting->decryptData($student_info_id);
        $feeReceipt = $this->FeeReceipts->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        
        $feeReceipts = $this->FeeReceipts->find();
        $feeReceipts->where(['session_year_id'=>$session_year_id]);
        $feeReceipts->where(['fee_category_id'=>3]);
        $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
        $feeReceipts = $feeReceipts->first();
        $ReceiptNo=$feeReceipts->receipt_no+1; 

        $category_id = 3;
        $FeeReturnData=$this->FeeReceipt->admissionFee($id,$session_year_id,$category_id);

        $FeeData = $FeeReturnData['FeeData'];
        $studentInfos = $FeeReturnData['studentInfos'];
        $students = $FeeReturnData['students'];

        //-- Form Submit Query

        if ($this->request->is('post')) {
            
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData(),[ 'associated' => ['FeeReceiptRows'] ]);
            $feeReceipt->receipt_no=$ReceiptNo;
            $feeReceipt->student_info_id=$id;
            $feeReceipt->created_by=$user_id;
            $feeReceipt->session_year_id=$session_year_id;
            if(!empty($this->request->getData('cheque_date')))
            {
                $feeReceipt->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
            }
            $feeReceipt->receipt_date=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
            $feeReceipt->fee_receipt_rows = [];
             
            foreach ($this->request->getData('fee_type_master_rows') as $value) {
                if(!empty($value['fee_type_master_row_id']) && !empty($value['amount']) ){
                    $feeReceiptRows = $this->FeeReceipts->FeeReceiptRows->newEntity(); 
                    $feeReceiptRows->fee_type_master_row_id=@$value['fee_type_master_row_id'];
                    $feeReceiptRows->amount=@$value['amount'];
                    $feeReceiptRows->student_info_id=$id;
                    $feeReceipt->fee_receipt_rows[]=$feeReceiptRows;
                }
            }
            if ($this->FeeReceipts->save($feeReceipt)) {
                $receipt_id=$this->EncryptingDecrypting->encryptData($feeReceipt->id);
                if($this->request->getData('save')=='print')
                {
                    $this->Flash->success(__('The fee receipt has been saved.'));
                    $html = new HtmlHelper(new \Cake\View\View());
                    $url = Router::Url(['controller' => 'Students', 'action' => 'feeStructureView',$student_info_id], true);
                    print $html->scriptBlock('if(confirm("Do you want to print Fee Card?") == true){window.open("'.$url.'", "_blank")}');
                    $url_same = Router::Url(['controller' => 'FeeReceipts', 'action' => 'receiptPrint','Students','admissionFeeSearch',$receipt_id,$student_info_id], true);
            
                    print $html->scriptBlock('window.open("'.$url_same.'", "_self");');
                }
                else
                {
                    return $this->redirect(['controller'=>'Students','action' => 'admissionFeeSearch']);
                }
               
            }
            $this->Flash->error(__('The fee receipt has not been saved.'));
        }

        $SubmittedFee=$this->FeeReceipts->find()
                    ->contain(['FeeReceiptRows'=>['FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes']]]])
                    ->where(['FeeReceipts.student_info_id'=>$id,'FeeReceipts.fee_category_id'=>3,'FeeReceipts.is_deleted'=>'N']);
                    //pr($SubmittedFee->toArray()); exit;
        $this->set(compact('FeeData', 'students', 'studentInfos','feeMonths','ReceiptNo','feeReceipt','SubmittedFee','id'));

    }

    public function hostelFee($student_info_id= null)
    {
        $id = $this->EncryptingDecrypting->decryptData($student_info_id); 
        $feeReceipt = $this->FeeReceipts->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        
        $feeReceipts = $this->FeeReceipts->find();
        $feeReceipts->where(['session_year_id'=>$session_year_id]);
        $feeReceipts->where(['fee_category_id'=>6]);
        $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
        $feeReceipts = $feeReceipts->first();
        $ReceiptNo=$feeReceipts->receipt_no+1;

        $category_id = 6;
        $FeeReturnData=$this->FeeReceipt->admissionFee($id,$session_year_id,$category_id);

        $FeeData = $FeeReturnData['FeeData'];
        $studentInfos = $FeeReturnData['studentInfos'];
        $students = $FeeReturnData['students'];

        //-- Form Submit Query

        if ($this->request->is('post')) {
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData(),[ 'associated' => ['FeeReceiptRows'] ]);
            $feeReceipt->receipt_no=$ReceiptNo;
            $feeReceipt->student_info_id=$id;
            $feeReceipt->created_by=$user_id;
            $feeReceipt->session_year_id=$session_year_id;
            if(!empty($this->request->getData('cheque_date')))
            {
                $feeReceipt->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
            }
            $feeReceipt->receipt_date=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
            $feeReceipt->fee_receipt_rows = [];
             
            foreach ($this->request->getData('fee_type_master_rows') as $value) {
                if(!empty($value['fee_type_master_row_id']) && !empty($value['amount']) ){
                    $feeReceiptRows = $this->FeeReceipts->FeeReceiptRows->newEntity(); 
                    $feeReceiptRows->fee_type_master_row_id=@$value['fee_type_master_row_id'];
                    $feeReceiptRows->amount=@$value['amount'];
                    $feeReceiptRows->student_info_id=$id;
                    $feeReceipt->fee_receipt_rows[]=$feeReceiptRows;
                }
                
            }
             if ($this->FeeReceipts->save($feeReceipt)) {
                $receipt_id=$this->EncryptingDecrypting->encryptData($feeReceipt->id);
                $this->Flash->success(__('The fee receipt has been saved.'));
                if($this->request->getData('save')=='print')
                {
                    return $this->redirect(['controller'=>'FeeReceipts','action' => 'receiptPrint','Students','searchHostelStudent',$receipt_id,$student_info_id]);
                }
                else
                {
                    return $this->redirect(['controller'=>'Students','action' => 'searchHostelStudent']);
                }
                
            }

            $this->Flash->error(__('The fee receipt has not been saved.'));
        }
        ///////   Warning Message ///////
        $this->warningMsg($id,$session_year_id);
        ////////////////////////////////
        $SubmittedFee=$this->FeeReceipts->find()
            ->contain(['FeeReceiptRows'=>['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes']]]])
            ->where(['FeeReceipts.student_info_id'=>$id,'FeeReceipts.fee_category_id'=>$category_id,'FeeReceipts.is_deleted'=>'N']);
        //pr($SubmittedFee->toArray());exit;
        $this->set(compact('FeeData', 'students', 'studentInfos','ReceiptNo','feeReceipt','SubmittedFee','id'));
    }

    public function adhocFeeNonscholar()
    {
        $feeReceipt = $this->FeeReceipts->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        
        $feeReceipts = $this->FeeReceipts->find();
        $feeReceipts->where(['session_year_id'=>$session_year_id]);
        $feeReceipts->where(['fee_category_id'=>5]);
        $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
        $feeReceipts = $feeReceipts->first();
        $ReceiptNo=$feeReceipts->receipt_no+1;

        $category_id = 5;
        $FeeReturnData=$this->FeeReceipt->nonScholarFee($session_year_id,$category_id);

        $FeeData = $FeeReturnData['FeeData'];

        //-- Form Submit Query

        if ($this->request->is('post')) {
            
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData(),[ 'associated' => ['FeeReceiptRows'] ]);
            $feeReceipt->receipt_no=$ReceiptNo;
            $feeReceipt->created_by=$user_id;
            $feeReceipt->session_year_id=$session_year_id;
            if(!empty($this->request->getData('cheque_date')))
            {
                $feeReceipt->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
            }
            $feeReceipt->receipt_date=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
            $feeReceipt->fee_receipt_rows = [];
             
            foreach ($this->request->getData('fee_type_master_rows') as $value) {
                if(!empty($value['fee_type_master_row_id']) && !empty($value['amount']) ){
                    $feeReceiptRows = $this->FeeReceipts->FeeReceiptRows->newEntity(); 
                    $feeReceiptRows->fee_type_master_row_id=@$value['fee_type_master_row_id'];
                    $feeReceiptRows->amount=@$value['amount'];
                    $feeReceipt->fee_receipt_rows[]=$feeReceiptRows;
                }
            }
            if ($this->FeeReceipts->save($feeReceipt)) {
                $receipt_id=$this->EncryptingDecrypting->encryptData($feeReceipt->id);
                $this->Flash->success(__('The fee receipt has been saved.'));
                if($this->request->getData('save')=='print')
                {
                    return $this->redirect(['controller'=>'FeeReceipts','action' => 'receiptPrint','FeeReceipts','adhocFeeNonscholar',$receipt_id]);
                }
                else
                {
                    return $this->redirect(['controller'=>'FeeReceipts','action' => 'adhocFeeNonscholar']);
                }
                
            }
            $this->Flash->error(__('The fee receipt has not been saved.'));
        }
        
        $SubmittedFee=$this->FeeReceipts->find()
                    ->contain(['FeeReceiptRows'=>function($q){
                        return $q->where([
                            'FeeReceiptRows.student_info_id IS NULL',
                            'FeeReceiptRows.enquiry_form_student_id IS NULL',
                            ])->contain(['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes']]]);
                        }
                    ])
                    ->where([
                        'FeeReceipts.student_info_id IS NULL',
                        'FeeReceipts.enquiry_form_student_id IS NULL',
                        'FeeReceipts.old_fee_id IS NULL',
                        'FeeReceipts.fee_category_id'=>5,'FeeReceipts.is_deleted'=>'N'
                    ]);
                    //pr($SubmittedFee->toArray()); exit;
        $this->set(compact('FeeData','ReceiptNo','feeReceipt','SubmittedFee'));
    }
    public function adhocFee($student_info_id= null)
    {
        $id = $this->EncryptingDecrypting->decryptData($student_info_id); 
        $feeReceipt = $this->FeeReceipts->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        
        $feeReceipts = $this->FeeReceipts->find();
        $feeReceipts->where(['session_year_id'=>$session_year_id]);
        $feeReceipts->where(['fee_category_id'=>5]);
        $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
        $feeReceipts = $feeReceipts->first();
        $ReceiptNo=$feeReceipts->receipt_no+1;

        $category_id = 5;
        $FeeReturnData=$this->FeeReceipt->admissionFee($id,$session_year_id,$category_id);

        $FeeData = $FeeReturnData['FeeData'];
        $studentInfos = $FeeReturnData['studentInfos'];
        $students = $FeeReturnData['students'];

        //-- Form Submit Query

        if ($this->request->is('post')) {
            
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData(),[ 'associated' => ['FeeReceiptRows'] ]);
            $feeReceipt->receipt_no=$ReceiptNo;
            $feeReceipt->student_info_id=$id;
            $feeReceipt->created_by=$user_id;
            $feeReceipt->session_year_id=$session_year_id;
            if(!empty($this->request->getData('cheque_date')))
            {
                $feeReceipt->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
            }
            $feeReceipt->receipt_date=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
            $feeReceipt->fee_receipt_rows = [];
             
            foreach ($this->request->getData('fee_type_master_rows') as $value) {
                if(!empty($value['fee_type_master_row_id']) && !empty($value['amount']) ){
                    $feeReceiptRows = $this->FeeReceipts->FeeReceiptRows->newEntity(); 
                    $feeReceiptRows->fee_type_master_row_id=@$value['fee_type_master_row_id'];
                    $feeReceiptRows->amount=@$value['amount'];
                    $feeReceiptRows->student_info_id=$id;
                    $feeReceipt->fee_receipt_rows[]=$feeReceiptRows;
                }
                
            }
            if ($this->FeeReceipts->save($feeReceipt)) {
                $receipt_id=$this->EncryptingDecrypting->encryptData($feeReceipt->id);
                $this->Flash->success(__('The fee receipt has been saved.'));
                if($this->request->getData('save')=='print')
                {
                    return $this->redirect(['controller'=>'FeeReceipts','action' => 'receiptPrint','Students','searchStudentAdhoc',$receipt_id,$student_info_id]);
                }
                else
                {
                    return $this->redirect(['controller'=>'Students','action' => 'searchStudentAdhoc']);
                }
            }

            $this->Flash->error(__('The fee receipt has not been saved.'));
        }
        ///////   Warning Message ///////
        $this->warningMsg($id,$session_year_id);
        ////////////////////////////////
        $SubmittedFee=$this->FeeReceipts->find()
                    ->contain(['FeeReceiptRows'=>['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes']]]])
                    ->where(['FeeReceipts.student_info_id'=>$id,'FeeReceipts.fee_category_id'=>5,'FeeReceipts.is_deleted'=>'N']);
                    //pr($SubmittedFee->toArray()); exit;
        $this->set(compact('FeeData', 'students', 'studentInfos','feeMonths','ReceiptNo','feeReceipt','SubmittedFee','id'));
    }

    public function annualFee($student_info_id= null)
    {
        $id = $this->EncryptingDecrypting->decryptData($student_info_id); 
        $feeReceipt = $this->FeeReceipts->newEntity();
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        
        $feeReceipts = $this->FeeReceipts->find();
        $feeReceipts->where(['session_year_id'=>$session_year_id]);
        $feeReceipts->where(['fee_category_id'=>4]);
        $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
        $feeReceipts = $feeReceipts->first();
        $ReceiptNo=$feeReceipts->receipt_no+1;

        $category_id = 4;
        $FeeReturnData=$this->FeeReceipt->admissionFee($id,$session_year_id,$category_id);

        $FeeData = $FeeReturnData['FeeData'];
        $studentInfos = $FeeReturnData['studentInfos'];
        $students = $FeeReturnData['students'];

        //-- Form Submit Query

        if ($this->request->is('post')) {
            
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData(),[ 'associated' => ['FeeReceiptRows'] ]);
            $feeReceipt->receipt_no=$ReceiptNo;
            $feeReceipt->student_info_id=$id;
            $feeReceipt->created_by=$user_id;
            $feeReceipt->session_year_id=$session_year_id;
            if(!empty($this->request->getData('cheque_date')))
            {
                $feeReceipt->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
            }
            $feeReceipt->receipt_date=date('Y-m-d',strtotime($this->request->getData('receipt_date')));
            $feeReceipt->fee_receipt_rows = [];
             
            foreach ($this->request->getData('fee_type_master_rows') as $value) {
                if(!empty($value['fee_type_master_row_id']) && !empty($value['amount']) ){
                    $feeReceiptRows = $this->FeeReceipts->FeeReceiptRows->newEntity(); 
                    $feeReceiptRows->fee_type_master_row_id=@$value['fee_type_master_row_id'];
                    $feeReceiptRows->amount=@$value['amount'];
                    $feeReceiptRows->student_info_id=$id;
                    $feeReceipt->fee_receipt_rows[]=$feeReceiptRows;
                }
                
            }
            if ($this->FeeReceipts->save($feeReceipt)) {
                $receipt_id=$this->EncryptingDecrypting->encryptData($feeReceipt->id);
                $this->Flash->success(__('The fee receipt has been saved.'));
                if($this->request->getData('save')=='print')
                {
                    return $this->redirect(['controller'=>'FeeReceipts','action' => 'receiptPrint','Students','searchStudentAnnual',$receipt_id,$student_info_id]);
                }
                else
                {
                    return $this->redirect(['controller'=>'Students','action' => 'searchStudentAnnual']);
                }
                
            }
            $this->Flash->error(__('The fee receipt has not been saved.'));
        }
        ///////   Warning Message ///////
        $this->warningMsg($id,$session_year_id);
        ////////////////////////////////
        $SubmittedFee=$this->FeeReceipts->find()
            ->contain(['FeeReceiptRows'=>['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes']]]])
            ->where(['FeeReceipts.student_info_id'=>$id,'FeeReceipts.fee_category_id'=>4,'FeeReceipts.is_deleted'=>'N']);
            //pr($SubmittedFee->toArray()); exit;
        $this->set(compact('FeeData', 'students', 'studentInfos','feeMonths','ReceiptNo','feeReceipt','SubmittedFee','id'));
    }
    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feeReceipt = $this->FeeReceipts->newEntity();
        if ($this->request->is('post')) {
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData());
            if ($this->FeeReceipts->save($feeReceipt)) {
                $this->Flash->success(__('The fee receipt has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fee receipt could not be saved. Please, try again.'));
        }
        $sessionYears = $this->FeeReceipts->SessionYears->find('list', ['limit' => 200]);
        $feeTypeReceipts = $this->FeeReceipts->FeeTypeReceipts->find('list', ['limit' => 200]);
        $students = $this->FeeReceipts->Students->find('list', ['limit' => 200]);
        $studentInfos = $this->FeeReceipts->StudentInfos->find('list', ['limit' => 200]);
        $this->set(compact('feeReceipt', 'sessionYears', 'feeTypeReceipts', 'students', 'studentInfos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fee Receipt id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feeReceipt = $this->FeeReceipts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData());
            if ($this->FeeReceipts->save($feeReceipt)) {
                $this->Flash->success(__('The fee receipt has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fee receipt could not be saved. Please, try again.'));
        }
        $sessionYears = $this->FeeReceipts->SessionYears->find('list', ['limit' => 200]);
        $feeTypeReceipts = $this->FeeReceipts->FeeTypeReceipts->find('list', ['limit' => 200]);
        $students = $this->FeeReceipts->Students->find('list', ['limit' => 200]);
        $studentInfos = $this->FeeReceipts->StudentInfos->find('list', ['limit' => 200]);
        $this->set(compact('feeReceipt', 'sessionYears', 'feeTypeReceipts', 'students', 'studentInfos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fee Receipt id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($action, $receipt_id, $student_info_id = null, $fee_type_role_ids = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($receipt_id); 
        $feeReceipt = $this->FeeReceipts->get($id, [
            'contain' => []
        ]);
        $feeReceipt = $this->FeeReceipts->patchEntity($feeReceipt, $this->request->getData());
        $feeReceipt->is_deleted='Y';
        $feeReceipt->deleted_remark=$this->request->getData('remark');
        $feeReceipt->delete_date=date('Y-m-d',strtotime($this->request->getData('delete_date')));
        if ($this->FeeReceipts->save($feeReceipt)) {

            $query = $this->FeeReceipts->FeeReceiptRows->query();
            $query->update()->set(['is_deleted' => 'Y'])
                  ->where(['fee_receipt_id' => $id])->execute();

            $this->Flash->success(__('The fee receipt has been deleted.'));
        } else {
            $this->Flash->error(__('The fee receipt could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller'=>'FeeReceipts','action' => $action,$student_info_id,$fee_type_role_ids]);
    }
    public function receiptPrint($controller,$action, $receipt_id, $student_info_id = null, $fee_type_role_ids = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($receipt_id); 
       
        $feeReceipt = $this->FeeReceipts->get($id, [
            'contain' => ['FeeTypeRoles','FeeCategories','SessionYears','StudentInfos'=>['StudentClasses','Mediums','Streams','Sections','ReceiptStudents'],'EnquiryFormStudents'=>['StudentClasses','Mediums','Streams'],'FeeReceiptRows'=>['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes'=>['FeeTypeRoles']]],'FeeTypeStudentMasters'=>['FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes'=>['FeeTypeRoles']]]]]]
        ]); 
       
        //echo system("lpr /path-to-file-to-print "); exit;
        $dir = new Folder();
        $path=WWW_ROOT.'print';
        $dir->chmod($path, 0777, true);
        $file =  tempnam($path, 'ctk');
        $handle = fopen($file, 'w');
        $total_fee=0; 
        $num_row=0;
        $data="";
        $i=0;
        $data.="\n";
        $data.="              ".$feeReceipt->receipt_no."           ".$feeReceipt->session_year->session_name."\n";
        if(!empty($feeReceipt->student_info))
        {
            $data.="     ".date('d-M-Y', strtotime($feeReceipt->receipt_date))."               ".$feeReceipt->student_info->receipt_student->scholar_no."\n";
            $data.="           ".$feeReceipt->student_info->receipt_student->name."\n";
              
            $data.="           ".$feeReceipt->student_info->receipt_student->father_name."\n";
            $data.="       ".$feeReceipt->student_info->student_class->roman_name." ".$feeReceipt->student_info->medium->name;
            if(!empty($feeReceipt->student_info->stream))
            {
                $data.=" ".$feeReceipt->student_info->stream->name;
            }
            if(!empty($feeReceipt->student_info->section))
            {
                $data.=" (".$feeReceipt->student_info->section->name.")";
            }
        }
        else if(!empty($feeReceipt->enquiry_form_student))
        {
            $data.="     ".date('d-M-Y', strtotime($feeReceipt->receipt_date))."               ".$feeReceipt->enquiry_form_student->admission_form_no."\n";
            $data.="           ".$feeReceipt->enquiry_form_student->name."\n";
              
            $data.="           ".$feeReceipt->enquiry_form_student->father_name."\n";
            $data.="       ".$feeReceipt->enquiry_form_student->student_class->roman_name." ".$feeReceipt->enquiry_form_student->medium->name;
            if(!empty($feeReceipt->enquiry_form_student->stream))
            {
                $data.=" ".$feeReceipt->enquiry_form_student->stream->name;
            }
        }
        else
        {
             $data.="     ".date('d-M-Y', strtotime($feeReceipt->receipt_date))."\n\n\n";
        }
        $data.="\n\n\n";
        foreach ($feeReceipt->fee_receipt_rows as $fee_receipt_row) 
        {

            if(!empty($fee_receipt_row->fee_type_student_master))
            {
                $fee_type_name=$fee_receipt_row->fee_type_student_master->fee_type_master_row->fee_type_master->fee_type->name;
            }
            else if(!empty($fee_receipt_row->fee_type_master_row))
            {
                $fee_type_name=$fee_receipt_row->fee_type_master_row->fee_type_master->fee_type->name;
            }
            else
            {
                $fee_type_name=(!empty($feeReceipt->fee_type_role_id))?'Old '.@$feeReceipt->fee_type_role->name:'Old '.$feeReceipt->fee_category->name;
            }
            if($feeReceipt->fee_category_id==1)
            {
                if(!empty($fee_receipt_row->fee_type_student_master))
                {
                    $FeeName[$fee_type_name][]=['month'=>$fee_receipt_row->fee_month->name,'amount'=>$fee_receipt_row->amount];
                }
                else
                {
                    $FeeName[$fee_type_name][]=['month'=>'','amount'=>$fee_receipt_row->amount];
                }
            }
            else
            {
                $FeeName[$fee_type_name][]=['month'=>'','amount'=>$fee_receipt_row->amount];
            }
        }
        
        
        foreach ($FeeName as $key => $value_data) 
        {
            $i++;
            $len=strlen($key);
            $data.="   ".$i." ".$key;
            for($j=$len; $j<=28; $j++)
            {
                $data.=" ";
            }
            $month=[];
            $amount=[];
            foreach ($value_data as $key => $value) {
                if($value['month']!='')
                {
                    $month[]=$value['month'];
                }
                
                $amount[]=$value['amount'];
            }
            $data.=array_sum($amount)."\n";
            $num_row++;
            if(!empty($month))
            {
                $data.="      (".implode(",", $month).")\n";
                $num_row++;
            }
        }
        /*if($feeReceipt->fee_category_id==1)
        {
            if(!empty($feeReceipt->concession_amount_1))
            {
                $data.="     Concession Tuition Fee        ".$feeReceipt->concession_amount_1."\n";
                $num_row++;
            }
            if(!empty($feeReceipt->concession_amount_2))
            {
                $data.="     Concession Bus Fee           ".$feeReceipt->concession_amount_2."\n";
                $num_row++;
            }
        }
        else
        {
            if(!empty($feeReceipt->concession_amount))
            {
                $data.="     Concession                   ".$feeReceipt->concession_amount."\n";
                $num_row++;
            }
        }*/
        if(!empty($feeReceipt->concession_amount))
        {
            if(!empty($feeReceipt->remark))
            {
                $data1=" ";
                $len1=strlen($feeReceipt->remark);
                for($j=$len1; $j<=14; $j++)
                {
                    $data1.=" ";
                }
                $data.="     Concession (".$feeReceipt->remark.")".$data1.$feeReceipt->concession_amount."\n";
            }
            else
            {
                $data.="     Concession                   ".$feeReceipt->concession_amount."\n";
            }
            $num_row++;
        }
        if(!empty($feeReceipt->fine_amount))
        {
            if(!empty($feeReceipt->remark))
            {
                $data1=" ";
                $len1=strlen($feeReceipt->remark);
                for($j=$len1; $j<=20; $j++)
                {
                    $data1.=" ";
                }
                $data.="     Fine (".$feeReceipt->remark.")".$data1.$feeReceipt->fine_amount."\n";
            }
            else
            {
                $data.="     Fine                         ".$feeReceipt->fine_amount."\n";
            }
            $num_row++;
        }
        if(empty($feeReceipt->student_info) && empty($feeReceipt->enquiry_form_student))
        {
            for($k=$num_row; $k<6; $k++)
            {
                $data.="\n";
            }
            if(!empty($feeReceipt->remark))
            {
                $data.="     (".$feeReceipt->remark.")\n";
            }
            else
            {
                $data.="\n";
            }
        }
        else
        {
            for($k=$num_row; $k<7; $k++)
            {
                $data.="\n";
            }
        }
        
        $data.="                                  ".$feeReceipt->total_amount."\n\n       ".$this->Numbers->convertNumberToWord($feeReceipt->total_amount)." Only.";
        
        if($feeReceipt->payment_type=='Cash')
        {
            $data.="\n Pay Mode- ".$feeReceipt->payment_type;
        }
        else if($feeReceipt->payment_type=='Cheque')
        {
            $data.="\n Cheque No.- ".$feeReceipt->cheque_no.", Bank Name- ".$feeReceipt->bank;
        }
        else
        {
            $data.="\n , Pay Mode- ".$feeReceipt->payment_type." Trans. No.- ".$feeReceipt->transaction_no;
        }
        fwrite($handle, $data);
        fclose($handle);
        system('print '.$file);
        unlink($file);

        /*$html = new HtmlHelper(new \Cake\View\View());
        $url = Router::Url(['controller' => 'Students', 'action' => 'feeStructureView',$student_info_id], true);
        print $html->scriptBlock('if(confirm("Do you want to print Fee Card?") == true){window.open("'.$url.'", "_blank")}');
        $url_same = Router::Url(['controller' => $controller, 'action' => $action,$student_info_id,$fee_type_role_ids], true);*/
        return $this->redirect(['controller'=>$controller,'action' => $action,$student_info_id,$fee_type_role_ids]);
        //print $html->scriptBlock('window.open("'.$url_same.'", "_self");');
        
    }
    public function receiptPrintLasser($controller,$action, $receipt_id, $student_info_id = null, $fee_type_role_ids = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($receipt_id); 
         $this->viewBuilder()->setLayout('');
        $feeReceipt = $this->FeeReceipts->get($id, [
            'contain' => ['FeeTypeRoles','FeeCategories','SessionYears','StudentInfos'=>['StudentClasses','Mediums','Streams','Sections','ReceiptStudents'=>function($q){
                    return $q->contain(['DocumentClassMappings'=>['Documents'],'StudentDocuments']);
            }],'EnquiryFormStudents'=>['StudentClasses','Mediums','Streams'],'FeeReceiptRows'=>['FeeMonths','FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes'=>['FeeTypeRoles']]],'FeeTypeStudentMasters'=>['FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes'=>['FeeTypeRoles']]]]]]
        ]); 

               
        $document_class_mapping_id=[];
        $document_class_student_id=[];
        foreach ($feeReceipt->student_info->receipt_student->document_class_mappings as $document_class_mapping) 
        {
            $document_class_mapping_id[]=$document_class_mapping->id;
        }
        foreach ($feeReceipt->student_info->receipt_student->student_documents as $student_document)
        {
            if(!empty($student_document->document_class_mapping_id))
            {
                $document_class_student_id[]=$student_document->document_class_mapping_id;
            }
        }
        $result = array_diff($document_class_mapping_id, $document_class_student_id);
        foreach ($feeReceipt->student_info->receipt_student->document_class_mappings as $dkey=>$document_class_mapping) 
        {
            $document_class_mapping->id;
            if(!in_array($document_class_mapping->id,$result))
            {
                unset($feeReceipt->student_info->receipt_student->document_class_mappings[$dkey]);
            }
        }
        $school = $this->FeeReceipts->StudentInfos->Students->Schools->find()->first();
        
        $this->set(compact('feeReceipt','school','controller','action','student_info_id','fee_type_role_ids'));
        
    }

}
