<table class="table table-bordered ">
    <thead>
        <tr>
            <th>Gross Total</th>        
            <th>Concession</th>        
            <th>Fine</th>        
            <th>Fee to be Deposited</th>        
             
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?= $this->Form->control('amount', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small GrossAmount','placeholder'=>'Gross Amount','readonly','id'=>'amount','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"])?>
            </td>
            <td>
                <?= $this->Form->control('concession_amount', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small concessionAmount','placeholder'=>'Concession','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"])?>
            </td>
            <td>
                <?= $this->Form->control('fine_amount', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small fineAmount','placeholder'=>'Fine','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"])?>
            </td>
            <td>
                <?= $this->Form->control('total_amount', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small totalFee','placeholder'=>'Total','readonly','id'=>'total_amount','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"])?>
            </td>         
        </tr>
    </tbody>
</table>
<?php
$js="
$(document).on('keyup', '.concessionAmount', function(){
        calAmount();
    });

    $(document).on('keyup', '.fineAmount', function(){
        calAmount();
    });
    function calAmount(){
        var GrossAmount = parseInt($('.GrossAmount').val());
        var concessionAmount = parseInt($('.concessionAmount').val());
        var fineAmount = parseInt($('.fineAmount').val());

        if(isNaN(fineAmount)){ fineAmount=0; }
        if(isNaN(concessionAmount)){ concessionAmount=0; }
        if(GrossAmount){
            if(concessionAmount > GrossAmount) {
                alert('Invalid Amount'); 
                $('.concessionAmount').val(''); 
                $('.totalFee').val(GrossAmount);  
            }
            else{
                var MainAmount = (GrossAmount - concessionAmount) + fineAmount; 
                $('.totalFee').val(MainAmount);  
            }
        }
        else{
            $('.concessionAmount').val(''); 
            $('.fineAmount').val(''); 
        }
    }";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>