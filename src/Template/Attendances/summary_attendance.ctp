<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Attendance Summary</label>
            </div>
            <div class="box-body">
                <?= $this->Form->create('',['id'=>'AttendanceForm']) ?>
                <div class="form-group hide_print">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('date',[
                                    'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required']);?>
                        </div>
                        <div  class="col-md-3" style="margin-top: 24px!important;">
                            <center>
                                <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                            </center>
                        </div>
                        
                    </div>
                </div>
                <?= $this->Form->end() ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <h3>Attendance Summary Report of <?= date('d-m-Y',strtotime($date)) ?></h3>
                                    </center>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="" width="100%">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">Sr. No.</th>
                                                <th rowspan="2">Teacher</th>
                                                <th rowspan="2">Class</th>
                                                <th rowspan="2">Sections</th>
                                                <th rowspan="2">Total</th>
                                                <th colspan="2" style="text-align: center;">Morning</th>
                                                <th colspan="2" style="text-align: center;">Evening</th>
                                            </tr>
                                            <tr>
                                                <th>Present</th>
                                                <th>Absent</th>
                                                <th>Present</th>
                                                <th>Absent</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                 <?php 
                                                        $i=1;
                                                        foreach (@$attendances as $attendance) {?>
                                                <tr>
                                                   

                                                        <td><?= $i;$i++; ?></td>
                                                        <td><?= @$attendance->class_mapping->employee->name ?></td>
                                                        <td><?= @$attendance->student_info->student_class->name ?></td>
                                                        <td><?= @$attendance->student_info->section->name ?></td>
                                                        <td><?= @$attendance->total_student ?></td>
                                                        <td><?= @$attendance->morning_p ?></td>
                                                        <td><?= @$attendance->morning_a + $attendance->morning_a_1?></td>
                                                        <td><?= @$attendance->evening_p ?></td>
                                                        <td><?= @$attendance->evening_a + $attendance->evening_a_1 ?></td>
                                                        <?php 

                                                            @$mr_pre=$attendance->morning_p;
                                                            @$mr_abs=$attendance->morning_a + $attendance->morning_a_1;
                                                            @$eve_pre=$attendance->evening_p;
                                                            @$eve_abs=$attendance->evening_a + $attendance->evening_a_1;

                                                            @$grand_total+=$attendance->total_student;?>
                                                        <?php @$total_present+=$mr_pre;?>
                                                        <?php @$total_absent+=$mr_abs;?>
                                                        <?php @$evening_present+=$eve_pre;?>
                                                        <?php @$evening_absent+=$eve_abs;?>
                                                         
                                                </tr>

                                                    <?php } ?>
                                                <tr>
                                                    <th colspan="4" style="text-align: center;">Total</th>
                                                    <th><?= $grand_total ?></th>
                                                    <th><?= $total_present ?></th>
                                                    <th><?= $total_absent ?></th>
                                                    <th><?= $evening_present?></th>
                                                    <th><?= $evening_absent?></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
 <?= $this->element('daterangepicker') ?>
<?= $this->element('datepicker') ?> 
<?= $this->element('data_table') ?>
<?= $this->element('icheck') ?>
