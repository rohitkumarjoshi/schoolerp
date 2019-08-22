<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
    .checkbox{
        display: inline-table;
    }
</style>
<?php $student_id = $EncryptingDecrypting->encryptData($students->id); ?> 
<?php $student_info_id = $EncryptingDecrypting->encryptData($studentInfos->id); ?> 
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
             <div class="box-header with-border" >
                <h3 class="box-title" >Fee Deposition Details</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
            <?= $this->Form->create($feeReceipt,['class'=>'FormSubmit','id'=>'ServiceForm']) ?>
                <?= $this->element('student_information') ?>
                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                    <?php
                         $fee_name=(!empty($fee_type_role_id))?'Old '.@$FeeData->fee_type_role->name:'Old '.$FeeData->fee_category->name;
                         if(!empty($fee_type_role_id))
                         {
                           echo $this->Form->hidden('fee_type_role_id',['value'=>$fee_type_role_id,'type'=>'text']);
                         }
                        echo"<tr> <th>".$fee_name."</th>";
                        echo"</tr>";
                        echo"<tr>";
                        
                            $totSubmitted = @$value->fee_receipt_rows[0]->total_amount;
                            $feeAmount=@$FeeData->due_amount;
                            $lableAmount=@$FeeData->due_amount;
                            $feeAmount=$feeAmount-@$SubmittedFee[0]->total_submit_amount;
                            echo "
                                <td style='text-align:left !important'><lable >".$lableAmount."</lable>".
                                $this->Form->control('amount_row',[
                                    'label' => false,
                                    'class'=>'form-control input-small amountValid',
                                    'placeholder'=>'Amount',
                                    'type'=>'text',
                                    'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",
                                    'row'=>'1',
                                    'value'=>$feeAmount,
                                    'actualAmount'=>$feeAmount
                                ])."</td>";   
                      
                        echo"</tr>";
                    
                    ?>
                    </thead> 
                </table>
                <?= $this->element('payment_calculation') ?>       
                <?= $this->element('payment_detail') ?>        
                <div align="center" class="">    
                <?php echo $this->Form->button('Save',['class'=>'btn btn-info submit_fee','type'=>'submit', 'value'=>'save', 'name'=>'save']); ?>
                <?php echo $this->Form->button('Save & Print',['class'=>'btn btn-info submit_fee','type'=>'submit', 'value'=>'print', 'name'=>'save']); ?>
                
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#FeeDetails">Show Previous Detail</button>
                </div>
            <?= $this->Form->end() ?>             
            </div>
        </div>
    </div>
</div>
<div id="FeeDetails" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Old Fee Receipt</h4>
      </div>
      <div class="modal-body">
         <table class="table table-bordered" id="tab">
            <thead>
                <tr>
                    <th>Recipt No.</th> 
                    <th>Date of Payment</th>
                    <th>Amount Paid</th>
                    <th>Concession</th>
                    <th>Fine</th>
                    <th>Fee Type</th>
                    <th>Remarks</th> 
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($feeReceiptAmounts as $feeReceiptAmount) {
                    $receipt_id=$EncryptingDecrypting->encryptData($feeReceiptAmount->id);
                    $old_fee_id=$EncryptingDecrypting->encryptData($feeReceiptAmount->old_fee_id);
                    ?>
                    <tr>
                        <td><?= $feeReceiptAmount->receipt_no ;?></td>
                        <td><?= $feeReceiptAmount->receipt_date ;?></td>
                        <td><?= $feeReceiptAmount->total_amount ;?></td>
                        <td><?= $feeReceiptAmount->concession_amount ;?></td>
                        <td><?= $feeReceiptAmount->fine_amount ;?></td>
                        <td><?= $fee_name ?></td>
                        <td><?= $feeReceiptAmount->remark ;?></td>
                        <td> 
                            <?= $this->Html->link('<i class="fa fa-print"></i>',['controller'=>'FeeReceipts','action'=>'receiptPrint','FeeReceipts','oldFee',$receipt_id,$student_info_id,$old_fee_id],['escape'=>false,'class'=>'btn btn-primary btn-xs']) ?>
                            <a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $feeReceiptAmount->id; ?>" data-toggle=modal><i class="fa fa-trash-o "></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
              
            </tbody>
        </table>
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
foreach ($feeReceiptAmounts as $feeReceiptAmount) 
{ 
    $receipt_id=$EncryptingDecrypting->encryptData($feeReceiptAmount->id);
    $old_fee_id=$EncryptingDecrypting->encryptData($feeReceiptAmount->old_fee_id);
    ?>
<div id="deletemodal<?php echo $feeReceiptAmount->id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <?= $this->Form->create('from',['url'=>['action'=>'delete','oldFee',$receipt_id,$student_info_id,$old_fee_id]]) ?>
            <div class="modal-content">
              <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                    Are you sure you want to delete this Receipt?
                    
                    </h4>
                </div>

                <div class="modal-body">
                   <?= $this->Form->control('delete_date', ['type' => 'taxt','class'=>'form-control datepicker  input-small','placeholder'=>'Delete Date','required'=>true,'data-date-format'=>'dd-mm-yyyy'])?>
                   <?= $this->Form->control('remark', ['type' => 'taxt','class'=>'form-control input-small','placeholder'=>'Remarks','required'=>true])?>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn  btn-sm btn-info">Yes</button>
                    <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
         
        <?= $this->Form->end() ?>
    </div>
</div> 
<?php
}?>
<?= $this->element('icheck') ?>
<?= $this->element('validate') ?> 
<?php  
$js="
 $(document).ready(function(){
 
    calcuteAmounts(); 
    $('#ServiceForm').validate({ 
        submitHandler: function () {
            var inputtes = $('.GrossAmount').val();
            if(inputtes != 0 ){
                $('#loading').show();
                $('.submit_fee').attr('disabled','disabled');
                form.submit();
            }
            else
            {
                alert('Invalid Amount');
                return false; 
            }
        }
    });
    $(document).on('keyup', '.amountValid', function(){
        var actualAmount=parseInt($(this).attr('actualAmount'));
        var inputted = parseInt($(this).val());
        var total = 0; 
        if( (inputted > actualAmount) || (inputted < 1) || ($(this).val().length == 0)){
            alert('Invalid Amount'); 
            $(this).val(actualAmount);
            calcuteAmounts();
        }
        else{
           calcuteAmounts(); 
        }
    });

    function calcuteAmounts(){
        var total = 0;
        $('.amountValid').each(function(){
                var amount = parseInt($(this).val());
                total=parseInt(total)+amount;
        });
        $('.GrossAmount').val(total); 
        $('.totalFee').val(total);
        $('.concessionAmount').trigger('keyup');       
    }      
});
    
";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>