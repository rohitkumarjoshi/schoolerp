<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentHealth[]|\Cake\Collection\CollectionInterface $studentHealths
 */
?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
                </div> 
                <div class="box-body">
                    <!--<?php $page_no=$this->Paginator->current('achivementCategories'); $page_no=($page_no-1)*10; ?>-->
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= 'Student Name' ?></th>
                                <th scope="col"><?= $this->Paginator->sort('health_master_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('health_value') ?></th>
                                <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($studentHealths as $studentHealth): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?php echo $studentHealth->student_info->student->name;?></td>
                                <td><?= $studentHealth->health_master->health_type ?></td>
                                <td><?= h($studentHealth->health_value) ?> <?= $studentHealth->health_master->unit ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'edit', $EncryptingDecrypting->encryptData($studentHealth->id)],['class'=>'btn btn-info btn-lg editbtn','escape'=>false]) ?>

                                    <a class=" btn btn-danger btn-lg deletebtn" data-target="#deletemodal<?php echo $studentHealth->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $studentHealth->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'StudentHealths','action'=>'delete',$studentHealth->id]]) ?>
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
