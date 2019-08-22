<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Student Ledger </label>
            </div>
            <div class="box-body">
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="form-group hide_print">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'required'=>true,'placeholder'=>'Date range']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php
                            $checked='';
                            if(empty(@$fee_collection))
                            {
                                $checked="checked";
                            }
                            echo $this->Form->radio(
                            'fee_collection',
                            [
                                ['value' => 'allstudent', 'text' => ' All Students'],
                                ['value' => 'paid', 'text' => ' Only those who have paid fees', $checked],
                            ],
                            ['class'=>'fee_collection']
                            ); ?>
                        </div>
                        
                    </div>
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
                        
                    </div>
                    <div  class="row">
                        <center>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </center>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <?php
                if(!empty($studentLedgers))
                { ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <h3>Student Ledger Report</h3>
                                    <h4><?= date('d-M-Y',strtotime($date_from)) ?> to <?= date('d-M-Y',strtotime($date_to)) ?></h4>
                                </center>
                                <table class="table table-bordered" style="text-align: center !important;" id="ledger">
                                    <thead>
                                        <th>Name</th>
                                        <th>Scholar No.</th>
                                        <th>Medium</th>
                                        <th>Class</th>
                                        <th>Stream</th>
                                        <?php
                                        foreach ($feeMonths as $key => $feeMonthName) {
                                            ?>
                                            <th><?= $feeMonthName ?></th>
                                            <?php
                                        }
                                        ?>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $overall_total=0;
                                        foreach ($studentLedgers as $studentLedger) {
                                            $grand_total=0;
                                            ?>
                                            <tr>
                                                <td style="text-align: left;"><?= $studentLedger->student->name ?></td>
                                                <td><?= $studentLedger->student->scholar_no ?></td>
                                                <td><?= $studentLedger->medium->name ?></td>
                                                <td><?= $studentLedger->student_class->name ?></td>
                                                <td><?= @$studentLedger->stream->name ?></td>
                                                <?php
                                                if(!empty($studentLedger->month))
                                                {
                                                     $amount=$studentLedger->total_amount;
                                                     $month_key=$studentLedger->month;
                                                }
                                                foreach ($feeMonths as $key => $feeMonthName) {
                                                    if(!empty($studentLedger->fee_receipts))
                                                    { 
                                                        $data='';
                                                        foreach ($studentLedger->fee_receipts as $fee_receipt) 
                                                        {
                                                            if($fee_receipt->month==$key)
                                                            {
                                                                $total_amount=$fee_receipt->total_amount;
                                                                if($key==$studentLedger->month)
                                                                {
                                                                    $total_amount+=$studentLedger->total_amount;
                                                                }
                                                                ?><td><?= ($total_amount > 0)?$total_amount:'-' ?></td><?php
                                                                $data='exist';
                                                                $grand_total+=$total_amount;
                                                            }
                                                            else if($studentLedger->month==$key)
                                                            {
                                                                ?><td><?= ($studentLedger->total_amount > 0)?$studentLedger->total_amount:'-' ?></td><?php
                                                                $data='exist';
                                                                $grand_total+=$studentLedger->total_amount;
                                                            }
                                                        }
                                                        if($data != 'exist')
                                                        {
                                                            if($studentLedger->month==$key)
                                                            {
                                                                ?><td><?= ($studentLedger->total_amount > 0)?$studentLedger->total_amount:'-' ?></td><?php
                                                                $data='exist';
                                                                $grand_total+=$studentLedger->total_amount;
                                                            } 
                                                            else{
                                                                ?><td>-</td><?php
                                                            } 
                                                            
                                                        }
                                                    }
                                                    else
                                                    {
                                                        ?><td>-</td><?php
                                                    }
                                                    
                                                }
                                                ?><td><?= $grand_total ?>
                                                <?php $overall_total+=$grand_total; ?>
                                                    <?= $this->Form->hidden('grand_total',['value'=>$grand_total,'class'=>'grand_total']) ?>
                                                </td><?php
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="18" style="text-align: right;"><?= $overall_total ?></th>
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
<?= $this->element('daterangepicker') ?>
<?= $this->element('icheck') ?>
<?php
$js="
$(document).ready(function(){
    var grand_total=0;";
    if(@$fee_collection=='paid')
    {
        $js.="$('input.grand_total').each(function(){
            grand_total=$(this).val();
            if(grand_total==0)
            {
                $(this).closest('tr').remove();
            }
        });";
    }

    
    $js.="
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