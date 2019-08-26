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
                                        <table class="table table-bordered" id="sample_2" width="100%">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">Sr. No.</th>
                                                <th rowspan="2">Medium</th>
                                                <th rowspan="2">Class</th>
                                                <th rowspan="2">Sections</th>
                                                <th colspan="2">Morning</th>
                                                <th colspan="2">Evening</th>
                                                <th colspan="2">Total</th>
                                            </tr>
                                            <tr>
                                                <th>P</th>
                                                <th>A</th>
                                                <th>P</th>
                                                <th>A</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                 <?php 
                                                        $i=1;
                                                        foreach (@$attendances as $attendance) {?>
                                                <tr>
                                                   

                                                        <td><?= $i;$i++; ?></td>
                                                        <td><?= @$attendance->student_info->medium->name ?></td>
                                                        <td><?= @$attendance->student_info->student_class->name ?></td>
                                                        <td><?= @$attendance->student_info->section->name ?></td>
                                                        <td><?= @$attendance->morning_p ?></td>
                                                        <td><?= @$attendance->morning_a ?></td>
                                                        <td><?= @$attendance->evening_p ?></td>
                                                        <td><?= @$attendance->evening_a ?></td>
                                                        <td><?= @$attendance->total_student ?></td>
                                                         
                                                </tr>

                                                    <?php } ?>
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
