<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Attendances Controller
 *
 * @property \App\Model\Table\AttendancesTable $Attendances
 *
 * @method \App\Model\Entity\Attendance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AttendancesController extends AppController
{
    
    public function initialize()
    {
        parent::initialize();
        //$this->loadComponent('Csrf');
    }
     public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        
      //  $this->getEventManager()->off($this->Csrf);
        $this->Security->setConfig('unlockedActions', ['add','summaryAttendance']);
         
        

    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function summaryAttendance()
    {
        //pr($daterange);exit;
        if ($this->request->is(['post','put'])) 
        {
         $date=date('Y-m-d',strtotime($this->request->getData('date')));
         //pr($date);exit;
        }
        else
        {
            $date=date('Y-m-d');
           
        }
        //


        $attendances=$this->Attendances->find()
        ->contain(['StudentInfos'=>['Students','Mediums','StudentClasses','Sections'],'ClassMappings'=>['Employees']])
        ->where(['Attendances.attendance_date'=>$date])
        ->group(['StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.section_id'])->autoFields(true);
        //pr($attendances->toArray());exit;

        $morning_p = $attendances->newExpr()
                ->addCase(
                    $attendances->newExpr()->add(['Attendances.first_half' => 0.5]),
                    1,
                    'integer'
                );
        $morning_a = $attendances->newExpr()
                ->addCase(
                    $attendances->newExpr()->add(['Attendances.first_half' => 0.0]),
                    1,
                    'integer'
                );

        $morning_a_1 = $attendances->newExpr()
                ->addCase(
                    $attendances->newExpr()->add(['Attendances.first_half' => 1]),
                    1,
                    'integer'
                );

        $evening_p = $attendances->newExpr()
                ->addCase(
                    $attendances->newExpr()->add(['Attendances.second_half' => 0.5]),
                    1,
                    'integer'
                );
        $evening_a = $attendances->newExpr()
                ->addCase(
                    $attendances->newExpr()->add(['Attendances.second_half' => 0.0]),
                    1,
                    'integer'
                );
        $evening_a_1 = $attendances->newExpr()
                ->addCase(
                    $attendances->newExpr()->add(['Attendances.second_half' => 1]),
                    1,
                    'integer'
                );

        $total_student = $attendances->newExpr()
                ->addCase(
                    $attendances->newExpr()->add(['Attendances.student_info_id']),
                    1,
                    'integer'
                );

            $attendances->select([
                'morning_p' => $attendances->func()->count($morning_p),
                'morning_a' => $attendances->func()->count($morning_a),
                'morning_a_1' => $attendances->func()->count($morning_a_1),
                'evening_p' => $attendances->func()->count($evening_p),
                'evening_a' => $attendances->func()->count($evening_a),
                'evening_a_1' => $attendances->func()->count($evening_a_1),
                'total_student' => $attendances->func()->count($total_student),
                'Attendances.student_info_id'
            ]);
      
        //pr($attendances->toArray());exit;

        $this->set(compact('attendances','date'));
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['SessionYears', 'Mediums', 'StudentClasses', 'Streams', 'Sections', 'StudentInfos']
        ];
        $attendances = $this->paginate($this->Attendances);

        $this->set(compact('attendances'));
    }


    public function attendanceReport()
    {
        //$attendances=$this->Attendances->find()->where(['id'=>1]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $medium_id=$this->request->getData('medium_id');
            $student_months=$this->request->getData('student_months');
            $student_class_id=$this->request->getData('student_class_id');
            //pr($student_class_id);exit;
            $section_id=$this->request->getData('section_id');

            if(!empty($student_months))
            {
                $attendances=$this->Attendances->find()->where(['Attendances.attendance_date LIKE'=>'%'.$student_months.'%'])->contain(['StudentInfos'=>['Students']])->group(['Attendances.student_info_id']);
            }

            if(!empty($medium_id))
            {
                $attendances=$this->Attendances->find()->where(['StudentInfos.medium_id'=>$medium_id])->contain(['StudentInfos'=>['Students','Mediums','StudentClasses','Sections']]);
                //pr($attendances->toArray());exit;
            }
            if(!empty($student_class_id))
            {
                $attendances=$this->Attendances->find()->where(['StudentInfos.student_class_id'=>$student_class_id])->contain(['StudentInfos'=>['Students','Mediums','StudentClasses','Sections']]);
            }
            if(!empty($section_id))
            {
                $attendances=$this->Attendances->find()->where(['StudentInfos.section_id'=>$section_id,])->contain(['StudentInfos'=>['Students','Mediums','StudentClasses','Sections']]);
            }
            //ini_set('memory_limit', '-1');


           
        }

        $mediums=$this->Attendances->StudentInfos->Mediums->find('list')->where(['Mediums.is_deleted'=>'N']);
        $sections=$this->Attendances->StudentInfos->Sections->find('list')->where(['Sections.is_deleted'=>'N']);
        $classes=$this->Attendances->StudentInfos->StudentClasses->find('list')->where(['StudentClasses.is_deleted'=>'N']);

        $this->set(compact('attendances','mediums','sections','month','classes'));
    }

    /**
     * View method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendance = $this->Attendances->get($id, [
            'contain' => ['SessionYears', 'Mediums', 'StudentClasses', 'Streams', 'Sections', 'StudentInfos']
        ]);

        $this->set('attendance', $attendance);
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
        if ($this->request->is('get'))
        {
            $where=[];
            $attendance_date= date('Y-m-d',strtotime($this->request->getQuery('attendance_date')));
            $medium_id = $this->request->getQuery('medium_id');
            if(!empty($medium_id)){
               $where['StudentInfos.medium_id'] = $medium_id; 
			   $Mediumsdata=$this->Attendances->StudentInfos->Mediums->get($medium_id);
			   $medium_name=$Mediumsdata->name;
            }
            $student_class_id = $this->request->getQuery('student_class_id');
            if(!empty($student_class_id)){
               $where['StudentInfos.student_class_id'] = $student_class_id; 
			   $StudentClassdata=$this->Attendances->StudentInfos->StudentClasses->get($student_class_id);
			   $class_name=$StudentClassdata->name;
            }
            $stream_id = $this->request->getQuery('stream_id');
            if(!empty($stream_id)){
               $where['StudentInfos.stream_id'] = $stream_id; 
			    $Streamsdata=$this->Attendances->StudentInfos->Streams->get($stream_id);
			    $stream_name=$Streamsdata->name;
            }
            $section_id = $this->request->getQuery('section_id');
            if(!empty($section_id)){
               $where['StudentInfos.section_id'] = $section_id; 
			   $Sectionsdata=$this->Attendances->StudentInfos->Sections->get($section_id);
			    $section_name=$Sectionsdata->name;
            }

            $optradio = $this->request->getQuery('optradio'); 
            $attendancesDatas = $this->Attendances->StudentInfos->find()
            ->contain(['Students','Attendances'=>function($q)use($attendance_date){
                return $q->where(['attendance_date'=>$attendance_date]);
            }])
            ->where($where)->order(['Students.name'=>'ASC']);
            //pr($attendancesDatas->toArray());exit;
			
			
        }
        $attendance = $this->Attendances->newEntity();
        if ($this->request->is('post')) {
            $attendance_date= date('Y-m-d',strtotime($this->request->getQuery('attendance_date')));
            $student_info_id=$this->request->getData('student_info_id');
            $attendanceData=$this->request->getData('attendance');
            $attendance_id=$this->request->getData('attendance_id');
            $optradio=$this->request->getData('optradio');
           
            $x=0;
            foreach ($student_info_id as $student_id) {
                if(@$attendance_id[$student_id]){
                    $attendance = $this->Attendances->get($attendance_id[$student_id], [
                        'contain' => []
                    ]);
                    $attendance->edited_by = $user_id; 
                }
                else{
                    $attendance = $this->Attendances->newEntity();
                    $attendance->created_by = $user_id; 
                }
                $attendance->attendance_date=$attendance_date;
                $attendance->student_info_id = $student_id; 
                $attendance->session_year_id = $session_year_id; 
                if($optradio=='first'){
                    echo $attendance->first_half = $attendanceData[$x];
                }
                else{
                    $attendance->second_half = $attendanceData[$x];
                }
                //-Save
                $this->Attendances->save($attendance);

                $x++;
            } 
                return $this->redirect(['action' => 'add']);
            }
        $mediums = $this->Attendances->StudentInfos->Mediums->find('list', ['limit' => 200])->where(['Mediums.is_deleted'=>'N']);
         
        $this->set(compact('attendance', 'mediums','attendancesDatas','optradio','class_name','stream_name','section_name','medium_name'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $attendance = $this->Attendances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->getData());
            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
        }
        $sessionYears = $this->Attendances->SessionYears->find('list', ['limit' => 200]);
        $media = $this->Attendances->Media->find('list', ['limit' => 200]);
        $studentClasses = $this->Attendances->StudentClasses->find('list', ['limit' => 200]);
        $streams = $this->Attendances->Streams->find('list', ['limit' => 200]);
        $sections = $this->Attendances->Sections->find('list', ['limit' => 200]);
        $studentInfos = $this->Attendances->StudentInfos->find('list', ['limit' => 200]);
        $this->set(compact('attendance', 'sessionYears', 'media', 'studentClasses', 'streams', 'sections', 'studentInfos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendance = $this->Attendances->get($id);
        if ($this->Attendances->delete($attendance)) {
            $this->Flash->success(__('The attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The attendance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
