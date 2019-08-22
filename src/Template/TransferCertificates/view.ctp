<html>
<head>
<style media="print">
    .hide_print
    {
        display:none !important;
    }
    .tr_bg
    {
        background-color:#999;
    
    }

</style>
<style>
    .tc_data tbody tr{
        line-height: 1.7;
    } 
    .heading tbody tr{
        line-height: 1.7;
    }
.report-logo{
        align-content: center;
        display: ruby-base-container;
        position: absolute;
    }
   .bg-maroon {
    background-color: #d81b60 !important;
}
.report-header{
        display: block;
            width: 1000px;
    }
tr
{
    height:25px;
    text-align:center;
    vertical-align: top;
}
.td_padd_first
{
padding-left:10px;
text-align:left;
 
 
    }
    .td_padd
{
padding-left:10px;
text-align:left;
font-weight: bold;
 
    }
   .report-logo{
        align-content: center;
        display: ruby-base-container;
        position: absolute;
    }
   .bg-maroon {
    background-color: #d81b60 !important;
}
.btn {
    border-radius: 0px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
a {
    color: #337ab7;
    text-decoration: none;
}
.pull-right {
    float: right !important;
}
</style>
</head>
    <body>
        <div class="pull-right">
            <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print ','style'=>'color:#fff !important;']) ?>
        </div>
        <div class="report-header" style="margin-left: 10%;">
            <div class="report-logo">
                <?= $this->Html->image('school_logo/reportlogo.png',['style'=>  'height: 120px;']) ?> 
            </div>
            <table width="100%" class="heading"  align="center"  cellpadding="0" cellspacing="0"  >
                <tbody>
                    <tr>
                        <td  align="center" style="font-size:25px">
                            <b style="text-transform: uppercase;"><?= $school->name ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" >
                            <B><I>(<?= $school->affiliation_no ?>)</I></B>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <b><?= $school->address ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"   style="font-size:20px">
                            <b>(<?= $school->agis ?>)</b>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"   style="font-size:20px">
                            <b><?= $auth->User('session_name') ?></b>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>
        <div  align="center" style="width:1000px; height:1300px;float:left;">
           <table width="100%"  align="center"  cellpadding="0" cellspacing="0" style="font-family: 'Abel', sans-serif;margin-left: 10%;" >
                <tr  class="tr_bg">
                <td bgcolor="#999"   colspan="2" style="text-align:center; background-color:#999;color:#ffffff;border:2px solid black;font-family: 'Pacifico', cursive; " height="25" > <b>SCHOOL LEAVING CERTIFICATE </b>
                </td>
                </tr>
            </table>
            <table width="100%"  align="center"  style="border-collapse:collapse;margin-top:7px;margin-bottom:12px;margin-left: 10%;text-align: center;">
                <tr>
                <td align="left" width="13%"><b>Serial No. :</b></td>
                <td align="left" width="20%"><?= h($transferCertificate->tc_serial_no) ?></td>
                </td>

                <td align="left" width="15%" ><b>Admission No. :</b></td>
                <td align="left" ><?= h($transferCertificate->student->scholar_no) ?></td>
                <td align="left"  width="15%"><b>School Code :</b></td>
                <td align="left" width="15%"><?= h($school->school_code) ?></td>
                </tr>
                 
            </table>
            <table width="100%"  align="center" style="border-collapse:collapse;font-family:Arial, Helvetica, sans-serif;font-size:18px;margin-left: 10%;" class="tc_data">

                <tr>
                    <td  width="3%"></td>
                    <td class="td_padd_first" width="35%"><span>Book No.</span></td>
                    <td class="td_padd" width="20%">
                        <?= h($transferCertificate->book_no) ?>
                    </td>
                </tr>
                <tr>
                    <td  width="3%"></td>
                    <td class="td_padd_first" width="35%"><span>Type of TC</span></td>
                    <td class="td_padd" width="20%">
                        <?= h($transferCertificate->tc_type) ?>
                    </td>
                </tr>

                <tr>
                    <td width="3%">1.</td>
                    <td class="td_padd_first" width="35%"><span>Name of Pupil</span></td>
                    <td class="td_padd" width="20%"><?= h($transferCertificate->student->name) ?></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td class="td_padd_first"><span>Father's/Guardian's Name</span></td>
                    <td class="td_padd"><?= h($transferCertificate->student->father_name) ?></td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td class="td_padd_first"><span>Mother's Name</span></td>
                    <td class="td_padd"><?= h($transferCertificate->student->mother_name) ?></td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td class="td_padd_first"><span>Nationality</span></td>
                    <td class="td_padd"><?= h($transferCertificate->student->nationality) ?></td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td class="td_padd_first"><span>Whether the Candidate belongs to Scheduled Caste or Scheduled Tribe</span></td>
                    <td class="td_padd"><?= h($transferCertificate->student->student_infos[0]->reservation_category->short_name) ?></td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td class="td_padd_first"><span>Date of First Admission in the school Class and Date : </span></td>
                    <td class="td_padd"><?= ($transferCertificate->student->registration_date != '')?date("d-m-Y", strtotime($transferCertificate->student->registration_date)):'' ?>
                    <br/>
                        <?= h($transferCertificate->student->admission_class->name) ?>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">7.</td>
                    <td class="td_padd_first"><span>Date of Birth ( in Christain Era ) according to Admission Register( In Figures ) :</span></td>
                    <td class="td_padd"><?= ($transferCertificate->student->dob != '')?date("d-m-Y", strtotime($transferCertificate->student->dob)):'' ?>
                    </td>
                </tr>
                <tr>
                    <td class="td_padd_first"><span>( In Words ) :</span></td>
                    <td class="td_padd"><?= ($transferCertificate->student->dob != '')?$this->Numbers->convertNumberToWord($transferCertificate->student->dob->format('j')).' '.$transferCertificate->student->dob->format('F').', '.$this->Numbers->convertNumberToWord($transferCertificate->student->dob->format('Y')):'' ?>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">8.</td>
                    <td class="td_padd_first"><span>Class in which pupil last studied <?= h($transferCertificate->result_status) ?> ( In Roman ):</span></td>
                    <td class="td_padd">
                       <?= h($transferCertificate->last_studied_student_class->roman_name) ?>
                    </td>
                </tr>
                <tr>
                    <td class="td_padd_first"><span>( In Words  ):</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->last_studied_student_class->name) ?>
                    </td>
                </tr>
                <tr>
                    <td>9.</td>
                    <td class="td_padd_first"><span>School / Board Annual Examination last taken with result :</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->school_board) ?>
                    </td>
                </tr>
                <tr>
                    <td>10.</td>
                    <td class="td_padd_first"><span>Whether Failed , If so Once / Twice in the same class:</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->fail) ?>
                    </td>
                </tr>
                <tr>
                    <td>11.</td>
                    <td class="td_padd_first"><span>Subjects Studied</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->subject) ?>
                    </td>
                </tr>
                <tr>
                    <td>12.</td>
                    <td class="td_padd_first"><span>Whether qualified for promotion to the higher class</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->higher_promotion) ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="td_padd_first"><span>if so, to which class the studying (in figures) (In Words ) :</span></td>
                    <td class="td_padd">
                       <?= h($transferCertificate->promoted_student_class->name) ?>
                    </td>
                </tr>
                <tr>
                    <td>13.</td>
                    <td class="td_padd_first"><span>Month upto which the (pupil has paid) School dues / paid</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->dues_paid) ?>
                    </td>
                </tr>
                <tr>
                    <td>14.</td>
                    <td class="td_padd_first"><span>Any Fee concession availed of : if so, the nature of such concession:</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->concession) ?>
                    </td>
                </tr>
                <tr>
                    <td>15.</td>
                    <td class="td_padd_first"><span>Total No. of working days <strong>Last Class</strong>:</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->working_day_last_class) ?>
                    </td>
                </tr>
                <tr>
                    <td>16.</td>
                    <td class="td_padd_first"><span>Total No. of working days present<strong>Last Class</strong>:</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->present_day_last_class) ?>
                    </td>
                </tr>
                <tr>
                    <td>17.</td>
                    <td class="td_padd_first"><span>Whether NCC Cadet / Boys Scout / Girl Guide (detail may given )</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->ncc_cadet) ?>
                    </td>
                </tr>
                <tr>
                    <td rowspan="<?php echo ($transferCertificate->extra_curricular_activity=='Yes')?2:1 ?>">18.</td>
                    <td class="td_padd_first"><span>Games played or extra curricular activities in which the pupil usually took part</span></td>
                    <td class="td_padd">
                        <?php
                        if($transferCertificate->extra_curricular_activity=='Yes')
                        {
                            echo $this->Text->autoParagraph(h($transferCertificate->extra_curricular_activity_name));
                        }
                        else
                        {
                            echo 'No';
                        }
                        ?>
                    </td>
                </tr>
                <?php
                if($transferCertificate->extra_curricular_activity=='Yes')
                {
                   ?>
                   <tr>
                        <td class="td_padd_first"><span>(Mention achievement level therin):</span></td>
                        <td class="td_padd">
                            <?= $this->Text->autoParagraph(h($transferCertificate->achievement)); ?>
                        </td>
                    </tr>
                   <?php
                }
                ?>
                
                <tr>
                    <td>19.</td>
                    <td class="td_padd_first"><span>General Conduct</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->general_conduct) ?>
                    </td>
                </tr>
                <tr>
                    <td>20.</td>
                    <td class="td_padd_first"><span>Date of application for Certificate</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->tc_apply_date) ?>
                    </td>
                </tr>
                <tr>
                    <td>21.</td>
                    <td class="td_padd_first"><span>Date of issue of Certificate</span></td>
                    <td class="td_padd">
                        <?= h($transferCertificate->tc_issue_date) ?>
                    </td>
                </tr>
                <tr>
                    <td>22.</td>
                    <td class="td_padd_first"><span>Reason for leaving the school</span></td>
                    <td class="td_padd">
                        <?= $this->Text->autoParagraph(h($transferCertificate->tc_reason)); ?>
                    </td>
                </tr>
                <tr>
                    <td>23.</td>
                    <td class="td_padd_first"><span>Any other remarks</span></td>
                    <td class="td_padd">
                        <?= $this->Text->autoParagraph(h($transferCertificate->other_remark)); ?>
                    </td>
                </tr>
            </table>
            <table width="90%"  align="center" style="border-collapse:collapse;margin-top:160px;border-collapse:collapse;font-family:Arial, Helvetica, sans-serif;font-size:18px">
                <tr>
                    <td width="30%" style="padding-left:8%;"><b>Signature</b></td>
                    <td width="30%"  style="padding-left:8%"><b>Checked by</b></td>
                    <td width="30%"  style="padding-left:8%"><b>Principal</b></td>
                </tr>
                <tr>
                    <td width="30%"  style="padding-left:6%;"><b>ClassTeacher / Incharge</b></td>
                    <td width="30%"  style="padding-left:8%">&nbsp;</td>
                    <td width="30%"  style="padding-left:8%"><b>Seal</b></td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
            </table>
        </div>
    </body>
</html>
