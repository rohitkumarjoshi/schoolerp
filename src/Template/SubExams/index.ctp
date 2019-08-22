<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?php if(!empty($id)){ ?>
                   <label>Edit Sub-Exam </label>
                <?php }else{ ?>
                    <label>Add Sub-Exam </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($subExam,['id'=>'ServiceForm','url'=>['action'=>'add',$id]]) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Main Exams <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('exam_master_id', ['options' => $examMasters,'label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Sub-Exam Name <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('name',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Sub-Exam Name','type'=>'text']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Max Marks <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('max_marks',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Maximum Marks','type'=>'number']);?>
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
                <!--<?php $page_no=$this->Paginator->current('achivementCategories'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('exam_master_id') ?></th>
                            <th scope="col"><?= __('Sub-Exam') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('max_marks') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($subExams as $subExam): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td><?php echo $subExam->exam_master->name;?></td>
                            <td><?php echo $subExam->name;?></td>
                            <td><?php echo $subExam->max_marks;?></td>
                            <td class="actions" align="center">
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($subExam->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Class', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Class']) ?>
                                <a class=" btn btn-danger btn-lg deletebtn" data-target="#deletemodal<?php echo $subExam->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $subExam->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['class'=>'filter_form','url'=>['action'=>'delete',$subExam->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        All marks of this exam will be delete.
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn  btn-sm btn-info">Agree</button>
                                                        <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
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

<?= $this->element('validate') ?> 
<?= $this->element('selectpicker') ?> 
