
    <?php
    if(!empty($visitor->student_id))
    {
        $student_is='Checked';
        $student_div='';
        $employee_div='hidden';
        $employee_is='';
    }
    else
    {
        $employee_is='Checked';
        $employee_div='';
        $student_div='hidden';
        $student_is='';
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                   <label> Edit Visitor  </label>
                     <div class="box-header pull-right"> 
                         <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Whom To Meet :</label>
                                <label class="radio-inline" id="student">
                                <input type="radio" id="option1" value="Student" name="whom_to_meet" <?= $student_is ?> > Student
                                </label>
                                <label class="radio-inline" id="employee">
                                    <input type="radio" id="option2" value="Employee" name="whom_to_meet"  <?= $employee_is ?>> Employee
                                </label>
                            </div>
                        </div>
                     </div>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($visitor,['id'=>'ServiceForm','type'=>'file']) ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> Visiting Area <span class="required" aria-required="true"> * </span></label>
                                           <?= $this->Form->control('visitor_type',array('options' => $visitor_types,'class'=>'select4','label'=>false,'style'=>'width:100%','empty'=>'Select Option')) ?>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="col-md-4 student <?= $student_div ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> Select Student<span class="required" aria-required="true"> * </span></label>

                                           <?= $this->Form->control('student_id', ['options' => $students, 'empty' => '--Select--','class'=>'','label'=>false,'id'=>'student-id','required'=>true,'style'=>'width:100%']);?>
                                        </div>
                                    </div> 
                                </div> 
                                 <div class="col-md-4 employee <?= $employee_div; ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> Select Employee<span class="required" aria-required="true"> * </span></label>
                                          <?= $this->Form->control('employee_id', ['options' => $employees, 'empty' => '--Select--','class'=>'','label'=>false,'id'=>'employee-id','style'=>'width:100%','required'=>true]);?>
                                        </div>
                                    </div> 
                                </div>  
                                 <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> Visitor Name<span class="required" aria-required="true"> * </span></label>
                                           <?= $this->Form->control('name', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Visitor Name','required'=>true,'oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');"])?>
                                        </div>
                                    </div> 
                                </div> 
                            </div> 
                             <div class="row">
                                 <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Mobile No</label>
                                           <?= $this->Form->control('mobile_no', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Mobile Number','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10',])?>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Id Card <span class="required" aria-required="true"> * </span></label>
                                            <?= $this->Form->control('id_card', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Id Card Name','required'=>true])?>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> Id Card Number <span class="required" aria-required="true"> * </span></label>
                                          <?= $this->Form->control('id_card_no', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Id Card Number','required'=>true])?>
                                        </div>
                                    </div> 
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> Vehicle No </label>
                                          <?= $this->Form->control('vehicle_no', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Vehicle Number'])?>
                                        </div>
                                    </div> 
                                </div> 
                                 <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> City <span class="required" aria-required="true"> * </span></label>
                                            <?= $this->Form->control('city_id',array('options' => $cities,'class'=>'select4','label'=>false,'style'=>'width:100%','empty'=>'Select City','required'=>true)) ?>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> Reason</label>
                                            <?= $this->Form->control('reason', ['label' => false, 'class'=>'form-control ','type'=>'textarea','placeholder'=>'Enter Reason','rows'=>'3','style'=>'resize:none;'])?>
                                        </div>
                                    </div> 
                                </div> 
                            </div> 
                            <div class="row">
                             <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label"> Address</label>
                                            <?= $this->Form->control('address', ['label' => false, 'class'=>'form-control ','type'=>'textarea','placeholder'=>'Enter Address','rows'=>'3','style'=>'resize:none;'])?>
                                        </div>
                                    </div> 
                                </div> 
                            </div> 
                           
                          <div class="row">
                                <fieldset>
                                    <legend><?= __('Document') ?></legend>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->hidden('photos',[
                                        'label' => false,'id'=>'snapshot']);?>
                                         <div class="col-md-12">
                                         <input type="button" class="btn btn-info" value="Take Snapshot" id="take_snapshot">
                                     </div>
                                        <div id="my_camera" class="col-md-6" style="padding-left: 0px !important;padding-top: 5px"></div>
                                        <div id="results" class="col-md-6" style="padding-top: 30px">Your captured image will appear here...</div>
                                    </div>
                                    <div class="col-md-12" id="document">
                                    </div>
                                </fieldset>
                            </div>
                        <?php if(!empty($id)){ ?>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"> Status</label>
                                       <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select4','label'=>false,'style'=>'width:100%')) ?>
                                    </div>
                                </div> 
                            </div> 
                        </div> 
                        <?php } ?>
                        <span class="help-block"></span>
                        <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                                        </div>
                                    </div>
                                </center>       
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->element('webcam') ?>
<?= $this->element('validate') ?> 
<?= $this->element('icheck') ?> 
<?= $this->element('student_autofill',['selector'=>'#student-id']) ?>
<?= $this->element('employee_autofill',['selector'=>'#employee-id']) ?>
<?php
$js="
$(document).ready(function(){


        $('#option1').on('ifChecked', function () {
                $('.employee').addClass('hidden');
                $('.student').removeClass('hidden');
                $('#student-id').attr('required','required');
                $('#employee-id').removeAttr('required');
        });

        $('#option2').on('ifChecked', function () {
                $('.student').addClass('hidden');
                $('.employee').removeClass('hidden');
                $('#employee-id').attr('required','required');
                $('#student-id').removeAttr('required');
        });

     
    $('#ServiceForm').validate({ 
        rules: {
            name: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>

<?= $this->element('datepicker') ?>     
