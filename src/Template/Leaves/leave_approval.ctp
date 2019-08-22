
<div class="box box-primary">
    <div class="box-header with-border"> 
        <label > Leaves</label>
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
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Select Students</label>
                                    <?php echo $this->Form->control('student_id',[
                                    'label' => false,'class'=>'select2','empty'=>'Select...','options' => $students,'style'=>'width:100%']);?>
                                </div>
                                <?php if($login_type == 'Admin'){?>
                                <div class="col-md-6">
                                    <label class="control-label">Select Employee</label>
                                    <?php echo $this->Form->control('employee_id',[
                                    'label' => false,'class'=>'select2','empty'=>'Select...','options' => $employee,'style'=>'width:100%']);?>
                                </div>
                                <?php } ?>
                            </div>
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <a href="<?php echo $this->Url->build(array('controller'=>'Leaves','action'=>'leaveApproval')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
                            <td> 
                            <?php
                            $strtodate=strtotime($leave->date_to);
                            $strcurrent=strtotime(date('Y-m-d'));
                            if($strtodate>=$strcurrent) {
                                if($leave->status=='Pending') { ?>
                                  <a href="#approve<?php echo $leave->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> <i class="fa fa-check"></i></a>
                                  <a href="#reject<?php echo $leave->id ;?>" class="btn btn-danger editbtn " data-toggle="modal" /> <i class="fa fa-times" style="color:white !important;"></i></a>
                               <?php } 
                               
                                    if($leave->status=='Rejected') { ?>
                                      <a href="#approve<?php echo $leave->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> <i class="fa fa-check"></i></a>
                               <?php }  
                                    if($leave->status=='Approved') { ?>
                                      <a href="#reject<?php echo $leave->id ;?>" class="btn btn-danger editbtn " data-toggle="modal" /> <i class="fa fa-times" style="color:white !important;"></i></a>
                                <?php } 
                            }
                                ?>
                         
                                <div id="approve<?php echo $leave->id ;?>" class="modal fade" role="dialog">
                                      <div class="modal-dialog modal-dialog">
                                        <div class="modal-content">
                                          <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"> Confirm Header </h4>
                                          </div>
                                          <div class="modal-body">
                                            <h4>
                                                Are you sure, you want to approve this leave ?
                                            </h4>
                                            <?php echo $this->Form->hidden('accept_request_id',[
                                              'value'=>$leave->id]);?>
                                             
                                          </div>
                                          <div class="modal-footer">
                                          <?php echo $this->Form->button('Approve',['class'=>'btn btn-success submit_member','name'=>'actionsubmit']); ?>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          </div>
                                            <?= $this->Form->unlockField('accept_request_id') ;?>
                                          <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                                </div>      
                                    
                                <div id="reject<?php echo $leave->id ;?>" class="modal fade" role="dialog">
                                       <div class="modal-dialog modal-dialog">
                                        <div class="modal-content">
                                          <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"> Confirm Header </h4>
                                          </div>
                                          <div class="modal-body">
                                            <h4>
                                              Are you sure, you want to reject this leave ?
                                            </h4>
                                            <?php echo $this->Form->hidden('reject_request_id',[
                                              'value'=>$leave->id]);?>
                                             
                                          </div>
                                          <div class="modal-footer">
                                          <?php echo $this->Form->button('Reject',['class'=>'btn btn-success submit_member','name'=>'actionsubmit']); ?>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          </div>
                                            <?php $this->Form->unlockField('reject_request_id') ;?>
                                          <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                                </div>
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
<?= $this->element('selectpicker') ?>   