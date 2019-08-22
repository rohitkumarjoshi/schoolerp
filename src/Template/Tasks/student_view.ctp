<div class="row"> 
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <label> View List </label>
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
                                    <label class="control-label">Select Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                     <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range']) ?> 
                                    </div>    
                                </div>  
                                <div class="col-md-6">
                                    <label class="control-label">Select Employee</label> 
                                    <?php echo $this->Form->control('empid',[
                                    'label' => false,'class'=>'select2','empty'=>'Select...','options' => $employees,'style'=>'width:100%']);?>     
                                </div> 
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <a href="<?php echo $this->Url->build(array('controller'=>'Tasks','action'=>'studentView')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
                <!--<?php $page_no=$this->Paginator->current('AppointmentMasters'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Title') ?></th> 
                            <th scope="col"><?= __('Description') ?></th> 
                            <th scope="col"><?= __('Date') ?></th> 
                            <th scope="col"><?= __('Employee') ?></th>   
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($tasksData as $complaint): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td width="25%"><?= h(@$complaint->title) ?></td> 
                            <td width="25%"><?= h(@$complaint->description) ?></td> 
                            <td width="25%"><?= h(@$complaint->task_date) ?></td> 
                            <td width="25%"><?= h(@$complaint->employee->name) ?></td>  
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table> 
            </div>
        </div>
    </div>
</div>
 
<?= $this->element('selectpicker') ?>  
<?= $this->element('daterangepicker') ?> 
 