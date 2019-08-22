<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php if(!empty($id)){ ?>
                   <label>Edit Employee </label>
                <?php }else{ ?>
                    <label>Add Employee </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($employee,['id'=>'ServiceForm','type'=>'file']) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Employee Name <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('name',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Employee Name','type'=>'text']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> DOB <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('dob',[
                            'label' => false,'class'=>'form-control datepicker','placeholder'=>'DOB','type'=>'text','data-date-format'=>'dd-M-yyyy']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Marital Status <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('marital_status',[
                            'label' => false,'class'=>'select2','placeholder'=>'Marital Status','style'=>'width:100%;','options'=>$marital_statuses]);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Gender <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('gender_id', ['label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Parmanent Address <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('parmanent_address', ['label'=>false,'class'=>'form-control ']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Correspondence Address<span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('correspondence_address', ['label'=>false,'class'=>'form-control ']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> State <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('state_id', ['label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> City <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('city_id', ['label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Role <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('role_id', ['label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                    </div>
					
                    <?php if(!empty($id)){ ?>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Status </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
					
					 <div class="row">
                        <div class="col-md-4">
						<?php 
						if(!empty($employee->photo)){
						     $cdn_path = $awsFileLoad->cdnPath();
							 echo $this->Html->image($cdn_path.'/'.$employee->photo,['style'=>  'margin-top: 0px;height: 150px;align-content: center; background-color: #f9eded00 !important;width: 200px;']);
						}
						
						?>
                            <label class="control-label"> Photo </label>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-11">
                             <?php echo $this->Form->control('photo', ['label'=>false,'class'=>'form-control','type'=>'file']);?>
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
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <label> View List </label>
            </div> 
            <div class="box-body">
                <?php $page_no=$this->Paginator->current('employees'); $page_no=($page_no-1)*10; ?>
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Name ') ?></th>
                            <th scope="col"><?= __('DOB  ') ?></th>
                            <th scope="col"><?= __('Marital Status ') ?></th>
                            <th scope="col"><?= __('Gender ') ?></th>
                            <th scope="col"><?= __('Role ') ?></th>
                            <th scope="col"><?= __('Status ') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($employees as $employee): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td><?php echo $employee->name;?></td>
                            <td><?php echo $employee->dob;?></td>
                            <td><?php echo $employee->marital_status;?></td>
                            <td><?php echo $employee->gender->name;?></td>
                            <td><?php echo $employee->role->name;?></td>
                            <td>
                            <?php
                            if($employee->is_deleted=='Y')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
                            <td class="actions" align="center">
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($employee->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Employee', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Employee']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            name: {
                required: true
            },
            dob: {
                required: true
            },
            parmanent_address: {
                required: true
            },
            correspondence_address: {
                required: true
            },
            marital_status: {
                required: true
            },
            gender_id: {
                required: true
            },
            city_id: {
                required: true
            },
            state_id: {
                required: true
            },
            role_id: {
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