<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
/* Students Controller */
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function login()
    { 
        $username=$this->request->getData('username');
        $password=$this->request->getData('password'); 
        $hasher = new DefaultPasswordHasher();
        $SessionYear=$this->Users->Employees->SessionYears->find()->where(['status'=>'Active'])->first();
        $CurrentSession=$SessionYear->id;
 
        $user=$this->Users->find() 
        ->contain(['Employees',
            'Students'=>['StudentInfoApis'=>function($q)use($CurrentSession){
                return $q->where(['StudentInfoApis.session_year_id'=>$CurrentSession]);
            },'StudentDocuments']]) 
        ->where(['Users.username'=>$username,'Users.is_deleted'=>'N'])->first();
        if(!empty($user))
        {
            $cdnPath = $this->AwsFile->cdnPath();
            $user['cdnPath']=$cdnPath;
            $is_valid_password=$hasher->check($password,$user->password); 
            if($is_valid_password){
                $success=true;
                $message='';
                unset($user->password);
            }else{
                $success=false;
                $message="Wrong password";
                $user=array();
            }
        }
        else
        {
            $success=false;
            $message="Wrong username and password";
            $user=array();
        } 
        $this->set(compact('success', 'message', 'user'));
        $this->set('_serialize', ['success', 'message', 'user']);
    } 
    
    public function forgotPassword()
    {
        $mobile_no=$this->request->data('mobile_no');
        $IfUserExist=$this->Users->Students->find()->where(['parent_mobile_no LIKE'=>'%'.$mobile_no.'%'])->count();
       
        if($IfUserExist>0)
        {       
            $random=(string)mt_rand(1000,9999);
            $sms1=str_replace(' ', '+', 'Dear, Your one time password is '.$random.'.');
            $sms_sender = 'SCHOOL'; 
                  
            file_get_contents("http://103.39.134.40/api/mt/SendSMS?user=phppoetsit&password=9829041695&senderid=".$sms_sender."&channel=Trans&DCS=0&flashsms=0&number=".$mobile_no."&text=".$sms1."&route=7");
            $result=array('otp' => $random,'mobile_no' => $mobile_no);
            
            $success=true;
            $message='';
            $response=$result;
        }
        else
        {
            $success=false;
            $message='Mobile no. not registered';
            $response=array();
        } 
        $forgotResponse=$response;
        $this->set(compact('success','message','forgotResponse'));
        $this->set('_serialize', ['success','message','forgotResponse']);
    }

    public function ChangePassword()
    {
        $mobile_no=$this->request->data('mobile_no');
        $password=$this->request->data('password'); 
        $Ifexistuser=$this->Users->Students->find()->where(['parent_mobile_no LIKE'=>'%'.$mobile_no.'%'])->count();
        if($Ifexistuser>0)
        {
            $studentData=$this->Users->Students->find()->select(['id'])->where(['parent_mobile_no LIKE'=>'%'.$mobile_no.'%']);
            $success=0;
            foreach ($studentData as $OneByOne) {
                $Updatedstudents=$this->Users->find()->select(['id'])->where(['student_id'=>$OneByOne->id])->first();

                $UpdatedstudentData=$this->Users->get($Updatedstudents->id);
                $UpdatedstudentData->password=$password;
                if ($this->Users->save($UpdatedstudentData)){
                    $success=1;
                } 
            }
            if ($success==1){
                $success=true;
                $message='Password update successfully'; 
            }
            else
            {
                $success=false;
                $message='Something went wrong'; 
            }
        }
        else
        {
            $success=false;
            $message='User not found.'; 
        }
        $this->set(compact('success','message'));
        $this->set('_serialize', ['success','message']);
    }

    public function apiVersion(){
        $this->ApiVersions = TableRegistry::get('ApiVersions');
        $apiVersions=$this->ApiVersions->find()->first();
        $cdnPath = $this->AwsFile->cdnPath();
        $apiVersions['cdnPath']=$cdnPath;
        $success=true;
        $message=''; 
        
        $this->set(compact('success','message','apiVersions'));
        $this->set('_serialize', ['success','message','apiVersions']);
    }

    public function profileDetails(){
        $user_id = $this->request->getData('user_id'); 
        $user_type = $this->request->getData('user_type'); 
        $currentSession = $this->AwsFile->currentSession();
        $class_teacher=[];
        if($user_type =='Employee'){
            $studentsDetails= $this->Users->Employees->find()->where(['Employees.id'=>$user_id])->first();
        }
        if($user_type == 'Student'){
            $studentsDetails= $this->Users->Students->find()->where(['Students.id'=>$user_id])
            ->contain(['StudentDocuments'=>function($q){
                    return $q->where(['StudentDocuments.document_class_mapping_id IS NULL']);
                },
                'StudentInfoApis'=>function($q)use($currentSession){
                return $q->where(['StudentInfoApis.session_year_id'=>$currentSession])->contain(['MediumsApi', 'StudentClassesApi', 'StreamsApi', 'SectionsApi','StudentHealths'=>['HealthMasters']]);
            }])->first(); 
            
            $medium_id = $studentsDetails->student_info_api->medium_id;
            $student_class_id = $studentsDetails->student_info_api->student_class_id;
            $section_id = $studentsDetails->student_info_api->section_id;
            $stream_id = $studentsDetails->student_info_api->stream_id;
            $conditionp=[];
            if(!empty($medium_id)){
                $condition['ClassMappings.medium_id']= $medium_id;
            } 

            if(!empty($section_id)){  
                $condition['ClassMappings.section_id']= $section_id;
            } 

            if(!empty($student_class_id)){  
                $condition['ClassMappings.student_class_id']= $student_class_id;
            } 

            if(!empty($stream_id))
            { 
                $condition['ClassMappings.stream_id']= $stream_id;
            }
            $class_teacher = $this->Users->Employees->ClassMappings->find()->contain('Employees')->where($condition)->first();
        }
        $recordArray['userDetails']=$studentsDetails;
        $recordArray['classTeacher']=$class_teacher; 
        $success=true;
        $message='';
        $this->set(compact('success', 'message', 'recordArray'));
        $this->set('_serialize', ['success', 'message', 'recordArray']); 
    }
}
