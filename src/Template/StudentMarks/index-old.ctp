<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\studentMark[]|\Cake\Collection\CollectionInterface $studentMarks
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
                    <b> View studentMarks </b>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create('studentMark') ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label"> Medium </label>
                                <?= $this->Form->control('medium_id',['options'=>$mediums,'empty'=>'--select--','class'=>'select2','style'=>'width:100%;','label'=>false,'val'=>'']) ?>
                            </div>

                            <div class="col-sm-3">
                                <label class="control-label"> Class </label>
                                <?= $this->Form->control('student_class_id',['options'=>'','class'=>'select2','style'=>'width:100%;','label'=>false,'val'=>'']) ?>
                            </div>

                            <div class="col-sm-3">
                                <label class="control-label"> Stream </label>
                                <?= $this->Form->control('stream_id',['options'=>'','class'=>'select2','style'=>'width:100%;','label'=>false]) ?>
                            </div>

                            <div class="col-sm-3">
                                <?= $this->Form->submit('search',['class'=>'btn btn-default btn-success btnClass']) ?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                    <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th><?= __('Sr.No') ?></th>
                                <th scope="col"><?= __('Class') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('exam_master_id') ?></th>
                                <th scope="col"><?= __('Student') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                                <th scope="col"><?= __('Marks') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>           
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($studentMarks as $studentMark): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= $studentMark->exam_master->name?></td>
                                <td><?= $studentMark->student_info->student_class->name?></td>
                                <td><?= $studentMark->student_info->student->name?></td>
                                <td><?= h($studentMark->student_number) ?></td>
                                <td><?= $studentMark->order_number?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil-square-o"></i> '), ['action' => 'edit', $EncryptingDecrypting->encryptData($studentMark->id)],['class'=>'btn btn-info btn-xs','escape'=>false]) ?>

                                    <a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $studentMark->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $studentMark->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'StudentMarks','action'=>'delete',$studentMark->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to remove this book ?
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
<?= $this->element('medium class stream filter user');?>

