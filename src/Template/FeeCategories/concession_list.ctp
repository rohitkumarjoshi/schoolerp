<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Concession List </label>
                
                <label >Student Ledger </label>
                <div class="action pull-right">
                    <?php 
                    if(empty($medium_id))
                        $medium_id="-";
                    if(empty($student_class_id))
                         $student_class_id="-";
                    if(empty($stream_id))
                         $stream_id="-"; 
                    if(empty($fee_type_role_id))
                         $fee_type_role_id="-"; 
                     if(empty($stream_id))
                         $stream_id="-";
                     if(empty($fee_category_id))
                         $fee_category_id="-"; 
                     if(empty($daterange))
                         $daterange="-"; 

                    ?>
                    <?php echo $this->Html->link('Excel',['controller'=>'FeeCategories','action' => 'exportConcessionListReport',@$medium_id,@$student_class_id,@$stream_id,@$fee_type_role_id,@$fee_category_id,@$daterange],['target'=>'_blank']); ?>
                </div>
            </div>
            <div class="box-body">
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="form-group hide_print">
                    <div class="row">
                        <div class="col-md-3">
                                <label class="control-label"> Medium</label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class</label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('stream_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Date Range <span class="required" aria-required="true"> * </span></label>
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
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label"> Check All </label>
                            <?php echo $this->Form->control('', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>'Check All','class'=>'check_all']);?>
                        </div>
                        <?php $individual='';
                        foreach ($feeCategories as $feeCategory) {
                            if($feeCategory->fee_collection=='Individual')
                            {
                                foreach ($feeTypeRoles as $feeTypeRole) {
                                    ?>
                                    <div class="col-md-2">
                                        <label class="control-label"> <?= $feeTypeRole->name ?> </label>
                                        <?php echo $this->Form->control('fee_type_role_id[]', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>$feeTypeRole->id,'class'=>'checkone']);?>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                 ?>
                                <div class="col-md-2">
                                    <label class="control-label"> <?= $feeCategory->name;?> </label>
                                    <?php echo $this->Form->control('fee_category_id[]', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>$feeCategory->id,'class'=>'checkone']);?>
                                </div>
                                <?php
                            }
                        }
                        ?> 
                    </div>
                    <div  class="row">
                        <center>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </center>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <?php
                if(!empty($dailyCollection))
                { ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <h3>Concession List</h3>
                                    <h4><?= date('d-M-Y',strtotime($date_from)) ?> to <?= date('d-M-Y',strtotime($date_to)) ?></h4>
                                </center>
                                <table class="table table-bordered" style="text-align: center !important;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center !important;">Sr. No.</th>
                                            <th style="text-align: center !important;">Scholar No.</th>
                                            <th>Name</th>
                                            <th>Father's Name</th>
                                            <th style="text-align: center !important;">Date</th>
                                            <th style="text-align: left !important;">Concession Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                        $overall_gross_amount=0;
                                        $sr_no=0;
                                        
                                        foreach ($dailyCollection as $class_id => $classArray) 
                                        {
                                            foreach ($studentClasses as $studentClass_id => $studentClass_name) {
                                                if($studentClass_id==$class_id)
                                                {
                                                    $class_name=$studentClass_name;
                                                }
                                            }
                                            
                                            $rep=0;
                                            $gross_amount=0;
                                            foreach ($classArray as $key => $value)
                                            {
                                                if(empty(@$value['scholar_no']))
                                                {
                                                    ?>
                                                    <tr><th colspan="6">Class: <?= $class_name ?> Stream: <?= $key ?></th></tr>
                                                    <?php
                                                    $gross_amount=0;
                                                    foreach ($value as $key1 => $value1) 
                                                    {
                                                        $gross_amount+=$value1['concession_amount'];
                                                        ?>
                                                        <tr>
                                                            <td><?= ++$sr_no ?></td>
                                                            <td><?= $value1['scholar_no'] ?></td>
                                                            <td><?= $value1['name'] ?></td>
                                                            <td><?= $value1['father_name'] ?></td>
                                                            <td><?= $value1['date'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['concession_amount'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    $overall_gross_amount+=$gross_amount;
                                                    ?>
                                                    <tr><th colspan="5" style="text-align: right;">Total </th><th style="text-align: right;"><?= $gross_amount ?></th>
                                                    <?php
                                                }
                                                else
                                                { 
                                                    $gross_amount+=$value['concession_amount'];
                                                    if($rep==0)
                                                    {
                                                        ?>
                                                        <tr><th colspan="6">Class: <?= $class_name ?></th></tr>
                                                        <?php
                                                        $rep++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?= ++$sr_no ?></td>
                                                        <td><?= $value['scholar_no'] ?></td>
                                                        <td><?= $value['name'] ?></td>
                                                        <td><?= $value['father_name'] ?></td>
                                                        <td><?= $value['date'] ?></td>
                                                        <td style="text-align: right;"><?= $value['concession_amount'] ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            if($rep > 0)
                                            {
                                                $overall_gross_amount+=$gross_amount;
                                                ?>
                                                <tr><th colspan="5" style="text-align: right;">Total </th><th style="text-align: right;"><?= $gross_amount ?></th></tr>
                                                <?php
                                            }
                                            
                                        }
                                        
                                        ?>
                                        
                                    </tbody>
                                    <tfoot>
                                            <tr>
                                                <th colspan="5" style="text-align: right;">Total Gross Amount </th><th style="text-align: right;"><?= $overall_gross_amount ?></th>
                                        </tr>
                                    </tfoot> 
                                </table>
                            </div>
                        </div>
                    </div>
                   
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('validate') ?> 
<?= $this->element('daterangepicker') ?>
<?= $this->element('icheck') ?>
<?php
$js="
$(document).ready(function(){
    $('#ServiceForm').validate({ 
        rules: {
            'fee_category_id[]': {
              required: true,
              minlength: 1
          }
        }
    });
    $(document).on('ifChanged', '.check_all', function(){
        if($(this).is(':checked')){
            $('.checkone').each(function(){
                $(this).attr('checked',true).iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });
                $(this).closest('div').addClass('checked');
            });
        }
        else
        {
            $('.checkone').each(function(){
                $(this).attr('checked',false).iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });
            });
        }
    });
    $(document).on('change', '#medium_id', function(e){
        var medium_id = $(this).val();
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getClass.json'])."';
        $.post(
            url, 
            {medium_id: medium_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#student_class_id').html(obj.response);
        });
    });
    $(document).on('change', '#student_class_id', function(e){
        var student_class_id = $(this).val();
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getStream.json'])."';
        $.post(
            url, 
            {student_class_id: student_class_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#stream_id').html(obj.response);
        });
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>