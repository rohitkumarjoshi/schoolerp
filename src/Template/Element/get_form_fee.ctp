<table class="table table-bordered table-hover" style="text-align: center;">
    <thead>
        <?php
        $x=0;
        foreach ($FeeData as $FeeDatas) {
            echo"<th>".$FeeDatas->fee_type->name."</th>";
            $totSubmitted = @$FeeDatas->fee_type_master_rows[0]->fee_receipt_rows[0]->total_amount;
            $feeAmount=@$FeeDatas->fee_type_master_rows[0]->amount;
                if($totSubmitted<$feeAmount){
                    echo $this->Form->control('fee_type_master_rows['.$x.'][fee_type_master_row_id]',['label' => false,'type'=>'hidden','value'=>$FeeDatas->fee_type_master_rows[0]->id]);
                }
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
            $readonly=true;
            $disabled=false;
            if($totSubmitted>=$feeAmount){
                $readonly=false;
                $disabled=true;
            }
            
            echo "
                <td>".
                $this->Form->control('fee_type_master_rows['.$x.'][amount]',[
                    'label' => false,
                    'class'=>'form-control input-small amount_add',
                    'placeholder'=>'Amount',
                    'type'=>'text',
                    'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",
                    'value'=>$FeeDatas->fee_type_master_rows[0]->amount,
                    'readonly'=>$readonly,
                    'disabled'=>$disabled,
                ])."</td>";
            $totalAmount+=$FeeDatas->fee_type_master_rows[0]->amount;
            $x++;
        }
        $totalAmount=$totalAmount-$SubmittedAmount;
        echo"</tr>";
        ?>
    </tbody>
</table>
<?php
/*$js="
 $(document).ready(function(){
     $('#amount').val(".$totalAmount.");
    $('#total_amount').val(".$totalAmount.");
    if(".$totalAmount." <= 0)
    {
        $('#submit').remove();
    }
});

";
$this->Html->scriptBlock($js,['block'=>'block_js']);*/
?>