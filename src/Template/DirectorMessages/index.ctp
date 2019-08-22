<div class="row">
    <?php if(!empty($id)){ ?>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Director/Principal Message </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($directorMessage,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Role Type <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                             <?= $this->Form->control('role_type', ['options'=>$roleTypes,'label' => false, 'class'=>'select2','empty'=>'Select Role','style'=>'width:100%','required'])?>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Message <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('message',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter Message Here','type'=>'textarea','required','rows'=>2]);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Message By <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                             <?= $this->Form->control('message_by', ['options'=>$MessageBy,'label' => false, 'class'=>'select2','empty'=>'Select Option','style'=>'width:100%','required'])?>
                        </div>
                    </div>
                    <?php /* if(!empty($id)){ ?>
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
                    <?php } */ ?>
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
<?php }
else { ?>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <label> Director/Principal Message </label>
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
                                    <label class="control-label">Select Category</label>
                                    <?php $type['All']='All';?>
                                    <?php $type['Teacher']='Teacher';?>
                                    <?php $type['Student']='Student';?>
                                    <?php echo $this->Form->control('role',[
                                    'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $type]);?>     
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Message by</label> 
                                    <?php $types['Principal']='Principal';?>
                                    <?php $types['Director']='Director';?>
                                    <?php echo $this->Form->control('msgby',[
                                    'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $types]);?>     
                                </div> 
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <a href="<?php echo $this->Url->build(array('controller'=>'DirectorMessages','action'=>'index')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
                <!--<?php $page_no=$this->Paginator->current('DirectorMessages'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Role') ?></th> 
                            <th scope="col"><?= __('Message By ') ?></th>
                            <th scope="col"><?= __('Message ') ?></th>
                            <th scope="col"><?= __('Status ') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($directorMessages as $directorMessage): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td width="25%"><?= h(@$directorMessage->role_type) ?></td> 
                            <td width="25%"><?= h(@$directorMessage->message_by) ?></td> 
                            <td width="25%"><?= h(@$directorMessage->message) ?></td> 
                            <td>
                            <?php
                            if($directorMessage->is_deleted=='Y')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
                            <td class="actions" align="center">
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($directorMessage->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table> 
            </div>
        </div>
    </div>
    <?php } ?>
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