<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > Polls List </label>
                <div class="box-tools pull-right">
                    <a style="font-size:19px;" class="btn btn-box-tool" data-target="#FilterModel" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group"> 
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
                                        <label class="control-label">Select Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                         <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range']) ?> 
                                        </div>    
                                    </div>
                                    <div class="col-md-12" align="center">
                                    <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                        <!-- <a href="<?php echo $this->Url->build(array('controller'=>'Polls','action'=>'index')) ?>"class="btn btn-danger btn-sm">Reset</a> -->
                                        <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                    </div> 
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <?= $this->Form->end() ?> 
                    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><?= h('S.No.') ?></th> 
                                <th scope="col"><?= h('Question') ?></th>
                                <th scope="col"><?= h('Poll Type') ?></th> 
                                <th scope="col"><?= h('Objectives') ?></th> 
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x=0; foreach ($polls as $poll): ?>
                            <tr>
                                <td><?= ++$x ?></td>
                                <td><?= $poll->question ?></td>
                                <td><?= $poll->poll_type ?></td>  
                                <td>
                                    <a class=" btn btn-primary btn-sm" data-target="#Details<?php echo $poll->id; ?>" data-toggle="modal"><i class="fa fa-book"></i> Objectives</a>
                                    <div id="Details<?php echo $poll->id; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md" >
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Objective List
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <table id="example1" class="table  table-striped" style="border-collapse:collapse;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?= h('S.No.') ?></th> 
                                                                <th scope="col"><?= h('Objective') ?></th>   
                                                                <th scope="col"><?= h('Correct or Not') ?></th>   
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php  $a=0;
                                                            foreach ($poll->poll_rows as $poll_row) {?>
                                                             <tr>
                                                                <td><?= ++$a;?></td>
                                                                <td><?= $poll_row->objective ; ?></td>
                                                                <td><?= $poll_row->correct_answer ; ?></td>
                                                             </tr>
                                                            <?php    
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                                <td class="actions">
                                	<?= $this->Html->link(__('<i class="fa fa-eye"></i>'), ['action' => 'view', $EncryptingDecrypting->encryptData($poll->id)],['class'=>'btn btn-success btn-sm','escape'=>false, 'data-widget'=>'View answers', 'data-toggle'=>'tooltip', 'data-original-title'=>'View answers']) ?>

                                    <a class=" btn btn-danger btn-sm" data-target="#deletemodal<?php echo $poll->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                        <div id="deletemodal<?php echo $poll->id; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md" >
                                            <?= $this->Form->create('',['url'=>['controller'=>'Polls','action'=>'delete',$poll->id]]) ?>
                                                    <div class="modal-content">
                                                      <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title" >
                                                                Stay Attention
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                        <h4 class="modal-title">
                                                            Are you sure you want to remove this poll ?
                                                            </h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-sm btn-info">Yes</button>
                                                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                <?= $this->Form->end() ?>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $this->element('pagination') ?> 
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('daterangepicker') ?> 
