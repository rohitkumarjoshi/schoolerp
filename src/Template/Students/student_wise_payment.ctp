<style type="text/css">
    th {
    font-weight: 700 !important;
}
hr {
  border: 1px solid !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label>Student Wise Payment</label>
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
                            'label' => false,'options'=>$StudentClasses,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('stream_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Specified Students</label>
                            <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#StudentDetails">Search Student</button>
                        </div>
                    </div>
                    <div  class="row">
                        <center>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </center>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <?= $this->Form->create('') ?>
                <div id="StudentDetails" class="modal fade hide_print" role="dialog">
                  <div class="modal-dialog" style="width: 75%;">
                    <div class="modal-content">
                      <div class="modal-body">
                        <?= $this->element('student_search') ?> 
                      </div>
                      <div class="modal-footer"> 
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                      </div>
                    </div>
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
                                    <h3>Student Wise Payment</h3>
                                </center>
                                <?php
                                foreach ($studentLedgers as $studentLedger) 
                                {
                                    ?>
                                    <table  class="table" style="width:100%;">
                                        <tr>
                                            <th align="left">Scholar No.</th><td><?= $studentLedger->student->scholar_no ?></td>
                                            <th align="left">Name</th><td><?= $studentLedger->student->name ?></td>
                                            <th align="left">Father's Name</th><td><?= $studentLedger->student->father_name ?></td>
                                        </tr>
                                        <tr>
                                                <th align="left">Class</th> <td><?= $studentLedger->student_class->name ?></td>
                                                <th align="left">Stream</th><td><?= @$studentLedger->stream->name ?></td>
                                                <th align="left">section</th><td><?= @$studentLedger->section->name ?></td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered" style="text-align: center !important;" id="ledger">
                                        <thead>
                                            <th style="text-align: center;">Receipt No.</th>
                                            <th style="text-align: center;">Receipt Date</th>
                                            <th style="text-align: center;">Fee Type</th>
                                            <th style="text-align: right;">Amount</th>
                                            <th style="text-align: right;">Concession</th>
                                            <th style="text-align: right;">Fine</th>
                                            <th style="text-align: right;">Total Amount</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $grand_total=0;
                                            if(!empty($studentLedger->student->enquiry_receipt))
                                            {
                                                $grand_total+=$studentLedger->student->enquiry_receipt->total_amount;
                                                ?>
                                                <tr>
                                                    <td><?= $studentLedger->student->enquiry_receipt->receipt_no ?></td>
                                                    <td><?= $studentLedger->student->enquiry_receipt->receipt_date ?></td>
                                                    <td>
                                                        <?php
                                                        if($studentLedger->student->enquiry_receipt->receipt_fee_category->fee_collection=='Individual')
                                                        {
                                                            echo $studentLedger->student->enquiry_receipt->fee_type_role->name;
                                                        }
                                                        else
                                                        {
                                                            echo $studentLedger->student->enquiry_receipt->receipt_fee_category->name;
                                                        }
                                                        ?>    
                                                    </td>
                                                    <td style="text-align: right;"><?= $studentLedger->student->enquiry_receipt->amount ?></td>
                                                    <td style="text-align: right;"><?= $studentLedger->student->enquiry_receipt->concession_amount ?></td>
                                                    <td style="text-align: right;"><?= $studentLedger->student->enquiry_receipt->fine_amount ?></td>
                                                    <td style="text-align: right;"><?= $studentLedger->student->enquiry_receipt->total_amount ?></td>
                                                </tr>
                                                <?php
                                            }
                                            foreach ($studentLedger->fee_receipts as $fee_receipt) 
                                            {
                                                $grand_total+=$fee_receipt->total_amount;
                                                ?>
                                                <tr>
                                                    <td><?= $fee_receipt->receipt_no ?></td>
                                                    <td><?= $fee_receipt->receipt_date ?></td>
                                                    <td>
                                                        <?php
                                                        if($fee_receipt->receipt_fee_category->fee_collection=='Individual')
                                                        {
                                                            echo $fee_receipt->fee_type_role->name;
                                                        }
                                                        else
                                                        {
                                                            echo $fee_receipt->receipt_fee_category->name;
                                                        }
                                                        ?>    
                                                    </td>
                                                    <td style="text-align: right;"><?= $fee_receipt->amount ?></td>
                                                    <td style="text-align: right;"><?= $fee_receipt->concession_amount ?></td>
                                                    <td style="text-align: right;"><?= $fee_receipt->fine_amount ?></td>
                                                    <td style="text-align: right;"><?= $fee_receipt->total_amount ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <th colspan="17" style="text-align: right;"><?= $grand_total ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr/>
                                <?php
                            }
                            ?>
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

<?= $this->element('selectpicker') ?> 
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
    $(document).on('keyup','input.student_search',function(){
        fetchData();
    });
    $(document).on('change','select.student_search',function(){
        fetchData();
    });
    function fetchData()
    {
       url = '".$this->Url->build(['action'=>'getStudentDataWise.json'])."';
        $.ajax({
            url: url,
            type: 'post',
            data: $('form').serialize(),
            contentType: 'application/x-www-form-urlencoded',
            success: function(result)
            {
                var obj = JSON.parse(JSON.stringify(result));
                $('#replace_data').html(obj.response);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
               $('#replace_data').html(textStatus);
            }
        }); 
    }
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>