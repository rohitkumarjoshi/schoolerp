
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>


<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                     <label > Edit Directory </label>
                <?php }else{ ?>
                     <label> Add Directory </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($directory,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Employee <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                             <?= $this->Form->control('employee_id', ['options'=>$employees,'label' => false, 'class'=>'select2','empty'=>'Select Employee','style'=>'width:100%','required'])?>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Mobile No <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('mobile_no',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter Mobile Number','type'=>'text','required','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>10,'minlength'=>10]);?>
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
                                <?php 
                                    $status[]=['value'=>'N','text'=>'Active'];
                                    $status[]=['value'=>'Y','text'=>'Deactive'];
                                ?>
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
                <div class="collapse" id="FilterModel" aria-expanded="false"> 
                    <fieldset style="text-align:left;"><legend>Filter</legend>
                        <div class="col-md-12">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <label class="control-label">Select</label>
                                    <?= $this->Form->control('emp_id', ['options'=>$employees,'label' => false, 'class'=>'select2','empty'=>'Select Employee','style'=>'width:100%'])?>     
                                </div> 
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
                <!--<?php $page_no=$this->Paginator->current('Directories'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Employee Name ') ?></th> 
                            <th scope="col"><?= __('Mobile No ') ?></th>
                            <th scope="col"><?= __('Status ') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($directories as $directory): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td width="25%"><?php echo $directory->employee->name;?></td> 
                            <td width="25%"><?php echo $directory->mobile_no;?></td> 
                            <td>
                            <?php
                            if($directory->is_deleted=='Y')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
                            <td class="actions" align="center">
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($directory->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
                </table> 
                <?= $this->element('pagination')?>
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
            service: {
                required: true
            },
            state_id:{
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