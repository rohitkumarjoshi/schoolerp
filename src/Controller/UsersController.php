<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        //$this->Auth->allow(['login','resetPassword','checkOtp','changePassword']);
        $this->Auth->allow(['login']);
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
        $this->Security->setConfig('unlockedActions', ['matchEmployeeUsername','editUser']);
    } 
    public function login()
    {
        $this->viewBuilder()->setLayout('');
        $login = $this->Users->newEntity();
        if ($this->request->is('post')) 
        {
            $redirect = $this->request->getQuery('redirect');
            $user=$this->Auth->identify();

            if($user)
            {
                $users = $this->Users->get($user['id'],[
                    'contain'=>['Employees','Students']
                ]);
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                $randomStrings = '';
                $length = 2;
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                for ($i = 0; $i < $length; $i++) {
                    $randomStrings .= $characters[rand(0, $charactersLength - 1)];
                }
                $users->pass_key='wt1U5MA'.$randomString.'JFTXGenFoZoiLwQGrLgdb'.$randomStrings;
                $SessionYear=$this->Users->Employees->SessionYears->find()->where(['status'=>'Active'])->first();
                $users->session_year_id=$SessionYear->id;
                $users->session_name=$SessionYear->session_name;
                $users->user_id=$users->id;
                if(!empty($users->employee))
                {
                    $role_id=$users->employee->role_id;
                    $users->role_id=$role_id;
                    $users->id=$users->employee->id;
                    $users->login_type=($role_id==1)?'Admin':'Employee';
                }
                else
                {
                    $role_id=$users->student->role_id;
                    $users->role_id=$role_id;
                    $users->id=$users->student->id;
                }
                
               
                $this->Flash->success(__('Welcome to School ERP.'));
                $this->Auth->setUser($users);
                return $this->redirect(['controller'=>'Students','action'=>'index']);
                /*if(!empty($redirect))
                    return $this->redirect(['controller'=>@explode('/',$redirect)[1],'action'=>@\explode('/',$redirect)[2]]);
                else
                    return $this->redirect(['controller'=>'Students','action'=>'index']);*/
            }
            $this->Flash->error(_('Invalid Username & Password. Please try agin?'));
        }
        

        $this->set(compact('login','title'));   
    }
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    public function changepassword()
    {
        $loginId=$this->Auth->User('user_id');
        if ($this->request->is('post')) 
        {
            $Users = $this->Users->get($loginId);
            $Users = $this->Users->patchEntity($Users, [
                        'old_password'  => $this->request->getData('old_password'),
                        'password'      => $this->request->getData('password'),
                        'confirm_password'     => $this->request->getData('confirm_password')
                    ],
                    ['validate' => 'password']);

            if ($this->Users->save($Users))
            {
                $this->Flash->success(__('Your password has been changed successfully.'));
                return $this->redirect(['action' => 'changepassword']);
            }
            else if($Users->getError('old_password'))
            {
                $this->Flash->error(__($Users->getError('old_password')['custom']));
            }
            else if($Users->getError('password')){
                $this->Flash->error(__($Users->getError('password')['custom']));
            }
        }   
    }
    public function editUser()
    {
        
        if ($this->request->is('post')) 
        {

            $user_id=$this->request->getData('user_id');
            $Users = $this->Users->get($user_id);
            $Users = $this->Users->patchEntity($Users,$this->request->getData());
            if ($this->Users->save($Users))
            {
                $this->Flash->success(__('Your password has been changed successfully.'));
                return $this->redirect(['action' => 'editUser']);
            }
            $this->Flash->error(__('Username not saved!'));
        }   
        $employee =  $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'concatenated'
        ]);
        $employee->where(['Users.employee_id IS NOT'=>'Null']);
        $employee->contain([
            'Employees'=>function($q){
                return $q->select(['id','concatenated'=>$q->func()->concat([
                        'name' => 'literal'
                    ])
                ]);
            }
        ]);
        $student =  $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'concatenated'
        ]);
        $student->where(['Users.student_id IS NOT'=>'Null']);
        $student->contain([
            'Students'=>function($q){
                return $q->select(['concatenated'=>$q->func()->concat([
                        'name' => 'literal',
                        ' (',
                        'scholar_no' => 'literal',
                        ' )'
                        
                    ])
                ]);
            }
        ]);
        $this->set(compact('employee','student'));
    }
    public function matchEmployeeUsername()
    {
        $user_id=$this->request->getData('user_id');
        $username=$this->request->getData('username');
        $user =  $this->Users->find()->where(['username'=>$username,'id !='=>$user_id])->count();
        if($user > 0)
        {
            echo 'false'; 
        }
        else
        {
            echo 'true';
        }
       
        exit;
    }
    public function getStudentUsername()
    {
        $success = 0;
        $response='';
        $user_id=$this->request->getData('user_id');
        $user =  $this->Users->get($user_id);
        $response=$user->username;
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function getEmployeeUsername()
    {
        $success = 0;
        $response='';
        $user_id=$this->request->getData('user_id');
        $user =  $this->Users->get($user_id);
        $response=$user->username;
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
    public function resetPassword(){ 
        $this->viewBuilder()->layout('signup');
        
        $adminUser = $this->AdminUsers->newEntity();
        if ($this->request->is('post','put','patch')) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            
             $phone_no = $adminUser->mobile_number;
            if(!empty($phone_no))
            {
                $mobile_no = explode('+91',$phone_no);
                $AdminUsers = $this->AdminUsers->find()->where(['AdminUsers.mobile_no'=>$mobile_no[1]])->first();
                
                if(!empty(@$mobile_no[1])){
                    if(@$AdminUsers->mobile_no == @$mobile_no[1]){
                        $digits = 4;
                        $otp=rand(pow(10, $digits-1), pow(10, $digits)-1);
                        ///start code for sms here
                            $this->loadComponent('Sms');
                            $status="Dear Admin, Your OTP is ".$otp.".";
                            $this->Sms->sendSmsForAssesments($phone_no,$status);
                        ///stop code for sms here
                            
                            $AdminUsers->otp_no=$otp;
                            $this->AdminUsers->save($AdminUsers);
                            $this->Flash->success(__('check your mobile for OTP'));
                            return $this->redirect(['controller'=>'AdminUsers','action' => 'checkOtp',$AdminUsers->id]);
                            
                    }else{
                            $this->Flash->error(__('Wrong mobile number entered'));
                            return $this->redirect(['controller'=>'AdminUsers','action' => 'resetPassword']);
                            
                            
                            
                    }
                }else{
                    $this->Flash->error(__('Enter Mobile Number'));
                    return $this->redirect(['controller'=>'AdminUsers','action' => 'resetPassword']);
                    
                }   
            }
        }
    }
    
    public function checkOtp($id=null){ 
        $this->viewBuilder()->layout('signup');
        $adminUser = $this->AdminUsers->newEntity();
        if ($this->request->is('post','put','patch')) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            
             $otp_no = $adminUser->otp_no;
             if(!empty($otp_no))
            {
                $AdminUsers = $this->AdminUsers->get($id);
                if($AdminUsers->otp_no==$otp_no){
                    $AdminUsers->otp_no=0;
                    $this->AdminUsers->save($AdminUsers);
                    $this->Flash->success(__('Change Password'));
                    return $this->redirect(['controller'=>'AdminUsers','action' => 'change-password',$id]);
                }else{
                    $this->Flash->success(__('wrong OTP'));
                    return $this->redirect(['controller'=>'AdminUsers','action' => 'checkOtp',$id]);
                }
                
            }
        }
    }
    
    public function forgotPassword($id=null){
        $this->viewBuilder()->layout('signup');
        $adminUser = $this->AdminUsers->newEntity();
         if ($this->request->is('post','put','patch')) {
            $AdminUsers = $this->AdminUsers->patchEntity($adminUser, $this->request->data);
            $AdminUsers->id=$id;
            if ($this->AdminUsers->save($AdminUsers)) {
                $this->Flash->success(__('Password changed successfully.Please login with new credentials.'));
                //$this->Auth->setUser($user);
                return $this->redirect(['controller'=>'AdminUsers','action' => 'login']);
                
            } else {
                $this->Flash->error(__('The password could not be updated right now. Please, try again.'));
            }
         }
    }
}
