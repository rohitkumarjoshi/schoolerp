<div class="box box-primary">
    <div class="box-header with-border"> 
        <label > Appointments Report</label> 
    </div>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->create($appointment,['autocomplete'=>'off','type'=>'get']) ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label> Search By Requestor</label>
                            <?= $this->Form->control('data[created_by]', ['options' =>$creaters, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-lable"> Date From </label>
                            <?= $this->Form->control('data[appointment_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['appointment_date >=']])?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Date To </label>
                            <?= $this->Form->control('data[appointment_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date','value'=>@$_GET['data']['appointment_date <=']])?>
                        </div>
                         <div class="col-md-3">
                            <label> Search By Status</label>
                            <?= $this->Form->control('data[status]', ['options' =>$status, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12" align="center">
                        <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                            <a href="<?php echo $this->Url->build(array('controller'=>'Appointments','action'=>'appmtApproval')) ?>"class="btn btn-danger btn-sm">Reset</a>

                            <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                        </div> 
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>  
       <?php if($data_exist=='data_exist') { ?>
        <?php $page_no=$this->Paginator->current('Appointments'); $page_no=($page_no-1)*20; ?>
        <div class="row">
            <div class="col-md-12">
                <table class="table ">
                     <thead>
                        <tr style="white-space: nowrap;">
                            <th>#</th>
                            <th>Meeting With</th>
                            <th>Person Name</th>
                            <th>Appointment Time</th>
                            <th>Mobile No</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($appointments as $appointment) :?>
                        <tr>
                            <td> <?php echo $i; ?></td>
                            <td><?= h($appointment->appointment_master->employee->name) ?> </td>
                            <td>
                                <?php  
                                if(!empty($appointment->student_id))
                                    {
                                      echo @$appointment->student->name;    
                                     }
                                    else
                                    {
                                        echo @$appointment->employee->name;
                                    }
                                ?>
                            </td>
                            <td><?= h(date('d-M-Y',strtotime(h($appointment->appointment_date)))).' ,'.h(date('h:i:s A',strtotime(h($appointment->appointment_time)))) ?> </td>
                            <td><?= h($appointment->mobile_no) ?> </td>
                            <td><?= h($appointment->reason) ?> </td>
                            <td><?= h($appointment->status) ?> </td> 
                            <td class="actions">
                            <?php
                                if($appointment->status=='Pending') { ?>
                                  <a href="#approve<?php echo $appointment->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> <i class="fa fa-check"></i></a>
                                  <a href="#reject<?php echo $appointment->id ;?>" class="btn btn-danger editbtn " data-toggle="modal" /> <i class="fa fa-times" style="color:white !important;"></i></a>
                               <?php } ?>
                               <?php
                                if($appointment->status=='Rejected') { ?>
                                  <a href="#approve<?php echo $appointment->id ;?>" class="btn btn-info editbtn " data-toggle="modal" /> <i class="fa fa-check"></i></a>
                               <?php } ?>

                                <?php
                                if($appointment->status=='Approved') { ?>
                                  <a href="#reject<?php echo $appointment->id ;?>" class="btn btn-danger editbtn " data-toggle="modal" /> <i class="fa fa-times" style="color:white !important;"></i></a>
                            <?php } ?>
                            </td>
                            <!-- ------------ Approve Modal  Start--------------------- -->
                        <div id="approve<?php echo $appointment->id ;?>" class="modal fade" role="dialog">
                              <div class="modal-dialog modal-dialog">
                                <div class="modal-content">
                                  <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"> Confirm Header </h4>
                                  </div>
                                  <div class="modal-body">
                                    <h4>
                                        Are you sure, you want to approve this appointment ?
                                    </h4>
                                     <?php echo $this->Form->hidden('accept_request_id',[
                                              'value'=>$appointment->id]);?>
                                     
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
                        <!-- ------------ Approve Modal  End--------------------- -->

                        <!-- ------------ Reject Modal  Start--------------------- -->
                        <div id="reject<?php echo $appointment->id ;?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog">
                                <div class="modal-content">
                                  <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"> Confirm Header </h4>
                                  </div>
                                  <div class="modal-body">
                                    <h4>
                                      Are you sure, you want to reject this appointment ?
                                    </h4>
                                    <?php echo $this->Form->hidden('reject_request_id',[
                                      'value'=>$appointment->id]);?>
                                     
                                  </div>
                                  <div class="modal-footer">
                                   <?php echo $this->Form->button('Reject',['class'=>'btn btn-success submit_member','name'=>'actionsubmit']); ?>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </div>
                                    <?= $this->Form->unlockField('reject_request_id') ;?>
                                  <?= $this->Form->end() ?>
                                </div>
                            </div>
                        </div>      
                        <!-- ------------ Reject Modal  End--------------------- ---->
                        </tr>
                    <?php $i++;endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
     <?php } else { ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3> <?= $data_exist ?></h3>
            </div>
        </div>
    <?php } ?>
   </div>
</div>  
<?= $this->element('datepicker') ?>  
<?= $this->element('selectpicker') ?> 