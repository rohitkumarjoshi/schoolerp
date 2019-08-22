
<div class="box box-primary">
    <div class="box-header with-border"> 
        <label > Appointments List</label>
        <!-- <div class="box-tools pull-right">
            <h3 class="box-title" style="padding:5px;color:gray;"><i class="fa fa-filter" data-target="#demo" data-toggle="collapse" aria-expanded="false" ></i></h3>
        </div> -->
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
                            <div class="col-sm-3">
                                <label class="control-lable"> Date From </label>
                                <?= $this->Form->control('data[appointment_date >=]',['class'=>'datepicker form-control','id'=>'date-from','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['appointment_date >=']])?>
                            </div>

                            <div class="col-sm-3">
                                <label class="control-label"> Date To </label>
                                <?= $this->Form->control('data[appointment_date <=]',['class'=>'datepicker form-control','id'=>'date-to','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['appointment_date <=']])?>
                            </div>
                            <div class="col-sm-2">
                                  <?= $this->Form->submit('Search',['class'=>'btn btn-success btnClass'])?>
                            </div>
                        </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        <br>
        
       <?php if(!empty($appointments)) { ?>
        <?php $page_no=$this->Paginator->current('Appointments'); $page_no=($page_no-1)*20; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                   
                    <div class="box-body" style="width: 100% !important;">
                        <div>
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
                                    <th>Delete Status</th>
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
                       <td>
                        <?php
                        if($appointment->is_deleted=='Y')
                        {
                            echo 'Deactive';
                        }
                        else{
                            echo 'Active';
                        }
                        ?>
                        </td> 
                        <td> 
                            <?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($appointment->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit appointment', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit appointment']) ?>
                          </td>
                    </tr>
                <?php $i++;endforeach; ?>
                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
   </div>
</div>
<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?> 
<?php
$js='



$(document).ready(function(){
    $(document).on("change", "#date-to,#date-from", function(){
        var txtStartDate = $("#date-from").val();
        var txtEndDates = $("#date-to").val();
        
        var Sdate = txtStartDate.split("-");
        var Syear= Sdate[2];
        var Smonth= Sdate[1];
        var Sday= Sdate[0];
        var SYMDDate = Syear + "-" + Smonth + "-" + Sday;
        var newdate= new Date(SYMDDate);
        var StartDateStrToTime=newdate.getTime();

        var Edate = txtEndDates.split("-");
        var Eyear= Edate[2];
        var Emonth= Edate[1];
        var Eday= Edate[0];
        var EYMDDate = Eyear + "-" + Emonth + "-" + Eday;
        var newdates= new Date(EYMDDate);
        var EndDateStrToTime=newdates.getTime(); 
        if(EndDateStrToTime>=StartDateStrToTime)
        {}
        else
        {
           $("#date-to").val("");
        } 

    });

    $("#ServiceForm").validate({ 
        rules: {
            appointment_id: {
                required: false
            }
        },
        submitHandler: function () {
            $("#loading").show();
            $("#submit_member").attr("disabled","disabled");
            form.submit();
        }
    });

});';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 