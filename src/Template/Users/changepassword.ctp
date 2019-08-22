<div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                        <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Change Password </label>
                </div>
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="box-body">
                    <center>
                        <div class="form-group" style="width: 500px;">    
                           <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Old Password <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('old_password',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Enter Old Password','type'=>'password','id'=>'old_password']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> New Password <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-8">
                                 <?php echo $this->Form->control('password',[
                                'label' => false,'class'=>'form-control pd','placeholder'=>'Enter New Password','type'=>'password','id'=>'new_password']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                         <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Confirm Password <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-8">
                                 <?php echo $this->Form->control('confirm_password',[
                                'label' => false,'class'=>'form-control cpassword','placeholder'=>'Confirm New Password','type'=>'password']);?>
                            </div>
                        </div>
                        
                    </div>
                </center>
                <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','id'=>'submit_member']); ?>
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
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
    $('#ServiceForm').validate({ 
        rules: {
            password: {
                required: true
            },
            old_password: {
                required: true
            },
            confirm_password: {
                required: true,
                equalTo: '#new_password'
            }
        },
        messages:{
               confirm_password : {
                  equalTo :'The new password and confirm password is not match!'
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

