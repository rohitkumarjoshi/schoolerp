<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="10">Payment Details</th>        
        </tr>
        <tr>
            <td>Payment Mode</td>        
            <td>Cheque No.</td>        
            <td>Cheque Date</td>        
            <td>Bank</td>        
            <td>Transaction No</td>  
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td>
                <?php $option['Cash']='Cash';?>
                <?php $option['Cheque']='Cheque';?>
                <?php $option['IMPS']='IMPS';?>
                <?php $option['RTGS']='RTGS';?>
                <?php $option['Online']='Online';?>
                <?php $option['Others']='Others';?>
                <?= $this->Form->control('payment_type', ['label'=>false,'class'=>'form-control input-small paymentMethod','placeholder'=>'Cheque No.','options'=>$option])?>
            </td>
            <td>
                <?= $this->Form->control('cheque_no', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small notApplicable','placeholder'=>'Cheque No.','disabled'])?>
            </td>
            <td>
                <?= $this->Form->control('cheque_date', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small notApplicable datepicker','placeholder'=>'Cheque Date','disabled','data-date-format'=>'dd-mm-yyyy'])?>
            </td>
            <td>
                <?= $this->Form->control('bank', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small notApplicable','placeholder'=>'Bank Name','disabled'])?>
            </td> 
            <td>
                <?= $this->Form->control('transaction_no', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small TrnotApplicable','placeholder'=>'Transaction No.','disabled'])?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $this->Form->control('receipt_date', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small datepicker','placeholder'=>'Receipt Date','data-date-format'=>'dd-mm-yyyy','value'=>date('d-m-Y')])?>
            </td>
            <td colspan="4">
                <?= $this->Form->control('remark', ['type' => 'taxt','label'=>false,'class'=>'form-control','placeholder'=>'Remarks'])?>
            </td>
        </tr>
    </tbody>
</table> 
<?php
echo $this->element('datepicker');
$js="
 $(document).ready(function(){
    $('form').attr('autocomplete','on');
    $('input').attr('autocomplete','on');
    $(document).on('change', '.paymentMethod', function(){
        var paymentMethod = $(this,'option:selected').val();
        var now = $(this);
        if(paymentMethod == 'Cash'){
            now.closest('tr').find('input.notApplicable').attr('disabled','disabled');
            now.closest('tr').find('input.TrnotApplicable').attr('disabled','disabled');
        }
        else if(paymentMethod=='Cheque'){
            now.closest('tr').find('input.notApplicable').removeAttr('disabled');
        }
        else{
            now.closest('tr').find('input.TrnotApplicable').removeAttr('disabled');
            now.closest('tr').find('input.notApplicable').attr('disabled','disabled');
        }
    });
    
});

";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>