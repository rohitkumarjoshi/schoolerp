<div class="box box-primary">
    <div class="box-header with-border"> 
        <label > Appointments Report</label> 
    </div>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->create($appointment,['autocomplete'=>'off']) ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <label> Whom To Meet</label>
                            <?= $this->Form->control('data[appointment_master_id]', ['options' =>$appointmentMasterArr, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-lable"> Date From </label>
                            <?= $this->Form->control('data[appointment_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['appointment_date >=']])?>
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label"> Date To </label>
                            <?= $this->Form->control('data[appointment_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['appointment_date <=']])?>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-4">
                            <label> Search By Student</label>
                            <?= $this->Form->control('data[student_id]', ['options' =>$students, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                        <div class="col-sm-4">
                            <label> Search By Status</label>
                            <?= $this->Form->control('data[status]', ['options' =>$status, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12" align="center">
                        <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                            <a href="<?php echo $this->Url->build(array('controller'=>'Appointments','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
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