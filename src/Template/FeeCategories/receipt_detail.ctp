<style type="text/css">
th {
    font-weight: 700 !important;
}
.checkbox{
    display: inline-block !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Receipt Detail </label>
            </div>
            <div class="box-body">
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="form-group hide_print">
                    <div class="row">
                        <div class="col-md-3">
                                <label class="control-label"> Medium <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('stream_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Date Range</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'required'=>true,'placeholder'=>'Date range','value'=>date('d-m-Y').'/'.date('d-m-Y')]) ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php $option1['Check All']='Check All';?>
                                <?= $this->Form->select('',$option1, ['multiple' => 'checkbox','class'=>'check_all']); ?>
                                <?php $option['Cash']='Cash';?>
                                <?php $option['Cheque']='Cheque';?>
                                <?php $option['IMPS']='IMPS';?>
                                <?php $option['RTGS']='RTGS';?>
                                <?php $option['Online']='Online';?>
                                <?php $option['Others']='Others';?>
                                <?= $this->Form->select('payment_type',$option, ['class'=>'checkone','multiple' => 'checkbox']); ?>
                            </div>
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
                if(!empty($dailyCollection))
                { ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <h3>Receipt Detail</h3>
                                    <h4><?= date('d-M-Y',strtotime($date_from)) ?> to <?= date('d-M-Y',strtotime($date_to)) ?></h4>
                                </center>
                                
                                            
                                <?php
                                
                                
                                     $cash_amount=$cheque_amount=$imps_amount=$rtgs_amount=$online_amount=$others_amount=0;
                                    foreach ($dailyCollection as $key2 => $value2)
                                    {
                                        $sr_no=0;
                                        $total_amount=$amount=$concession_amount=$fine_amount=0;
                                   
                                        ?>
                                        <div class="table-responsive">
                                            <center><h3><?= $key2 ?></h3></center>
                                            <table class="table table-bordered" style="text-align: center !important;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center !important;">Sr. No.</th>
                                                        <th style="text-align: center !important;">Receipt No.</th>
                                                        <th style="text-align: center !important;">Scholar No.</th>
                                                        <th>Name</th>
                                                        <th>Father's Name</th>
                                                        <th>Class</th>
                                                        <th style="text-align: center !important;">Date</th>
                                                        <th style="text-align: left !important;">Amount</th>
                                                        <th style="text-align: left !important;">Concession Amount</th>
                                                        <th style="text-align: left !important;">Fine Amount</th>
                                                        <th style="text-align: left !important;">Total Amount</th>
                                                        <th>Fee Type</th>
                                                        <th>Pay Mode</th>
                                                        <th>Bank Name</th>
                                                        <th>Cheque/Transaction No.</th>
                                                        <th>Cheque Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($value2 as $key => $value)
                                                {
                                                    foreach ($value as $key1 => $value1) 
                                                    {
                                                        $amount+=$value1['amount'];
                                                        $concession_amount+=$value1['concession_amount'];
                                                        $fine_amount+=$value1['fine_amount'];
                                                        $total_amount+=$value1['total_amount'];
                                                        if($value1['pay_mode']=='Cash')
                                                        {
                                                            $cash_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='Cheque')
                                                        {
                                                            $cheque_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='IMPS')
                                                        {
                                                            $imps_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='RTGS')
                                                        {
                                                            $rtgs_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='Online')
                                                        {
                                                            $online_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='Others')
                                                        {
                                                            $others_amount+=$value1['total_amount'];
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?= ++$sr_no ?></td>
                                                            <td><?= $value1['receipt_no'] ?></td>
                                                            <td><?= $value1['scholar_no'] ?></td>
                                                            <td><?= $value1['name'] ?></td>
                                                            <td><?= $value1['father_name'] ?></td>
                                                            <td><?= $value1['class'] ?>
                                                                <?php
                                                                if(!empty($value1['stream']))
                                                                {
                                                                    echo '-'.$value1['stream'];
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?= $value1['date'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['amount'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['concession_amount'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['fine_amount'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['total_amount'] ?></td>
                                                            <td><?= $value1['fee_type'] ?></td>
                                                            <td><?= $value1['pay_mode'] ?></td>
                                                            <td><?= $value1['bank'] ?></td>
                                                            <td><?= $value1['cheque_no'].''.$value1['transaction_no'] ?></td>
                                                            <td><?= $value1['cheque_date'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                   
                                                }
                                                ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="text-align: right;">Total Gross Amount </th>
                                                        <th style="text-align: right;"><?= $amount ?></th>
                                                        <th style="text-align: right;"><?= $concession_amount ?></th>
                                                        <th style="text-align: right;"><?= $fine_amount ?></th>
                                                        <th style="text-align: right;"><?= $total_amount ?></th>
                                                        <th colspan="5"></th>
                                                    </tr>
                                                </tfoot> 
                                            </table>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                
                                        
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="text-align: center !important;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center !important;">Cash Amount</th>
                                                <th style="text-align: center !important;">Cheque Amount</th>
                                                <th style="text-align: center !important;">IMPS Amount</th>
                                                <th style="text-align: center !important;">RTGS Amount</th>
                                                <th style="text-align: center !important;">Online Amount</th>
                                                <th style="text-align: center !important;">Others Amount</th>
                                                <th style="text-align: center !important;">Expenses Amount</th>
                                                <th style="text-align: center !important;">Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <th style="text-align: center !important;"><?= $cash_amount ?></th>
                                            <th style="text-align: center !important;"><?= $cheque_amount ?></th>
                                            <th style="text-align: center !important;"><?= $imps_amount ?></th>
                                            <th style="text-align: center !important;"><?= $rtgs_amount ?></th>
                                            <th style="text-align: center !important;"><?= $online_amount ?></th>
                                            <th style="text-align: center !important;"><?= $others_amount ?></th>
                                            <th style="text-align: center !important;"><?= @$expenses->toArray()[0]->total_amount; ?></th>
                                            <th style="text-align: center !important;"><?= $cash_amount-$expenses->toArray()[0]->total_amount; ?></th>
                                        </tbody>
                                    </table>
                                </div>
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
            'payment_type[]': {
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