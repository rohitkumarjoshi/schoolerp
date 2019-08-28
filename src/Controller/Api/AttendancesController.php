<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * Attendances Controller
 *
 * @property \App\Model\Table\AttendancesTable $Attendances
 *
 * @method \App\Model\Entity\Attendance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AttendancesController extends AppController
{ 
    public function addAttendance()
    {
        $user_type = $this->request->getData('user_type');
        if($user_type=='Employee'){
            $currentSession = $this->AwsFile->currentSession();
            $user_id = $this->request->getData('user_id');   

            $attendance = $this->Attendances->newEntity();
            $attendance_date= date('Y-m-d',strtotime($this->request->getData('attendance_date')));
            $student_info_id=$this->request->getData('student_id');
            $attendanceData=$this->request->getData('attendance'); 
            $optradio=$this->request->getData('half_type');
            $class_section_id=$this->request->getData('class_section_id');
			
            //pr($student_info_id); pr($attendanceData); exit;
            $x=0;
            foreach ($student_info_id as $key=>$student_id) {
                $field_name='second_half';
                if($optradio=='first_half'){
                    $field_name='first_half';
                }

                 $attendanceCount = $this->Attendances->find()->where(['attendance_date'=>$attendance_date,'student_info_id'=>$student_id])->count();

                if($attendanceCount>0){
                    $attedata = $this->Attendances->find()->where(['attendance_date'=>$attendance_date,'student_info_id'=>$student_id])->first();
                    
                    $attendance = $this->Attendances->get($attedata->id, [
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
                $attendance->session_year_id = $currentSession; 
				$check="";
                if($optradio=='first_half'){
                    $attendance->first_half = $attendanceData[$key];
					if($attendanceData[$key]=="0.5"){
						$check="Present";
					}else{
						
						$check="Absent";
					}
                }
                else{
                    $attendance->second_half = $attendanceData[$key];
					if($attendanceData[$key]=="0.5"){
						$check="Present";
					}else{
						
						$check="Absent";
					}
                } 
				
		    /// notification code start
				$this->loadmodel('StudentInfos');
				$StudentInfos=$this->StudentInfos->get($student_id,['contain'=>['Users','Students']]);
				$name=$StudentInfos->student->name; 
				$device_token=$StudentInfos->user->device_token;
				$title="Attendance";
				$message="Your ward is ".$check."";
				if(!empty($device_token)){
							
								$tokens = array($device_token);

								$header = [
								'Content-Type:application/json',
								'Authorization: Key=AAAABVEB0FY:APA91bGo3Y-hslS9_ztp95KFdzgfkf_IR-KR1K9WJlPo5wGYtWFunp_LK3zy8Dom3DJo2UV9IXBbcO_hDeLFRf6hUHt-QelMevoA0O4b_DC3VpH_POvBM2NG0_z20Iztzp7lE1FtTV8e'
								];

								$msg = [
								'title'=> $title,
								'message' => $message,
								
								'link' =>''
								];

								$payload = array(
								'registration_ids' => $tokens,
								'data' => $msg
								);

								$curl = curl_init();
								curl_setopt_array($curl, array(
								CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_CUSTOMREQUEST => "POST",
								CURLOPT_POSTFIELDS => json_encode($payload),
								CURLOPT_HTTPHEADER => $header
								));
								$response = curl_exec($curl);
								$err = curl_error($curl);
								curl_close($curl);
								
								$final_result=json_decode($response);
								$sms_flag=$final_result->success;     
								if ($err) {
									echo "cURL Error #:" . $err;
								} else {
									echo $response;
								}            
									
						} 
				
				//End
				$attendance->class_mapping_id = $class_section_id;
				//pr($attendance); 
                $this->Attendances->save($attendance);
 
                $x++;
            } 
            $success=true;
            $message="successfully Submitted";
        }
        else{
            $success=false;
            $message="Invalid user type";
        }
        $this->set(compact('success', 'message'));
        $this->set('_serialize', ['success', 'message']);
    }
    
    public function attendanceStudents(){
        $class_section_id = $this->request->getData('class_section_id');
        $attendance_date = date('Y-m-d',strtotime($this->request->getData('attendance_date')));

        $attendanceCount = $this->Attendances->find()->where(['attendance_date'=>$attendance_date,'class_mapping_id'=>$class_section_id])->count();
		
		$data = $this->Attendances->ClassMappings->find()->where(['ClassMappings.id'=>$class_section_id])->first();
             
            $medium_id = $data->medium_id;
            $student_class_id = $data->student_class_id;
            $stream_id = $data->stream_id;
            $section_id = $data->section_id;
			
        $mainArray=array();
        if($attendanceCount>0){
		$studentList = $this->Attendances->find()->where(['attendance_date'=>$attendance_date,'class_mapping_id'=>$class_section_id])->contain(['StudentInfoApis'=>['Students']]);
			
			/*  $studentList = $this->Attendances->find()->where(['attendance_date'=>$attendance_date])->contain(['StudentInfoApis'=>['Students']]); */
			
			//pr($studentList); exit;
            $listArray=Array();
            foreach ($studentList as $value) {
                $listArray['first_half']=(string)$value->first_half;
                $listArray['second_half']=(string)$value->second_half;
                $listArray['student_info_id']=$value->student_info_api->id;
                $listArray['student_name']=$value->student_info_api->student->name;
                $mainArray[]=$listArray;
            }
            $StudentsList =$mainArray;
            $success=true;
            $message=''; 
        }
        else
        {  
            $data = $this->Attendances->ClassMappings->find()->where(['ClassMappings.id'=>$class_section_id])->first();
             
            $medium_id = $data->medium_id;
            $student_class_id = $data->student_class_id;
            $stream_id = $data->stream_id;
            $section_id = $data->section_id;
            $session_year_id = $data->session_year_id;
            $condition=[];
            if(!empty($medium_id)){
                $condition['StudentInfoApis.medium_id']= $medium_id;
            } 

            if(!empty($section_id)){  
                $condition['StudentInfoApis.section_id']= $section_id;
            } 

            if(!empty($student_class_id)){  
                $condition['StudentInfoApis.student_class_id']= $student_class_id;
            } 

            if(!empty($stream_id))
            { 
                $condition['StudentInfoApis.stream_id']= $stream_id;
            } 
            $condition['StudentInfoApis.session_year_id']= $session_year_id; 

            $studentList = $this->Attendances->StudentInfoApis->find()->contain('Students')->where($condition);

            if($studentList->count()>0){
                $listArray=Array();
                foreach ($studentList as $value) {
                    $listArray['first_half']='';
                    $listArray['second_half']='';
                    $listArray['student_info_id']=$value->id;
                    $listArray['student_name']=$value->student->name;
                    $mainArray[]=$listArray;
                }
                $StudentsList =$mainArray;
                $success=true;
                $message='';
                
            }else{
                $success=false;
                $message="No data found";
                $StudentsList=array();
            }
        }
		array_multisort(array_column($StudentsList, "student_name"), SORT_ASC, $StudentsList);
		
        $this->set(compact('success', 'message', 'StudentsList'));
        $this->set('_serialize', ['success', 'message', 'StudentsList']);
    }

    public function AttendanceCalendar(){
        $student_info_id = $this->request->getQuery('user_id');

        $month = $this->request->getQuery('month');
        $monthData = $this->Attendances->FeeMonths->find()->select(['id'])->where(['month_number'=>$month])->first();
        $month_id = $monthData->id;

        $currentSession = $this->AwsFile->currentSession(); 
        $student_data=$this->Attendances->StudentInfoApis->get($student_info_id);
        $condition=array();
        if($student_data->student_class_id){
           $condition['TotalMeetings.student_class_id']= $student_data->student_class_id; 
        } 
        if($student_data->medium_id){
           $condition['TotalMeetings.medium_id']= $student_data->medium_id; 
        }
        if($student_data->stream_id){
           $condition['TotalMeetings.stream_id']= $student_data->stream_id; 
        }
        $totalMeetingData = $this->Attendances->TotalMeetings->find()->select(['total_meeting'])->where(['TotalMeetings.fee_month_id'=>$month_id,$condition,'TotalMeetings.session_year_id'=>$currentSession])->first();
        $total_meeting=0;
        if(!empty($totalMeetingData)){
            $total_meeting=$totalMeetingData->total_meeting;
        }

        $total_holidays= $this->Attendances->AcademicCalenders->find()->where(['academic_category_id'=>2,'session_year_id'=>$currentSession,'MONTH(`date`)'=>$month])->count();

        $AttendancesData =$this->Attendances->find()->where(['Attendances.is_deleted'=>'N','Attendances.student_info_id'=>$student_info_id,'MONTH(`attendance_date`)'=>$month,'session_year_id'=>$currentSession])->order(['attendance_date'=>'ASC']);

        $total_present=0;
        $total_absent=0;
        $total_leave=0;
        $total_halfday=0;
        foreach ($AttendancesData as $result) {
            $StatusOfTheDay='';
            $first_half = $result->first_half;
            $second_half = $result->second_half;
            if($first_half=='0.5' && $second_half=='0.5'){
                $total_present++;
                $StatusOfTheDay='Present';
            }
            else if($first_half=='1' && $second_half=='1')
            {
              $total_leave++;
              $StatusOfTheDay='Leave';  
            }
            else if($first_half=='0' && $second_half=='0')
            {
              $total_absent++;
              $StatusOfTheDay='Absent';  
            }
            else if($first_half=='0.5' || $second_half=='0.5')
            {
              $total_halfday++; 
              $StatusOfTheDay='Halfday'; 
            }
            $result->StatusOfTheDay=$StatusOfTheDay;
        }
        $totalResult=array('total_present'=>$total_present,'total_absent'=>$total_absent,'total_leave'=>$total_leave,'total_halfday'=>$total_halfday,'total_meeting'=>$total_meeting,'total_holidays'=>$total_holidays);
        $success=true;
        $error='';
        $this->set(compact('success','error','AttendancesData','totalResult'));
        $this->set('_serialize', ['success','error','AttendancesData','totalResult']);   
    }

    public function OLD(){
        $student_info_id = $this->request->getQuery('user_id');
        $month = $this->request->getQuery('month');  
        $currentSession = $this->AwsFile->currentSession();
        $CurrentYearData=$this->Attendances->SessionYears->find()->select(['session_year_name'])->where(['SessionYears.id'=>$currentSession])->first();;
        $year = $CurrentYearData->session_year_name;
        $first_date=date('Y-m-d', strtotime($year.'-'.$month.'-01'));
        $last_date=date('Y-m-t', strtotime($year.'-'.$month.'-01'));  
       


        $AttendancesData =$this->Attendances->find() 
                ->where(['Attendances.is_deleted'=>'N','Attendances.student_info_id'=>$student_info_id,'MONTH(`attendance_date`)'=>$month])->order(['attendance_date'=>'ASC']);
        pr($AttendancesData->toArray());exit;


        $currentTime=strtotime($first_date);
        $endTime=strtotime($last_date);
        //---
        $k=0;
        $results = array();
        while ($currentTime <= $endTime) {
            if (date('N', $currentTime) < 8) {
                $results[] = date('Y-m-d', $currentTime);
            }
            $currentTime = strtotime('+1 day', $currentTime);
        }
        unset($timestamp);
        foreach($results as $value)
        {
            $timestamp[]=$value;
        }
        $CurrentMonth = date('M',strtotime($first_date));
        $CurrentYear = date('Y',strtotime($first_date));
        $oneByOne=array_unique($timestamp);
        unset($timestamp);
        $response=array();
        foreach($oneByOne as $OneDate)
        {  
            $ACDate = date('d',strtotime($OneDate));
            $ACFullDate = date('D',strtotime($OneDate));
            $ACMonth = date('M',strtotime($OneDate));
            $ACYear = date('Y',strtotime($OneDate)); 

            $AttendancesData =$this->Attendances->find() 
                ->where(['Attendances.is_deleted'=>'N','Attendances.student_info_id'=>$student_info_id,'Attendances.attendance_date'=>$OneDate])->first();
 
            if($AttendancesData)
            {
                $first_half = $AttendancesData->first_half;
                $second_half = $AttendancesData->second_half;
                $date = $OneDate;
            }
            else
            {
                $first_half = '';
                $second_half = '';
                $date = $OneDate;
            }
            $response[] =array('date' => $ACDate,
                'day' => $ACFullDate,
                'month' => $ACMonth,
                'year' => $ACYear,
                'first_half'=>$first_half,
                'second_half'=>$second_half,
                'full_date'=>$date,
                ); 
        }
        $AttendList[] = array('month_id' => $CurrentMonth, 'year'=>$CurrentYear,
        'data' => $response);
        $success=true;
        $error='';
        $this->set(compact('success','error','AttendList'));
        $this->set('_serialize', ['success','error','AttendList']);   
    }
    public function AttendanceCalendarOld(){
        $student_info_id = $this->request->getQuery('user_id'); 
        $currentSession = $this->AwsFile->currentSession();
        $CurrentYearData=$this->Attendances->SessionYears->find()->select(['from_date','to_date'])->where(['SessionYears.id'=>$currentSession])->first();;
        $first_date = $CurrentYearData->from_date;
        $last_date = $CurrentYearData->to_date; 
        //$first_date ='2019-01-01';
        //$last_date ='2019-02-28';
        $currentTime=strtotime($first_date);
        $endTime=strtotime($last_date);
        //---
        $k=0;
        $results = array();
        while ($currentTime <= $endTime) {
            if (date('N', $currentTime) < 8) {
                $results[] = date('Y-m-d', $currentTime);
            }
            $currentTime = strtotime('+1 day', $currentTime);
        }
        unset($timestamp);
        foreach($results as $value)
        {
            $timestamp[]=$value;
        } 
        $CurrentYear = date('Y',strtotime($first_date));
        $oneByOne=array_unique($timestamp);
        unset($timestamp);
        $response=array();
        $totalResult=array();
        $xa=0;
        $total_present=0;
        $total_absent=0;
        $total_leave=0;
        $total_halfday=0;
        $total_holidays=0;
        foreach($oneByOne as $OneDate)
        {  
            $xa++;
            $month = date('m',strtotime($OneDate));
            $ACDate = date('d',strtotime($OneDate));
            $ACFullDate = date('D',strtotime($OneDate));
            $ACMonth = date('M',strtotime($OneDate));
            $ACYear = date('Y',strtotime($OneDate)); 
            $date = date('d-m-Y',strtotime($OneDate)); 

            $lastDataOfMonth = date('t',strtotime($OneDate));
            //-- TOTAL MEETING
            if($lastDataOfMonth == $xa){
                $total_holidays= $this->Attendances->AcademicCalenders->find()->where(['academic_category_id'=>2,'session_year_id'=>$currentSession,'MONTH(`date`)'=>$month])->count();

                $monthData = $this->Attendances->FeeMonths->find()->select(['id'])->where(['month_number'=>$month])->first();
                $month_id = $monthData->id;

                $student_data=$this->Attendances->StudentInfoApis->get($student_info_id);
                $condition=array();
                if($student_data->student_class_id){
                   $condition['TotalMeetings.student_class_id']= $student_data->student_class_id; 
                } 
                if($student_data->medium_id){
                   $condition['TotalMeetings.medium_id']= $student_data->medium_id; 
                }
                if($student_data->stream_id){
                   $condition['TotalMeetings.stream_id']= $student_data->stream_id; 
                }

                $totalMeetingData = $this->Attendances->TotalMeetings->find()->select(['total_meeting'])->where(['TotalMeetings.fee_month_id'=>$month_id,$condition,'TotalMeetings.session_year_id'=>$currentSession])->first();
                $total_meeting=0;
                if(!empty($totalMeetingData)){
                    $total_meeting=$totalMeetingData->total_meeting;
                }
            }
            //-- TOTAL MEETING

             
 
            $AttendancesData =$this->Attendances->find() 
                ->where(['Attendances.is_deleted'=>'N','Attendances.student_info_id'=>$student_info_id,'Attendances.attendance_date'=>$OneDate,'Attendances.is_deleted'=>'N'])->first();
           
            if($xa==1){  
                $total_present=0;
                $total_absent=0;
                $total_leave=0;
                $total_halfday=0;
            }
            //pr($AttendancesData);
            if(!empty($AttendancesData)){
            
                $StatusOfTheDay='';
                $first_half = $AttendancesData->first_half;
                $second_half = $AttendancesData->second_half;
                if($first_half=='0.5' && $second_half=='0.5'){
                    $total_present++;
                    $StatusOfTheDay='Present';
                }
                else if($first_half=='1' && $second_half=='1')
                {
                  $total_leave++;
                  $StatusOfTheDay='Leave';  
                }
                else if($first_half=='0' && $second_half=='0')
                {
                  $total_absent++;
                  $StatusOfTheDay='Absent';  
                }
                else if($first_half=='0.5' || $second_half=='0.5')
                {
                  $total_halfday++; 
                  $StatusOfTheDay='Halfday'; 
                } 
                 
                $response[] =array('date' => $ACDate,
                    'day' => $ACFullDate,
                    'month' => $ACMonth,
                    'year' => $ACYear,
                    'status'=>$StatusOfTheDay, 
                    'full_date'=>$date,
                );  
            }
            else{
              $response[] =array('date' => $ACDate,
                    'day' => $ACFullDate,
                    'month' => $ACMonth,
                    'year' => $ACYear,
                    'status'=>'', 
                    'full_date'=>$date,
                );   
            }

            if($lastDataOfMonth == $xa){ 
                $totalResultnew[$month]=array('total_present'=>$total_present,'total_absent'=>$total_absent,'total_leave'=>$total_leave,'total_halfday'=>$total_halfday,'total_meeting'=>$total_meeting,'total_holidays'=>$total_holidays,'month_name'=>$ACMonth,'month_id'=>$month,'month_data'=>$response);
				
                $response=array();
                $xa=0;
            } 
        }
				ksort($totalResultnew);
				foreach($totalResultnew as $datas){
					$totalResult[]=$datas;
				}
        $success=true;
        $error='';
        $this->set(compact('success','error','totalResult'));
        $this->set('_serialize', ['success','error','totalResult']);   
    }
}
