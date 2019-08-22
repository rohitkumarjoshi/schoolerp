
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                     <label > Edit Document Class Mapping </label>
                <?php }else{ ?>
                     <label> Add Document Class Mapping </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($documentClassMapping,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Document <span class="required" aria-required="true"> * </span></label>
                           <?= $this->Form->control('document_id', ['options'=>$documents,'label' => false, 'class'=>'select2','empty'=>'Select Document','style'=>'width:100%','required'])?>
                        </div>
                    </div>
                    <span class="help-block"></span><div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                              <?= $this->Form->control('student_class_id', ['options'=>$studentClasses,'label' => false, 'class'=>'select2','empty'=>'Select Class','style'=>'width:100%','required'])?>
                        </div>
                    </div>
                    <span class="help-block"></span>
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
                <hr>
                    <div class="row">
                        <center>
                            <div class="col-md-12">
                                <div class="col-md-offset-3 col-md-6">  
                                    <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                                </div>
                            </div>
                        </center>       
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
                <?= $this->Form->create('',['type'=>'get']) ?>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Document</label>
                                    <?php echo $this->Form->control('document_id', ['empty'=>'---Select---','options' => $documents,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$document_id]);?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Class</label>
                                    <?php echo $this->Form->control('student_class_id', ['empty'=>'---Select---','options' => $studentClasses,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$student_class_id]);?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?= $this->Form->label('Search', null, ['class'=>'control-label','style'=>'visibility: hidden;']) ?>
                                    <div class="input-icon right">
                                       <?= $this->Form->button(__('Search'),['class'=>'btn text-uppercase btn-success','name'=>'search','value'=>'search']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="box-body">
                <?php $page_no = $this->Paginator->counter(['format' => __('{{page}}')]); ?>
                <?php $page_no=($page_no-1)*10; ?>
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Document') ?></th>
                            <th scope="col"><?= __('Class') ?></th>
                            <th scope="col"><?= __('Status') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($documentClassMappings as $documentClassMapping): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td>
                            <?php echo $documentClassMapping->document->document_name;?>
                            </td> 
                             <td>
                            <?php echo $documentClassMapping->student_class->name;?>
                            </td> 
                            <td>
                            <?php
                            if($documentClassMapping->is_deleted=='Y')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
                            <td class="actions">
                                <?= $this->Html->link(__(' <i class="fa fa-edit"></i>'), ['action' => 'index', $EncryptingDecrypting->encryptData($documentClassMapping->id)],['class'=>'btn btn-info editbtn','escape'=>false, 'data-widget'=>'Edit document', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit document']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table>
            </div>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
  $('#ServiceForm').validate({ 
        rules: {
            document_id: {
                required: true
            },
            student_class_id: {
                required: true
            }

        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
});
    ";
$this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>