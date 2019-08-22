<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Change Username and Password</label>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active" >
                            <a href="#tab_1_1" data-toggle="tab" aria-expanded="true">Employee</a>
                        </li>
                        <li class="">
                            <a href="#tab_1_2" data-toggle="tab">Student</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_1_1">
                        <div class="row">
                            <div class="col-md-6">  
                                <div class="box box-info">
                                    <div class="box-header">
                                        <div class="caption">Employee</div>
                                    </div>
                                    <?= $this->Form->create('',['id'=>'EmployeeForm']) ?>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label"> Employee <span class="required" aria-required="true"> * </span></label>
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo $this->Form->control('user_id', ['empty'=>'--Select Employee--','options'=>$employee,'label'=>false,'class'=>'select2 user_id','style'=>'width:100%;']);?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label"> Username <span class="required" aria-required="true"> * </span></label>
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo $this->Form->control('username', ['label'=>false,'class'=>'form-control username']);?>
                                            </div>
                                        </div>
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
                                    <div class="box-footer">
                                        <div class="row">
                                            <center>
                                                <div class="col-md-12">
                                                    <div class="col-md-offset-3 col-md-6">  
                                                        <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_employee']); ?>
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
                    <div class="tab-pane fade in" id="tab_1_2">
                        <div class="row">
                            <div class="col-md-6">  
                                <div class="box box-info">
                                    <div class="box-header">
                                        <div class="caption">Student</div>
                                    </div>
                                    <?= $this->Form->create('',['id'=>'StudentForm']) ?>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label"> Student <span class="required" aria-required="true"> * </span></label>
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo $this->Form->control('user_id', ['empty'=>'--Select Student--','options'=>$student,'label'=>false,'class'=>'select2 student_id','style'=>'width:100%;']);?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label"> Username <span class="required" aria-required="true"> * </span></label>
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo $this->Form->control('username', ['label'=>false,'class'=>'form-control studentusername']);?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label"> New Password <span class="required" aria-required="true"> * </span></label>
                                            </div>
                                            <div class="col-md-8">
                                                 <?php echo $this->Form->control('password',[
                                                'label' => false,'class'=>'form-control pd','placeholder'=>'Enter New Password','type'=>'password','id'=>'student_new_password']);?>
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
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
    $('.user_id').on('change',function(e){
        var c_form = $(this).closest('form');

        var url = '".$this->Url->build(['controller'=>'Users','action'=>'getEmployeeUsername.json'])."';
        $.ajax({
            url: url,
            type: 'post',
            data: $('form#EmployeeForm').serialize(),
            contentType: 'application/x-www-form-urlencoded',
            success: function(result)
            {
                var obj = JSON.parse(JSON.stringify(result));
                c_form.find('.username').val(obj.response);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
             
            }
        }); 
    });
    $('.student_id').on('change',function(e){
        var c_form = $(this).closest('form');

        var url = '".$this->Url->build(['controller'=>'Users','action'=>'getStudentUsername.json'])."';
        $.ajax({
            url: url,
            type: 'post',
            data: $('form#StudentForm').serialize(),
            contentType: 'application/x-www-form-urlencoded',
            success: function(result)
            {
                var obj = JSON.parse(JSON.stringify(result));
                c_form.find('.studentusername').val(obj.response);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
             
            }
        }); 
    });
    $('#EmployeeForm').validate({ 
        rules: {
            password: {
                required: true
            },
             username: {
                required: true,
                remote: {
                    type: 'post',
                    url: '".$this->Url->build(['controller'=>'Users','action'=>'matchEmployeeUsername'])."',
                    data: {
                        'user_id': function() { return $('.user_id option:selected').val(); },
                        'username': function() { return $('.username').val(); }
                    },

                }

            },
            user_id: {
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
               },
               username: {
                  remote: 'The username is already in use!'
                }
        },
        submitHandler: function (form) {
            $('#loading').show();
            $('#submit_employee').attr('disabled','disabled');
            form.submit();
        }
    });
    
    $('#StudentForm').validate({ 
        rules: {
            password: {
                required: true
            },
             username: {
                required: true,
                remote: {
                    type: 'post',
                    url: '".$this->Url->build(['controller'=>'Users','action'=>'matchEmployeeUsername'])."',
                    data: {
                        'user_id': function() { return $('.student_id option:selected').val(); },
                        'username': function() { return $('.studentusername').val(); }
                    },

                }

            },
            user_id: {
                required: true
            },
            confirm_password: {
                required: true,
                equalTo: '#student_new_password'
            }
        },
        messages:{
               confirm_password : {
                  equalTo :'The new password and confirm password is not match!'
               },
               username: {
                  remote: 'The username is already in use!'
                }
        },
        submitHandler: function (form) {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
    
    
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
