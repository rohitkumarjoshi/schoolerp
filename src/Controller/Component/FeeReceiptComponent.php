<?php
namespace App\Controller\Component;
use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class FeeReceiptComponent extends Component
{
    function initialize(array $config) 
    {
        parent::initialize($config);
    }
  
    function feeGenerate($id,$session_year_id,$fee_type_role_id=null)
    {
        $this->StudentInfos = TableRegistry::get('StudentInfos'); 
        $studentInfos = $this->StudentInfos->get($id,[
            'contain' => ['StudentClasses','Sections','Mediums','Streams']
        ]);

        $studentClassId=$studentInfos->student_class_id;
        $mediumId=$studentInfos->medium_id;
        $streamId=$studentInfos->stream_id; 
        $vehicleId=$studentInfos->vehicle_id; 
        //$sessionYearId=$studentInfos->session_year_id; 
        $vehicleStationId=$studentInfos->vehicle_station_id; 
        $bus_facility=$studentInfos->bus_facility; 
        $studentId=$studentInfos->student_id; 
 
        $this->Students = TableRegistry::get('Students');
        $students = $this->Students->get($studentId);
        $sessionYearId=$students->session_year_id;
        $genderId=$students->gender_id;
        $condition=array();
        if(!empty($streamId)){
            $condition[]=['FeeTypeMasters.stream_id'=>$streamId,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>1]; 
        }
        else
        {
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>1];
        }
        $this->FeeTypeMasters = TableRegistry::get('FeeTypeMasters');
        $FeeData=array();
        foreach ($condition as $where) {
   
          $feeTypeMasters = $this->FeeTypeMasters->find()
                        ->contain([
                          'FeeTypeMasterRows'=>['FeeTypeStudentMasters'=>function($q)use($id){
                              return $q->where(['FeeTypeStudentMasters.student_info_id'=>$id]);
                          },
                            'FeeReceiptRows'=>function($q)use($id){
                              return $q->where(['FeeReceiptRows.student_info_id'=>$id,'FeeReceiptRows.is_deleted'=>'N'])
                              ->select(['FeeReceiptRows.fee_type_master_row_id','total_amount'=>$q->func()->sum('FeeReceiptRows.amount')])
                              ->group(['FeeReceiptRows.fee_type_master_row_id']);
                            }]
                            ,'FeeTypes'=>function($q)use($fee_type_role_id){
                                if($fee_type_role_id)
                                {
                                  $q->where(['FeeTypes.fee_type_role_id'=>$fee_type_role_id]);
                                }
                                return $q;
                            }
                        ])
                        ->where($where)
                         ->where(['FeeTypeMasters.is_deleted'=>'N','FeeTypeMasters.session_year_id'=>$session_year_id]);
                     
                        

          foreach ($feeTypeMasters as $feeTypeMaster) 
          {
              if($feeTypeMaster->fee_type->fee_type_role_id == 2 AND $bus_facility=='No')
              {
                goto down;
              }

              if($feeTypeMaster->gender_id == $genderId)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              else if($feeTypeMaster->gender_id == 0)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
          
              down:
          }
        }
      $FeeReturnData['studentInfos']=$studentInfos;
      $FeeReturnData['students']=$students;
      $FeeReturnData['FeeData']=$FeeData;
      return $FeeReturnData;
    }

    function enquiryFee($id,$session_year_id)
    {
        $this->EnquiryFormStudents = TableRegistry::get('EnquiryFormStudents'); 
        $studentInfos = $this->EnquiryFormStudents->get($id,[
            'contain' => ['StudentClasses','Mediums','Streams']
        ]);
        $studentClassId=$studentInfos->student_class_id;
        $mediumId=$studentInfos->medium_id;
        $streamId=$studentInfos->stream_id; 
        $genderId=$studentInfos->gender_id;
        $sessionYearId=$studentInfos->session_year_id;
        $vehicleId='';  
        $vehicleStationId=''; 
        
        $condition=array();
        if(!empty($streamId)){
            $condition[]=['FeeTypeMasters.stream_id'=>$streamId,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>2]; 
        }
        else
        {
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>2];
        }
        $this->FeeTypeMasters = TableRegistry::get('FeeTypeMasters');
        $FeeData=array();
        foreach ($condition as $where) {
          $feeTypeMasters = $this->FeeTypeMasters->find()
                          ->contain([
                            'FeeTypeMasterRows'=>[
                              'FeeReceiptRows'=>function($q)use($id){
                                return $q->where(['FeeReceiptRows.enquiry_form_student_id'=>$id])
                                ->where(['FeeReceiptRows.is_deleted'=>'N'])
                                ->select(['FeeReceiptRows.fee_type_master_row_id','total_amount'=>$q->func()->sum('FeeReceiptRows.amount')])
                                ->group(['FeeReceiptRows.fee_type_master_row_id']);
                              }]
                              ,'FeeTypes'
                          ])
                          ->where($where)
                          ->where(['FeeTypeMasters.is_deleted'=>'N','FeeTypeMasters.session_year_id'=>$session_year_id]);


          foreach ($feeTypeMasters as $feeTypeMaster) {
              if($feeTypeMaster->gender_id == $genderId)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              else if($feeTypeMaster->gender_id == 0)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              
          }
        }
      $FeeReturnData['studentInfos']=$studentInfos;
      $FeeReturnData['FeeData']=$FeeData;
      return $FeeReturnData;
    }
    function formFee($studentClassId,$mediumId,$streamId,$genderId,$session_year_id)
    {
        $this->EnquiryFormStudents = TableRegistry::get('EnquiryFormStudents');
        $vehicleId='';  
        $vehicleStationId=''; 
        $condition=array();
        if(!empty($streamId)){
            $condition[]=['FeeTypeMasters.stream_id'=>$streamId,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>2]; 
        }
        else
        {
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>2]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>2];
        }
        $this->FeeTypeMasters = TableRegistry::get('FeeTypeMasters');
        $FeeData=array();
        foreach ($condition as $where) {
          $feeTypeMasters = $this->FeeTypeMasters->find()
                          ->contain([
                            'FeeTypeMasterRows'
                              ,'FeeTypes'
                          ])
                          ->where($where)
                           ->where(['FeeTypeMasters.is_deleted'=>'N','FeeTypeMasters.session_year_id'=>$session_year_id]);


          foreach ($feeTypeMasters as $feeTypeMaster) {
              if($feeTypeMaster->gender_id == $genderId)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      $student_wise='New';
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      $student_wise='New';
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              else if($feeTypeMaster->gender_id == 0)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      $student_wise='New';
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      $student_wise='New';
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              
          }
        }
       $FeeReturnData['FeeData']=$FeeData;
       return $FeeReturnData;
    }
    function admissionFee($id,$session_year_id,$category_id)
    {
        $this->StudentInfos = TableRegistry::get('StudentInfos'); 
        $studentInfos = $this->StudentInfos->get($id,[
            'contain' => ['StudentClasses','Sections','Mediums','Streams']
        ]);

        $studentClassId=$studentInfos->student_class_id;
        $mediumId=$studentInfos->medium_id;
        $streamId=$studentInfos->stream_id; 
        $vehicleId=$studentInfos->vehicle_id; 
        
        $vehicleStationId=$studentInfos->vehicle_station_id; 
        $studentId=$studentInfos->student_id; 
        $hostel_id=$studentInfos->hostel_id; 

        $this->Students = TableRegistry::get('Students');
        //$students = $this->Students->get($studentId);
        $students = $this->Students->get($studentId,[
          'contain'=>['HostelRegistrations']
        ]);
        //pr($students->toArray());
        $sessionYearId=$students->session_year_id;

        $genderId=$students->gender_id;
        if($category_id==6)
        {
          foreach ($students->hostel_registrations as $hostel_registration) {
             $sessionYearId=$hostel_registration->session_year_id;
          }
        }
        
         
        $genderId=$students->gender_id;
        $condition=array();
        if(!empty($streamId)){
          if(!empty($hostelId))
          {
            $condition[]=['FeeTypeMasters.stream_id'=>$streamId,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id,'hostel_id'=>$hostel_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id,'hostel_id'=>$hostel_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id,'hostel_id'=>$hostel_id]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>$category_id,'hostel_id'=>$hostel_id];
          }
          else
          {
            $condition[]=['FeeTypeMasters.stream_id'=>$streamId,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>$category_id];
          }
        }
        else
        {
          if(!empty($hostelId))
          {
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id,'hostel_id'=>$hostel_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id,'hostel_id'=>$hostel_id]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>$category_id,'hostel_id'=>$hostel_id];
          }
          else
          {
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>$category_id];
          }
        }
        $this->FeeTypeMasters = TableRegistry::get('FeeTypeMasters');
        $FeeData=array();
        foreach ($condition as $where) {

          $feeTypeMasters = $this->FeeTypeMasters->find()
                        ->contain([
                          'FeeTypeMasterRows'=>[
                            'FeeReceiptRows'=>function($q)use($id){
                              return $q->where(['FeeReceiptRows.student_info_id'=>$id,'FeeReceiptRows.is_deleted'=>'N'])
                              ->select(['FeeReceiptRows.fee_type_master_row_id','total_amount'=>$q->func()->sum('FeeReceiptRows.amount')])
                              ->group(['FeeReceiptRows.fee_type_master_row_id']);
                            }]
                            ,'FeeTypes'
                        ])
                        ->where($where)
                        ->where(['FeeTypeMasters.is_deleted'=>'N','FeeTypeMasters.session_year_id'=>$session_year_id]);

          foreach ($feeTypeMasters as $feeTypeMaster) {
              if($feeTypeMaster->gender_id == $genderId)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              else if($feeTypeMaster->gender_id == 0)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              
          }
        }
      $FeeReturnData['studentInfos']=$studentInfos;
      $FeeReturnData['students']=$students;
      $FeeReturnData['FeeData']=$FeeData;
      return $FeeReturnData;
    }
    function nonScholarFee($session_year_id,$category_id)
    {
       
        $condition=array();
        $condition[]=['FeeTypeMasters.fee_category_id'=>$category_id];
        $this->FeeTypeMasters = TableRegistry::get('FeeTypeMasters');
        $FeeData=array();
        foreach ($condition as $where) {

          $feeTypeMasters = $this->FeeTypeMasters->find()
                        ->contain([
                          'FeeTypeMasterRows','FeeTypes'
                        ])
                        ->where($where)
                         ->where(['FeeTypeMasters.is_deleted'=>'N','FeeTypeMasters.session_year_id'=>$session_year_id]);

          foreach ($feeTypeMasters as $feeTypeMaster) {
              $FeeData[]=$feeTypeMaster;
          }
        }
      $FeeReturnData['FeeData']=$FeeData;
      return $FeeReturnData;
    }
    function promotePendingFee($id,$session_year_id)
    {
        $this->StudentInfos = TableRegistry::get('StudentInfos'); 
        $studentInfos = $this->StudentInfos->get($id,[
            'contain'=>[
                'Students'=>['OldFees'=>['FeeCategories','FeeReceipts'=>function($q){
                    return $q->select(['FeeReceipts.old_fee_id','total_submit'=>$q->func()->sum('FeeReceipts.amount')])->group('FeeReceipts.old_fee_id');
                }]
            ]]
        ]);
        $hostel_facility=$studentInfos->hostel_facility; 

        $this->FeeMonths = TableRegistry::get('FeeMonths'); 
        $month_name = date('M');
        $feeMonth = $this->FeeMonths->find()->order(['id'=>'DESC'])->first();
        $pendingMonthlyFees=$this->dueFee($id,$session_year_id,1,$feeMonth->id);
        $pendingFees[1]=$this->pendingFeeCalculation($pendingMonthlyFees);
        $pendingMonthlyFees=$this->dueFee($id,$session_year_id,4);
        $pendingFees[4]=$this->pendingFeeCalculation($pendingMonthlyFees);
        if($hostel_facility=='Yes')
        {
            $pendingMonthlyFees=$this->dueFee($id,$session_year_id,6);
            $pendingFees[6]=$this->pendingFeeCalculation($pendingMonthlyFees);
        }
       
        $totalSubmitted=0;
        foreach ($studentInfos->student->old_fees as $old_fee) {
            if(!empty($old_fee->fee_receipts))
            {
                $total_paid=$old_fee->fee_receipts[0]->total_submit;
                $totalSubmitted+=$total_paid;
                $old_due_fee=$old_fee->due_amount-$total_paid;
                foreach ($pendingFees as $key => $value) 
                {
                    if($key == $old_fee->fee_category_id)
                    {
                        $old_amount = $value+$old_due_fee;
                        $pendingFees[$key]=$old_amount;
                    }
                    
                }
            }
            else
            {
                foreach ($pendingFees as $key => $value) 
                {
                    if($key == $old_fee->fee_category_id)
                    {
                        $old_amount = $value+$old_fee->due_amount;
                        $pendingFees[$key]=$old_amount;
                    }
                    
                }
            }
        }
        return $pendingFees;
    }
    function pendingDocument($id,$session_year_id)
    {
        $this->StudentInfos = TableRegistry::get('StudentInfos');
        $studentDocuments = $this->StudentInfos->get($id,[
            'contain' => [
                'Students'=>function($q){
                    return $q->contain(['DocumentClassMappings'=>['Documents'],'StudentDocuments']);
                }
            ]
        ]);
        $doc=[];
        $doc_i=0;
        $setData='';
        $setData.='\\n';
        $document_class_mapping_id = [];
        $document_class_student_id = [];
        
        foreach ($studentDocuments->student->document_class_mappings as $document_class_mapping) 
        {
            $document_class_mapping_id[]=$document_class_mapping->id;
        }
        foreach ($studentDocuments->student->student_documents as $student_document)
        {
            if(!empty($student_document->document_class_mapping_id))
            {
                $document_class_student_id[]=$student_document->document_class_mapping_id;
            }
            
        }
        $result = array_diff($document_class_mapping_id, $document_class_student_id);
        if(empty($result))
        {
            unset($studentDocuments);
        }
        else
        {
            foreach ($studentDocuments->student->document_class_mappings as $dkey=>$document_class_mapping) 
            {
                if(!in_array($document_class_mapping->id,$result))
                {
                    unset($studentDocuments->student->document_class_mappings[$dkey]);
                }
            }
            foreach ($studentDocuments->student->document_class_mappings as $document_class_mapping) 
            {
                $doc_i++;
                $doc[]='\\n'.$doc_i.'. '.$document_class_mapping->document->document_name;
            }
        }
        
        return $setData.implode(', ', $doc);
    }
    function getOldFee($student_id,$session_year_id,$category_id)
    {
        $this->OldFees = TableRegistry::get('OldFees'); 
        $oldFees = $this->OldFees->find();
            $oldFees->where(['OldFees.student_id'=>$student_id,'OldFees.fee_category_id'=>$category_id,'OldFees.session_year_id'=>$session_year_id]);
            $oldFees->contain(['FeeReceipts'=>function($q){
                    return $q->select(['FeeReceipts.old_fee_id','total_submit'=>$q->func()->sum('FeeReceipts.amount')])->group('FeeReceipts.old_fee_id');
                }]);
        $old_fee_amount=0;
        foreach ($oldFees as $old_fee) {
            if(!empty($old_fee->fee_receipts))
            {
                $total_paid=$old_fee->fee_receipts[0]->total_submit;
                $totalSubmitted+=$total_paid;
                $old_fee_amount=$old_fee->due_amount-$total_paid;
            }
            else
            {
                $old_fee_amount=$old_fee->due_amount;
            }
        }
        return $old_fee_amount;
        
    }
    function pendingFee($id,$session_year_id)
    {
        $this->StudentInfos = TableRegistry::get('StudentInfos'); 
        $studentInfos = $this->StudentInfos->get($id,[
            'contain'=>[
                'Students'=>['OldFees'=>['FeeCategories','FeeReceipts'=>function($q){
                    return $q->select(['FeeReceipts.old_fee_id','total_submit'=>$q->func()->sum('FeeReceipts.amount')])->group('FeeReceipts.old_fee_id');
                }]
            ]]
        ]);
        //pr($studentInfos->toArray()); exit;
        $hostel_facility=$studentInfos->hostel_facility; 

        $this->FeeMonths = TableRegistry::get('FeeMonths'); 
        $month_name = date('M');
        $feeMonth = $this->FeeMonths->find()->where(['name'=>$month_name])->first();
        $pendingMonthlyFees=$this->dueFee($id,$session_year_id,1,$feeMonth->id);
        $pendingFees['Monthly Fee']=$this->pendingFeeCalculation($pendingMonthlyFees);
        $pendingMonthlyFees=$this->dueFee($id,$session_year_id,4);
        $pendingFees['Annual Fee']=$this->pendingFeeCalculation($pendingMonthlyFees);
        if($hostel_facility=='Yes')
        {
            $pendingMonthlyFees=$this->dueFee($id,$session_year_id,6);
            $pendingFees['Hostel Fee']=$this->pendingFeeCalculation($pendingMonthlyFees);
        }
        $setData='';
        $setData.='\\n';
        foreach ($pendingFees as $key => $value) {
            $setData.='\\n';
            $setData.=$key.' => '.$value;
        }
        $totalSubmitted=0;
        foreach ($studentInfos->student->old_fees as $old_fee) {
            if(!empty($old_fee->fee_receipts))
            {
                $total_paid=$old_fee->fee_receipts[0]->total_submit;
                $totalSubmitted+=$total_paid;
                $old_due_fee=$old_fee->due_amount-$total_paid;
                $setData.='\\n';
                $setData.='Old '.$old_fee->fee_category->name.' => '.$old_due_fee;
            }
            else
            {
                $setData.='\\n';
                $setData.='Old '.$old_fee->fee_category->name.' => '.$old_fee->due_amount;
            }
        }
        return $setData;
        
    }
    function pendingFeeCalculation($pendingMonthlyFees)
    {
        $monthlyDues=0;
        foreach ($pendingMonthlyFees as $feeTypeMaster){
            foreach ($feeTypeMaster->fee_type_master_rows as $fee_type_master_row) {
                if(!empty($fee_type_master_row->fee_type_student_masters))
                {
                    foreach ($fee_type_master_row->fee_type_student_masters as $fee_type_student_master) {
                        $FeeAmount=$fee_type_student_master->amount;
                    }
                }
                else
                {
                    $FeeAmount=$fee_type_master_row->amount;
                }
                $submittedAmounts = @$fee_type_master_row->fee_receipt_rows[0]->total_amount;
                $monthlyDues+=$FeeAmount-$submittedAmounts;
            }
        }
        return $monthlyDues;
    }

    function dueFee($id,$session_year_id,$category_id,$month_id=null)
    {
        $this->StudentInfos = TableRegistry::get('StudentInfos'); 
        $studentInfos = $this->StudentInfos->get($id);

        $studentClassId=$studentInfos->student_class_id;
        $mediumId=$studentInfos->medium_id;
        $streamId=$studentInfos->stream_id; 
        $vehicleId=$studentInfos->vehicle_id; 
        //$sessionYearId=$studentInfos->session_year_id; 
        $vehicleStationId=$studentInfos->vehicle_station_id; 
        $studentId=$studentInfos->student_id; 
        $bus_facility=$studentInfos->bus_facility; 
        
        $this->Students = TableRegistry::get('Students');
        //$students = $this->Students->get($studentId);
         $students = $this->Students->get($studentId,[
          'contain'=>['HostelRegistrations']
        ]);
        //pr($students->toArray());
        $sessionYearId=$students->session_year_id;
        if($category_id==6)
        {
          foreach ($students->hostel_registrations as $hostel_registration) {
             $sessionYearId=$hostel_registration->session_year_id;
          }
        }
        $genderId=$students->gender_id;
        $condition=array();
        if(!empty($streamId)){
            $condition[]=['FeeTypeMasters.stream_id'=>$streamId,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>$category_id]; 
        }
        else
        {
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>$category_id]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>$category_id];
        }
        $this->FeeTypeMasters = TableRegistry::get('FeeTypeMasters');
        $FeeData=array();
        foreach ($condition as $where) {
 
          $feeTypeMasters = $this->FeeTypeMasters->find()
                        ->contain([
                          'FeeTypeMasterRows'=>function($q)use($month_id,$category_id,$id){
                            if(!empty($month_id) && $category_id==1)
                            {
                              $q->where(['fee_month_id <='=>$month_id]);
                            }
                            $q->leftJoinWith('FeeMonths',function($q){
                                  return $q->select(['FeeMonths.name']);
                              }); 
                                $q->contain([
                                    'FeeTypeStudentMasters'=>function($q)use($id){
                                  return $q->where(['FeeTypeStudentMasters.student_info_id'=>$id]);
                              },
                            'FeeReceiptRows'=>function($q)use($id){
                              return $q->where(['FeeReceiptRows.student_info_id'=>$id,'FeeReceiptRows.is_deleted'=>'N'])->contain(['FeeMonths'=>function($q){
                                  return $q->select(['FeeMonths.name']);
                              }])
                              ->select(['FeeReceiptRows.fee_type_master_row_id','total_amount'=>$q->func()->sum('FeeReceiptRows.amount'),'fee_month_id'])
                              ->group(['FeeReceiptRows.fee_type_master_row_id']);
                            }]);
                            return $q;
                          },'FeeTypes'
                        ])
                        ->where($where)
                         ->where(['FeeTypeMasters.is_deleted'=>'N']);

          foreach ($feeTypeMasters as $feeTypeMaster) 
          {

              if($feeTypeMaster->fee_type->fee_type_role_id == 2 AND $bus_facility=='No')
              {
                goto down;
              }
              if($feeTypeMaster->gender_id == $genderId)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              else if($feeTypeMaster->gender_id == 0)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              down:
              
          }
        }
      return $FeeData;
        
      
  }
    function feeStructureGenerate($id,$session_year_id)
    {
        $this->StudentInfos = TableRegistry::get('StudentInfos'); 
        $studentInfos = $this->StudentInfos->get($id,[
            'contain' => ['StudentClasses','Sections','Mediums','Streams']
        ]);

        $studentClassId=$studentInfos->student_class_id;
        $mediumId=$studentInfos->medium_id;
        $streamId=$studentInfos->stream_id; 
        $vehicleId=$studentInfos->vehicle_id; 
         
        $vehicleStationId=$studentInfos->vehicle_station_id; 
        $bus_facility=$studentInfos->bus_facility; 
        $studentId=$studentInfos->student_id; 
 
        $this->Students = TableRegistry::get('Students');
        $students = $this->Students->get($studentId);
        $sessionYearId=$students->session_year_id;
        $genderId=$students->gender_id;
        $condition=array();
        if(!empty($streamId)){
            $condition[]=['FeeTypeMasters.stream_id'=>$streamId,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>1]; 
        }
        else
        {
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>$studentClassId,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1];
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>$mediumId,'FeeTypeMasters.fee_category_id'=>1]; 
            $condition[]=['FeeTypeMasters.stream_id'=>0,'FeeTypeMasters.student_class_id'=>0,'FeeTypeMasters.medium_id'=>0,'FeeTypeMasters.fee_category_id'=>1];
        }
        $this->FeeTypeMasters = TableRegistry::get('FeeTypeMasters');
        $FeeData=array();
        foreach ($condition as $where) {
   
          $feeTypeMasters = $this->FeeTypeMasters->find()
                        ->contain([
                          'FeeTypeMasterRows'=>['FeeTypeStudentMasters'=>function($q)use($id){
                              return $q->where(['FeeTypeStudentMasters.student_info_id'=>$id]);
                          }]
                            ,'FeeTypes'=>function($q){
                                
                                return $q;
                            }
                        ])
                        ->where($where)
                         ->where(['FeeTypeMasters.is_deleted'=>'N','FeeTypeMasters.session_year_id'=>$session_year_id]);
                        

          foreach ($feeTypeMasters as $feeTypeMaster) 
          {
              if($feeTypeMaster->fee_type->fee_type_role_id == 2 AND $bus_facility=='No')
              {
                goto down;
              }

              if($feeTypeMaster->gender_id == $genderId)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
              else if($feeTypeMaster->gender_id == 0)
              {
                  if($feeTypeMaster->vehicle_station_id == $vehicleStationId)
                  {
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
                  elseif($feeTypeMaster->vehicle_station_id == 0){
                      if($session_year_id == $sessionYearId)
                      {
                          $student_wise='New';
                      }
                      else 
                      {
                          $student_wise='Old';
                      }
                      if($feeTypeMaster->student_wise==$student_wise)
                      {
                          $FeeData[]=$feeTypeMaster;
                      }
                      else if(empty($feeTypeMaster->student_wise)){
                           $FeeData[]=$feeTypeMaster;
                      }
                  }
              }
          
              down:
          }
        }
      $FeeReturnData['studentInfos']=$studentInfos;
      $FeeReturnData['students']=$students;
      $FeeReturnData['FeeData']=$FeeData;
      return $FeeReturnData;
  }

}
?>