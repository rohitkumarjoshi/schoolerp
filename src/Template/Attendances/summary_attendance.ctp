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
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="form-group hide_print">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label"> Date Range</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'required'=>true,'placeholder'=>'Date range']) ?>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <div  class="row">
                        <center>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </center>
                    </div>
                </div>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <h3>Attendance Summary Report of <?= date('d-m-Y',strtotime($date_from))." To ".date('d-m-Y',strtotime($date_to)) ?></h3>
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
                                                        <td><?= @$attendance->total_student.'/'.sum() ?></td>
                                                         
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
<?= $this->element('data_table') ?>
<?= $this->element('icheck') ?>
