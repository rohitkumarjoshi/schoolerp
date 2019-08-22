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
                  <?= $this->Html->link('Student Edit',['controller'=>'Students','action'=>'editStudent',$student_id,'FeeReceipts','adhocFee'],['class'=>'btn btn-warning','style'=>'color:#FFF !important;']) ?>
                </div>
            </div>
            <div class="box-body">
            <?= $this->Form->create($feeReceipt,['class'=>'FormSubmit','id'=>'ServiceForm']) ?>
                <?= $this->Form->control('fee_category_id',['label' => false,'type'=>'hidden','value'=>5])?>
                 <?= $this->element('student_information') ?>
                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                        <?php
                        $x=0;
                        foreach ($FeeData as $FeeDatas) {
                            echo"<th>".$this->Form->control('fee_type_master_rows['.$x.'][fee_type_master_row_id]', ['type' => 'checkbox','label'=>false,'class'=>'checkDisable','uncheck'=>'removeDisable'.$FeeDatas->id,'value'=>$FeeDatas->fee_type_master_rows[0]->id]).' '.$FeeDatas->fee_type->name."</th>";
                            $x++;
                        }
                        echo"</tr>";
                        ?>
                    </thead>
                    <tbody>
                        <tr> 
                        <?php
                        $x=0;
                        $totalAmount = 0;
                        $SubmittedAmount = 0;
                          foreach ($FeeData as $FeeDatas) {
                            $totSubmitted = @$FeeDatas->fee_type_master_rows[0]->fee_receipt_rows[0]->total_amount;
                            $SubmittedAmount+=$totSubmitted;
                            $feeAmount=@$FeeDatas->fee_type_master_rows[0]->amount;
                            $FeeAmount=$feeAmount-$totSubmitted;
                            
                            echo "
                                <td style='text-align:left !important'><lable >".$feeAmount."</lable>".
                                $this->Form->control('fee_type_master_rows['.$x.'][amount]',[
                                    'label' => false,
                                    'class'=>'form-control input-small amountValid removeDisable'.$FeeDatas->id,
                                    'placeholder'=>'Amount',
                                    'type'=>'text',
                                    'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",
                                    'row'=>'1',
                                    'value'=>$FeeAmount,
                                    'actualAmount'=>$FeeAmount,
                                    'disabled'=>'disabled',
                                ])."</td>";
                            $totalAmount+=$FeeDatas->fee_type_master_rows[0]->amount;
                            $x++;
                        }
                        $totalAmount=$totalAmount-$SubmittedAmount;
                        echo"</tr>";
                        ?>
                    </tbody>
                </table>
                <?= $this->element('payment_calculation') ?>       
                <?= $this->element('payment_detail') ?>        
                <div align="center" class="">
                <?php $id = $EncryptingDecrypting->encryptData($id)?>    
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
        <h4 class="modal-title">Adhoc Fee Receipt</h4>
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
                foreach ($SubmittedFee as $Submittedlist) {
                    $FeeName=[];
                    foreach ($Submittedlist->fee_receipt_rows as $key => $value) { 
                        $FeeName[]=$value->fee_type_master_row->fee_type_master->fee_type->name;
                    } 
                    $Fees = implode(', <br>', $FeeName);
                    $receipt_id=$EncryptingDecrypting->encryptData($Submittedlist->id);
                    ?>
                    <tr>
                        <td><?= $Submittedlist->receipt_no ;?></td>
                        <td><?= $Submittedlist->receipt_date ;?></td>
                        <td><?= $Submittedlist->total_amount ;?></td>
                        <td><?= $Submittedlist->concession_amount ;?></td>
                        <td><?= $Submittedlist->fine_amount ;?></td>
                        <td><?= $Fees ?></td>
                        <td><?= $Submittedlist->remark ;?></td>
                        <td> 
                            <?= $this->Html->link('<i class="fa fa-print"></i>',['controller'=>'FeeReceipts','action'=>'receiptPrint','FeeReceipts','adhocFee',$receipt_id,$student_info_id],['escape'=>false,'class'=>'btn btn-primary btn-xs']) ?>
                            <a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $Submittedlist->id; ?>" data-toggle=modal><i class="fa fa-trash-o "></i></a>
                            
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
foreach ($SubmittedFee as $Submittedlist)
{ 
    $receipt_id=$EncryptingDecrypting->encryptData($Submittedlist->id);
    ?>
    <div id="deletemodal<?php echo $Submittedlist->id; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md" >
            <?= $this->Form->create('from',['url'=>['action'=>'delete','adhocFee',$receipt_id,$student_info_id]]) ?>
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
}
?>
<?= $this->element('icheck') ?>
<?= $this->element('validate') ?> 
<?php  
$js="
 $(document).ready(function(){
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
        var isClass = $(this).attr('uncheck');  
        var inputted = parseInt($(this).val());
        var total = 0; 
        if( (inputted < 1) || ($(this).val().length == 0)){
            alert('Invalid Amount'); 
            $(this).val(actualAmount);
            calcuteAmounts();
        }
        else{
           calcuteAmounts(); 
        }
    });
    
    $(document).on('ifChanged', '.checkDisable', function(){
        var isClass = $(this).attr('uncheck');
        var value = $(this).val();
        if($(this).is(':checked')){
            $('.' + isClass).attr('column','1');
            $('.check'+value).attr('checked',true);
            $('.check'+value).attr('value',value);
        }
        else{
            $('.' + isClass).attr('column','0');
            $('.check'+value).attr('checked',false);
            $('.check'+value).removeAttr('value');
        }
        removeDisable();
    });
    function removeDisable(){
        $('.amountValid').each(function(){
            var column = $(this).attr('column');
            var row = $(this).attr('row');
            if(row == 1 && column == 1){
               $(this).removeAttr('disabled');
            }
            else{
                 $(this).attr('disabled','true');
            }
        });
        calcuteAmounts();
    }

    function calcuteAmounts(){
        var total = 0;
        $('.amountValid').each(function(){
            var column = $(this).attr('column');
            var row = $(this).attr('row');
            if(row == 1 && column == 1){
                var amount = parseInt($(this).val());
                total=parseInt(total)+amount;
            }
        });
        $('.GrossAmount').val(total); 
        $('.totalFee').val(total);
        $('.concessionAmount').trigger('keyup');       
    }      
});
    
";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>