<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                     <label > Edit Taks </label>
                <?php }else{ ?>
                     <label> Add Task </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($tasks,['id'=>'ServiceForm']) ?>
                     <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Employee </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('employee_id',[
                                'label' => false,'class'=>'select2','empty'=>'Select...','options' => $employees,'style'=>'width:100%']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Student </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('student_id',[
                                'label' => false,'class'=>'select2','empty'=>'Select...','options' => $students,'style'=>'width:100%']);?>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('task_date',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required','value'=>date('d-m-Y')]);?>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Title <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('title',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter Title ','type'=>'text','required']);?>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('description',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter description here','type'=>'textarea','required','rows'=>2]);?>
                        </div>
                    </div>
                    <?php if(!empty($id)){ ?>
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
                <div class="box-tools pull-right">
                    <a style="font-size:19px;" class="btn btn-box-tool" data-target="#FilterModel" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
                </div>
            </div> 
            <div class="box-body">
                <?= $this->Form->create('FilterForm',['type'=>'get']) ?>
                <div class="collapse"  id="FilterModel" aria-expanded="false"> 
                    <fieldset style="text-align:left;"><legend>Filter</legend>
                        <div class="col-md-12">
                            <div class="row"> 
                                <div class="col-md-6">
                                    <label class="control-label">Select Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                     <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range']) ?> 
                                    </div>    
                                </div>  
                                <div class="col-md-6">
                                    <label class="control-label">Select Employee</label> 
                                    <?php echo $this->Form->control('empid',[
                                    'label' => false,'class'=>'select2','empty'=>'Select...','options' => $employees,'style'=>'width:100%']);?>     
                                </div> 
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <!-- <a href="<?php echo $this->Url->build(array('controller'=>'Tasks','action'=>'index')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                     --><?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
                <!--<?php $page_no=$this->Paginator->current('AppointmentMasters'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Title') ?></th> 
                            <th scope="col"><?= __('Description') ?></th> 
                            <th scope="col"><?= __('Date') ?></th> 
                            <th scope="col"><?= __('Employee') ?></th>  
                            <th scope="col"><?= __('Student') ?></th>  
                            <th scope="col"><?= __('Status') ?></th>  
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($tasksData as $complaint): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td width="25%"><?= h(@$complaint->title) ?></td> 
                            <td width="25%"><?= h(@$complaint->description) ?></td> 
                            <td width="25%"><?= h(@$complaint->task_date) ?></td> 
                            <td width="25%"><?= h(@$complaint->employee->name) ?></td> 
                            <td width="25%"><?= h(@$complaint->student->name) ?></td> 
                            <td width="25%"><?php  if ($complaint->is_deleted=='Y') {
                                echo "Deactive";
                            }
                            else{
                                echo "Active";
                            } ?></td> 
                            <td class="actions" align="center">
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($complaint->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table> 
            </div>
        </div>
    </div>
</div>

<?= $this->element('validate') ?> 
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('daterangepicker') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            title: {
                required: true
            },
            description:{
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