<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<?php // @$no_month=cal_days_in_month(CAL_GREGORIAN,$student_months,2019);
//pr($no_month);exit; ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Attendance List </label>
            </div>
            <div class="box-body">
               <?= $this->Form->create('attendance') ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                                <label class="control-label"> Medium</label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id','required']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class</label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control class','empty'=>'---Select Class---','id'=>'student_class_id','options'=>$classes,'required']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Section</label>
                            <?php echo $this->Form->control('section_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Section---','options'=>$sections,'id'=>'section_id','required']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Month</label>
                           
                            <select name="student_months" class="form-control" required="required">
                                <option value="">--Select--</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                           
                        </div>
                    </div>
                    <div  class="row">
                        <center>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </center>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <?php if(!empty($attendances)) {?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12" style="height: 400px; overflow-y: scroll;">
                                    <center>
                                        <h3>Attendance List Report</h3>
                                    </center>
                                    <div class="table-responsive">
                                        <h4 style="color: blue;"><?php 


                                            $a="a";
                                            $b="b";
                                            $dateObj = DateTime::createFromFormat('!m', $student_months); 
  
                                            // Store the month name to variable 
                                            $monthName = $dateObj->format('F'); 
                                              
                                            // Display output 
                                            foreach ($attendances as $attend) {
                                                
                                                if($a != $b)
                                                {

                                                    echo $attend->student_info->medium->name." ".$attend->student_info->student_class->name." ".$attend->student_info->section->name." ".$monthName; 
                                                }
                                                $a=$attend->student_info->medium->name." ".$attend->student_info->student_class->name." ".$attend->student_info->section->name." ".$monthName;
                                                $b=$attend->student_info->medium->name." ".$attend->student_info->student_class->name." ".$attend->student_info->section->name." ".$monthName;
                                        }
                                        ?></h4>
                                        <table class="table table-bordered" id="sample_2" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Scholar No.</th>
                                                <th>Name</th>
                                                <th>Father's Name</th>
                                                <!-- <?php 
                                                    for ($a = 1; $a <= $no_month; $a++) {?>
                                                        <th><?= $a ?></th>
                                                <?php    }
                                                ?> -->
                                                <?php
                                                    while (strtotime($first_date) <= strtotime($last_date)) {
                                                    $show_date=date('d-M',strtotime($first_date));
                                                    echo '<th scope="col"style="width:10%;">'.$show_date.'</th>';
                                                    $first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
                                                    }
                                                ?>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                 <?php 
                                                        $i=1;
                                                        foreach (@$studenlist as $key=>$data) {
                                                        $first_date=date('Y-m-d',strtotime($F_date));
                                                          $last_date=date('Y-m-t',strtotime($F_date));
                                                            ?>
                                                <tr>
                                                   

                                                        <td><?= $i;$i++; ?></td>
                                                        <td><?= @$data['scoler_no']?></td>
                                                        <td><?= @$data['student_name'] ?></td>
                                                        <td><?= @$data['father_name'] ?></td>
                                                       <?php
                                                    $total_P=0;
                                                    $total_HD=0;
                                                    $total_AB=0;
                                                    $total_O=0;
                                                    $total_F=0;
                                                    $total_present=0;
                                                    $total_absent=0;
                                                    while (strtotime($first_date) <= strtotime($last_date)) {
                                                        $show_date=strtotime($first_date);
                                                        $status = @$AttendancesFirstHalf[$key][$show_date];
                                                        $show_Lable='';
                                                        

                                                        $show_dates=strtotime($last_date);
                                                        $last_status = @$AttendancesSecondHalf[$key][$show_dates];


                                                        if(($status==0.5)&&($last_status==0.0)){
                                                            $total_HD++;
                                                            $show_Lable='H';
                                                        }
                                                        if(($status==0.0)&&($last_status==0.5)){
                                                            $total_HD++;
                                                            $show_Lable='H';
                                                        }
                                                        if(($status==0.5)&&($last_status==0.5)){
                                                            $total_HD++;
                                                            $show_Lable='P';
                                                        }
                                                         if(($status==0.5)&&($last_status==0.1)){
                                                            $total_HD++;
                                                            $show_Lable='H';
                                                        }
                                                        if(($status==0.1)&&($last_status==0.5)){
                                                            $total_HD++;
                                                            $show_Lable='H';
                                                        }
                                                        if(($status==0.0)&&($last_status==0.1)){
                                                            $total_HD++;
                                                            $show_Lable='L';
                                                        }
                                                        if(($status==0.0)&&($last_status==0.0)){
                                                            $total_HD++;
                                                            $show_Lable='A';
                                                        }
                                                         if(($status==0.1)&&($last_status==0.0)){
                                                            $total_HD++;
                                                            $show_Lable='L';
                                                        }
                                                         if(($status==0.1)&&($last_status==0.1)){
                                                            $total_HD++;
                                                            $show_Lable='L';
                                                        }


                                                        echo '<td scope="col"style="width:10%;">'.$show_Lable.'</td>';
                                                        $first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
                                                    }
                                                    ?>
                                                       
                                                        <td></td>
                                                </tr>

                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
</div>
 <?= $this->element('daterangepicker') ?>
<?= $this->element('data_table') ?>
<?= $this->element('icheck') ?>
