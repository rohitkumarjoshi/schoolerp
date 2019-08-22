    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                        <i class="fa fa-gift fas" style="float:none !important;"></i> <label> <legend><?= __('Add Hostel Attendance') ?></legend> </label>
                </div><hr>
                <div class="box-body">
                    <div class="form-group">
                        <?= $this->Form->create($hostelAttendance) ?>
                        <div class="row  ">
                                <div class="col-md-4 ">
                                     <label> Select Date</label>

                                     <?= $this->Form->control('date_from', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy']) ?>
                                </div>
                            </div>
                           <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Student</th>
                                    <th> Attendence</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php 
                                $i=1;foreach ($hostelAttendances as $hostelAttendance): ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $hostelAttendance->student->name ?></td>
                                    <td> 
                                        <label class="radio-inline" >
                                            <input type="radio" id="inward_in" value="In" name="inward_status" checked > Present
                                        </label>
                                        <label class="radio-inline" >
                                             <input type="radio" id="inward_out" value="Out" name="inward_status"  > Absent 
                                        </label> 
                                        <label class="radio-inline" >
                                             <input type="radio" id="inward_out" value="Out" name="inward_status"  > Leave 
                                        </label>
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
<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
        $('#ServiceForm').validate({ 
        rules: {
            vehicle_id: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
        });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
