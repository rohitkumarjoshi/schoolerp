<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Attendance List </label>
            </div>
            <div class="box-body">
               <?= $this->Form->create('attendance') ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                                <label class="control-label"> Medium</label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class</label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control class','empty'=>'---Select Class---','id'=>'student_class_id','options'=>$classes]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Section</label>
                            <?php echo $this->Form->control('section_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Section---','options'=>$sections,'id'=>'section_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Month</label>
                            <?php 
                            $months=[];
                            $months[]=['text'=>'January','value'=>1];
                            $months[]=['text'=>'February','value'=>2];
                            $months[]=['text'=>'March','value'=>3];
                            $months[]=['text'=>'April','value'=>4];
                            $months[]=['text'=>'May','value'=>5];
                            $months[]=['text'=>'June','value'=>6];
                            $months[]=['text'=>'July','value'=>7];
                            $months[]=['text'=>'August','value'=>8];
                            $months[]=['text'=>'September','value'=>9];
                            $months[]=['text'=>'October','value'=>10];
                            $months[]=['text'=>'November','value'=>11];
                            $months[]=['text'=>'December','value'=>12];
                            ?>
                            <?php echo $this->Form->control('student_months',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Section---','options'=>$months,'id'=>'section_id']);?>
                           
                        </div>
                    </div>
                    <div  class="row">
                        <center>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </center>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <?php if(!empty($attendances)) {?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <h3>Attendance List Report</h3>
                                    </center>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="sample_2" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Scholar No.</th>
                                                <th>Name</th>
                                                <th>Father's Name</th>
                                                <th>Medium</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                 <?php 
                                                        $i=1;
                                                        foreach (@$attendances as $attendance) {?>
                                                <tr>
                                                   

                                                        <td><?= $i;$i++; ?></td>
                                                        <td><?= @$attendance->student_info->student->scholar_no?></td>
                                                        <td><?= @$attendance->student_info->student->name ?></td>
                                                        <td><?= @$attendance->student_info->student->father_name ?></td>
                                                        <td><?= @$attendance->student_info->medium->name ?></td>
                                                        <td><?= @$attendance->student_info->student_class->name ?></td>
                                                        <td><?= @$attendance->student_info->section->name ?></td>
                                                </tr>

                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>
</div>
 <?= $this->element('daterangepicker') ?>
<?= $this->element('data_table') ?>
<?= $this->element('icheck') ?>
