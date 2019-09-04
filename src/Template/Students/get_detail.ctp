<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
</style>
<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <h3 class="box-title" >Student Profile</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="tab">
                            <tbody>
                                <?php foreach ($personal_infos as $personal_info) {?>
                                <tr>
                                    <th style="font-weight: bold!important;">Name : <?= $personal_info->student->name ?></th>
                                    <th>Class : <?= $personal_info->student_class->name?></th>
                                    <th>Section : <?= $personal_info->section->name?></th>
                                </tr>
                                <tr>
                                    <th rowspan="4"><?php
                                    foreach ($studentDocumentPhotos as $pic) {
                                    echo $this->Html->image($cdn_path.'/'.@$pic->image_path,['style'=>  'margin-top: 0px;height: 100px;align-content: center; background-color: #f9eded00 !important;width: 100px;']);}?></th>
                                    <th>Scholar No.: <?=$personal_info->student->scholar_no?></th>
                                    <th>Admission Date: <?= date('d-m-Y',strtotime($personal_info->student->registration_date))?></th>
                                    
                                </tr>
                                <tr>
                                    <th>Father's Name : <?=$personal_info->student->father_name?></th>
                                    <th>Mother's Name : <?=$personal_info->student->mother_name?></th>
                                </tr>
                                 <tr>
                                    <th>Gender : <?=$personal_info->student->gender->name?></th>
                                    <th>DOB : <?=$personal_info->student->dob?></th>
                                </tr>
                                 <tr>
                                    <th>Email : <?=$personal_info->email?></th>
                                    <th>Mobile : <?=$personal_info->student->parent_mobile_no?></th>
                                </tr>
                                <?php } ?>
                            </tbody>
                </table> 
                <?php if(!empty($achivements->toArray()))
                {?>
                <span><h4><strong>Achivements</strong></h4></span>
                <table class="table table-bordered" id="tab">
                    <thead>
                        <th>Achivement Category</th>
                        <th>Achivement Type</th>
                        <th>Achivement Date</th>
                    </thead>
                    <tbody>
                       <?php foreach ($achivements as $achivement) {?>
                        <tr>
                            <td><?= $achivement->achivement_category->name ?></td>
                            <td><?= $achivement->achivement_type?></td>
                            <td><?= date('d-m-Y',strtotime($achivement->achivement_date))?></td>
                        </tr>
                       <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
                <span><h4><strong>Fee History</strong></h4></span>
                <table class="table table-bordered" id="tab">
                    <thead>
                        <th>Part 1</th>
                        <th>Part 2</th>
                        <th>Part 3</th>
                        <th>Part 4</th>
                        <th>Part 5</th>
                        <th>Part 6</th>
                        <th>Part 7</th>
                        <th>Part 8</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
                <span><h4><strong>Attendance Record</strong></h4></span>
                <table class="table table-bordered" id="tab">
                    <thead>
                        <?php
                            for ($i = 1; $i <= 12; $i++)
                            {
                                $month_name = date('F', mktime(0, 0, 0, $i, 1, $year_name));
                                echo '<th>'.$month_name.'</th>';
                            }
                        ?>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                for($i=1;$i<=12;$i++)
                                {
                                    $d=cal_days_in_month(CAL_GREGORIAN,$i,$year_name);
                                    echo '<td>Total - '.$d.'</td>';
                                }
                            ?>
                        </tr> 
                        <tr>
                        <?php 
                            for($i=1;$i<=12;$i++)                           
                                {
                                    $total_P=0;
                                    $total_A=0;
                            foreach ($attendances[$i] as $attend) {
                                $first_half=$attend->first_half;
                                $second_half=$attend->second_half;
                               if(($first_half == 0.5)&&($second_half == 0.5))
                               {
                                    $total_P++;
                               }
                               if(($first_half == 0.0)&&($second_half == 0.0))
                               {
                                    $total_A++;
                               }
                                if(($first_half == 1.0)&&($second_half == 1.0))
                                {
                                  $total_A++;   
                                }
                            }?>
                            <td>Present -<?= $total_P ?><br>Absent - <?= $total_A ?></td>
                               <?php } ?>  
                        </tr>
                    </tbody>
                </table>
                <?php if(!empty($hostels->toArray()))
                {?>
                <span><h4><strong>Hostel Record</strong></h4></span>
                <table class="table table-bordered" id="tab">
                    <thead>
                        <th>Hostel Name</th>
                        <th>Room</th>
                        <th>Registration No.</th>
                        <th>Registration Date</th>
                    </thead>
                    <tbody>
                       <?php foreach ($hostels as $hostel) {?>
                        <tr>
                            <td><?= $hostel->hostel->hostel_name ?></td>
                            <td><?= $hostel->room->room_no?></td>
                            <td>
                                <?php 
                               $count= strlen($hostel->registration_no);
                                if($count<3){
                                echo "000".$hostel->registration_no;
                                }else
                                 {
                                    echo $hostel->registration_no;
                                }
                            ?>
                            </td>
                            <td><?= $hostel->registration_date?></td>
                        </tr>
                       <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>