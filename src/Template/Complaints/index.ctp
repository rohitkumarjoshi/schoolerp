<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                     <label > Edit Complaint </label>
                <?php }else{ ?>
                     <label> Add Complaint </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($complaint,['id'=>'ServiceForm']) ?>
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
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter description here','type'=>'textarea','required','style'=>'resize:none;']);?>

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
            </div> 
            <div class="box-body">
                <!--<?php $page_no=$this->Paginator->current('AppointmentMasters'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Title') ?></th> 
                            <th scope="col"><?= __('Description') ?></th> 
                            <th scope="col"><?= __('Complaint By') ?></th> 
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($complaints as $complaint): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td width="25%"><?= h(@$complaint->title) ?></td> 
                            <td width="25%"><?= h(@$complaint->description) ?></td> 
                            <td width="25%"><?= h(@$complaint->employee->name) ?></td>
                            
                           <!--  <td>
                            <?php
                            if($complaint->is_deleted=='Y')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td> -->
                            <?php if($complaint->status =='Pending') { ?>  
                            <td class="actions" align="center"> 
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($complaint->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit']) ?>
                            
                            </td>
                            <?php } ?>
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

<?= $this->element('validate') ?> 
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
<?= $this->element('selectpicker') ?> 