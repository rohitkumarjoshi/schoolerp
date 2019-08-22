<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Auth\DefaultPasswordHasher;
/* Students Controller */
class StudentsController extends AppController
{
	public function login()
	{ 
		$username=$this->request->getData('username');
		$password=$this->request->getData('password');
		$session_year=$this->request->getData('session_year');
		$hasher = new DefaultPasswordHasher();
		$user=$this->Students->find()
			->contain(['StudentInfos'=>function($q)use($session_year){
				return $q->where(['StudentInfos.session_year_id'=>$session_year]);
			}])
			->where(['Students.username'=>$username])->first();
		if(!empty($user))
		{
			$user->password;
			$is_valid_password=$hasher->check($password,$user->password); 
			if($is_valid_password){

				$success=true;
				$error='';
				unset($user->password);
			}else{
				$success=false;
				$error="Wrong password";
				$user=array();
			}
		}
		else
		{
			$success=false;
			$error="Wrong username and password";
			$user=array();
		}
		$response=$user;
		$this->set(compact('success', 'error', 'response'));
		$this->set('_serialize', ['success', 'error', 'response']);
	}
	
	public function forgotPassword()
	{
		$mobile_no=$this->request->data('mobile_no');
		$IfUserExist=$this->Students->find()->where(['parent_mobile_no'=>$mobile_no])->count();
		if($IfUserExist>0)
		{		
			$random=(string)mt_rand(1000,9999);
			$sms1=str_replace(' ', '+', 'Dear, Your one time password is '.$random.'.');
			$sms_sender = 'SCHOOL';
			$query = $this->Students->query();
            $query->update()->set(['otp' => $random])
                  ->where(['parent_mobile_no' => $mobile_no])->execute();
				  
			//file_get_contents("http://103.39.134.40/api/mt/SendSMS?user=phppoetsit&password=9829041695&senderid=".$sms_sender."&channel=Trans&DCS=0&flashsms=0&number=".$mobile_no."&text=".$sms."&route=7");
			$result=array('otp' => $random,'mobile_no' => $mobile_no);
			
			$success=true;
			$error='';
			$response=$result;
		}
		else
		{
			$success=false;
			$error='Mobile no. not registered';
			$response=array();
		}
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
 	}
 	
	public function ChangePassword()
	{
		$mobile_no=$this->request->data('mobile_no');
		$password=$this->request->data('password'); 
		$Ifexistuser=$this->Students->find()->where(['parent_mobile_no'=>$mobile_no])->count();
		if($Ifexistuser>0)
		{
			$studentData=$this->Students->find()->where(['parent_mobile_no'=>$mobile_no])->first();
			$UpdatedstudentData=$this->Students->get($studentData->id);
			$UpdatedstudentData->password=$password;
			$UpdatedstudentData->otp='';
			
			if ($this->Students->save($UpdatedstudentData)){
				$success=true;
				$error='';
				$response="password update successfully";
			}
			else
			{
				$success=false;
				$error='Something went wrong.';
				$response="";
			}
		}
		else
		{
			$success=false;
			$error='User not found.';
			$response="";
		}
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
 	}
   
}
