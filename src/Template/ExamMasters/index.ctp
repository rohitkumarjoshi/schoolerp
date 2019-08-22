<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExamMaster[]|\Cake\Collection\CollectionInterface $examMasters
 */
?>

<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                     <label> View Exams </label>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create('examMaster') ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label"> Medium </label>
                                <?= $this->Form->control('medium_id',['options'=>$mediums,'empty'=>'--select--','class'=>'select2','style'=>'width:100%;','label'=>false,'val'=>'']) ?>
                            </div>

                            <div class="col-sm-3">
                                <label class="control-label"> Class </label>
                                <?= $this->Form->control('student_class_id',['options'=>[],'class'=>'select2','style'=>'width:100%;','label'=>false,'val'=>'']) ?>
                            </div>

                            <div class="col-sm-3">
                                <label class="control-label"> Stream </label>
                                <?= $this->Form->control('stream_id',['options'=>[],'class'=>'select2','style'=>'width:100%;','label'=>false]) ?>
                            </div>

                            <div class="col-sm-3">
                                <?= $this->Form->submit('search',['class'=>'btn btn-default btn-success btnClass']) ?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                    <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
                     <table id="example1" class="table">
                        <thead>
                            <tr>
                                <th><?= __('Sr.No') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= ('Class') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('stream_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('order_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('max_marks') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('number_of_best') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>           
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($examMasters as $examMaster): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= h($examMaster->name) ?></td>
                                <td><?= $examMaster->has('student_class') ? $examMaster->student_class->name : '' ?></td>
                                <td><?= $examMaster->has('stream') ? $examMaster->stream->name : '' ?></td>
                                <td><?= $examMaster->has('parent_exam_master') ? $examMaster->parent_exam_master->name : '' ?></td>
                                <td><?= $examMaster->order_number?></td>
                                <td><?= $examMaster->max_marks?></td>
                                <td><?= $examMaster->number_of_best?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'add', $EncryptingDecrypting->encryptData($examMaster->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false]) ?>

                                    <a class=" btn btn-danger btn-xs deletebtn" data-target="#deletemodal<?php echo $examMaster->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $examMaster->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'ExamMasters','action'=>'delete',$examMaster->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to remove this ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn  btn-sm btn-info">Yes</button>
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
                </div>
                <div class="box-footer">
                    <?= $this->element('pagination') ?> 
                </div>
            </div>
        </div>
    </div>


<?= $this->element('selectpicker');?>
<?= $this->element('loading');?>
<?= $this->element('medium class stream filter all');?>