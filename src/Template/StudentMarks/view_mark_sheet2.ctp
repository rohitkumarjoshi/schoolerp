
<!-- find subject length -->
<?php
    $subjectArray = $scholastic_subjects;
    $subjectLength = $Find->maxDepth($scholastic_subjects); 
?>
 
<style>
.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
    padding: 1px !important;

}
.row{
    margin: 3px 0 0 0 !important;
}
.row-eq-height{
    display: flex;
}

.table-new>tbody>tr>td {
    text-align: center !important;
}

.table-new>thead>tr>th {
    text-align: center !important;
}
.a1
{height: auto; border: 1px solid; font-family: Arial, Helvetica, sans-serif; page-break-after:always;
}
.center_align { text-align:center; }
table
{
border-collapse:collapse;
height: 100%;
width: 100%;
}
div
{
border-collapse:collapse;
}
td {
    text-align:center !important;  
}
p {
    text-align:center !important;  
    margin:0 !important;  
}
 
.header_font
{
    font-weight:bold;
    font-size:14px;
}
.header_sub
{
    font-weight:bold;
}
.firstTH
{
    padding-left: 5px;
}
.extra
{
    padding-top: 3px;
    padding-bottom: 3px;
}
.main_color{ background-color:#CCFFCC !important;}
.second_color{ background-color:#E0A366 !important;}

</style>

<div class="portlet light ">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                </div> 
                <div class="box-body">
                    <div class="a1">
                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%" border="0"><br>
                                    <tr>
                                        <td width="15%">
                                            <?php echo $this->Html->image('aloklogo.jpg', array('width' => '140','height'=>160)); ?>
                                        </td>
                                        <td width="70%">
                                            <div  style="font-size:35px; text-align:center;">
                                                <strong style="font-family:revue-bt"><?php echo "ALOK School";?></strong>
                                            </div>
                                            <div  style="font-size:20px; text-align:center;"> 
                                                <strong><?php echo @$schoolDetail->address;?></strong>
                                            </div>
                                            <div  style="font-size:22px; margin-top:10px; text-align:center;">
                                                <strong>Record of Academic Performance<br>
                                                Session : (2019-20)</strong>
                                            </div>
                                        </td>
                                        <td width="15%">
                                            <?php echo $this->Html->image('cbselogo.png', array('width' => '140','height'=>160)); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-12">
                                <table height="100" style="width:100%;margin-top:20px; font-size:14px;font weight:bold" cellpadding="1" border="0" cellspacing="10">
                                    <tr align="left">
                                        <th class="firstTH">Name of Student</th>
                                        <th> : &nbsp; <strong ><?= @$student->student->name?></strong> </th>
                                        <th style="width:15%">Scholar No.</th>
                                        <th style="width:55%" align="left">: &nbsp;<?= @$student->student->scholar_no?></th>
                                    </tr>
                                    <tr align="left">
                                        <th class="firstTH">Father's Name</th>
                                        <th>: &nbsp; <strong > <?= @$student->student->father_name?></strong></th>
                                        <th>Roll No.</th>
                                        <th> : &nbsp; <?= @$student->roll_no?></th>
                                    </tr>
                                    <tr align="left">
                                        <th class="firstTH">Mother's Name</th>
                                        <th> : &nbsp; <strong ><?= @$student->student->mother_name?></strong></th>
                                        <th>Class </th>
                                        <th> : &nbsp; <?= @$student->student_class->roman_name?>
                                            <?= $student->has('stream') ? ' '.$student->stream->name :''?>
                                        </th>
                                    </tr>
                                    <tr align="left">
                                        <th style="width:15%" class="firstTH">DOB</th>
                                        <th style="width:55%" align="left">: &nbsp; <?= @$student->student->dob?></th>
                                        <th style="width:15%">Section</th>
                                        <th align="left"> : &nbsp; <?= $student->has('section') ? ' '.$student->section->name :''?></th>
                                    </tr>
                                    <tr align="left" >
                                        <th class="firstTH">Address</th>
                                        <th> : &nbsp; <?= @$student->parmanent_address?></th>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-12">
                                <!-- Scholastic Area -->
                                <table class="table-new" cellpadding="0px" border="1" id="sample_1">
                                    <tbody>
                                        <tr class="header_font main_color" bgcolor="CCFFCC">
                                            <td  height="20px" colspan="100">Part 1 : Scholastic Area</td>
                                        </tr>
                                        <?php $maxDepth = $Find->maxDepth($exams); $itteration = $maxDepth;?>
                                        <?php $examLength=0; ?>
                                        <?php for ($i=0; $i < $itteration; $i++) { ?>
                                            <tr class="header_font second_color">
                                                <?php if ($i == 0): ?>
                                                    <th rowspan="<?= $maxDepth ?>" colspan="<?=$subjectLength?>"><p> Exams</p></th>
                                                <?php endif ?>

                                                <?php foreach ($exams as $key => $section): ?>
                                                    <?php $rowSpan = ($Find->arrayDepth($section) == 0 ? $maxDepth : 0)?>
                                                    <?php $colSpan = $Find->arrayWidth($section)?>
                                                    
                                                    <?php if($i == ($itteration - 1) || $Find->arrayDepth($section) == 0){
                                                        $examLength++;
                                                    } ?>
                                                    <th <?= $rowSpan!=0?'rowspan='.$rowSpan:'' ?> <?= $colSpan > 0?'colspan='.$colSpan:'' ?>><p>
                                                        <?= $section['name'] ?></p>
                                                    </th>
                                                <?php endforeach; ?>
                                                <?php if ($i == 0): ?>
                                                    <th rowspan="<?= $maxDepth ?>" colspan="<?=$subjectLength?>"><p> Grand</p></th>
                                                <?php endif ?>
                                            </tr>

                                            <?php 
                                                $maxDepth--;
                                                $exams2 = $exams;
                                                unset($exams);
                                                $exams = $Find->nextChild($exams2);
                                             ?>
                                        <?php } ?>
                                        <tr class="header_font second_color">
                                            <th colspan="<?=$subjectLength?>"><p>Max Marks</p></th>
                                            <?php $gt=0; foreach ($exams2 as $key => $value) {
                                                @$gt+=$value['max_marks'];
                                                echo "<th><p>".$value['max_marks']."</p></th>";
                                            } ?>
                                            <th><p><?= $gt ?></p></th>
                                        </tr>
                                        <!-- Printing non elective subjects -->
                                        <?php 
                                            $total = [];
                                            function abc($scholastic_subjects,$Find,&$total)
                                            {
                                                $maxWidth = $Find->maxWidth($scholastic_subjects);
                                                $maxDepth = $Find->maxDepth($scholastic_subjects);
                                                foreach ($scholastic_subjects as $sub_key => $scholastic_subject): ?>
                                                    <?php $currentDepth =  $Find->arrayDepth($scholastic_subject);?>
                                                    <?php $colSpan = $maxDepth - $currentDepth; ?>
                                                    <tr>
                                                        <?php $a[0] = $scholastic_subject; ?>
                                                        <?php $rowspan = $Find->maxWidth($a); ?>
                                                        <th class="subjects" rowspan="<?= $rowspan==0?'':$rowspan ?>" colspan="<?= $colSpan==0?'':$colSpan ?>"><p><?= $scholastic_subject['name'] ?></p></th>
                                                        <?php if(!empty($scholastic_subject['children'])): ?>
                                                            <?= "<tr>" ?> 
                                                            <?= def($scholastic_subject['children'],$Find,$total); ?>
                                                        <?php else: ?>
                                                            <?php $subject_id = $scholastic_subject['id'] ?>
                                                            <?php $gt=0; foreach ($scholastic_subject['exams'] as $key => $exam): ?>
                                                                <?php if($sub_key == 0){$total[$key] = 0;} ?>
                                                                <td>
                                                                    <?php if (!empty($exam['student_marks'])): ?>
                                                                        <?php foreach ($exam['student_marks'] as $key2 => $marks): ?>
                                                                            <?php if ($marks['subject_id'] == $subject_id): ?>
                                                                                <?= $marks['student_number'] ?>
                                                                                <?php $total[$key]+= $marks['student_number']?>
                                                                                <?php $gt+= $marks['student_number']?>
                                                                            <?php endif ?>
                                                                        <?php endforeach ?>
                                                                    <?php else: ?>
                                                                        <?= @$exam['marks'] ?>
                                                                        <?php @$total[$key]+= @$exam['marks']?>
                                                                        <?php $gt+= @$exam['marks']?>
                                                                    <?php endif ?>
                                                            <?php endforeach ?>
                                                            <td><?= $gt?>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; 
                                            }
                                            function def($scholastic_subjects,$Find,&$total)
                                            {
                                                $maxWidth = $Find->maxWidth($scholastic_subjects);
                                                $maxDepth = $Find->maxDepth($scholastic_subjects);
                                                foreach ($scholastic_subjects as $sub_key => $scholastic_subject): ?>
                                                    <?php $currentDepth =  $Find->arrayDepth($scholastic_subject);?>
                                                    <?php $colSpan = $maxDepth - $currentDepth; ?>
                                                    <?php $a[0] = $scholastic_subject; ?>
                                                        <?php $rowspan = $Find->maxWidth($a); ?>
                                                        <th class="subjects" colspan="<?= $colSpan==0?'':$colSpan ?>" rowspan="<?= $rowspan==0?'':$rowspan ?>"><p><?= $scholastic_subject['name'] ?></p></th>
                                                        <?php if(empty($scholastic_subject['children'])):?>
                                                            <?php $subject_id = $scholastic_subject['id'] ?>
                                                            <?php $gt=0; foreach ($scholastic_subject['exams'] as $exam_key => $exam): ?>
                                                                <td>
                                                                    <?php if (!empty($exam['student_marks'])): ?>
                                                                        <?php foreach ($exam['student_marks'] as $key2 => $marks): ?>
                                                                            <?php if ($marks['subject_id'] == $subject_id): ?>
                                                                                <?= $marks['student_number'] ?>
                                                                                <?php $total[$key]+= $marks['student_number']?>
                                                                                <?php $gt+= $marks['student_number']?>
                                                                            <?php endif ?>
                                                                        <?php endforeach ?>
                                                                    <?php else: ?>
                                                                        <?= @$exam['marks'] ?>
                                                                        <?php $total[$exam_key]+= @$exam['marks']?>
                                                                        <?php $gt+= @$exam['marks']?>
                                                                    <?php endif ?>
                                                            <?php endforeach ?>
                                                            <td><?= $gt?>

                                                        <?php endif; ?>
                                                        <tr>
                                                    <?php 
                                                        if(!empty($scholastic_subject['children']))
                                                        { 
                                                            def($scholastic_subject['children'],$Find,$total); 
                                                        }
                                                        else{
                                                        } 
                                                    ?>
                                                <?php endforeach; 
                                            }?>

                                            <?php abc($scholastic_subjects,$Find,$total); ?>
                                        
                                        <tr class="header_font">
                                            <th colspan="<?=$subjectLength?>"><p>Total</p></th>
                                            <?php $gt=0; foreach ($total as $total_key => $value){ 
                                                echo "<th><p>$value</p></th>";
                                                $gt+= $value;
                                            } ?>
                                            <th><p><?= $gt ?></p></th>
                                        </tr>      
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row row-eq-height">
                            <div class="col-xs-5">
                                <table cellspacing="0px" cellpadding="0px" border="1" id="sample_1">
                                    <tbody>
                                        <tr class="header_font main_color">
                                            <th height="25" colspan="102" style="margin-left:5px;text-align:center;">Part 2 : Co-Scholastic Activities (to be assessed on a 3 point scale)</th>
                                        </tr>
                                        <tr class="header_font second_color" >
                                            <th height="35" style="margin-left:5px;text-align:center;">Activities</th>
                                            <th style="margin-left:5px;text-align:center;">Term-1</th>
                                            <th style="margin-left:5px;text-align:center;">Term-2</th>
                                        </tr>
                                        
                                        <tr class="subsubject">
                                            <th height="29" width="45%" class="header_sub " style="margin-left:5px;text-align:center;" rowspan="">
                                                <?php echo 'General Knowledge' ?>
                                            </th>
                                            <td style="margin-left:5px;text-align:center;">A</td>
                                            <td style="margin-left:5px;text-align:center;">A</td>
                                        </tr>
                                        <tr class="subsubject">
                                            <th height="29" width="45%" class="header_sub " style="margin-left:5px;text-align:center;" rowspan="">
                                                <?php echo 'General Knowledge' ?>
                                            </th>
                                            <td style="margin-left:5px;text-align:center;">A</td>
                                            <td style="margin-left:5px;text-align:center;">A</td>
                                        </tr>
                                        <tr class="subsubject">
                                            <th height="29" width="45%" class="header_sub " style="margin-left:5px;text-align:center;" rowspan="">
                                                <?php echo 'General Knowledge' ?>
                                            </th>
                                            <td style="margin-left:5px;text-align:center;">A</td>
                                            <td style="margin-left:5px;text-align:center;">A</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-xs-7">
                                <table border="1"  cellspacing="0" cellpadding="0">
                                    <tr class="header_font main_color" >
                                        <th height="25" colspan="102" style="margin-left:5px;text-align:center;">Signature</th>
                                    </tr>
                                    <tr class="header_font second_color">
                                        <th height="35" style="text-align:center;">Class Teacher</th>
                                        <th style="text-align:center;">Examination</th>
                                        <th style="text-align:center;">Principal</th>
                                        <th style="text-align:center;">Parent</th>
                                        <th width="20%" rowspan="4" style="background-color:#FFF !important;text-align:center;">
                                        <?php
                                            $qrcode='ALOK SENIOR SECONDARY SCHOOL  HIRAN MAGRI, SECTOR - 11, Udaipur  CBSE, NEW DELHI, AFFILIATION NO.-1730007';

                                            if (isset($qrcode)) 
                                            { 
                                            echo '<img height="90px" width="" src="" />'; 
                                            }
                                        ?>
                                        </th>
                                    </tr>
                                    <tr class="header_sub">
                                        <th height="45px" style="text-align:center;">
                                            Ashish Bohra
                                        </th>
                                        <th style="text-align:center;">Dashrath Ji</th>
                                        <th style="text-align:center;">Ankit Sir</th>
                                        <th style="text-align:center;">PP </th>
                                    </tr>
                                    <tr>
                                        <td height="40px"></td>
                                        <td> <?php echo $this->Html->image('Anilji_sign (1).jpg', array('width' => '75px')); ?></td>
                                        <td> <?php echo $this->Html->image('Shashank_taunk_signature (1) (1).jpg', array('width' => '90px')); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td height="28px">Date of Declaration</td>
                                        <td>24-Mar-2018</td>
                                        <td>Date of Issue</td>
                                        <td><?php //echo $_GET['dt']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row row-eq-height">
                            <div class="col-xs-5">
                                <table cellspacing="0px" cellpadding="0px" border="1" id="sample_1">
                                    <tbody>
                                        <tr class="header_font main_color">
                                             <th height="25px" colspan="102" style="margin-left:5px;text-align:center;">Part 3 : Discipline (to be assessed on a 3 point scale)</th>
                                        </tr>
                                        <tr class="header_font second_color" height="25" >
                                            <th height="37px" style="margin-left:5px;text-align:center;">Elements</th>
                                            
                                                <th style="text-align:center;">Term-1</th>
                                            
                                                <th style="text-align:center;">Term-2</th>
                                                   
                                        </tr>
                                        
                                        <tr class="subsubject">
                                            <th height="31px" width="45%" class="header_sub " style="margin-left:5px;text-align:center;" rowspan="<?php //echo $sub_count; ?>">
                                                DD</th>
                                            <td style="text-align:center;">A</td>
                                            <td style="text-align:center;">A</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-xs-7">
                                <table border="1" cellspacing="0" cellpadding="0" style="text-align:center;">
                                    <tr class="header_font main_color">
                                        <th colspan="4" height="25px" style="text-align:center;">Attendance</th>
                                    </tr>
                                    <tr class="header_font second_color">
                                        <th height="30px" width="25%" style="text-align:center;"> Total Meetings</th>
                                        <th style="text-align:center;">Meetings Attended</th>
                                        <th style="text-align:center;">Percentage</th>
                                        <th style="text-align:center;">Remarks</th>
                                    </tr>
                                    <tr>
                                        <td height="30px" width="25%">150</td>
                                        <td width="25%">100</td>
                                        <td width="25%">75%</td>
                                        <td width="25%">Good</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row row-eq-height">
                            <div class="col-xs-5">
                                <table border="1" cellspacing="0" cellpadding="0" >
                                    <tr class="main_color">
                                        <th colspan="3" height="25px" class="header_font" style="text-align:center;">
                                            Scholastic Area Grade Scale
                                        </th>
                                    </tr>
                                    <tr class="header_font second_color">
                                        <td width="34%" height="25px">MARKS-RANGE</td>
                                        <td width="33%">GRADE</td> 
                                    </tr>

                                    <tr>
                                        <td height="15px"><b>91 - 100</b></td>
                                        <td><b>A+</b> </td>
                                    </tr>

                                    <tr>
                                        <td height="15px"><b>91 - 100</b></td>
                                        <td><b>A+</b> </td>
                                    </tr>

                                    <tr>
                                        <td height="15px"><b>91 - 100</b></td>
                                        <td><b>A+</b> </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-xs-7">
                                <table border="1"  cellspacing="0" cellpadding="0" >
                                    <tr class="main_color">
                                        <th colspan="3" height="25px" class="header_font" style="text-align:center;">
                                            Co-Scholastic Activities Grade Scale
                                        </th>
                                    </tr>
                                    <tr class="header_font second_color">
                                        <td width="33%" height="25px">GRADE</td>
                                        <td width="33%">GRADE POINT</td>
                                        <td width="33%">GRADE ACHIEVEMENTS</td>
                                    </tr>
                                    <tr>
                                        <td >A</td>
                                        <td>3</td>
                                        <td>Outstanding</td>
                                    </tr>
                                    <tr>
                                        <td >B</td>
                                        <td>2</td>
                                        <td>Very Good</td>
                                    </tr>
                                    <tr>
                                        <td >C</td>
                                        <td>1</td>
                                        <td>Fair</td>
                                    </tr>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$js ="
$(document).ready(function(){
    
});
";
$this->Html->scriptBlock($js, ['block' => 'scriptPageBottom']);
 ?>