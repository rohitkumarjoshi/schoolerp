
<div class="box box-primary">
    <div class="box-header with-border"> 
        <label > Leaves List</label>
        <div class="box-tools pull-right">
            <a style="font-size:19px;" class="btn btn-box-tool" data-target="#FilterModel" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
        </div>
    </div>
    <div class="box-body" > 
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
                                    <label class="control-label">Select Status</label>
                                    <?php $type['Pending']='Pending';?>
                                    <?php $type['Rejected']='Rejected';?>
                                    <?php $type['Approved']='Approved';?>
                                    <?php echo $this->Form->control('status',[
                                    'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $type]);?>     
                                </div> 
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <a href="<?php echo $this->Url->build(array('controller'=>'Leaves','action'=>'studentIndex')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
        <?php $page_no=$this->Paginator->current('Leaves'); $page_no=($page_no-1)*20; ?>
        <div class="row">
            <div class="col-md-12"> 
                <table class="table ">
                     <thead>
                        <tr style="white-space: nowrap;">
                            <th>#</th>
                            <th>Name</th>
                            <th>Leave From </th>
                            <th>Leave To</th>
                            <th>Half Day</th>
                            <th>Half Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($leaves as $leave) :?>
                        <tr>
                            <td> <?php   echo $i; ?></td>
                            <td> 
                                <?= $name=($leave->student)?$leave->student->name:$leave->employee->name;?>
                            </td>
                            <td><?= h(date('d-M-Y',strtotime(h($leave->date_from)))) ?> </td>
                            <td><?= h(date('d-M-Y',strtotime(h($leave->date_to)))) ?> </td>
                            <td><?=h(@$leave->half_day) ?> </td>
                            <td>
                                <?php
                                if(@$leave->half_day=='No') 
                                {
                                    echo 'NA';
                                }else{
                                    echo @$leave->halfday_type;
                                }
                                ?> 
                            </td>
                            <td><?= h($leave->reason) ?> </td>
                            <td><?= h($leave->status) ?> </td>
                            
                            <td><?php
                                if(@$leave->status=='Pending') 
                                { ?> 
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($leave->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit leave', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit leave']) ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php $i++;endforeach; ?>
                    </tbody>
                </table>
                <?= $this->element('pagination') ?>  
            </div>
        </div> 
   </div>
</div> 
<?= $this->element('daterangepicker') ?>   