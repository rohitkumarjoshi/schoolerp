<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                 <h3 class="box-title" > Complaints Report</h3>
                 <hr>
                 <?= $this->Form->create($complaint,['id'=>'ServiceForm','type'=>'get']) ?>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label class="control-label">Search By Employee</label>
                               <?= $this->Form->control('data[employee_id]', ['options' => $employees,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Employee','dataplaceholder'=>'Select Vehicle'])?>
                            </div>
                             <div class="col-md-4">
                                <label class="control-label">Search By Student</label>
                               <?= $this->Form->control('data[student_id]', ['options' => $students,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Student','dataplaceholder'=>'Select Vehicle'])?>
                            </div>
                             <div class="col-md-2">
                                 <label class="control-label" style="visibility: hidden;">Search By Employee</label>
                                <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label" style="visibility: hidden;">Search By Employee</label>
                                
                            </div>

                        </div>
                    </div>
                     <?= $this->Form->end() ?>
                </div>
            <?php if($data_exist=='data_exist') { ?>
                    <br></br>
            <div class="box-body" >
                <!-- <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($complaint,['autocomplete'=>'off','url'=>['action'=>'driverconductorExport']]) ?>
                                            <?php if (isset($where)): ?>
                                                <?php foreach ($where as $key => $value): ?>
                                                    <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info'])?>
                                        <?= $this->Form->end() ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> -->
                <?php $page_no=$this->Paginator->current('Feedbacks'); $page_no=($page_no-1)*10; ?>
                <div class="row"> 
                    <div class="col-md-12"> 
                        <table cellpadding="0" cellspacing="0" class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><?= __('Sr.No') ?></th>
                                    <th scope="col"><?= __('Complaint By') ?></th>
                                    <th scope="col"><?= __('Title') ?></th>
                                    <th width="40%" scope="col"><?= __('Comment') ?></th>
                                    <th scope="col"><?= __(' Posted On') ?></th>
                                    <th scope="col"><?= __('Status') ?></th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php  foreach ($complaints as $complaint): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td>
                                <?php  
                                if(!empty($complaint->employee_id)) 
                                {
                                    echo $complaint->employee->name;
                                }
                                else  if(!empty($complaint->student_id)) 
                                {
                                     echo $complaint->student->name;
                                }  
                                ?>
                                </td> 
                                <td >
                                <?php echo $complaint->title;?>
                                </td> 
                                <td >
                                <?php echo $complaint->description;?>
                                </td> 
                                <td >
                                <?php echo date('d-M-Y',strtotime($complaint->created_on));?>
                                </td>
                                <td >
                                <?php echo $complaint->status;?>
                                </td>
                            </tr>
                        <?php  endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div> 
     <?php } else { ?>
         <div class="row">
            <div class="col-md-12 text-center">
                <h3> <?= $data_exist ?></h3>
            </div>
        </div>
    <?php } ?>
        </div>
    </div>
</div>
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

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
<?= $this->element('selectpicker') ?> 