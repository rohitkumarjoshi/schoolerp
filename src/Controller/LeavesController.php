<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Leaves Controller
 *
 * @property \App\Model\Table\LeavesTable $Leaves
 *
 * @method \App\Model\Entity\Leave[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeavesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit','leaveApproval']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type  = $this->Auth->User('login_type');
        $user_type   = $this->Auth->User('user_type');
         
        $this->paginate = [
            'contain' => ['Students','Employees']
        ]; 
        $leaves = $this->Leaves->find();
        if(!empty($this->request->getData('daterange'))){
            $daterange=explode('/',$this->request->getData('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            $leaves->where(function($exp) use($date_from,$date_to) {
                return $exp->between('date_from', $date_from, $date_to, 'date');
            })
            ->orWhere(function($exp) use($date_from,$date_to) {
                 return $exp->between('date_to', $date_from, $date_to, 'date');
            });
        }
        if(!empty($this->request->getQuery('status'))){
             $leaves->where(['Leaves.status'=> $this->request->getQuery('status')]);
        }   
            
        if($user_type=='Employee'){
            if($login_type=='Admin'){
                $leaves->where(['Leaves.created_by'=> $user_id]);
            }
            else{
                $leaves->where(['Leaves.employee_id'=> $user_id]);
            }
        }
        if($user_type=='Student'){
            $leaves->where(['Leaves.student_id'=> $user_id]);
        }
            
        $leaves = $this->paginate($leaves);
         
        $this->set(compact('leaves','user_type'));
    } 

    public function studentIndex()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type  = $this->Auth->User('login_type');
        $user_type   = $this->Auth->User('user_type');
         
        $this->paginate = [
            'contain' => ['Students','Employees']
        ]; 
        $leaves = $this->Leaves->find()->where(['Leaves.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            $leaves->where(function($exp) use($date_from,$date_to) {
                return $exp->between('date_from', $date_from, $date_to, 'date');
            })
            ->orWhere(function($exp) use($date_from,$date_to) {
                 return $exp->between('date_to', $date_from, $date_to, 'date');
            });
        } 
        if(!empty($this->request->getQuery('status'))){
             $leaves->where(['Leaves.status'=> $this->request->getQuery('status')]);
        } 
            
        if($user_type=='Employee'){
            if($login_type=='Admin'){
                $leaves->where(['Leaves.created_by'=> $user_id]);
            }
            else{
                $leaves->where(['Leaves.employee_id'=> $user_id]);
            }
        }
        if($user_type=='Student'){
            $leaves->where(['Leaves.student_id'=> $user_id]);
        }
            
        $leaves = $this->paginate($leaves);
         
        $this->set(compact('leaves','user_type'));
    } 
    /**
     * View method
     *
     * @param string|null $id Leave id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leave = $this->Leaves->get($id, [
            'contain' => ['SessionYears', 'Students']
        ]);

        $this->set('leave', $leave);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type  = $this->Auth->User('login_type');
        $user_type   = $this->Auth->User('user_type');
        $leave = $this->Leaves->newEntity();
        if ($this->request->is('post')) {
            $leave = $this->Leaves->patchEntity($leave, $this->request->getData());
            $leave->date_from= date('Y-m-d',strtotime($this->request->getData('date_from')));
            $leave->date_to= date('Y-m-d',strtotime($this->request->getData('date_to')));
            if(!empty($this->request->getData('halfday_date'))){
                 $leave->halfday_date= date('Y-m-d',strtotime($this->request->getData('halfday_date')));
            }
            if($user_type == 'Employee'){
                $leave->employee_id =$user_id;
            }
            else{
                $leave->student_id =$user_id;
            }
           
            $leave->created_by =$user_id;
            $leave->session_year_id =$session_year_id;
            $leave->status ='Pending'; 
            if ($this->Leaves->save($leave)) {
                $this->Flash->success(__('The leave has been saved.'));
                if($user_type == 'Employee'){
                    return $this->redirect(['action' => 'index']);
                }
                else{
                     return $this->redirect(['action' => 'StudentIndex']);
                }
            }
            $this->Flash->error(__('The leave could not be saved. Please, try again.'));
        }
        $this->set(compact('leave'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $id = $this->EncryptingDecrypting->decryptData($id);
        $leave = $this->Leaves->get($id, [
            'contain' => []
        ]);
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leave = $this->Leaves->patchEntity($leave, $this->request->getData());
            $leave->date_from= date('Y-m-d',strtotime($this->request->getData('date_from')));
            $leave->date_to= date('Y-m-d',strtotime($this->request->getData('date_to')));
            if(!empty($this->request->getData('halfday_date'))){
                 $leave->halfday_date= date('Y-m-d',strtotime($this->request->getData('halfday_date')));
            }
            $leave->student_id =$user_id;
            $leave->edited_by =$user_id;
            $leave->session_year_id =$session_year_id;
            $leave->status ='Pending';
            if ($this->Leaves->save($leave)) {
                $this->Flash->success(__('The leave has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave could not be saved. Please, try again.'));
        }
        $status=['Y'=>'Deactive','N'=>'Active'];
        $this->set(compact('leave','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $leave = $this->Leaves->get($id);
        if ($this->Leaves->delete($leave)) {
            $this->Flash->success(__('The leave has been deleted.'));
        } else {
            $this->Flash->error(__('The leave could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function leaveApproval()
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        $login_type  = $this->Auth->User('login_type');
        $user_type   = $this->Auth->User('user_type');
        $data = $this->Leaves->FacultyClassMappings->ClassMappings->find();
           
       
        $data->select(['Mname'=>'Mediums.name','Mid'=>'Mediums.id','Cname'=>'StudentClasses.name','Cid'=>'StudentClasses.id','Sname'=>'Streams.name','STid'=>'Streams.id','SCname'=>'Sections.name','SCid'=>'Sections.id'])
            ->where(['ClassMappings.session_year_id'=>$session_year_id,'ClassMappings.employee_id'=>$user_id])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
     
         
        $option=[];
        foreach ($data as $key => $d) {
            $option[]=[ 
                'mid'=>$d->Mid,
                'cid'=>$d->Cid,
                'stid'=>$d->STid,
                'scid'=>$d->SCid,
            ];
        }
       

        $this->paginate = [
            'contain' => ['Students','Employees']
        ]; 
        $leaves = $this->Leaves->find()->where(['Leaves.is_deleted'=>'N']);
        if(!empty($this->request->getQuery('daterange'))){
            $daterange=explode('/',$this->request->getQuery('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            $leaves->where(function($exp) use($date_from,$date_to) {
                return $exp->between('date_from', $date_from, $date_to, 'date');
            })
            ->orWhere(function($exp) use($date_from,$date_to) {
                 return $exp->between('date_to', $date_from, $date_to, 'date');
            });
        }
        if(!empty($this->request->getQuery('status'))){
             $leaves->where(['Leaves.status'=> $this->request->getQuery('status')]);
        }  
        if(!empty($this->request->getQuery('student_id'))){
             $leaves->where(['Leaves.student_id'=> $this->request->getQuery('student_id')]);
        }  
        if(!empty($this->request->getQuery('employee_id'))){
             $leaves->where(['Leaves.employee_id'=> $this->request->getQuery('employee_id')]);
        }
        if($user_type=='Employee'){
            if($login_type=='Admin'){
                $stud = $this->Leaves->Students->StudentInfos->find()->contain(['Students'])->where(['StudentInfos.session_year_id'=>@$session_year_id,'Students.is_deleted'=>'N']);
            }
            else{ 
                $StudentsIds=[];
                foreach ($option as $key => $value) {
                    $stud = $this->Leaves->Students->StudentInfos->find()->where(['StudentInfos.session_year_id'=>@$session_year_id]);
                    
                    $medium_id='';
                    if(!empty($value['mid'])){
                        $medium_id=$value['mid'];
                        $stud->where(['StudentInfos.medium_id'=>@$medium_id]);
                    } 

                    $section_id='';
                    if(!empty($value['scid'])){
                        $section_id=$value['scid'];
                        $stud->where(['StudentInfos.section_id'=>@$section_id]);
                    }   
                    
                    
                    $class_id='';
                    if(!empty($value['cid'])){
                        $class_id=$value['cid'];
                        $stud->where(['StudentInfos.student_class_id'=>@$class_id]);
                    } 
                    $stream_id='';
                    if(!empty($value['stid'])){
                        $stream_id=$value['stid'];
                        $stud->where(['StudentInfos.stream_id'=>@$stream_id]);
                    } 
                    $stud->contain(['Students']); 
                    if(sizeof($stud->toArray())>0){
                        foreach ($stud as $stdRecod) {
                            $StudentsIds[]= $stdRecod->student_id;
                        }
                    }  
                }

                if(!empty($StudentsIds)){
                 $leaves->where(['Leaves.student_id IN'=> $StudentsIds]);
                }
                else
                {
                    $leaves->where(['Leaves.student_id IN'=> 0]); 
                }
                
            }
        }   
        $leaves->order(['Leaves.id'=>'DESC']);
        $leaves = $this->paginate($leaves);

        if($this->request->is(['post']))
        {
            if(isset($this->request->data['accept_request_id'])) 
            {
                $accept_request_id=$this->request->getData('accept_request_id');
                $leaveData=$this->Leaves->get($accept_request_id);
                $dateFrom = $leaveData->date_from;
                $dateTo = $leaveData->date_to;
                $half_day = $leaveData->half_day;
                $halfday_type = $leaveData->halfday_type;
                $halfday_date = $leaveData->halfday_date;
                $student_id = $leaveData->student_id;
                if($student_id){
                    $StudentData=$this->Leaves->Students->StudentInfos->find()->select('id')->where(['StudentInfos.student_id'=>$student_id,'StudentInfos.session_year_id'=>$session_year_id])->first();
                    $studentInfoId = $StudentData->id;

                    $currentTime=strtotime($dateFrom);
                    $endTime=strtotime($dateTo);

                    $HalfDayTime=strtotime($halfday_date);
                    //---
                    $k=0;
                    $results = array();
                    while ($currentTime <= $endTime) {
                         if (date('N', $currentTime) < 8) {
                            //$results[] = date('Y-m-d', $currentTime);
                            echo $currentDate = date('Y-m-d', $currentTime);
                            if($half_day=='Yes'){
                                //--Half day Entry
                                if($HalfDayTime==$currentTime){
                                   if($halfday_type=='First'){
                                        $check=0;
                                        $attendance='';
                                        $check = $this->Leaves->Attendances->find()->where(['Attendances.attendance_date'=>$currentDate,'Attendances.student_info_id'=>$studentInfoId])->first();
                                        if(!empty($check)){

                                            $attendance = $this->Leaves->Attendances->get($check->id, [
                                                'contain' => []
                                            ]);
                                            $attendance->edited_by = $user_id; 
                                        }
                                        else{
                                            $attendance = $this->Leaves->Attendances->newEntity();
                                            $attendance->created_by = $user_id; 
                                        }
                                        $attendance->attendance_date=$currentDate;
                                        $attendance->student_info_id = $studentInfoId; 
                                        $attendance->session_year_id = $session_year_id; 
                                        $attendance->first_half = 1; 
                                        $this->Leaves->Attendances->save($attendance);
                                   }
                                   else{
                                        $check=0;
                                        $attendance='';
                                        $check = $this->Leaves->Attendances->find()->where(['Attendances.attendance_date'=>$currentDate,'Attendances.student_info_id'=>$studentInfoId])->first();
                                        if(!empty($check)){

                                            $attendance = $this->Leaves->Attendances->get($check->id, [
                                                'contain' => []
                                            ]);
                                            $attendance->edited_by = $user_id; 
                                        }
                                        else{
                                            $attendance = $this->Leaves->Attendances->newEntity();
                                            $attendance->created_by = $user_id; 
                                        }
                                        $attendance->attendance_date=$currentDate;
                                        $attendance->student_info_id = $studentInfoId; 
                                        $attendance->session_year_id = $session_year_id; 
                                        $attendance->second_half = 1;
                                        $this->Leaves->Attendances->save($attendance);     
                                   }
                                }
                                else{
                                    //--Full day Entry 
                                    $check=0;
                                    $attendance=''; 
                                    $check = $this->Leaves->Attendances->find()->where(['Attendances.attendance_date'=>$currentDate,'Attendances.student_info_id'=>$studentInfoId])->first();
                                    
                                    if(!empty($check)){

                                        $attendance = $this->Leaves->Attendances->get($check->id, [
                                            'contain' => []
                                        ]);
                                        $attendance->edited_by = $user_id; 
                                    }
                                    else{
                                        $attendance = $this->Leaves->Attendances->newEntity();
                                        $attendance->created_by = $user_id; 
                                    }

                                    $attendance->attendance_date=$currentDate;
                                    $attendance->student_info_id = $studentInfoId; 
                                    $attendance->session_year_id = $session_year_id; 
                                    $attendance->first_half = 1;
                                    $attendance->second_half = 1; 
                                    $this->Leaves->Attendances->save($attendance);
                                }
                            }
                            else{
                                //--Full day Entry 
                                $check=0;
                                $check = $this->Leaves->Attendances->find()->where(['Attendances.attendance_date'=>$currentDate,'Attendances.student_info_id'=>$studentInfoId])->first();
                                if(!empty($check)){

                                    $attendance = $this->Leaves->Attendances->get($check->id, [
                                        'contain' => []
                                    ]);
                                    $attendance->edited_by = $user_id; 
                                }
                                else{
                                    $attendance = $this->Leaves->Attendances->newEntity();
                                    $attendance->created_by = $user_id; 
                                }
                                $attendance->attendance_date=$currentDate;
                                $attendance->student_info_id = $studentInfoId; 
                                $attendance->session_year_id = $session_year_id; 
                                $attendance->first_half = 1;
                                $attendance->second_half = 1;
                                $this->Leaves->Attendances->save($attendance); 
                            }
                         }
                         $currentTime = strtotime('+1 day', $currentTime);
                    }
                }
              
                $approved_on=date('Y-m-d'); 
                $query = $this->Leaves->query();
                $result = $query->update()
                    ->set(['status' => 'Approved','action_by'=>$user_id,'action_date'=>$approved_on])
                    ->where(['id' =>$accept_request_id ])
                    ->execute();
                $this->Flash->success(__('The leave has been approved.'));
                return $this->redirect(['action' => 'leaveApproval']);
            }
            if(isset($this->request->data['reject_request_id'])) 
            { 
                $reject_request_id=$this->request->getData('reject_request_id');
                $leaveData=$this->Leaves->get($reject_request_id);
                $dateFrom = $leaveData->date_from;
                $dateTo = $leaveData->date_to;
                $half_day = $leaveData->half_day;
                $halfday_type = $leaveData->halfday_type;
                $halfday_date = $leaveData->halfday_date;
                $student_id = $leaveData->student_id;
                if($student_id){
                    $StudentData=$this->Leaves->Students->StudentInfos->find()->select('id')->where(['StudentInfos.student_id'=>$student_id,'StudentInfos.session_year_id'=>$session_year_id])->first();
                    $studentInfoId = $StudentData->id;

                    $currentTime=strtotime($dateFrom);
                    $endTime=strtotime($dateTo);

                    $HalfDayTime=strtotime($halfday_date);
                    //---
                    $k=0;
                    $results = array();
                    while ($currentTime <= $endTime) {
                         if (date('N', $currentTime) < 8) {
                            //$results[] = date('Y-m-d', $currentTime);
                            echo $currentDate = date('Y-m-d', $currentTime);
                            if($half_day=='Yes'){
                                //--Half day Entry
                                if($HalfDayTime==$currentTime){
                                   if($halfday_type=='First'){
                                        $check=0;
                                        $attendance='';
                                        $check = $this->Leaves->Attendances->find()->where(['Attendances.attendance_date'=>$currentDate,'Attendances.student_info_id'=>$studentInfoId])->first();
                                        if(!empty($check)){

                                            $attendance = $this->Leaves->Attendances->get($check->id, [
                                                'contain' => []
                                            ]);
                                            $attendance->edited_by = $user_id; 
                                        }
                                        else{
                                            $attendance = $this->Leaves->Attendances->newEntity();
                                            $attendance->created_by = $user_id; 
                                        }
                                        $attendance->attendance_date=$currentDate;
                                        $attendance->student_info_id = $studentInfoId; 
                                        $attendance->session_year_id = $session_year_id; 
                                        $attendance->first_half = 0; 
                                        $this->Leaves->Attendances->save($attendance);
                                   }
                                   else{
                                        $check=0;
                                        $attendance='';
                                        $check = $this->Leaves->Attendances->find()->where(['Attendances.attendance_date'=>$currentDate,'Attendances.student_info_id'=>$studentInfoId])->first();
                                        if(!empty($check)){

                                            $attendance = $this->Leaves->Attendances->get($check->id, [
                                                'contain' => []
                                            ]);
                                            $attendance->edited_by = $user_id; 
                                        }
                                        else{
                                            $attendance = $this->Leaves->Attendances->newEntity();
                                            $attendance->created_by = $user_id; 
                                        }
                                        $attendance->attendance_date=$currentDate;
                                        $attendance->student_info_id = $studentInfoId; 
                                        $attendance->session_year_id = $session_year_id; 
                                        $attendance->second_half = 0;
                                        $this->Leaves->Attendances->save($attendance);     
                                   }
                                }
                                else{
                                    //--Full day Entry 
                                    $check=0;
                                    $attendance=''; 
                                    $check = $this->Leaves->Attendances->find()->where(['Attendances.attendance_date'=>$currentDate,'Attendances.student_info_id'=>$studentInfoId])->first();
                                    
                                    if(!empty($check)){

                                        $attendance = $this->Leaves->Attendances->get($check->id, [
                                            'contain' => []
                                        ]);
                                        $attendance->edited_by = $user_id; 
                                    }
                                    else{
                                        $attendance = $this->Leaves->Attendances->newEntity();
                                        $attendance->created_by = $user_id; 
                                    }

                                    $attendance->attendance_date=$currentDate;
                                    $attendance->student_info_id = $studentInfoId; 
                                    $attendance->session_year_id = $session_year_id; 
                                    $attendance->first_half = 0;
                                    $attendance->second_half = 0; 
                                    $this->Leaves->Attendances->save($attendance);
                                }
                            }
                            else{
                                //--Full day Entry 
                                $check=0;
                                $check = $this->Leaves->Attendances->find()->where(['Attendances.attendance_date'=>$currentDate,'Attendances.student_info_id'=>$studentInfoId])->first();
                                if(!empty($check)){

                                    $attendance = $this->Leaves->Attendances->get($check->id, [
                                        'contain' => []
                                    ]);
                                    $attendance->edited_by = $user_id; 
                                }
                                else{
                                    $attendance = $this->Leaves->Attendances->newEntity();
                                    $attendance->created_by = $user_id; 
                                }
                                $attendance->attendance_date=$currentDate;
                                $attendance->student_info_id = $studentInfoId; 
                                $attendance->session_year_id = $session_year_id; 
                                $attendance->first_half = 0;
                                $attendance->second_half = 0;
                                $this->Leaves->Attendances->save($attendance); 
                            }
                         }
                         $currentTime = strtotime('+1 day', $currentTime);
                    }
                }

                $approved_on=date('Y-m-d'); 
                $query = $this->Leaves->query();
                $result = $query->update()
                    ->set(['status' => 'Rejected','action_by'=>$user_id,'action_date'=>$approved_on])
                    ->where(['id' =>$reject_request_id ])
                    ->execute();
                $this->Flash->error(__('The leave has been rejected.'));
                return $this->redirect(['action' => 'leaveApproval']);
            }
        }
      $students=[];
       foreach ($stud as $students_data) {
          $name = $students_data->student->name;
          $id = $students_data->student->id;
          $students[]=['value'=>$id,'text'=>$name];
       }
        $employee=$this->Leaves->Employees->find('list')->where(['Employees.is_deleted'=>'N','Employees.session_year_id'=>$session_year_id]);         
        $this->set(compact('leaves','user_type','employee','students','login_type'));
    } 
     
}
