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
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <h3>Attendance Summary Report</h3>
                                    </center>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="sample_2" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Medium</th>
                                                <th>Class</th>
                                                <th>Sections</th>
                                                <th>Present</th>
                                                <th>Absent</th>
                                                <th>Total</th>
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
                                                        <td><?= @$attendance->first_half ?></td>
                                                        <td><?= @$attendance->student_info->medium->name ?></td>
                                                        <td><?= @$attendance->student_info->medium->name ?></td>
                                                        
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
