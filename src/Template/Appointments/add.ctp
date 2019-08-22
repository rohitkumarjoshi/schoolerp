<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                    <label> Add Appointment </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($appointment,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-4">
                             <label class="control-label"> Whom To Meet <span class="required" aria-required="true"> * </span></label>
                             <?= $this->Form->control('appointment_master_id', ['options'=>$appointmentMasters,'label' => false, 'class'=>'select2','empty'=>'Select Employee','style'=>'width:100%','required'])?>
                        </div>
                         <div class="col-md-4">
                             <label class="control-label"> Appointment Date <span class="required" aria-required="true"> * </span></label>
                              <?= $this->Form->control('appointment_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','required'])?>
                        </div> 
                        <div class="col-md-4">
                            <label class="control-label"> Appointment Time <span class="required" aria-required="true"> * </span></label>
                             <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php echo $this->Form->control('appointment_time',[
                                        'label' => false,'class'=>'form-control timepicker','type'=>'text','style'=>'width:300px;','required']);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Mobile No <span class="required" aria-required="true"> * </span></label>
                              <?php echo $this->Form->control('mobile_no',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Enter Mobile Number','type'=>'text','required','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>10,'minlength'=>10]);?>
                        </div>
                         <div class="col-md-8">
                            <label class="control-label"> Reason <span class="required" aria-required="true"> * </span></label>
                              <?php echo $this->Form->control('reason',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Enter reason here','type'=>'textarea','required','rows'=>2]);?>
                        </div>
                    </div>
                    
                    </div>
                    <?php if(!empty($id)){ ?>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Status </label>
                            <div class="form-group">
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
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
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('timepicker') ?> 
<?= $this->element('validate') ?> 


<?php
$js="
$(document).ready(function(){
    $('.timepicker').timepicker({
      showInputs: false
    });
    function rename()
    {
        $('#mainTable >tbody').find('tr').each(function(){
                $('.timepicker').timepicker({
                    showInputs: false
                }); 
                $(this).find('select.selectadd').select2();
            });
      }
    $(document).on('click','.DeleteRow',function(){
        $(this).closest('tr').remove();
    });
    $(document).on('click','#addRow',function(){
        var addRowContain = $('#addRowContain >tbody').html();
        $('#mainTable >tbody').append(addRowContain);
        rename();
    });

    $('#ServiceForm').validate({ 
        rules: {
            appointment_master_id: {
                required: true
            },
            appointment_date: {
                required: true
            },
            appointment_time: {
                required: true
            },
            mobile_no: {
                required: true,
                maxlength:10,
                minlength:10,
                digits:true
            },
            reason: {
                required: true
            }, 
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

