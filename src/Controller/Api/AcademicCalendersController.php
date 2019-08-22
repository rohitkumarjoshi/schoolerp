<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController; 

/**
 * AcademicCalenders Controller
 */
class AcademicCalendersController extends AppController
{
 
    public function calenderList()
    {
         $academicCalenders =$this->AcademicCalenders->find()
        	->contain('AcademicCategories')
        	->where(['AcademicCalenders.is_deleted'=>'N']);
 	 
		$response = $academicCalenders;
		$success=true;
		$error='';
		 
        $this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);         
    }

    public function OldList() {
		$currnt=date('Y');
		$nextyear=$currnt+1;
		$yearArray=array();
		$y=0;
		for($x=$currnt;$x<=$nextyear; $x++)
		{	$y++;
			for($c=1;$c<=12; $c++)
			{
				$first_date=date('Y-m-d', strtotime($x.'-'.$c.'-01'));
			    $last_date=date('Y-m-t', strtotime($x.'-'.$c.'-01'));  
				$CurrentMonth=	$c-1;	
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
				
				$oneByOne=array_unique($timestamp);
				unset($timestamp);
				$response=array();
				foreach($oneByOne as $OneDate)
				{  
					$ACDate = date('d',strtotime($OneDate));
					$ACFullDate = date('D',strtotime($OneDate));
					$ACMonth = date('M',strtotime($OneDate));
					$ACYear = date('Y',strtotime($OneDate)); 

					$academicCalenders =$this->AcademicCalenders->find()
			        	->contain('AcademicCategories')
			        	->where(['AcademicCalenders.is_deleted'=>'N','AcademicCalenders.date'=>$OneDate]);
			        $AcademicCount = $academicCalenders->count();
					$OneDateArray=array();
					if($AcademicCount>0)
					{
						foreach($academicCalenders as $academicCalender)
						{
 							$OneDateArray[] = array(
								'id' => $academicCalender->id,
								'name' => $academicCalender->description,
								'type' => $academicCalender->academic_category->name,
								'date' => $academicCalender->date, 
							);
						}
					}
					else
					{
						$fullday='';
						if($ACFullDate=='Sun'){$fullday='Sunday';} 
							$OneDateArray[] = array(
								'id' => 0,
								'name' => '',
								'type' => $fullday,
								'date' => $OneDate, 
							);
					}
					$response[] =array('date' => $ACDate,
						'day' => $ACFullDate,
						'month' => $ACMonth,
						'year' => $ACYear,
						'academicData'=>$OneDateArray);
					unset($OneDateArray);
				}
				unset($timestamp);
				$result1[] = array('month_id' => $CurrentMonth, 'year'=>$ACYear,
				'data' => $response);
				unset($result); 
			}
 		
 			$yearArray[]=array('year'=> $x,'monthdata'=> $result1);
			unset($result1);
			}
			$success=true;
			$error='';
			$response = $yearArray;
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
  	}

  	public function academicCalendar() {
		$currnt=date('Y');
		$nextyear=$currnt+1;
		$yearArray=array();
		$y=0;
		for($x=$currnt;$x<=$nextyear; $x++)
		{	$y++;
			for($c=1;$c<=12; $c++)
			{
				$first_date=date('Y-m-d', strtotime($x.'-'.$c.'-01'));
			    $last_date=date('Y-m-t', strtotime($x.'-'.$c.'-01'));  
				
					/*$ACDate = date('d',strtotime($OneDate));
					$ACFullDate = date('D',strtotime($OneDate));
					$ACMonth = date('M',strtotime($OneDate));
					$ACYear = date('Y',strtotime($OneDate)); 
*/
					$academicCalenders =$this->AcademicCalenders->find()
			        	->contain('AcademicCategories')
			        	->where(['AcademicCalenders.is_deleted'=>'N'])
			        	->where(function($exp) use($first_date,$last_date) {
			                return $exp->between('date', $first_date, $last_date, 'date');
			            });

			        $AcademicCount = $academicCalenders->count();
					$eventsArray=array();
					$examArray=array();
					$holidayArray=array();
					$otherArray=array();

					if($AcademicCount>0)
					{
						foreach($academicCalenders as $academicCalender)
						{ 
							if($academicCalender->academic_category_id==1){
								$examArray[] = array(
									'id' => $academicCalender->id,
									'name' => $academicCalender->description,
									'type' => $academicCalender->academic_category->name,
									'date' => $academicCalender->date, 
								);
							}
							if($academicCalender->academic_category_id==2){
								$holidayArray[] = array(
									'id' => $academicCalender->id,
									'name' => $academicCalender->description,
									'type' => $academicCalender->academic_category->name,
									'date' => $academicCalender->date, 
								);
							}
							if($academicCalender->academic_category_id==3){
								$eventsArray[]=array(
									'id' => $academicCalender->id,
									'name' => $academicCalender->description,
									'type' => $academicCalender->academic_category->name,
									'date' => $academicCalender->date,
								);
							}
							if($academicCalender->academic_category_id==4){
								$otherArray[] = array(
									'id' => $academicCalender->id,
									'name' => $academicCalender->description,
									'type' => $academicCalender->academic_category->name,
									'date' => $academicCalender->date, 
								);
							}
						}
					}
					$result1[] = array(
						'month_id' => $c, 
						'year'=>$currnt,
						'examArray' => $examArray,
						'holidayArray' => $holidayArray,
						'eventsArray' => $eventsArray,
						'otherArray' => $otherArray
					);  
				}
	 			$yearArray[]=array('year'=> (string)$x,'monthdata'=> $result1);
				unset($result1);
			}
			$success=true;
			$message='';
			$academicData = $yearArray;
			$this->set(compact('success','message','academicData'));
	        $this->set('_serialize', ['success','message','academicData']);
  		}


}
