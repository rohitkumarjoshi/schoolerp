<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use Cake\View\View;
use Cake\View\Helper\HtmlHelper;
use Cake\View\Helper\FormHelper;
use Cake\I18n\Date;
/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 *
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
        $this->Security->setConfig('unlockedActions', ['studentLedger','editStudent','getStudent']);
    } 


     public function getDetail($student_id = null, $id = null)
    {
        $session_year_id = $this->Auth->User('session_year_id');

        $session_year_name=$this->Students->SessionYears->find()
        ->select(['session_year_name'])
        ->where(['SessionYears.id'=>$session_year_id]);

        foreach ($session_year_name as $session_name) {
            $year_name=$session_name->session_year_name;
        }

        $id = $this->EncryptingDecrypting->decryptData($id);
        //pr($id);exit;
        $student_id = $this->EncryptingDecrypting->decryptData($student_id);
        //pr($id);exit;

        $studentDocumentPhotos = $this->Students->StudentDocuments->find()->where(['StudentDocuments.student_id'=>$student_id,'document_class_mapping_id Is NULL']);

        $fees=$this->Students->StudentInfos->FeeReceipts->find();
        //pr($fees->toArray());exit;

        $personal_infos=$this->Students->StudentInfos->find()->where(['StudentInfos.id'=>$id])
        ->contain(['Students'=>['Genders','StudentDocuments'],'StudentClasses','Sections']);

        $achivements=$this->Students->StudentAchivements->find()->where(['StudentAchivements.student_id'=>$student_id,'StudentAchivements.is_deleted'=>'N'])->contain(['AchivementCategories']);

        $hostels=$this->Students->HostelRegistrations->find()->where(['HostelRegistrations.student_id'=>$student_id,'HostelRegistrations.is_deleted'=>'N'])->contain(['Hostels','Rooms']);


        for ($i = 1; $i <= 12; $i++)
        {
            $F_date=$year_name.'-'.$i.'-01';
            $first_date=date('Y-m-d',strtotime($F_date));
            $last_date=date('Y-m-t',strtotime($F_date));

                $attendances[$i]=$this->Students->StudentInfos->Attendances->find()
            ->select(['first_half','second_half'])
            ->where(['Attendances.student_info_id'=>$id,'Attendances.attendance_date >=' => $first_date,'Attendances.attendance_date <=' => $last_date])->toArray();
            

         }

        //pr($attendances);exit;
 
        //sprintf('%02s', $i);


        $this->set(compact('personal_infos','achivements','year_name','studentDocumentPhotos','first_date','last_date','attendances','hostels'));
    }
	
	public function createlogin(){
		
		 $user_id = $this->Auth->User('id');
         $session_year_id = $this->Auth->User('session_year_id');
		 
		 /*   $StudentInfos=$this->Students->StudentInfos->find()->contain(['Students'])->toArray();
		
		 foreach($StudentInfos as $Student){
			$random=(string)mt_rand(1000,9999);
			$student_id=$Student->student_id;
			$scholar_no=$Student->student->scholar_no;
			$Users=$this->Students->Users->newEntity();
			$Users->student_id=$student_id;
			$Users->user_type='Student';
			$Users->username=$scholar_no;
			$Users->password='alok'.$random;
			$Users->passwordnew='alok'.$random;
			$this->Students->Users->save($Users);
				
		} 
		
		exit; */
		
		  $StudentInfosnew=[];
		  if(!empty($this->request->getQuery('student_class_id')) || !empty($this->request->getQuery('section_id'))){
			$StudentInfosnew=$this->Students->StudentInfos->find();
		  }
		if(!empty($this->request->getQuery('student_class_id'))){
			$StudentInfosnew->where(['StudentInfos.student_class_id'=>$this->request->getQuery('student_class_id')])->contain(['Users','Students']);
			 $student_class_id=$this->request->getQuery('student_class_id');
		}
		if(!empty($this->request->getQuery('section_id'))){
			$StudentInfosnew->where(['StudentInfos.section_id'=>$this->request->getQuery('section_id')])->contain(['Users','Students']);
			 $section_id=$this->request->getQuery('section_id');
		}
		//pr($StudentInfosnew->toArray()); exit;
		$this->loadmodel('StudentClasses');
		$this->loadmodel('Sections');
		$studentClasses = $this->StudentClasses->find('list')->where(['is_deleted'=>'N']);
		$sections = $this->Sections->find('list')->where(['is_deleted'=>'N']);
		
		$this->set(compact('sections','studentClasses','StudentInfosnew','student_class_id','section_id'));
		
		
		
		
		 
	}
	
    public function promoteStudent()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $next_session_year_id = $this->request->getData('next_session_year_id');
            $student_class_id = $this->request->getData('student_class_id');
            $studentInfos = $this->Students->AllStudentInfos->find();
                $studentInfos->where(['AllStudentInfos.student_class_id IN'=>$student_class_id]);
                $studentInfos->contain(['StudentClasses','Students'=>function($q)use($session_year_id){
                    return $q->notMatching('TransferCertificates',function($q)use($session_year_id){
                                return $q->where(['tc_status'=>'Success','TransferCertificates.session_year_id'=>$session_year_id]);
                            });
                }]);
        
            foreach ($studentInfos as $studentInfo) 
            {
                $order_of_class = $studentInfo->student_class->order_of_class;
                $studentClass = $this->Students->StudentInfos->StudentClasses->find()->where(['order_of_class'=>$order_of_class+1])->first();
                
                if(empty($studentClass))
                {
                    $next_class_id = $studentInfo->student_class_id;
                }
                else if($studentInfo->student_status != 'Continue')
                {
                    $next_class_id = $studentInfo->student_class_id;
                }
                else
                {
                    $next_class_id = $studentClass->id;
                }
                $studentInfoSave = $this->Students->StudentInfos->newEntity();
                $studentInfoSave->student_id = $studentInfo->student_id;
                $studentInfoSave->session_year_id = $next_session_year_id;
                $studentInfoSave->permanent_address = $studentInfo->permanent_address;
                $studentInfoSave->correspondence_address = $studentInfo->correspondence_address;
                $studentInfoSave->minority = $studentInfo->minority;
                $studentInfoSave->local_guardian = $studentInfo->local_guardian;
                $studentInfoSave->guardian_address = $studentInfo->guardian_address;
                $studentInfoSave->guardian_pincode = $studentInfo->guardian_pincode;
                $studentInfoSave->guardian_mobile_no = $studentInfo->guardian_mobile_no;
                $studentInfoSave->roll_no = $studentInfo->roll_no;
                $studentInfoSave->hostel_facility = $studentInfo->hostel_facility;
                $studentInfoSave->living = $studentInfo->living;
                $studentInfoSave->hostel_this_year = $studentInfo->hostel_this_year;
                $studentInfoSave->fee_type_role_id = $studentInfo->fee_type_role_id;
                $studentInfoSave->bus_facility = $studentInfo->bus_facility;
                $studentInfoSave->vehicle_station_id = $studentInfo->vehicle_station_id;
                $studentInfoSave->reservation_category_id = $studentInfo->reservation_category_id;
                $studentInfoSave->state_id = $studentInfo->state_id;
                $studentInfoSave->city_id = $studentInfo->city_id;
                $studentInfoSave->email = $studentInfo->email;
                $studentInfoSave->rte = $studentInfo->rte;
                $studentInfoSave->aadhaar_no = $studentInfo->aadhaar_no;
                $studentInfoSave->caste_id = $studentInfo->caste_id;
                $studentInfoSave->religion_id = $studentInfo->religion_id;
                $studentInfoSave->student_class_id = $next_class_id;
                $studentInfoSave->medium_id = $studentInfo->medium_id;
                $studentInfoSave->section_id = $studentInfo->section_id;
                $studentInfoSave->stream_id = $studentInfo->stream_id;
                $studentInfoSave->house_id = $studentInfo->house_id;
                $studentInfoSave->student_parent_profession_id = $studentInfo->student_parent_profession_id;
                $studentInfoSave->vehicle_id = $studentInfo->vehicle_id;
                $studentInfoSave->hostel_id = $studentInfo->hostel_id;
                $studentInfoSave->room_id = $studentInfo->room_id;
                //$studentInfoSave->hostel_tc_nodues = $studentInfo->hostel_tc_nodues;
                //$studentInfoSave->hostel_tc_date = h($studentInfo->hostel_tc_date);
                $studentInfoSave->student_status = $studentInfo->student_status;
                $studentInfoSave->created_by = $user_id;
                $this->Students->StudentInfos->save($studentInfoSave);
            }
            $this->Flash->success(__('The student has been prometed.'));
            return $this->redirect(['action' => 'promoteStudent']);
        }
        $sessionYears = $this->Students->SessionYears->find('list')->order(['id'=>'DESC'])->limit(1);
        $studentClasses = $this->Students->StudentInfos->StudentClasses->find('list')->order(['order_of_class'=>'ASC']);
        $this->set(compact('sessionYears','studentClasses'));
    }
    public function promoteOldFees()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $next_session_year_id = $this->request->getData('next_session_year_id');
            $student_class_id = $this->request->getData('student_class_id');
            $studentInfos = $this->Students->AllStudentInfos->find();
                $studentInfos->where(['AllStudentInfos.student_class_id IN'=>$student_class_id]);
                $studentInfos->contain(['StudentClasses','Students'=>function($q)use($session_year_id){
                    return $q->notMatching('TransferCertificates',function($q)use($session_year_id){
                                return $q->where(['tc_status'=>'Success','TransferCertificates.session_year_id'=>$session_year_id]);
                            });
                }]);

            foreach ($studentInfos as $studentInfo) 
            {
                $query = $this->Students->OldFees->query();
                    $query->delete()
                        ->where(['session_year_id' => $next_session_year_id,
                                    'student_id' => $studentInfo->student_id
                                ])
                        ->execute();
                $pendingFees=$this->FeeReceipt->promotePendingFee($studentInfo->id,$session_year_id);
                
                foreach ($pendingFees as $key => $value) 
                {
                    if($value > 0)
                    {
                        $oldFeesSave = $this->Students->OldFees->newEntity();
                        $oldFeesSave->student_id = $studentInfo->student_id;
                        $oldFeesSave->due_session_year = $session_year_id;
                        $oldFeesSave->session_year_id = $next_session_year_id;
                        $oldFeesSave->fee_category_id = $key;
                        $oldFeesSave->fee_type_role_id = 0;
                        $oldFeesSave->due_amount = $value;
                        $this->Students->OldFees->save($oldFeesSave);
                    }
                }
                
                
            }
            $this->Flash->success(__('The due fees has been prometed.'));
            return $this->redirect(['action' => 'promoteOldFees']);
        }
        $sessionYears = $this->Students->SessionYears->find('list')->order(['id'=>'DESC'])->limit(1);
        $studentClasses = $this->Students->StudentInfos->StudentClasses->find('list')->order(['order_of_class'=>'ASC']);
        $this->set(compact('sessionYears','studentClasses'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $total_enquiry=$this->Students->EnquiryForms->find()->where(['enquiry_no >'=>0])->count();
        $total_admission_form=$this->Students->EnquiryForms->find()->where(['admission_form_no >'=>0])->count();
        $date = Date::now();
        $now_date=$date->i18nFormat('yyyy-MM-dd');
        $dailyAmounts=$this->Students->StudentInfos->FeeReceipts->find()->where(['receipt_date'=>$now_date]);
        $dailyAmounts->select(['daily_amount'=>$dailyAmounts->func()->sum('total_amount')]);
        //pr($dailyAmount->toArray()); exit;
        $total_admission=$this->Students->EnquiryForms->find()->where(['admission_generated'=>'Y'])->count();
        $attendances=$this->Students->StudentInfos->Attendances->find()
        ->contain(['StudentInfos'=>['Students','Mediums','StudentClasses','Sections']])
        ->where(['Attendances.attendance_date'=>$date,'Attendances.is_deleted'=>'N'])
        ->autoFields(true);

        $present_std = $attendances->newExpr()
                ->addCase(
                    $attendances->newExpr()->add(['Attendances.first_half' => 0.5]),
                    1,
                    'integer'
                );
        $total_std = $attendances->newExpr()
        ->addCase(
            $attendances->newExpr()->add(['StudentInfos.student_id']),
            1,
            'integer'
        );
            $attendances->select([
                'present_std' => $attendances->func()->count($present_std),
                'total_std' => $attendances->func()->count($total_std)
            ]);
        //pr($attendances->toArray());exit;
        $leaves=$this->Students->Leaves->find()
        ->select(['pending_leave'=>'count(Leaves.id)'])
        ->where(['Leaves.is_deleted'=>'N','Leaves.employee_id IS NOT NULL','Leaves.status'=>'Pending']);
        //pr($leaves->toArray());exit;

        $feedbacks=$this->Students->Feedbacks->find()
        ->select(['total'=>'count(Feedbacks.id)'])
        ->where(['Feedbacks.is_deleted'=>'N']);
        //pr($feedbacks->toArray());exit; 

        $notices=$this->Students->SessionYears->Notices->find()
        ->select(['total'=>'count(Notices.id)'])
        ->where(['Notices.valid_to >='=>date('Y-m-d')]);

        $holidays=$this->Students->SessionYears->AcademicCalenders->find()->where(['AcademicCalenders.is_deleted'=>'N','AcademicCalenders.academic_category_id'=>2,'AcademicCalenders.date >='=>date('Y-m-d')]);

         $alok_kids=$this->Students->SessionYears->AcademicCalenders->find()->where(['AcademicCalenders.is_deleted'=>'N','AcademicCalenders.academic_category_id'=>5,'AcademicCalenders.date >='=>date('Y-m-d')]);
        //pr($holidays->toArray());exit;

        $events=$this->Students->SessionYears->AcademicCalenders->find()->where(['AcademicCalenders.is_deleted'=>'N','AcademicCalenders.academic_category_id'=>3,'AcademicCalenders.date >='=>date('Y-m-d')]);


        $this->set(compact('total_enquiry','total_admission','total_admission_form','dailyAmounts','attendances','leaves','feedbacks','holidays','events','alok_kids','notices'));
    }
    public function getStudent()
    {
        $value = $this->request->getData('value');
        $response = $this->Students->find()->select(['key'=>'Students.id','text'=>'Students.name','scholar_no'=>'Students.scholar_no'])->where(['name LIKE'=>'%'.$value.'%'])->distinct('name')->where(['name IS NOT NULL'])->innerJoinWith('StudentInfos');
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response']);
    }
    public function getStudentTutionCertificate()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    $data.=$html->link('View',['controller'=>'Students','action'=>'tutionFeeCertificateView',$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function searchOldFeeStudent()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='';
        $this->set(compact('StudentClasses','fee_type'));
    }
    public function getOldStudentData()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $fee_type=$this->request->getData('fee_type');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        },'OldFees'=>['FeeCategories']])
        ->innerJoinWith('OldFees')      
        ->group('Students.id');  
        $feeTypeRoles=$this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    foreach ($studentsForm->old_fees as $old_fee) 
                    {
                        $fee_collection=$old_fee->fee_category->fee_collection;
                        $fee_category_name=$old_fee->fee_category->name;
                        $fee_category_id = $this->EncryptingDecrypting->encryptData($old_fee->fee_category->id);
                        if($fee_collection == 'Individual')
                        {
                            foreach ($feeTypeRoles as $feeTypeRole) {
                               if($old_fee->fee_type_role_id==$feeTypeRole->id)
                               {
                                    $old_fee_id = $this->EncryptingDecrypting->encryptData($old_fee->id);
                                    
                                    $data.=$html->link('Old '.$feeTypeRole->name,['controller'=>'FeeReceipts','action'=>'old_fee',$id,$old_fee_id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                               }
                                
                            }
                        }
                        else
                        {
                            $old_fee_id = $this->EncryptingDecrypting->encryptData($old_fee->id);
                            $data.=$html->link('Old '.$fee_category_name,['controller'=>'FeeReceipts','action'=>'old_fee',$id,$old_fee_id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                        }
                        $data.=" ";
                    }
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function searchStudent()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='monthlyFee';
        $this->set(compact('StudentClasses','fee_type'));
    }
    public function studentDetail()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='monthlyFee';
        $this->set(compact('StudentClasses','fee_type'));
    }
    public function getStudentData()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $fee_type=$this->request->getData('fee_type');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        $feeCategories=$this->Students->StudentInfos->FeeReceipts->FeeCategories->get(1);
        $feeTypeRoles=$this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $fee_collection=$feeCategories->fee_collection;
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            $student_id=$this->EncryptingDecrypting->encryptData($studentsForm->id);
            //pr($student_id);exit;
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    if($fee_collection == 'Individual')
                    {
                        foreach ($feeTypeRoles as $feeTypeRole) {
                            $fee_type_role_id = $this->EncryptingDecrypting->encryptData($feeTypeRole->id);
                            
                            
                            $data.=$html->link($feeTypeRole->name,['controller'=>'FeeReceipts','action'=>$fee_type,$id,$fee_type_role_id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                        }
                    }
                    else
                    {
                        $data.=$html->link('Get Fee',['controller'=>'FeeReceipts','action'=>$fee_type,$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                    }
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function getStudentData1()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $fee_type=$this->request->getData('fee_type');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        @$feeCategories=$this->Students->StudentInfos->FeeReceipts->FeeCategories->get(1);
       @ $feeTypeRoles=$this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        @$fee_collection=$feeCategories->fee_collection;
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            $student_id=$this->EncryptingDecrypting->encryptData($studentsForm->id);
            //pr($student_id);exit;
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    if($fee_collection == 'Individual')
                    {
                        foreach ($feeTypeRoles as $feeTypeRole) {
                            $fee_type_role_id = $this->EncryptingDecrypting->encryptData($feeTypeRole->id);
                            
                            
                            $data.=$html->link('View',['controller'=>'Students','action'=>'getDetail',$student_id,$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                        }
                    }
                    else
                    {
                      
                        $data.=$html->link('View',['controller'=>'Students','action'=>'getDetail',$student_id,$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                    }
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function searchHostelStudent()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='hostelFee';
        $this->set(compact('StudentClasses','fee_type'));
    }
    public function getHostelStudentData()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $fee_type=$this->request->getData('fee_type');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id,'hostel_facility'=>'Yes','hostel_this_year'=>'Yes'])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
       
        $response=[];
        $sr_no=1;
        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $response[]='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                        <td style="text-align:center !important;">'.$html->link('Get Fee',['controller'=>'FeeReceipts','action'=>$fee_type,$id],['escape'=>false,'class'=>'btn btn-xs btn-info']).'</td>
                        </tr>
                   ';
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function admissionForm()
    {
    }
    public function exportAdmissionFormReport()
    {
         $this->viewBuilder()->layout('');
        $session_year_id = $this->Auth->User('session_year_id');
        $enquiryFormStudents = $this->Students->EnquiryForms->find();
        $enquiryFormStudents->where(['EnquiryForms.session_year_id'=>$session_year_id,'admission_form_no >'=>0])->contain(['Genders','Mediums','StudentClasses']);
       
        $this->set(compact('enquiryFormStudents','studentClasses','enquiryStatuses'));
    }
    public function admissionFormReport()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $enquiryFormStudents = $this->Students->EnquiryForms->find();
        if ($this->request->is(['post'])) {
            $student_class_id=$this->request->getData('student_class_id');
            if(!empty($student_class_id))
            {
                $enquiryFormStudents->where(['student_class_id' => $student_class_id]);
            }
            $entrance_exam_resulte=$this->request->getData('entrance_exam_resulte');
            if(!empty($entrance_exam_resulte))
            {
                $enquiryFormStudents->where(['entrance_exam_resulte' => $entrance_exam_resulte]);
            }
            $admission_generated=$this->request->getData('admission_generated');
            if(!empty($admission_generated))
            {
                $enquiryFormStudents->where(['admission_generated' => $admission_generated]);
            }
        }
        $enquiryFormStudents->where(['EnquiryForms.session_year_id'=>$session_year_id,'admission_form_no >'=>0])->contain(['Genders','Mediums','StudentClasses','Streams']);
        $studentClasses  = $this->Students->StudentInfos->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('enquiryFormStudents','studentClasses','enquiryStatuses'));
    }
    public function formFeeSearch()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $this->set(compact('StudentClasses'));
    }
    
    public function getEnquiryData()
    {
        $success = 0;
        $session_year_id=$this->Auth->User('session_year_id');
        $enquiryForms=$this->Students->EnquiryForms->find()->contain(['StudentClasses']);
        $enquiryForms->where(['EnquiryForms.session_year_id'=>$session_year_id]);


        $class_id=$this->request->getData('class_id');
        $enquiry_no=$this->request->getData('enquiry_no');
        $admission_form_no=$this->request->getData('admission_form_no');
        $name=$this->request->getData('name');
        $father_name=$this->request->getData('father_name');
        if(!empty($class_id))
        {
            $enquiryForms->where(['student_class_id'=>$class_id]);
        }
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
                return $exp->like('EnquiryForms.name', '%'.$name.'%');
            });
        }
        if(!empty($father_name))
        {
            $enquiryForms->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('father_name', '%'.$father_name.'%');
            });
        }
        
        //$enquiryForms->where(['enquiry_status IN'=>['Approved','']]);
        
        $response=[];
        $sr_no=1;
        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($enquiryForms as $enquiryForm) {
            $success = 1;

            $id = $this->EncryptingDecrypting->encryptData($enquiryForm->id);
            $enrance_exam='';
            if($enquiryForm->admission_form_no > 0)
            {
                $enrance_exam='&nbsp;'.$html->link(__('Exam'), ['controller'=>'EntranceExamResults','action'=>'index', $id],['class'=>'btn btn-info btn-xs','escape'=>false, 'data-widget'=>'Entrance Exam', 'data-toggle'=>'tooltip', 'data-original-title'=>'Entrance Exam']);
                $enrance_exam.='&nbsp;'.$html->link(__('View'), ['controller'=>'Students','action'=>'admissionFormView', $id],['class'=>'btn btn-info btn-xs','escape'=>false, 'data-widget'=>'Admission Form', 'data-toggle'=>'tooltip', 'data-original-title'=>'Admission Form']);
            }
            $response[]='<tr>
                    <td style="text-align:center;">'.$sr_no++.'</td>
                    <td style="text-align:center;">'.$enquiryForm->student_class->name.'</td>
                    <td style="text-align:center;">'.$enquiryForm->enquiry_no.'</td>
                    <td style="text-align:center;">'.$enquiryForm->admission_form_no.'</td>
                    <td>'.$enquiryForm->name.'</td>
                    <td>'.$enquiryForm->father_name.'</td>
                    <td>'.$enquiryForm->entrance_exam_resulte.'</td>
                    <td style="text-align:left;">'.$html->link('Form Fee',['controller'=>'FeeReceipts','action'=>'formFee',$id],['escape'=>false,'class'=>'btn btn-info btn-xs']).$enrance_exam.'</td>
                    </tr>';
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="8"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function admissionFormView($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $session_year_id=$this->Auth->User('session_year_id');
        $enquiryFormStudent = $this->Students->EnquiryForms->get($id, [
            'contain' => ['SessionYears','Genders','Mediums','StudentClasses','Streams','LastMediums','LastClasses','LastStreams','StudentFatherProfessions'=>['StudentParentProfessions'],'StudentMotherProfessions'=>['StudentParentProfessions'],'ReservationCategories','StudentDocuments'=>['DocumentClassMappings'=>['Documents']]]
        ]);
        $studentDocumentPhotos = $this->Students->DocumentClassMappings->StudentDocuments->find()->where(['enquiry_form_student_id'=>$id,'document_class_mapping_id Is'=>null])->first();
        $school = $this->Students->Schools->find()->first();
        $this->set(compact('enquiryFormStudent','studentDocumentPhotos','school'));
    }
    public function admissionFeeSearch()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $this->set(compact('StudentClasses'));
    }

    public function getEnquiryDataForAdmission()
    {
        $success = 0;
        $session_year_id=$this->Auth->User('session_year_id');
        //-- Enquiry
        $enquiryForms=$this->Students->EnquiryForms->find()->contain(['StudentClasses']);
        $enquiryForms->where(['EnquiryForms.session_year_id'=>$session_year_id,'EnquiryForms.admission_form_no >'=>0]);

        $class_id=$this->request->getData('class_id');
        $enquiry_no=$this->request->getData('enquiry_no');
        $admission_form_no=$this->request->getData('admission_form_no');
        $name=$this->request->getData('name');
        $father_name=$this->request->getData('father_name');
        //- Student
        $students=$this->Students->find();         
        if(!empty($class_id))
        {
            $enquiryForms->where(['student_class_id'=>$class_id]);
        }
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
                return $exp->like('EnquiryForms.name', '%'.$name.'%');
            });
        }
        if(!empty($father_name))
        {
            $enquiryForms->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('father_name', '%'.$father_name.'%');
            });
        }
        $enquiryForms->where(['admission_generated'=>'N','admission_form_no >'=>0]);

        $students->contain(['EnquiryFormStudents','StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
            $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
            if(!empty($class_id))
            {
                $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
            }
            return $studentInfos;
        }]); 

        $response=[];
        $sr_no=1;
        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($enquiryForms as $enquiryForm) {
            $success = 1;
            $id = $this->EncryptingDecrypting->encryptData($enquiryForm->id);
            $response[]='<tr>
                    <td style="text-align:center;">'.$sr_no++.'</td>
                    <td style="text-align:center;">'.$enquiryForm->student_class->name.'</td>
                    <td style="text-align:center;">'.$enquiryForm->enquiry_no.'</td>
                    <td style="text-align:center;">'.$enquiryForm->admission_form_no.'</td>
                    <td>'.$enquiryForm->name.'</td>
                    <td>'.$enquiryForm->father_name.'</td>
                    <td style="text-align:center;">'.$html->link('Convert to Admission',['controller'=>'FeeReceipts','action'=>'convertToAdmission',$id],['escape'=>false,'class'=>'btn btn-xs btn-primary']).'</td>
                    </tr>';
        }
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $response[]='
                    <tr>
                        <td style="text-align:center;">'.$sr_no++.'</td>
                        <td style="text-align:center;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center;">'.$studentsForm->enquiry_form_student->enquiry_no.'</td>
                        <td style="text-align:center;">'.$studentsForm->enquiry_form_student->admission_form_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                        <td style="text-align:center;">'.$html->link('Converted',['controller'=>'FeeReceipts','action'=>'admissionFee',$id],['escape'=>false,'class'=>'btn btn-xs btn-info']).'</td>
                    </tr>
                   ';
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="7"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function searchStudentAdhoc()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='adhocFee';
        $this->set(compact('StudentClasses','fee_type'));
    }

    public function searchStudentAnnual()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='annualFee';
        $this->set(compact('StudentClasses','fee_type'));
    }


    public function getStudentDataAdhoc()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $fee_type=$this->request->getData('fee_type');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        $feeCategories=$this->Students->StudentInfos->FeeReceipts->FeeCategories->get(1);
        $feeTypeRoles=$this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $fee_collection=$feeCategories->fee_collection;
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    $data.=$html->link('Get Fee',['controller'=>'FeeReceipts','action'=>$fee_type,$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function studentSearch()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='editStudent';
        $this->set(compact('StudentClasses','fee_type'));
    }

    public function getStudentDataEdit()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $fee_type=$this->request->getData('fee_type');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['AllStudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['AllStudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['AllStudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        /*$feeCategories=$this->Students->StudentInfos->FeeReceipts->FeeCategories->get(1);
        $feeTypeRoles=$this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $fee_collection=$feeCategories->fee_collection;*/
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->all_student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($studentsForm->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    $data.=$html->link('Edit Student',['controller'=>'Students','action'=>$fee_type,$id],['escape'=>false,'class'=>' btn btn-xs btn-info']);
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function getStudentDataWise()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $fee_type=$this->request->getData('fee_type');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($studentsForm->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    $data.=$html->link('View',['controller'=>'Students','action'=>'studentWisePayment',$id],['escape'=>false,'class'=>' btn btn-xs btn-info']);
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Genders', 'SessionYears', 'AdmissionClasses', 'AdmissionMediums', 'AdmissionStreams', 'Disabilities', 'LastClasses', 'LastStreams', 'LastMediums', 'BookIssueReturns', 'FeeReceipts', 'FeeTypeStudentMasters', 'HostelAttendances', 'HostelOutPasses', 'HostelRegistrations', 'HostelStudentAssets', 'ItemIssueReturns', 'LibraryStudentInOuts', 'MessAttendances', 'StudentAchivements', 'StudentDocuments', 'StudentInfos', 'StudentRedDiaries', 'StudentSiblings', 'VehicleFeedbacks', 'VehicleStudentAttendances']
        ]);

        $this->set('student', $student);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $genders = $this->Students->Genders->find('list');
        $sessionYears = $this->Students->SessionYears->find('list');
        $admissionClasses = $this->Students->AdmissionClasses->find('list');
        $admissionMedia = $this->Students->AdmissionMedia->find('list');
        $admissionStreams = $this->Students->AdmissionStreams->find('list');
        $disabilities = $this->Students->Disabilities->find('list');
        $lastClasses = $this->Students->LastClasses->find('list');
        $lastStreams = $this->Students->LastStreams->find('list');
        $lastMedia = $this->Students->LastMedia->find('list');
        $this->set(compact('student', 'genders', 'sessionYears', 'admissionClasses', 'admissionMedia', 'admissionStreams', 'disabilities', 'lastClasses', 'lastStreams', 'lastMedia'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editStudent($id = null,$controller = null,$action = null,$fee_type_role_ids = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $session_year_id=$this->Auth->User('session_year_id');
        $user_id=$this->Auth->User('id');
        
        $student = $this->Students->get($id, [
            'contain' => ['StudentFatherProfessions','StudentMotherProfessions','StudentInfos'=>function($q)use($session_year_id){
                return $q->where(['StudentInfos.session_year_id'=>$session_year_id]);
            }]
        ]);
        $student_mother=[];
        foreach ($student->student_mother_professions as $student_mother_profession) 
        {
            $student_mother[]=$student_mother_profession->student_parent_profession_id;
        }
        $student_father=[];
        foreach ($student->student_father_professions as $student_father_profession) 
        {
            $student_father[]=$student_father_profession->student_parent_profession_id;
        }

        $student_id=$student->id;
        $studentDocumentPhotos = $this->Students->DocumentClassMappings->StudentDocuments->find()->where(['student_id'=>$student_id,'document_class_mapping_id Is'=>null])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $student = $this->Students->patchEntity($student, $this->request->getData());
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
            $student->name =$name;
            $student->name_separate =$name_separate;
            if(!empty($this->request->getData('registration_date')))
            {
                $student->registration_date=date('Y-m-d',strtotime($this->request->getData('registration_date')));
            }
            if(!empty($this->request->getData('dob')))
            {
                $student->dob=date('Y-m-d',strtotime($this->request->getData('dob')));
            }
			//pr($student); exit;
            if ($this->Students->save($student)) {
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
                $student_father_result = array_merge(array_diff($student_father_professions, $student_father), array_diff($student_father, $student_father_professions));

                foreach ($student_father_result as $key => $value) {
                     $query = $this->Students->StudentFatherProfessions->query();
                    $query->delete()
                        ->where(['student_id' => $id,
                                    'student_parent_profession_id'=>$value
                                ])
                        ->execute();
                }
                
                $student_mother_result = array_merge(array_diff($student_mother_professions, $student_mother), array_diff($student_mother, $student_mother_professions));
                foreach ($student_mother_result as $key => $value) {
                     $query = $this->Students->StudentMotherProfessions->query();
                    $query->delete()
                        ->where(['student_id' => $id,
                                    'student_parent_profession_id'=>$value
                                ])
                        ->execute();
                }
               
                foreach ($student_father_professions as $key => $value) 
                {
                    $studentFatherProfessions = $this->Students->StudentFatherProfessions->find()->where(['student_id'=>$id,'student_parent_profession_id'=>$value])->first();
                    if(empty($studentFatherProfessions))
                    {
                        $query = $this->Students->StudentFatherProfessions->query();
                        $query->insert(['student_id', 'student_parent_profession_id'])
                            ->values([
                                'student_id' => $id,
                                'student_parent_profession_id' => $value
                            ])
                            ->execute();
                    }

                }
                foreach ($student_mother_professions as $key => $value) 
                {
                    $studentMotherProfessions = $this->Students->StudentMotherProfessions->find()->where(['student_id'=>$id,'student_parent_profession_id'=>$value])->first();
                    if(empty($studentMotherProfessions))
                    {
                        $query = $this->Students->StudentMotherProfessions->query();
                        $query->insert(['student_id', 'student_parent_profession_id'])
                            ->values([
                                'student_id' => $id,
                                'student_parent_profession_id' => $value
                            ])
                            ->execute();
                    }
                }
                $student_photo=$this->request->getData('student_photo');
                if(!empty($student_photo))
                {
                    $image_parts = explode(";base64,", $student_photo);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $setNewFileName = time().rand();
                    $file_name = $setNewFileName.'.'.$image_type;
                    if(empty(@$studentDocumentPhotos))
                    {
                        $studentDocuments =$this->Students->DocumentClassMappings->StudentDocuments->newEntity();
                        $studentDocuments->student_id = $student->id;
                        $studentDocuments->image_path = $file_name;
                        $studentDocuments->session_year_id = $session_year_id;
                        $studentDocuments->created_by=$user_id;
                        if($this->Students->DocumentClassMappings->StudentDocuments->save($studentDocuments))
                        {
                            $keyname = 'document/'.$studentDocuments->id.'/'.$file_name;
                            $this->AwsFile->putObjectBase64($keyname,$image_base64,$image_type);
                            $query = $this->Students->DocumentClassMappings->StudentDocuments->query();
                            $query->update()->set(['image_path' => $keyname])
                                  ->where(['id' => $studentDocuments->id])->execute();
                        }
                    }
                    else
                    {
                        $this->AwsFile->deleteObjectFile($studentDocumentPhotos->image_path);
                        $keyname = 'document/'.$studentDocumentPhotos->id.'/'.$file_name;
                        $this->AwsFile->putObjectBase64($keyname,$image_base64,$image_type);
                        $query = $this->Students->DocumentClassMappings->StudentDocuments->query();
                            $query->update()->set(['image_path' => $keyname])
                                  ->where(['id' => $studentDocumentPhotos->id])->execute();
                    }
                }
                $documents=$this->request->getData('document');
                $sr=0;
                if($documents)
                {
                    foreach ($documents as $documentFile) {
                        if(empty($documentFile['error']))
                        {
                            $ext=explode('/',$documentFile['type']);
                            $setNewFileName = time().rand();
                            $studentDocuments = $this->Students->DocumentClassMappings->StudentDocuments->newEntity();
                            $existStudentDocuments = $this->Students->DocumentClassMappings->StudentDocuments->find()->where(['student_id'=>$student->id,'document_class_mapping_id'=>$this->request->getData('document_class_mapping')[$sr]])->first();

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
                            $studentDocuments->student_id = $student->id;
                            $studentDocuments->image_path = $file_name;
                            $studentDocuments->document_class_mapping_id = $this->request->getData('document_class_mapping')[$sr];
                            
                            if($this->Students->DocumentClassMappings->StudentDocuments->save($studentDocuments))
                            {
                                $keyname = 'document/'.$studentDocuments->id.'/'.$setNewFileName.'.'.$ext[1];
                                $this->AwsFile->putObjectFile($keyname,$documentFile['tmp_name'],$documentFile['type']);
                                $query = $this->Students->DocumentClassMappings->StudentDocuments->query();
                                $query->update()->set(['image_path' => $keyname])
                                      ->where(['id' => $studentDocuments->id])->execute();
                            }
                        }
                        $sr++;
                    }
                }
                $this->Flash->success(__('The student has been saved.'));
                if(!empty(@$controller))
                {
                    $student_info_id = $this->EncryptingDecrypting->encryptData($student->student_infos[0]->id);
                    return $this->redirect(['controller'=>$controller,'action' => $action,$student_info_id,$fee_type_role_ids]);
                }
                else
                {
                    return $this->redirect(['action' => 'studentSearch']);
                }
                
            }
            
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        
        $genders = $this->Students->Genders->find('list');
        $admissionClasses = $this->Students->AdmissionClasses->find('list');
        $mediums = $this->Students->AdmissionMediums->find('list');
        $admissionStreams = $this->Students->AdmissionStreams->find('list');
        $cities = $this->Students->StudentInfos->Cities->find('list');
        $states = $this->Students->StudentInfos->States->find('list');
        $castes = $this->Students->StudentInfos->Castes->find('list');
        $religions = $this->Students->StudentInfos->Religions->find('list');
        $sections = $this->Students->StudentInfos->Sections->find('list');
        $houses = $this->Students->StudentInfos->Houses->find('list');
        $studentParentProfessions = $this->Students->StudentInfos->StudentParentProfessions->find('list');
        $vehicles = $this->Students->StudentInfos->Vehicles->find('list');
        $vehicleStations = $this->Students->StudentInfos->VehicleStations->find('list');
        $reservationCategories = $this->Students->StudentInfos->ReservationCategories->find('list');
        $disabilities = $this->Students->Disabilities->find('list');
        
        $documentClassMappings = $this->Students->DocumentClassMappings->find()->where(['student_class_id'=>$student->admission_class_id,'session_year_id'=>$session_year_id])->contain(['Documents','StudentDocuments'=>function($q)use($student_id){
                return $q->where(['StudentDocuments.student_id'=>$student_id]);
        }]);
        
        
        $this->set(compact('student', 'genders',  'admissionClasses', 'mediums', 'admissionStreams', 'cities', 'states', 'castes', 'religions','sections','houses','studentParentProfessions','vehicles','reservationCategories','disabilities','documentClassMappings','vehicleStations','studentDocumentPhotos','student_mother','student_father'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

     public function exportOldDueListReport()
    {
         $this->viewBuilder()->layout('');
        $session_year_id=$this->Auth->User('session_year_id');
        
           
        $students=$this->Students->find();
        $students->contain(['StudentInfos'=>['StudentClasses'],'OldFees'=>['FeeCategories','FeeReceipts'=>function($q){
            return $q->select(['FeeReceipts.old_fee_id','total_submit'=>$q->func()->sum('FeeReceipts.amount')])->group('FeeReceipts.old_fee_id');
        }]]) 
        ->innerJoinWith('OldFees')  
        ->innerJoinWith('StudentInfos')  
        ->group('Students.id');  
        $this->set(compact('mediums','feeCategories','feeTypeRoles','students','sessionYears'));
    }
    public function oldDueListReport()
    {
        $session_year_id=$this->Auth->User('session_year_id');
        
           
        $students=$this->Students->find();
        $students->contain(['StudentInfos'=>['StudentClasses'],'OldFees'=>['FeeCategories','FeeReceipts'=>function($q){
            return $q->select(['FeeReceipts.old_fee_id','total_submit'=>$q->func()->sum('FeeReceipts.amount')])->group('FeeReceipts.old_fee_id');
        }]]) 
        ->innerJoinWith('OldFees')  
        ->innerJoinWith('StudentInfos')  
        ->group('Students.id');  
        $this->set(compact('mediums','feeCategories','feeTypeRoles','students','sessionYears'));
    }
    /*public function dueListReport()
    {
        $sessionYears=$this->Auth->User('session_year_id');
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
         
        $feeMonths=$this->Students->StudentInfos->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find('list')->select(['id','name'])->order(['id'=>'ASC']);

        $feeTypeRoles = $this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find();
        $feeCategories->where(['id !='=>5,'is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);


        $studentInfos =array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            
          // pr($this->request->getData());exit;
            $medium_id= $this->request->getData('medium_id');
            $student_class_id= $this->request->getData('student_class_id');
            $stream_id= $this->request->getData('stream_id');
            $month_id= $this->request->getData('month_id');
            $fee_category= $this->request->getData('fee_category');
            $categoryData = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find()->where(['FeeCategories.id'=>$fee_category])->first();
            $condition=[];
            if($medium_id){
               $condition['StudentInfos.medium_id']= $medium_id;
            }
            if($student_class_id){
               $condition['StudentInfos.student_class_id']= $student_class_id;
            }
            if($stream_id){
               $condition['StudentInfos.stream_id']= $stream_id;
            } 
            if($fee_category==6)
            {
              $condition['hostel_facility']='Yes';
            }
            $studentInfos = $this->Students->StudentInfos->find()->contain(['StudentClasses','Sections','Streams','Students'])->where($condition);  
        } 
        $Component = $this->FeeReceipt;
        $this->set(compact('mediums','feeCategories','feeMonths','feeTypeRoles','studentInfos','categoryData','sessionYears','Component','month_id'));
    }*/
  /*   public function dueListReport()
    {
        $sessionYears=$this->Auth->User('session_year_id');
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
         
        $feeMonths=$this->Students->StudentInfos->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find('list')->select(['id','name'])->order(['id'=>'ASC']);

        $feeTypeRoles = $this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find();
        $feeCategories->where(['id !='=>5,'is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);

        $studentInfos =array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            
          // pr($this->request->getData());exit;
            $medium_id= $this->request->getData('medium_id');
            $student_class_id= $this->request->getData('student_class_id');
            $stream_id= $this->request->getData('stream_id');
            $month_id= $this->request->getData('month_id');
            $fee_category_ids=$this->request->getData('fee_category_id');
            $categoryData = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find()->where(['FeeCategories.id IN'=>$fee_category_ids]);

            $studentClasses = $this->Students->StudentInfos->StudentClasses->find();
                if($student_class_id)
                {
                    $studentClasses->where(['StudentClasses.id'=>$student_class_id]);
                }
                $studentClasses->contain(['StudentInfos'=>function($q)use($medium_id,$stream_id){
                        if($medium_id)
                        {
                            $q->where(['StudentInfos.medium_id'=>$medium_id]);
                        }
                        if($stream_id)
                        {
                            $q->where(['StudentInfos.stream_id'=>$stream_id]);
                        } 
                    return $q->contain(['Students'=>['OldFees']]);
                }]);
                //pr($studentClasses->toArray()); exit;
           /* $studentInfos = $this->Students->StudentInfos->find()->contain(['StudentClasses','Sections','Streams','Students'])->where($condition)->order(['StudentInfos.student_class_id'=>'ASC']); 
        } 
        $Component = $this->FeeReceipt;
        $this->set(compact('mediums','feeCategories','feeMonths','feeTypeRoles','studentClasses','categoryData','sessionYears','Component','month_id','fee_category_ids'));
    } */
	
    //  public function exportDueListReport()
    // {
    //    $this->viewBuilder()->layout('');
        
    //      $sessionYears=$this->Auth->User('session_year_id');
    //     $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
    //      $section_data=[];
    //     $feeMonths=$this->Students->StudentInfos->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find('list')->select(['id','name'])->order(['id'=>'ASC']);

    //     $feeTypeRoles = $this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
    //     $feeCategories = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find();
    //     $feeCategories->where(['id !='=>5,'is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);
    //     //pr($feeCategories->toArray());exit;
    //     $sections = $this->Students->StudentInfos->Sections->find('list')->where(['is_deleted'=>'N']);
    //     foreach($sections as $key=>$data){
    //         $section_data[$key]=$data;
    //     }
        
    //     $studentInfos =array();
    //     if ($this->request->is(['patch', 'post', 'put'])) {
            
    //       //pr($this->request->getData());exit;
    //         $medium_id= $this->request->getData('medium_id');
    //         $student_class_id= $this->request->getData('student_class_id');
    //         $stream_id= $this->request->getData('stream_id');
    //         $month_id= $this->request->getData('month_id');
    //         $fee_category_ids=$this->request->getData('fee_category_id');
    //         //pr($fee_category_ids);exit;
    //         $section_id=$this->request->getData('section_id');
    //         $categoryData = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find()->where(['FeeCategories.id IN'=>$fee_category_ids]);

    //         $studentClasses = $this->Students->StudentInfos->StudentClasses->find();
    //             if($student_class_id)
    //             {
    //                 $studentClasses->where(['StudentClasses.id'=>$student_class_id]);
    //             }
    //             $studentClasses->contain(['StudentInfos'=>function($q)use($medium_id,$stream_id,$section_id){
    //                     if($medium_id)
    //                     {
    //                         $q->where(['StudentInfos.medium_id'=>$medium_id]);
    //                     }
    //                     if($stream_id)
    //                     {
    //                         $q->where(['StudentInfos.stream_id'=>$stream_id]);
    //                     }  
    //                     if($section_id)
    //                     {
    //                         $q->where(['StudentInfos.section_id'=>$section_id]);
    //                     } 
    //                 return $q->contain(['Students'=>['OldFees']]);
    //             }]);
    //             //pr($studentClasses->toArray()); exit;
    //        /* $studentInfos = $this->Students->StudentInfos->find()->contain(['StudentClasses','Sections','Streams','Students'])->where($condition)->order(['StudentInfos.student_class_id'=>'ASC']); */ 
    //     } 
    //     $Component = $this->FeeReceipt;
        
    //     $this->set(compact('feeCategories','feeTypeRoles','studentClasses','categoryData','sessionYears','Component','month_id','fee_category_ids','sections','section_id','section_data'));
    // }  


    public function exportDueListReport()
    {

        $this->viewBuilder()->layout('');
        $url=$this->request->here();
        $url=parse_url($url,PHP_URL_QUERY);
        $medium_id=$this->request->query('medium_id'); 
        $student_class_id=$this->request->query('student_class_id'); 
        $stream_id=$this->request->query('stream_id'); 
        $month_id=$this->request->query('month_id'); 
        $fee_category_ids=$this->request->query('fee_category_id'); 
        $section_id=$this->request->query('section_id'); 
            pr($this->request->query()); exit;
        $sessionYears=$this->Auth->User('session_year_id');
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
         $section_data=[];
        $feeMonths=$this->Students->StudentInfos->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find('list')->select(['id','name'])->order(['id'=>'ASC']);

        $feeTypeRoles = $this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find();
        $feeCategories->where(['id !='=>5,'is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);
        $sections = $this->Students->StudentInfos->Sections->find('list')->where(['is_deleted'=>'N']);
        foreach($sections as $key=>$data){
            $section_data[$key]=$data;
        }
        
        $studentInfos =array();
            
           //pr($this->request->getData());exit;
           
            $categoryData = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find()->where(['FeeCategories.id IN'=>$fee_category_ids]);

            $studentClasses = $this->Students->StudentInfos->StudentClasses->find();
                if(!empty($student_class_id))
                {
                    $studentClasses->where(['StudentClasses.id'=>$student_class_id]);
                }
                $studentClasses->contain(['StudentInfos'=>function($q)use($medium_id,$stream_id,$section_id){
                        if(!empty($medium_id))
                        {
                            $q->where(['StudentInfos.medium_id'=>$medium_id]);
                        }
                        if(!empty($stream_id))
                        {
                            $q->where(['StudentInfos.stream_id'=>$stream_id]);
                        }  
                        if(!empty($section_id))
                        {
                            $q->where(['StudentInfos.section_id'=>$section_id]);
                        } 
                    return $q->contain(['Students'=>['OldFees']]);
                }]);
                //pr($studentClasses->toArray()); exit;
           /* $studentInfos = $this->Students->StudentInfos->find()->contain(['StudentClasses','Sections','Streams','Students'])->where($condition)->order(['StudentInfos.student_class_id'=>'ASC']); */ 
        
        $Component = $this->FeeReceipt;
        
        $this->set(compact('mediums','feeCategories','feeMonths','feeTypeRoles','studentClasses','categoryData','sessionYears','Component','month_id','fee_category_ids','sections','section_id','section_data'));
    }

	 public function dueListReport()
    {
        $sessionYears=$this->Auth->User('session_year_id');
       // $sessionYears=$this->Auth->User('export');
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
         $section_data=[];
        $feeMonths=$this->Students->StudentInfos->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find('list')->select(['id','name'])->order(['id'=>'ASC']);

        $feeTypeRoles = $this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find();
        $feeCategories->where(['id !='=>5,'is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);
		$sections = $this->Students->StudentInfos->Sections->find('list')->where(['is_deleted'=>'N']);
		foreach($sections as $key=>$data){
			$section_data[$key]=$data;
		}
        $medium_id= '';
        $student_class_id= '';
        $stream_id= '';
        $month_id= '';
        $fee_category_ids='';
        $section_id='';
		
        $studentInfos =array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            
           //pr($this->request->getData());exit;
            $medium_id= $this->request->getData('medium_id');
            $student_class_id= $this->request->getData('student_class_id');
            $stream_id= $this->request->getData('stream_id');
            $month_id= $this->request->getData('month_id');
            $fee_category_ids=$this->request->getData('fee_category_id');
			$section_id=$this->request->getData('section_id');
            $categoryData = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find()->where(['FeeCategories.id IN'=>$fee_category_ids]);

            $studentClasses = $this->Students->StudentInfos->StudentClasses->find();
                if($student_class_id)
                {
                    $studentClasses->where(['StudentClasses.id'=>$student_class_id]);
                }
                $studentClasses->contain(['StudentInfos'=>function($q)use($medium_id,$stream_id,$section_id){
                        if($medium_id)
                        {
                            $q->where(['StudentInfos.medium_id'=>$medium_id]);
                        }
                        if($stream_id)
                        {
                            $q->where(['StudentInfos.stream_id'=>$stream_id]);
                        }  
						if($section_id)
                        {
                            $q->where(['StudentInfos.section_id'=>$section_id]);
                        } 
                    return $q->contain(['Students'=>['OldFees']]);
                }]);
                //pr($studentClasses->toArray()); exit;
           /* $studentInfos = $this->Students->StudentInfos->find()->contain(['StudentClasses','Sections','Streams','Students'])->where($condition)->order(['StudentInfos.student_class_id'=>'ASC']); */ 
        } 
        $Component = $this->FeeReceipt;
		
        $this->set(compact('mediums','feeCategories','feeMonths','feeTypeRoles','studentClasses','categoryData','sessionYears','Component','month_id','fee_category_ids','sections','section_id','section_data','medium_id','student_class_id','stream_id','month_id','fee_category_ids','section_id'));
    }

     public function exportStudentLedgerReport($medium_id,$student_class_id,$stream_id)
    {
        $this->viewBuilder()->layout('');
        $session_year_id = $this->Auth->User('session_year_id');
            
            //$date_from=date('Y-m-d',strtotime($daterange[0]));
            //$date_to=date('Y-m-d',strtotime($daterange[1]));
            $studentLedgers = $this->Students->StudentInfos->find();
                if($medium_id!="null")
                {
                    $studentLedgers->where(['StudentInfos.medium_id'=>$medium_id]);
                }
                if($student_class_id!="null")
                {
                    $studentLedgers->where(['StudentInfos.student_class_id'=>$student_class_id]);
                }
                if($stream_id!="null")
                {
                    $studentLedgers->where(['StudentInfos.stream_id'=>$stream_id]);
                }
                $studentLedgers->where(['StudentInfos.session_year_id'=>$session_year_id]);
                $studentLedgers->contain(['Mediums','StudentClasses','Streams','Students'=>function($q)use($session_year_id){
                    return $q->select(['Students.name','Students.scholar_no'])->contain(['EnquiryReceipts'=>function($q)use($session_year_id){
                        return $q->where(['EnquiryReceipts.session_year_id'=>$session_year_id])
                                ->select([
                                    'month' => 'MONTH(receipt_date)',
                                    'total_amount' => 'EnquiryReceipts.total_amount'
                                    ]);
                    }]);
                    },'FeeReceipts'=>function($q){
                        return $q->select([
                            'FeeReceipts.student_info_id',
                            'month' => 'MONTH(receipt_date)',
                            'total_amount'=>$q->func()->sum('FeeReceipts.total_amount')
                            ])
                            ->group(['MONTH(receipt_date)','FeeReceipts.student_info_id'])
                            ;
                        }
                ]);
                
                $feeMonths=$this->Students->StudentInfos->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find('list', [
                    'keyField' => 'month_number',
                    'valueField' => 'name'
                 ])->order(['id'=>'ASC']);//pr($studentLedgers->toArray()); exit;
       
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->Students->StudentInfos->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->Students->StudentInfos->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('date_from','date_to','mediums','studentClasses','streams','studentLedgers','feeMonths','fee_collection','medium_id','student_class_id','stream_id','daterange'));
    }
	
    public function studentLedger()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $fee_collection=$this->request->getData('fee_collection');
            $medium_id=$this->request->getData('medium_id');
            $student_class_id=$this->request->getData('student_class_id');
            $stream_id=$this->request->getData('stream_id');
            $daterange=explode('/',$this->request->getData('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            $studentLedgers = $this->Students->StudentInfos->find();
                if(!empty($medium_id))
                {
                    $studentLedgers->where(['StudentInfos.medium_id'=>$medium_id]);
                }
                if(!empty($student_class_id))
                {
                    $studentLedgers->where(['StudentInfos.student_class_id'=>$student_class_id]);
                }
                if(!empty($stream_id))
                {
                    $studentLedgers->where(['StudentInfos.stream_id'=>$stream_id]);
                }
                $studentLedgers->where(['StudentInfos.session_year_id'=>$session_year_id]);
                $studentLedgers->contain(['Mediums','StudentClasses','Streams','Students'=>function($q)use($session_year_id){
                    return $q->select(['Students.name','Students.scholar_no'])->contain(['EnquiryReceipts'=>function($q)use($session_year_id){
                        return $q->where(['EnquiryReceipts.session_year_id'=>$session_year_id])
                                ->select([
                                    'month' => 'MONTH(receipt_date)',
                                    'total_amount' => 'EnquiryReceipts.total_amount'
                                    ]);
                    }]);
                    },'FeeReceipts'=>function($q){
                        return $q->select([
                            'FeeReceipts.student_info_id',
                            'month' => 'MONTH(receipt_date)',
                            'total_amount'=>$q->func()->sum('FeeReceipts.total_amount')
                            ])
                            ->group(['MONTH(receipt_date)','FeeReceipts.student_info_id'])
                            ;
                        }
                ]);
                
                $feeMonths=$this->Students->StudentInfos->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find('list', [
                    'keyField' => 'month_number',
                    'valueField' => 'name'
                 ])->order(['id'=>'ASC']);//pr($studentLedgers->toArray()); exit;
        }
       
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->Students->StudentInfos->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->Students->StudentInfos->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('date_from','date_to','mediums','studentClasses','streams','studentLedgers','feeMonths','fee_collection','medium_id','student_class_id','stream_id','daterange'));
    }
    public function getStudentCharacterCertificate()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    $data.=$html->link('View',['controller'=>'Students','action'=>'characterCertificateView',$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function characterCertificate()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='';
        $this->set(compact('StudentClasses','fee_type'));
    }
    public function characterCertificateView($student_info_id)
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $student_info_id = $this->EncryptingDecrypting->decryptData($student_info_id);
        $studentLedgers = $this->Students->StudentInfos->get($student_info_id,[
            'contain'=>['StudentClasses','Students']
        ]);
        $school = $this->Students->Schools->find()->first();
        $this->set(compact('studentLedgers','school'));
    }
    public function tutionFeeCertificate()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='';
        $this->set(compact('StudentClasses','fee_type'));
    }
    public function tutionFeeCertificateView($student_info_id)
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $student_info_id = $this->EncryptingDecrypting->decryptData($student_info_id);
        $studentLedgers = $this->Students->StudentInfos->find();
        $studentLedgers->where(['StudentInfos.session_year_id'=>$session_year_id]);
        $studentLedgers->where(['StudentInfos.id'=>$student_info_id]);
        $studentLedgers->contain(['StudentClasses','Students'=>function($q)use($session_year_id){
            return $q->contain(['EnquiryReceipts'=>function($q)use($session_year_id){
                return $q->where(['EnquiryReceipts.session_year_id'=>$session_year_id])
                        ->contain(['ReceiptFeeCategories']);
            }]);
            },'FeeReceipts'=>function($q){
                return $q->contain(['ReceiptFeeCategories','FeeReceiptRows'=>['FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes'=>['FeeTypeRoles']]],'FeeTypeStudentMasters'=>['FeeTypeMasterRows'=>['FeeTypeMasters'=>['FeeTypes'=>['FeeTypeRoles']]]]]]);
                    
                }
        ]);
        $school = $this->Students->Schools->find()->first();
        $this->set(compact('studentLedgers','school'));
    }

     public function exportStudentWisePaymentReport($student_id=null)
    {
         $this->viewBuilder()->layout('');
            $url=$this->request->here();
            $url=parse_url($url,PHP_URL_QUERY);
            
        $session_year_id = $this->Auth->User('session_year_id');
        $medium_id=$this->request->query('medium_id');
        $student_class_id=$this->request->query('student_class_id');
        $stream_id=$this->request->query('stream_id');
        
            
           
            $studentLedgers = $this->Students->StudentInfos->find();
                if(!empty($medium_id))
                {
                    $studentLedgers->where(['StudentInfos.medium_id'=>$medium_id]);
                }
                if(!empty($student_class_id))
                {
                    $studentLedgers->where(['StudentInfos.student_class_id'=>$student_class_id]);
                }
                if(!empty($stream_id))
                {
                    $studentLedgers->where(['StudentInfos.stream_id'=>$stream_id]);
                }
                $studentLedgers->where(['StudentInfos.session_year_id'=>$session_year_id]);
                $studentLedgers->contain(['Sections','StudentClasses','Streams','Students'=>function($q)use($session_year_id){
                    return $q->contain(['EnquiryReceipts'=>function($q)use($session_year_id){
                        return $q->where(['EnquiryReceipts.session_year_id'=>$session_year_id])
                                ->contain(['ReceiptFeeCategories','FeeTypeRoles']);
                    }]);
                    },'FeeReceipts'=>function($q){
                        return $q->contain(['ReceiptFeeCategories','FeeTypeRoles']);
                            
                        }
                ]);
        
                $student_id=$this->request->query('student_id');
                if(!empty($student_id))
                {
                    $studentLedgers = $this->Students->StudentInfos->find();
                        $studentLedgers->where(['StudentInfos.session_year_id'=>$session_year_id]);
                        $studentLedgers->contain(['Sections','StudentClasses','Streams','Students'=>function($q)use($session_year_id,$student_id){
                            if(!empty($student_id))
                            {
                                $student_id = $this->EncryptingDecrypting->decryptData($student_id);
                                $q->where(['Students.id'=>$student_id]);
                            }
                            return $q->contain(['EnquiryReceipts'=>function($q)use($session_year_id){
                                return $q->where(['EnquiryReceipts.session_year_id'=>$session_year_id])
                                        ->contain(['ReceiptFeeCategories','FeeTypeRoles']);
                            }]);
                            },'FeeReceipts'=>function($q){
                                return $q->contain(['ReceiptFeeCategories','FeeTypeRoles']);
                                    
                                }
                        ]);
                }
                
        
      
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $fee_type ='';
        $streams = $this->Students->StudentInfos->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('mediums','StudentClasses','streams','studentLedgers','feeMonths','fee_collection','fee_type'));
    }

    public function studentWisePayment($student_id=null)
    {

        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            
            $medium_id=$this->request->getData('medium_id');
            $student_class_id=$this->request->getData('student_class_id');
            $stream_id=$this->request->getData('stream_id');
            $studentLedgers = $this->Students->StudentInfos->find();
                if(!empty($medium_id))
                {
                    $studentLedgers->where(['StudentInfos.medium_id'=>$medium_id]);
                }
                if(!empty($student_class_id))
                {
                    $studentLedgers->where(['StudentInfos.student_class_id'=>$student_class_id]);
                }
                if(!empty($stream_id))
                {
                    $studentLedgers->where(['StudentInfos.stream_id'=>$stream_id]);
                }
                $studentLedgers->where(['StudentInfos.session_year_id'=>$session_year_id]);
                $studentLedgers->contain(['Sections','StudentClasses','Streams','Students'=>function($q)use($session_year_id){
                    return $q->contain(['EnquiryReceipts'=>function($q)use($session_year_id){
                        return $q->where(['EnquiryReceipts.session_year_id'=>$session_year_id])
                                ->contain(['ReceiptFeeCategories','FeeTypeRoles']);
                    }]);
                    },'FeeReceipts'=>function($q){
                        return $q->contain(['ReceiptFeeCategories','FeeTypeRoles']);
                            
                        }
                ]);
        }
        else
        {
            if ($this->request->is(['get']))
            {
                if(!empty($student_id))
                {
                    $studentLedgers = $this->Students->StudentInfos->find();
                        $studentLedgers->where(['StudentInfos.session_year_id'=>$session_year_id]);
                        $studentLedgers->contain(['Sections','StudentClasses','Streams','Students'=>function($q)use($session_year_id,$student_id){
                            if(!empty($student_id))
                            {
                                $student_id = $this->EncryptingDecrypting->decryptData($student_id);
                                $q->where(['Students.id'=>$student_id]);
                            }
                            return $q->contain(['EnquiryReceipts'=>function($q)use($session_year_id){
                                return $q->where(['EnquiryReceipts.session_year_id'=>$session_year_id])
                                        ->contain(['ReceiptFeeCategories','FeeTypeRoles']);
                            }]);
                            },'FeeReceipts'=>function($q){
                                return $q->contain(['ReceiptFeeCategories','FeeTypeRoles']);
                                    
                                }
                        ]);
                }
                
            }
        }
      
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $fee_type ='';
        $streams = $this->Students->StudentInfos->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('mediums','StudentClasses','streams','studentLedgers','feeMonths','fee_collection','fee_type'));
    }

    public function exportReceiptDeleteDetailReport()
    {

            $this->viewBuilder()->layout('');
            $url=$this->request->here();
            $url=parse_url($url,PHP_URL_QUERY);
            
            
                @$fee_type_role_ids=$this->request->query('fee_type_role_id'); 
                $fee_category_ids=$this->request->query('fee_category_id');
                //pr($fee_category_ids);exit;
                $daterange=$this->request->query('daterange'); 
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
        
            
            if(!empty($fee_type_role_ids))
            {
                $getFeeTypeRoles = $this->FeeCategories->FeeTypes->find()
                            ->select(['fee_category_id'])
                            ->where(['fee_type_role_id IN'=>$fee_type_role_ids])
                            ->first();
                $fee_category_ids[]=$getFeeTypeRoles->fee_category_id;
            }
            else
            {

                $fee_category_ids=$this->request->query('fee_category_id'); 
            }
            
            $studentLedgers = $this->Students->StudentInfos->DeleteFeeReceipts->find();
            $studentLedgers->where(['fee_category_id IN'=>$fee_category_ids]);
            $studentLedgers->where(['DeleteFeeReceipts.delete_date >='=>$date_from,'DeleteFeeReceipts.delete_date <='=>$date_to]);

            $studentLedgers->contain([
                    'ReceiptFeeCategories','FeeTypeRoles'
                    ])
                    ->leftJoinWith('StudentInfos',function($q){
                        return $q->contain(['StudentClasses','Streams','Students']);
                    })
                    ->leftJoinWith('EnquiryFormStudents',function($q){
                        return $q->contain(['StudentClasses','Streams']);
                    });
        
       
      //pr($studentLedgers->toArray());exit;
        $feeTypeRoles = $this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find();
        $feeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);
        $this->set(compact('studentLedgers','feeTypeRoles','feeCategories'));
    }

    public function receiptDeleteDetail()
    {
        if ($this->request->is(['post','put'])) 
        {
            $fee_type_role_ids=$this->request->getData('fee_type_role_id');
            $fee_category_ids=$this->request->getData('fee_category_id');
            //pr($fee_type_role_ids);
            //pr($fee_category_ids);exit;                             
            $daterange=explode('/',$this->request->getData('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            if(!empty($fee_type_role_ids))
            {
                $getFeeTypeRoles = $this->FeeCategories->FeeTypes->find()
                            ->select(['fee_category_id'])
                            ->where(['fee_type_role_id IN'=>$fee_type_role_ids])
                            ->first();
                $fee_category_ids[]=$getFeeTypeRoles->fee_category_id;
            }
            
            $studentLedgers = $this->Students->StudentInfos->DeleteFeeReceipts->find();
            $studentLedgers->where(['fee_category_id IN'=>$fee_category_ids]);
            $studentLedgers->where(['DeleteFeeReceipts.delete_date >='=>$date_from,'DeleteFeeReceipts.delete_date <='=>$date_to]);

            $studentLedgers->contain([
                    'ReceiptFeeCategories','FeeTypeRoles'
                    ])
                    ->leftJoinWith('StudentInfos',function($q){
                        return $q->contain(['StudentClasses','Streams','Students']);
                    })
                    ->leftJoinWith('EnquiryFormStudents',function($q){
                        return $q->contain(['StudentClasses','Streams']);
                    });
        }
       
      //pr($studentLedgers->toArray());exit;
        $feeTypeRoles = $this->Students->StudentInfos->FeeReceipts->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->Students->StudentInfos->FeeReceipts->FeeCategories->find();
        $feeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);
        $this->set(compact('studentLedgers','feeTypeRoles','feeCategories','fee_category_ids','fee_type_role_ids'));
    }

    public function exportStudentListReport($list_type,$medium_id,$student_class_id,$stream_id,$section_id)
    {
        $this->viewBuilder()->layout('');
        $session_year_id = $this->Auth->User('session_year_id');
        
            $studentLists = $this->Students->AllStudentInfos->find();
            if($medium_id !="-")
            {
                $studentLists->where(['AllStudentInfos.medium_id'=>$medium_id]);
            }
            if($student_class_id !="-")
            {
                $studentLists->where(['AllStudentInfos.student_class_id'=>$student_class_id]);
            } 
            if($section_id !="-")
            {
                $studentLists->where(['AllStudentInfos.section_id'=>$section_id]);
            }
            if($stream_id !='-')
            {
                $studentLists->where(['AllStudentInfos.stream_id'=>$stream_id]);
            }
                if($list_type=='rte')
                {
                    $studentLists->where(['AllStudentInfos.rte'=>'Yes','AllStudentInfos.student_status !='=>'Discontinue']);
                }
                else if($list_type=='discontinue')
                {
                    $studentLists->where(['AllStudentInfos.student_status'=>'Discontinue']);
                }
                else if($list_type=='new_admission')
                {
                    $studentLists->where(['AllStudentInfos.student_status !='=>'Discontinue']);
                }
                else if($list_type=='new_old_list')
                {
                   $studentLists->where(['AllStudentInfos.student_status !='=>'Discontinue']);
                }
                else if($list_type=='new_hostel' || $list_type=='new_old_hostel')
                {
                    $studentLists->where(['AllStudentInfos.hostel_facility'=>'Yes','AllStudentInfos.student_status !='=>'Discontinue']);
                }
                else if($list_type=='bus')
                {
                    $studentLists->where(['AllStudentInfos.bus_facility'=>'Yes','AllStudentInfos.student_status !='=>'Discontinue']);
                }
                else if($list_type=='pending_document')
                {
                    $studentLists->where(['AllStudentInfos.student_status !='=>'Discontinue']);
                }
            $studentLists->contain(['Mediums','StudentClasses','Streams','Sections','ReservationCategories','Castes','Religions','Students'=>function($q)use($session_year_id,$list_type){
                    $q->select(['Students.id','Students.name','scholar_no','father_name','mother_name','registration_date','dob','parent_mobile_no','admission_class_id','gender_id','disability_id']);
                    if($list_type=='new_admission')
                    {
                        $q->where(['Students.session_year_id'=>$session_year_id]);
                    }
                    if($list_type=='tc')
                    {
                        $q->innerJoinWith('TransferCertificates',function($q)use($session_year_id){
                            return $q->where(['tc_status'=>'Success','TransferCertificates.session_year_id'=>$session_year_id]);
                        });
                    }
                    else
                    { 
                
                        /* $q->notMatching('TransferCertificates',function($q)use($session_year_id){
                            return $q->where(['tc_status'=>'Success','TransferCertificates.session_year_id'=>$session_year_id]);
                        }); */
                    }
                    $q->innerJoinWith('Genders');
                    $q->leftJoinWith('Disabilities');
                    $q->contain(['DocumentClassMappings'=>['Documents'],'StudentDocuments','Genders','Disabilities','StudentFatherProfessions'=>['StudentParentProfessions'],'StudentMotherProfessions'=>['StudentParentProfessions']]);
                   
                    if($list_type=='new_hostel')
                    {
                        $q->innerJoinWith('HostelRegistrations',function($q)use($session_year_id){
                            return $q->where(['HostelRegistrations.session_year_id'=>$session_year_id]);
                        });
                    }
                    
                    return $q;
                }
            ]);
            $studentLists->order(['AllStudentInfos.student_class_id'=>'ASC']);
            //pr($studentLists->toArray()); exit;
            if($list_type=='pending_document')
            {
                $studentLists=$studentLists->toArray();
                foreach ($studentLists as $key=>$studentList) 
                { 
                    $document_class_mapping_id=[];
                    $document_class_student_id=[];
                    foreach ($studentList->student->document_class_mappings as $document_class_mapping) 
                    {
                        $document_class_mapping_id[]=$document_class_mapping->id;
                    }
                    foreach ($studentList->student->student_documents as $student_document)
                    {
                        if(!empty($student_document->document_class_mapping_id))
                        {
                            $document_class_student_id[]=$student_document->document_class_mapping_id;
                        }
                        
                    }
                    $result = array_diff($document_class_mapping_id, $document_class_student_id);
                    
                    if(empty($result))
                    {
                        unset($studentLists[$key]);
                    }
                    else
                    {
                        foreach ($studentList->student->document_class_mappings as $dkey=>$document_class_mapping) 
                        {
                            $document_class_mapping->id;
                            if(!in_array($document_class_mapping->id,$result))
                            {
                                unset($studentList->student->document_class_mappings[$dkey]);
                            }
                        }
                    }
                    
                }
                $reindex=array_values($studentLists);
                $studentLists = $reindex;
            }
            else
            {
                $studentLists=$studentLists->toArray();
                foreach ($studentLists as $key=>$studentList) 
                { 
                    $document_class_mapping_id=[];
                    $document_class_student_id=[];
                    foreach ($studentList->student->document_class_mappings as $document_class_mapping) 
                    {
                        $document_class_mapping_id[]=$document_class_mapping->id;
                    }
                    foreach ($studentList->student->student_documents as $student_document)
                    {
                        if(!empty($student_document->document_class_mapping_id))
                        {
                            $document_class_student_id[]=$student_document->document_class_mapping_id;
                        }
                        
                    }
                    $result = array_diff($document_class_mapping_id, $document_class_student_id);
                    
                    
                        foreach ($studentList->student->document_class_mappings as $dkey=>$document_class_mapping) 
                        {
                            $document_class_mapping->id;
                            if(!in_array($document_class_mapping->id,$result))
                            {
                                unset($studentList->student->document_class_mappings[$dkey]);
                            }
                        }
                    
                }
            }
           
        
        $sections = $this->Students->StudentInfos->Sections->find('list')->where(['is_deleted'=>'N']);
        foreach($sections as $key=>$data){
            $section_data[$key]=$data;
        }
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->Students->StudentInfos->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->Students->StudentInfos->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('date_from','date_to','mediums','studentClasses','streams','studentLists','feeMonths','list_type','sections'));
    }

    public function studentList()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $list_type=$this->request->getData('list_type');
            $medium_id=$this->request->getData('medium_id');
            $student_class_id=$this->request->getData('student_class_id');
            $stream_id=$this->request->getData('stream_id'); 
			$section_id=$this->request->getData('section_id');
            $studentLists = $this->Students->AllStudentInfos->find();
            if(!empty($medium_id))
            {
                $studentLists->where(['AllStudentInfos.medium_id'=>$medium_id]);
            }
            if(!empty($student_class_id))
            {
                $studentLists->where(['AllStudentInfos.student_class_id'=>$student_class_id]);
            } 
			if(!empty($section_id))
            {
                $studentLists->where(['AllStudentInfos.section_id'=>$section_id]);
            }
            if(!empty($stream_id))
            {
                $studentLists->where(['AllStudentInfos.stream_id'=>$stream_id]);
            }
            if($list_type=='rte')
            {
                $studentLists->where(['AllStudentInfos.rte'=>'Yes','AllStudentInfos.student_status !='=>'Discontinue']);
            }
            else if($list_type=='discontinue')
            {
                $studentLists->where(['AllStudentInfos.student_status'=>'Discontinue']);
            }
            else if($list_type=='new_admission')
            {
                $studentLists->where(['AllStudentInfos.student_status !='=>'Discontinue']);
            }
            else if($list_type=='new_old_list')
            {
               $studentLists->where(['AllStudentInfos.student_status !='=>'Discontinue']);
            }
            else if($list_type=='new_hostel' || $list_type=='new_old_hostel')
            {
                $studentLists->where(['AllStudentInfos.hostel_facility'=>'Yes','AllStudentInfos.student_status !='=>'Discontinue']);
            }
            else if($list_type=='bus')
            {
                $studentLists->where(['AllStudentInfos.bus_facility'=>'Yes','AllStudentInfos.student_status !='=>'Discontinue']);
            }
            else if($list_type=='pending_document')
            {
                $studentLists->where(['AllStudentInfos.student_status !='=>'Discontinue']);
            }
            $studentLists->contain(['Mediums','StudentClasses','Streams','Sections','ReservationCategories','Castes','Religions','Students'=>function($q)use($session_year_id,$list_type){
                    $q->select(['Students.id','Students.name','scholar_no','father_name','mother_name','registration_date','dob','parent_mobile_no','admission_class_id','gender_id','disability_id']);
                    if($list_type=='new_admission')
                    {
                        $q->where(['Students.session_year_id'=>$session_year_id]);
                    }
                    if($list_type=='tc')
                    {
                        $q->innerJoinWith('TransferCertificates',function($q)use($session_year_id){
                            return $q->where(['tc_status'=>'Success','TransferCertificates.session_year_id'=>$session_year_id]);
                        });
                    }
                    else
                    { 
				
                        /* $q->notMatching('TransferCertificates',function($q)use($session_year_id){
                            return $q->where(['tc_status'=>'Success','TransferCertificates.session_year_id'=>$session_year_id]);
                        }); */
                    }
                    $q->innerJoinWith('Genders');
                    $q->leftJoinWith('Disabilities');
                    $q->contain(['DocumentClassMappings'=>['Documents'],'StudentDocuments','Genders','Disabilities','StudentFatherProfessions'=>['StudentParentProfessions'],'StudentMotherProfessions'=>['StudentParentProfessions']]);
                   
                    if($list_type=='new_hostel')
                    {
                        $q->innerJoinWith('HostelRegistrations',function($q)use($session_year_id){
                            return $q->where(['HostelRegistrations.session_year_id'=>$session_year_id]);
                        });
                    }
                    
                    return $q;
                }
            ]);
            $studentLists->order(['AllStudentInfos.student_class_id'=>'ASC']);
            //pr($studentLists->toArray()); exit;
            if($list_type=='pending_document')
            {
                $studentLists=$studentLists->toArray();
                foreach ($studentLists as $key=>$studentList) 
                { 
                    $document_class_mapping_id=[];
                    $document_class_student_id=[];
                    foreach ($studentList->student->document_class_mappings as $document_class_mapping) 
                    {
                        $document_class_mapping_id[]=$document_class_mapping->id;
                    }
                    foreach ($studentList->student->student_documents as $student_document)
                    {
                        if(!empty($student_document->document_class_mapping_id))
                        {
                            $document_class_student_id[]=$student_document->document_class_mapping_id;
                        }
                        
                    }
                    $result = array_diff($document_class_mapping_id, $document_class_student_id);
                    
                    if(empty($result))
                    {
                        unset($studentLists[$key]);
                    }
                    else
                    {
                        foreach ($studentList->student->document_class_mappings as $dkey=>$document_class_mapping) 
                        {
                            $document_class_mapping->id;
                            if(!in_array($document_class_mapping->id,$result))
                            {
                                unset($studentList->student->document_class_mappings[$dkey]);
                            }
                        }
                    }
                    
                }
                $reindex=array_values($studentLists);
                $studentLists = $reindex;
            }
            else
            {
                $studentLists=$studentLists->toArray();
                foreach ($studentLists as $key=>$studentList) 
                { 
                    $document_class_mapping_id=[];
                    $document_class_student_id=[];
                    foreach ($studentList->student->document_class_mappings as $document_class_mapping) 
                    {
                        $document_class_mapping_id[]=$document_class_mapping->id;
                    }
                    foreach ($studentList->student->student_documents as $student_document)
                    {
                        if(!empty($student_document->document_class_mapping_id))
                        {
                            $document_class_student_id[]=$student_document->document_class_mapping_id;
                        }
                        
                    }
                    $result = array_diff($document_class_mapping_id, $document_class_student_id);
                    
                    
                        foreach ($studentList->student->document_class_mappings as $dkey=>$document_class_mapping) 
                        {
                            $document_class_mapping->id;
                            if(!in_array($document_class_mapping->id,$result))
                            {
                                unset($studentList->student->document_class_mappings[$dkey]);
                            }
                        }
                    
                }
            }
           
        }
        $sections = $this->Students->StudentInfos->Sections->find('list')->where(['is_deleted'=>'N']);
        //pr($sections->toArray());exit;
		foreach($sections as $key=>$data){
			$section_data[$key]=$data;
		}
        $mediums = $this->Students->StudentInfos->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->Students->StudentInfos->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->Students->StudentInfos->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('date_from','date_to','mediums','studentClasses','streams','studentLists','feeMonths','list_type','sections','student_class_id','section_id','stream_id','medium_id'));
    }
    public function summary()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        /////////////////////////Total Student/////////////
        $totalStudent = $this->Students->SummaryStudentInfos->find();
            $totalStudent->innerJoinWith('Students');
            $totalStudent->where(['SummaryStudentInfos.student_status !='=>'Discontinue'
                                    ]);
                $totalOldBoyCount = $totalStudent->newExpr()
                    ->addCase(
                        $totalStudent->newExpr()->add([
                            'Students.session_year_id <'=>$session_year_id,
                            'Students.gender_id'=>1
                        ]),
                        $totalStudent->newExpr()->add(['SummaryStudentInfos.id']),
                        'integer'
                    );
                $totalNewBoyCount = $totalStudent->newExpr()
                    ->addCase(
                        $totalStudent->newExpr()->add([
                            'Students.session_year_id'=>$session_year_id,
                            'Students.gender_id'=>1
                        ]),
                        $totalStudent->newExpr()->add(['SummaryStudentInfos.id']),
                        'integer'
                    );
                $totalOldGirlCount = $totalStudent->newExpr()
                    ->addCase(
                        $totalStudent->newExpr()->add([
                            'Students.session_year_id <'=>$session_year_id,
                            'Students.gender_id'=>2
                        ]),
                        $totalStudent->newExpr()->add(['SummaryStudentInfos.id']),
                        'integer'
                    );
                $totalNewGirlCount = $totalStudent->newExpr()
                    ->addCase(
                        $totalStudent->newExpr()->add([
                            'Students.session_year_id'=>$session_year_id,
                            'Students.gender_id'=>2
                        ]),
                        $totalStudent->newExpr()->add(['SummaryStudentInfos.id']),
                        'integer'
                    );

            $totalStudent->select([
                'totalOldBoyCount' => $totalStudent->func()->count($totalOldBoyCount),
                'totalNewBoyCount' => $totalStudent->func()->count($totalNewBoyCount),
                'totalOldGirlCount' => $totalStudent->func()->count($totalOldGirlCount),
                'totalNewGirlCount' => $totalStudent->func()->count($totalNewGirlCount)
            ]);
            $totalStudents=$totalStudent->first();
        
        /////////////////////////Class Wise Summary/////////////
        $mediums=$this->Students->StudentInfos->Mediums->find()->order(['id']);
        foreach ($mediums as $medium)
        {
            $classes=$this->Students->StudentInfos->StudentClasses->find()->order(['id']);
            foreach ($classes as $class) {

                $totalClassStudent = $this->Students->SummaryStudentInfos->find();
                    $totalClassStudent->innerJoinWith('Students');
                    $totalClassStudent->where(['SummaryStudentInfos.student_status !='=>'Discontinue',
                                                'SummaryStudentInfos.student_class_id'=>$class->id,
                                                'SummaryStudentInfos.medium_id'=>$medium->id
                                            ]);
                        $totalOldBoyCount = $totalClassStudent->newExpr()
                            ->addCase(
                                $totalClassStudent->newExpr()->add([
                                    'Students.session_year_id <'=>$session_year_id,
                                    'Students.gender_id'=>1
                                ]),
                                $totalClassStudent->newExpr()->add(['SummaryStudentInfos.id']),
                                'integer'
                            );
                        $totalNewBoyCount = $totalClassStudent->newExpr()
                            ->addCase(
                                $totalClassStudent->newExpr()->add([
                                    'Students.session_year_id'=>$session_year_id,
                                    'Students.gender_id'=>1
                                ]),
                                $totalClassStudent->newExpr()->add(['SummaryStudentInfos.id']),
                                'integer'
                            );
                        $totalOldGirlCount = $totalClassStudent->newExpr()
                            ->addCase(
                                $totalClassStudent->newExpr()->add([
                                    'Students.session_year_id <'=>$session_year_id,
                                    'Students.gender_id'=>2
                                ]),
                                $totalClassStudent->newExpr()->add(['SummaryStudentInfos.id']),
                                'integer'
                            );
                        $totalNewGirlCount = $totalClassStudent->newExpr()
                            ->addCase(
                                $totalClassStudent->newExpr()->add([
                                    'Students.session_year_id'=>$session_year_id,
                                    'Students.gender_id'=>2
                                ]),
                                $totalClassStudent->newExpr()->add(['SummaryStudentInfos.id']),
                                'integer'
                            );

                    $totalClassStudent->select([
                        'totalOldBoyCount' => $totalClassStudent->func()->count($totalOldBoyCount),
                        'totalNewBoyCount' => $totalClassStudent->func()->count($totalNewBoyCount),
                        'totalOldGirlCount' => $totalClassStudent->func()->count($totalOldGirlCount),
                        'totalNewGirlCount' => $totalClassStudent->func()->count($totalNewGirlCount)
                    ]);
                    $totalClassStudentCounts[$medium->name][$class->name]=$totalClassStudent;
                   
            }
        }
        
        
        /////////////////////////Discontinued Students Status/////////////
        $totalConDisStudents = $this->Students->SummaryStudentInfos->find();
            $totalConDisStudents->select(['SummaryStudentInfos.student_class_id'])->contain(['StudentClasses'=>function($q){
                    return $q->select(['StudentClasses.name']);
            }])
            ->where(['SummaryStudentInfos.session_year_id' => $session_year_id]);
                $totalDiscontinue = $totalConDisStudents->newExpr()
                    ->addCase(
                        $totalConDisStudents->newExpr()->add(['SummaryStudentInfos.student_status'=>'Discontinue']),
                        $totalConDisStudents->newExpr()->add(['SummaryStudentInfos.id']),
                        'integer'
                    );
                $totalTemporaryDicontinue = $totalConDisStudents->newExpr()
                    ->addCase(
                        $totalConDisStudents->newExpr()->add(['SummaryStudentInfos.student_status'=>'Temporary Discontinue']),
                        $totalConDisStudents->newExpr()->add(['SummaryStudentInfos.id']),
                        1,
                        'integer'
                    );

            $totalConDisStudents->select([
                'total_discontinue' => $totalConDisStudents->func()->count($totalDiscontinue),
                'total_temporary_dicontinue' => $totalConDisStudents->func()->count($totalTemporaryDicontinue)
            ]);
            $totalConDisStudents->group(['SummaryStudentInfos.student_class_id'])
            ->order(['SummaryStudentInfos.student_class_id']);

        /////////////////////////Bus Students Status/////////////
        $totalBusStudents = $this->Students->SummaryStudentInfos->find();
                $totalBusStudents->select(['total_bus_student'=>$totalBusStudents->func()->count('SummaryStudentInfos.id'),'SummaryStudentInfos.student_class_id'])->contain(['StudentClasses'=>function($q){
                        return $q->select(['StudentClasses.name']);
                }])
                ->where(['SummaryStudentInfos.session_year_id' => $session_year_id,'SummaryStudentInfos.student_status !='=>'Discontinue','SummaryStudentInfos.bus_facility'=>'Yes'])
                ->group(['SummaryStudentInfos.student_class_id'])
                ->order(['SummaryStudentInfos.student_class_id']);

        /////////////////////////Hostel Students Status/////////////
        $totalHostelStudents = $this->Students->SummaryStudentInfos->find();
                $totalHostelStudents->select(['total_hostel_student'=>$totalHostelStudents->func()->count('SummaryStudentInfos.id'),'SummaryStudentInfos.student_class_id'])->contain(['StudentClasses'=>function($q){
                        return $q->select(['StudentClasses.name']);
                }])
                ->where(['SummaryStudentInfos.session_year_id' => $session_year_id,'SummaryStudentInfos.student_status !='=>'Discontinue','SummaryStudentInfos.hostel_facility'=>'Yes'])
                ->group(['SummaryStudentInfos.student_class_id'])
                ->order(['SummaryStudentInfos.student_class_id']);

        /////////////////////////TC Students Status/////////////
        $totalTcStudent = $this->Students->find();
        $totalTcStudent->innerJoinWith('TransferCertificates',function($q)use($session_year_id){
            return $q->where(['tc_status'=>'Success','TransferCertificates.session_year_id'=>$session_year_id]);
        });
        $totalTcStudent->select(['total_tc_student'=>$totalTcStudent->func()->count('Students.id')]);
        $totalTcStudents=$totalTcStudent->first()->total_tc_student;
        /////////////////////////Receipt Books and Fee Collection/////////////
        $feeReceipts=$this->Students->StudentInfos->FeeReceipts->find();
            $feeReceipts->select(['min_receipt_no' => $feeReceipts->func()->min('receipt_no'),
                                'max_receipt_no' => $feeReceipts->func()->max('receipt_no'),
                                'total_amount'=>$feeReceipts->func()->sum('total_amount')
                                ]);
            $feeReceipts->contain(['FeeCategories'=>function($q){
                return $q->select(['FeeCategories.name']);
            }])
            ->where(['FeeReceipts.session_year_id'=>$session_year_id])
            ->group(['FeeReceipts.fee_category_id'])
            ->order(['FeeReceipts.fee_category_id']);

        $this->set(compact('totalStudents','totalClassStudentCounts','totalConDisStudents','totalBusStudents','totalHostelStudents','totalTcStudents','feeReceipts'));
    }
    public function scholarRegister()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='';
        $this->set(compact('StudentClasses','fee_type'));
    }
    public function getStudentScholarRegister()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    $data.=$html->link('View',['controller'=>'Students','action'=>'scholarRegisterView',$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function scholarRegisterView($student_info_id=null)
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $this->viewBuilder()->setLayout('');

        
        $studentInfos = $this->Students->StudentInfos->find();
        $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id]);
        if(!empty($student_info_id))
        {
            $student_info_id = $this->EncryptingDecrypting->decryptData($student_info_id);
            $studentInfos->where(['StudentInfos.id'=>$student_info_id]);
            $studentInfos->contain(['StudentClasses','Students'=>['LastClasses']]);
        }
        else
        {
            $daterange=explode('/',$this->request->getData('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            $studentInfos->contain(['StudentClasses','Students'=>function($q)use($date_from,$date_to){
                return $q->where(function (QueryExpression $exp, Query $q)use($date_from,$date_to) {
                            return $exp->between('registration_date', $date_from,$date_to);
                        })->contain(['LastClasses']);
            }]);
        }
       
        $school = $this->Students->Schools->find()->first();
        $studentClasses = $this->Students->StudentInfos->StudentClasses->find()->order(['order_of_class']);
        //pr($studentInfos->toArray()); exit;
        $this->set(compact('studentInfos','school','studentClasses'));
    }
    public function getStudentTransferCertificate()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['TransferCertificates'=>function($q){
                return $q->select(['tc_status','TransferCertificates.student_id','TransferCertificates.id'])
                        ->where(['tc_status !='=>'Cancel']);
        },'StudentInfos'=>function($studentInfos) use($class_id){
                $studentInfos->order(['StudentInfos.session_year_id'=>'DESC'])
                            ->group(['StudentInfos.student_id'])
                            ->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);       
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        $form = new FormHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                   
                    if(!empty($studentsForm->transfer_certificate))
                    {
                        $transfer_certificate_id = $this->EncryptingDecrypting->encryptData($studentsForm->transfer_certificate->id);
                        $data.=$html->link('View TC',['controller'=>'TransferCertificates','action'=>'view',$transfer_certificate_id],['escape'=>false,'class'=>'btn btn-xs btn-info','target'=>'_blank']);
                        $data.=' ';
                        $data.=$html->link('Edit TC',['controller'=>'TransferCertificates','action'=>'edit',$transfer_certificate_id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                        $data.=' ';
                        $data.=$form->postLink(__('Cancel TC'), ['controller'=>'TransferCertificates','action' => 'tcCancel', $transfer_certificate_id], ['confirm' => __('Are you sure you want to cancel this TC?'),'escape'=>false,'class'=>'btn btn-xs btn-info']);
                    }
                    else
                    {
                        $data.=$html->link('Create TC',['controller'=>'TransferCertificates','action'=>'add',$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                    }
                    
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function transferCertificate()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='';
        $this->set(compact('StudentClasses','fee_type'));
    }
    public function feeStructure()
    {
        $StudentClasses = $this->Students->StudentInfos->StudentClasses->find('list');
        $fee_type='';
        $this->set(compact('StudentClasses','fee_type'));
    }
    
    public function getStudentFeeStructure()
    {
        $success = 0;
        $class_id=$this->request->getData('class_id');
        $scholar_no=$this->request->getData('scholar_number');
        $student_name=$this->request->getData('student_name');
        $father_name=$this->request->getData('father_name');
        $session_year_id=$this->Auth->User('session_year_id');
      
        $students=$this->Students->find();
        if(!empty($scholar_no))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($scholar_no) {
                return $exp->like('Students.scholar_no', '%'.$scholar_no.'%');
            });
        }
        if(!empty($student_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($student_name) {
                return $exp->like('Students.name', '%'.$student_name.'%');
            });
        }
        if(!empty($father_name))
        {
            $students->where(function (QueryExpression $exp, Query $q) use($father_name) {
                return $exp->like('Students.father_name', '%'.$father_name.'%');
            });
        }
        $students->contain(['StudentInfos'=>function($studentInfos) use($class_id,$session_year_id){
                $studentInfos->where(['StudentInfos.session_year_id'=>$session_year_id])->contain(['StudentClasses']);
                if(!empty($class_id))
                {
                    $studentInfos->where(['StudentInfos.student_class_id'=>$class_id]);
                }
                return $studentInfos;
        }]);                
        
        $response=[];
        $sr_no=1;

        $html = new HtmlHelper(new \Cake\View\View());
        foreach ($students as $studentsForm)
        {
            foreach ($studentsForm->student_infos as $student_info) 
            {
                $id = $this->EncryptingDecrypting->encryptData($student_info->id);
                $success = 1;
                $data='';
                $data.='
                        <tr>
                        <td style="text-align:center !important;">'.$sr_no++.'</td>
                        <td style="text-align:center !important;">'.$student_info->student_class->name.'</td>
                        <td style="text-align:center !important;">'.$studentsForm->scholar_no.'</td>
                        <td>'.$studentsForm->name.'</td>
                        <td>'.$studentsForm->father_name.'</td>
                   ';
                    $data.='<td style="text-align:center !important;">';
                    $data.=$html->link('View',['controller'=>'Students','action'=>'feeStructureView',$id],['escape'=>false,'class'=>'btn btn-xs btn-info']);
                    $data.='</td>';
                    $data.='</tr>';
                    $response[]=$data;
                    
            }
        }
        if($success==0)
        {
            $response[]='
                        <tr>
                        <td style="text-align:center !important;" colspan="6"><h3>No record found.</h3></td>
                        </tr>
                   ';
        }
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function feeStructureView($student_info_id)
    {
        $id = $this->EncryptingDecrypting->decryptData($student_info_id);
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $session_name = $this->Auth->User('session_name');
        
        $feeReceipts = $this->Students->StudentInfos->FeeReceipts->find();
        $feeReceipts->where(['session_year_id'=>$session_year_id]);
        $feeReceipts->where(['fee_category_id'=>1]);
        
        $feeReceipts->select(['receipt_no'=>$feeReceipts->func()->max('receipt_no')]);
        $feeReceipts = $feeReceipts->first();
        $ReceiptNo=$feeReceipts->receipt_no+1; 
        
        $FeeReturnData=$this->FeeReceipt->feeStructureGenerate($id,$session_year_id);
        $FeeData = $FeeReturnData['FeeData'];
        $studentInfos = $FeeReturnData['studentInfos'];
        $students = $FeeReturnData['students'];
        
        foreach ($FeeData as $Fee_data_show)
        {
            foreach ($Fee_data_show->fee_type_master_rows as $fee_type_master_row) {
                if(!empty($fee_type_master_row->fee_type_student_masters))
                {
                    foreach ($fee_type_master_row->fee_type_student_masters as $fee_type_student_master) {
                        $fee_store[$Fee_data_show->fee_type->name][]=$fee_type_student_master->amount;
                    }
                }
                else
                {
                    $fee_store[$Fee_data_show->fee_type->name][]=$fee_type_master_row->amount;
                }
                
            }
            
        }
        
        foreach ($fee_store as $fee_name => $get_fee) {
           
            $fee_structure_data[$fee_name]=max($get_fee);
        }
       /* pr($this->Auth->User());
        exit;*/

        
         
        
        
        $this->set(compact('fee_structure_data', 'students', 'studentInfos','session_name'));
    }

}
