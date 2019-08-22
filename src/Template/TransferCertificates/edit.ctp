<style type="text/css">
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
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Transfer Certificate</label>
            </div>
            <div class="box-body">
                <?= $this->Form->create($transferCertificate) ?>
                <div class="row">
                   <div class="report-header" style="margin-left: 10%;">
            <div class="report-logo">
                <?= $this->Html->image('school_logo/reportlogo.png',['style'=>  'height: 120px;']) ?> 
            </div>
            <table width="90%"  align="center"  cellpadding="0" cellspacing="0"  >
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
           <table width="90%"  align="center"  cellpadding="0" cellspacing="0" style="font-family: 'Abel', sans-serif;" >
                <tr  class="tr_bg">
                <td bgcolor="#999"   colspan="2" style="text-align:center; background-color:#999;color:black;border:2px solid black;font-family: 'Pacifico', cursive; " height="25" > <b>SCHOOL LEAVING CERTIFICATE </b>
                </td>
                </tr>
            </table>
            <table width="90%"  align="center"  style="border-collapse:collapse;margin-top:7px;margin-bottom:12px;text-align: center;">
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
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <table  width="90%" border="1" align="center" style="border-collapse:collapse;background-color:#DFDFDF;font-family:font-family: 'Noto Serif', serif;">

                            <tr>
                                <td  width="3%"></td>
                                <td class="td_padd" width="35%"><span>Book No.</span></td>
                                <td class="td_padd" width="20%">
                                    <?= $this->Form->control('book_no',['class'=>'form-control','label'=>false,'required'=>true,'placeholder'=>'Book No.']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td  width="3%"></td>
                                <td class="td_padd" width="35%"><span>Type of TC</span></td>
                                <td class="td_padd" width="20%">
                                    <?= $this->Form->control('tc_type',['class'=>'form-control','label'=>false,'options'=>['Original'=>'Original','Duplicate'=>'Duplicate']]) ?>
                                </td>
                            </tr>

                            <tr>
                                <td width="3%">1.</td>
                                <td class="td_padd" width="35%"><span>Name of Pupil</span></td>
                                <td class="td_padd" width="20%"><?= h($transferCertificate->student->name) ?></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td class="td_padd"><span>Father's/Guardian's Name</span></td>
                                <td class="td_padd"><?= h($transferCertificate->student->father_name) ?></td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td class="td_padd"><span>Mother's Name</span></td>
                                <td class="td_padd"><?= h($transferCertificate->student->mother_name) ?></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td class="td_padd"><span>Nationality</span></td>
                                <td class="td_padd"><?= h($transferCertificate->student->nationality) ?></td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td class="td_padd"><span>Whether the Candidate belongs to Scheduled Caste or Scheduled Tribe</span></td>
                                <td class="td_padd"><?= h($transferCertificate->student->student_infos[0]->reservation_category->short_name) ?></td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td class="td_padd"><span>Date of First Admission in the school Class and Date : </span></td>
                                <td class="td_padd"><?= ($transferCertificate->student->registration_date != '')?date("d-m-Y", strtotime($transferCertificate->student->registration_date)):'' ?>
                                <br/>
                                    <?= h($transferCertificate->student->admission_class->name) ?>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">7.</td>
                                <td class="td_padd"><span>Date of Birth ( in Christain Era ) according to Admission Register( In Figures ) :</span></td>
                                <td class="td_padd"><?= ($transferCertificate->student->dob != '')?date("d-m-Y", strtotime($transferCertificate->student->dob)):'' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_padd"><span>( In Words ) :</span></td>
                                <td class="td_padd"><?= ($transferCertificate->student->dob != '')?$this->Numbers->convertNumberToWord($transferCertificate->student->dob->format('j')).' '.$transferCertificate->student->dob->format('F').', '.$this->Numbers->convertNumberToWord($transferCertificate->student->dob->format('Y')):'' ?>
                                </td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td class="td_padd"><span>Class in which pupil last studied ( Passed / Compartment / Failed ) ( In Figures ):</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('result_status',['class'=>'form-control','label'=>false,'options'=>['Passed'=>'Passed','Failed'=>'Failed','Compartment'=>'Compartment','Studying'=>'Studying','Absent'=>'Absent','Left'=>'Left']]) ?>
                                    <?= $this->Form->control('last_studied_class_id',['class'=>'form-control','label'=>false,'options'=>$studentClasses]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td class="td_padd"><span>School / Board Annual Examination last taken with result :</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('school_board',['class'=>'form-control','label'=>false,'options'=>['CBSE'=>'CBSE','School'=>'School']]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>10.</td>
                                <td class="td_padd"><span>Whether Failed , If so Once / Twice in the same class:</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('fail',['class'=>'form-control','label'=>false,'options'=>['No'=>'No','Once'=>'Once','Twice'=>'Twice']]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>11.</td>
                                <td class="td_padd"><span>Subjects Studied</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('subject',['type'=>'text','class'=>'form-control','label'=>false,'placeholder'=>'Subjects Studied']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>12.</td>
                                <td class="td_padd"><span>Whether qualified for promotion to the higher class</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('higher_promotion',['class'=>'form-control','label'=>false,'options'=>['Yes'=>'Yes','No'=>'No']]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="td_padd"><span>if so, to which class the studying (in figures) (In Words ) :</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('higher_promotion_class_id',['class'=>'form-control','label'=>false,'options'=>$studentClassesHigher]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>13.</td>
                                <td class="td_padd"><span>Month upto which the (pupil has paid) School dues / paid</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('dues_paid',['class'=>'form-control','label'=>false,'options'=>['Yes'=>'Yes','No'=>'No']]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>14.</td>
                                <td class="td_padd"><span>Any Fee concession availed of : if so, the nature of such concession:</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('concession',['class'=>'form-control','label'=>false,'options'=>['Yes'=>'Yes','No'=>'No']]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>15.</td>
                                <td class="td_padd"><span>Total No. of working days <strong>Last Class</strong>:</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('working_day_last_class',['class'=>'form-control','label'=>false,'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'type'=>'text','placeholder'=>'Enter total working days']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>16.</td>
                                <td class="td_padd"><span>Total No. of working days present<strong>Last Class</strong>:</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('present_day_last_class',['class'=>'form-control','label'=>false,'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'type'=>'text','placeholder'=>'Enter total working days present']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>17.</td>
                                <td class="td_padd"><span>Whether NCC Cadet / Boys Scout / Girl Guide (detail may given )</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('ncc_cadet',['class'=>'form-control','label'=>false,'options'=>['Yes'=>'Yes','No'=>'No']]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">18.</td>
                                <td class="td_padd"><span>Games played or extra curricular activities in which the pupil usually took part</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('extra_curricular_activity',['class'=>'form-control curricular_activity','label'=>false,'options'=>['Yes'=>'Yes','No'=>'No']]) ?>
                                    <?= $this->Form->control('extra_curricular_activity_name',['type'=>'text','class'=>'form-control activities','label'=>false,'placeholder'=>'Enter extra curricular activities']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_padd"><span>If yes mention achievement level therin</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('achievement',['type'=>'text','class'=>'form-control activities','label'=>false,'placeholder'=>'Enter achievement']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>19.</td>
                                <td class="td_padd"><span>General Conduct</span></td>
                                <td class="td_padd">
                                    <?= $this->Form->control('general_conduct',['class'=>'form-control','label'=>false,'options'=>['Good'=>'Good','Very Good'=>'Very Good','Excellent'=>'Excellent']]) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20.</td>
                                <td class="td_padd"><span>Date of application for Certificate</span></td>
                                <td class="td_padd">
                                   <?= $this->Form->control('tc_apply_date',['class'=>'form-control datepicker','label'=>false,'required'=>true,'placeholder'=>'Apply Date','type'=>'text','data-date-format'=>'dd-mm-yyyy']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>21.</td>
                                <td class="td_padd"><span>Date of issue of Certificate</span></td>
                                <td class="td_padd">
                                   <?= $this->Form->control('tc_issue_date',['class'=>'form-control datepicker','label'=>false,'required'=>true,'placeholder'=>'Issue Date','type'=>'text','data-date-format'=>'dd-mm-yyyy']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>22.</td>
                                <td class="td_padd"><span>Reason for leaving the school</span></td>
                                <td class="td_padd">
                                   <?= $this->Form->control('tc_reason',['type'=>'text','class'=>'form-control','label'=>false,'required'=>true,'placeholder'=>'Enter Reason']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>23.</td>
                                <td class="td_padd"><span>Any other remarks</span></td>
                                <td class="td_padd">
                                   <?= $this->Form->control('other_remark',['type'=>'text','class'=>'form-control','label'=>false,'required'=>true,'placeholder'=>'Enter Remark']) ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <center>
                                <?php echo $this->Form->button('Edit TC',['class'=>'btn button','id'=>'submit_member']); ?>
                            </center>
                                
                        </div>
                    </div>
                </div>
                <?= $this->Form->unlockField('achievement') ?>
                <?= $this->Form->unlockField('extra_curricular_activity_name') ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('datepicker') ?>

<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
    $('form').attr('autocomplete','on');
    $('input').attr('autocomplete','on');
    $('#ServiceForm').validate({ 
        rules: {
            book_no: {
                required: true
            },
            tc_type: {
                required: true
            },
            type_of_tc: {
                required: true
            },
            tc_apply_date: {
                required: true
            },
            tc_issue_date: {
                required: true
            },
            tc_reason: {
                required: true
            },
            school_board: {
                required: true
            },
            fail: {
                required: true
            },
            subject: {
                required: true
            },
            higher_promotion: {
                required: true
            },
            dues_paid: {
                required: true
            },
            concession: {
                required: true
            },
            working_day_last_class: {
                required: true
            },
            present_day_last_class: {
                required: true
            },
            ncc_cadet: {
                required: true
            },
            general_conduct: {
                required: true
            },
            other_remark: {
                required: true
            },
            result_status: {
                required: true
            },
            extra_curricular_activity: {
                required: true
            },
            extra_curricular_activity_name: {
                required: true
            },
            achievement: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
    var curricular_activity = $('.curricular_activity').val();
        if(curricular_activity=='Yes')
        {
            $('.activities').prop('disabled',false);
        }
        else
        {
            $('.activities').prop('disabled',true);
        }
    $(document).on('change','.curricular_activity',function(e){
        var curricular_activity = $(this).val();
        if(curricular_activity=='Yes')
        {
            $('.activities').prop('disabled',false);
        }
        else
        {
            $('.activities').prop('disabled',true);
        }
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>