<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                    <label> Edit Leave </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($leave,['id'=>'ServiceForm']) ?>
                    <div class="row">
                         <div class="col-md-4">
                             <label class="control-label"> Date From <span class="required" aria-required="true"> * </span></label>
                              <?= $this->Form->control('date_from', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','required'])?>

                        </div> 
                         <div class="col-md-4">
                             <label class="control-label"> Date To <span class="required" aria-required="true"> * </span></label>
                              <?= $this->Form->control('date_to', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','required'])?>
                              
                        </div> 
                         <div class="col-md-4">
                            <label class="control-label"> Status </label>
                            <div class="form-group">
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
                     <span class="help-block"></span>
                     <div class="row">
                       <div class="col-md-4">
                            <label class="control-label"> Half Day </label>
                            <?php
                            if($leave->half_day=='No')
                            {
                                $other_is='Checked';
                                $campus_div='hidden';
                                $campus_is='';
                                
                            }
                            else
                            {
                                $campus_is='Checked';
                                $campus_div='show';
                                $other_is='';
                            }?>

                            <?php 
                                if($leave->halfday_type=='First')
                                {
                                    $halfDay_F='Checked';
                                    $halfDay_S='';
                                }else
                                {
                                    $halfDay_F='';
                                    $halfDay_S='Checked';
                                }
                            ?>
                            <br>
                                <?php 
                                echo $this->Form->radio(
                                'half_day',
                                [
                                    ['value' => 'yes', 'text' => ' Yes',$campus_is],
                                    ['value' => 'no', 'text' => ' No',$other_is],
                                    
                                ],
                                ['class'=>'half_day']
                                );?>
                            </div> 
                            <div class="col-md-4 halfday_type <?php echo $campus_div ; ?>">
                                <label class="control-label"> Half Day Type </label>
                                <br>
                                <?php
                                echo $this->Form->radio(
                                'halfday_type',
                                [
                                    ['value' => 'first', 'text' => ' First Half',$halfDay_F],
                                    ['value' => 'second', 'text' => ' Second Half',$halfDay_S],
                                    
                                ],
                                ['class'=>'halfday_type_value']
                                ); ?>
                            </div>
                            <div class="col-md-4 halfday_date <?php echo $campus_div ; ?>">
                             <label class="control-label"> Half Day<span class="required" aria-required="true"> * </span></label>
                              <?= $this->Form->control('halfday_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker halfDayDateD','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy']) ?>

                            </div> 
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-12">
                            <label class="control-label"> Reason <span class="required" aria-required="true"> * </span></label>
                              <?php echo $this->Form->control('reason',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Enter reason here','type'=>'textarea','required','rows'=>2]);?>
                            </div>
                        </div>
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
<?= $this->element('icheck') ?> 
<?= $this->element('validate') ?> 


<?php
$js="
$(document).ready(function(){
     $(document).on('ifChecked', '.half_day', function(){
        var isNow= $(this).val();
        if(isNow == 'yes'){
            $('.halfday_type').css('display','block');
            $('.halfday_date').css('display','block');
            $('.halfday_type').removeClass('hidden');
            $('.halfday_date').removeClass('hidden');
            $('.halfDayDateD').prop('required', true);
        }
        else{
           $('.halfday_type').css('display','none');
           $('.halfday_date').css('display','none');
            $('.halfday_type').removeClass('show');
            $('.halfday_date').removeClass('show');
            $('.halfDayDateD').prop('required', false);
        }
    });


        $('#ServiceForm').validate({ 
        rules: {
            vehicle_id: {
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

