<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject[]|\Cake\Collection\CollectionInterface $subjects
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
                    <label> View Subjects </label>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create('subject',['url'=>['controller'=>'Subjects','action'=>'index']]) ?>
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
                     <table id="example1" class="table">
                        <thead>
                            <tr>
                                <th><?= __('Sr.No') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('student_class_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('stream_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('elective') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('subject_type_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('order_number') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>           
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($subjects as $subject): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= h($subject->name) ?></td>
                                <td><?= $subject->has('student_class') ? $this->Html->link($subject->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $subject->student_class->id]) : '' ?></td>
                                <td><?= $subject->has('stream') ? $this->Html->link($subject->stream->name, ['controller' => 'Streams', 'action' => 'view', $subject->stream->id]) : '' ?></td>
                                <td><?= $subject->has('parent_subject') ? $this->Html->link($subject->parent_subject->name, ['controller' => 'Subjects', 'action' => 'view', $subject->parent_subject->id]) : '' ?></td>
                                <td><?= h($subject->elective) ?></td>
                                <td><?= $subject->has('subject_type') ? $this->Html->link($subject->subject_type->name, ['controller' => 'SubjectTypes', 'action' => 'view', $subject->subject_type->id]) : '' ?></td>
                                <td><?= $subject->order_number?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'edit', $EncryptingDecrypting->encryptData($subject->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false]) ?>

                                    <a class=" btn btn-danger btn-xs deletebtn" data-target="#deletemodal<?php echo $subject->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $subject->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'Subjects','action'=>'delete',$subject->id]]) ?>
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