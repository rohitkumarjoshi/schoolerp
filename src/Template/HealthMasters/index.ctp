<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HealthMaster[]|\Cake\Collection\CollectionInterface $healthMasters
 */
?>

    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                        <label > Edit Master </label>
                    <?php }else{ ?>
                        <label> Add Master </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($healthMaster,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Health Type <span class="required" aria-required="true"> * </span></label>
                            </div>
							
                            <div class="col-md-8">
                                <?php echo $this->Form->control('health_type', ['class'=>'form-control','label'=>false]);?>
                            </div>
                        </div>
						<br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Unit <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('unit', ['class'=>'form-control','label'=>false]);?>
                            </div>
                        </div>
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
                    <?php $page_no=$this->Paginator->current('achivementCategories'); $page_no=($page_no-1)*10; ?>
                     <table id="example1" class="table  table-striped" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= __('Health Type') ?></th>
                                <th scope="col"><?= __('Unit') ?></th>
                                <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($healthMasters as $healthMaster): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= h($healthMaster->health_type) ?></td>
                                <td><?= h($healthMaster->unit) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($healthMaster->id)],['class'=>'btn btn-info btn-lg editbtn','escape'=>false]) ?>
										
                                    <a class=" btn btn-danger btn-lg deletebtn" data-target="#deletemodal<?php echo $healthMaster->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $healthMaster->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'HealthMasters','action'=>'delete',$healthMaster->id]]) ?>
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

