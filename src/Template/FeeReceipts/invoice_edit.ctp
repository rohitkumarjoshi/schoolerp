<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Student Wise Fee Edit </label>
            </div>
            <div class="box-body">
            <?= $this->Form->create($feeReceipt,['class'=>'FormSubmit']) ?>
                <?= $this->Form->control('fee_category_id',['label' => false,'type'=>'hidden','value'=>1])?>
                <table class="table table-bordered table-hover" id="tab">
                    <tbody>
                    <tr>
                        <th>Scholar No.: <?=$students->scholar_no?></th> 
                        <th>Date: <?= date('d-m-Y')?></th>
                        <th>Class: <?= @$studentInfos->student_class->name?></th>
                    </tr>
                    <tr> 
                        <th>Name: <?=$students->name?></th>
                        <th>Father Name: <?= @$students->father_name?></th>
                        <th>Mother Name: <?= @$students->mother_name?></th> 
                    </tr>
                    <tr>
                        <th>Medium: <?= @$studentInfos->medium->name?></th> 
                        <th>Stream: <?= @$studentInfos->stream->name?></th>
                        <th>Section: <?= @$studentInfos->section->name?></th 
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered table-hover" style="text-align: center;">
                    <thead>
                        <tr>
                            <th class='text-center'>Months</th>
                            <?php
                                $y=0;
                                foreach ($feeMonths as $key => $value) {
                                    echo " <th class='text-center'>".$value->name."</th>";
                                 $y++;
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='text-center'> Fee Component<?= $this->Form->control('check_all', ['type' => 'checkbox','label'=>false,'class'=>'check_all']) ?></td>
                            <?php
                            $y=0;
                                foreach ($feeMonths as $key => $value) { 

                                echo '<td class="text-center">'.$this->Form->control('dsad', ['type' => 'checkbox','label'=>false,'class'=>'checkDisable','uncheck'=>'removeDisable'.$value->id,'totalAmount'=>'totalAmount'.$value->id,'value'=>$value->id]).'</td>';
                                $y++;

                                }
                            ?>
                        </tr>
                        <?php
                        $rr=0;
                          foreach ($FeeData as $FeeDatas) {
                            echo"<tr><td>".$FeeDatas->fee_type->name.$this->Form->control('paidornot', ['type' => 'checkbox','label'=>false,'class'=>'rowsCount']).$this->Form->control('test', ['type' => 'text','label'=>false,'class'=>'form-control input-xsmall multipleValue'])."</td>";
                             $x=0;
                            foreach ($feeMonths as $key => $value) {
                                 
                                $FeeAmount = @$FeeDatas->fee_type_master_rows[$x]->amount;

                                if(sizeof($FeeDatas->fee_type_master_rows[$x]->fee_type_student_masters)>0){

                                	echo $this->Form->hidden('fee_type_master_rows['.$rr.']['.$x.'][id]', ['type' => 'text','label'=>false,'value'=>$FeeDatas->fee_type_master_rows[$x]->fee_type_student_masters[0]->id]);

                                	$FeeAmount =@$FeeDatas->fee_type_master_rows[$x]->fee_type_student_masters[0]->amount;

                                }
                                
                                

                                $SubmittedAmount = @$FeeDatas->fee_type_master_rows[$x]->fee_receipt_rows[0]->total_amount;

                                $disabledCls='removeDisable'.$value->id;
                                if($SubmittedAmount>0){
                                	$disabledCls='';
                                }
                                $FeeAmount=$FeeAmount-$SubmittedAmount;
                                echo "
                                    <td>";
                                    echo $this->Form->hidden('fee_type_master_rows['.$rr.']['.$x.'][fee_month_id]', ['type' => 'checkbox','label'=>false,'class'=>'check'.$value->id]);
                                    echo $this->Form->control('fee_type_master_rows['.$rr.']['.$x.'][fee_type_master_row_id]',['label' => false,'type'=>'hidden','value'=>$FeeDatas->fee_type_master_rows[$x]->id]);
                                    echo "
                                    <label>".
                                        $FeeDatas->fee_type_master_rows[$x]->amount
                                    ."</label>".
                                     $this->Form->hidden('fee_type_master_rows['.$rr.']['.$x.'][actual_amount]',[
                                        'label' => false,
                                        'value'=>$FeeAmount,
                                        'column'=>0,
                                        'row'=>0,
                                        'disabled'=>true,
                                        'class'=>'form-control actualamountValid input-small '.$disabledCls,
                                    ]).
                                    $this->Form->control('fee_type_master_rows['.$rr.']['.$x.'][amount]',[
                                        'label' => false,
                                        'class'=>'form-control amountValid input-small '.$disabledCls,
                                        'placeholder'=>'Amount',
                                        'type'=>'text',
                                        'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",
                                        'column'=>0,
                                        'row'=>0,
                                        'value'=>$FeeAmount,
                                        'disabled'=>true,
                                        'actualAmount'=>$FeeAmount,
                                        'totalAmount'=>'totalAmount'.$value->id,  
                                    ]).
                                    "</td>";
                                $x++;
                            }
                            echo"</tr>";
                            $rr++;
                        }
                        ?>
                         
                        <tr>
                            <td colspan="20">
                            	<?= $this->Form->control('remark', ['type' => 'taxt','label'=>false,'class'=>'form-control','placeholder'=>'Remarks'])?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                        
                <div align="center" class="">    
                <?php echo $this->Form->button('Save',['class'=>'btn btn-info','type'=>'submit' ]); ?>
                 </div>
            <?= $this->Form->end() ?>             
            </div>
        </div>
    </div>
</div>
 <?= $this->element('icheck') ?>
<?php 
$js="
 $(document).ready(function(){
    $(document).on('ifChanged', '.check_all', function(){
        if($(this).is(':checked')){
            $('.checkDisable').each(function(){
                $(this).attr('checked',true).iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });
                $(this).closest('div').addClass('checked');
                var isClass = $(this).attr('uncheck');
                var value = $(this).val();
                $('.' + isClass).attr('column','1');
                $('.check'+value).attr('checked',true);
                $('.check'+value).attr('value',value);
                removeDisable();
                
            });
        }
        else
        {
            $('.checkDisable').each(function(){
                $(this).attr('checked',false).iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });
                var isClass = $(this).attr('uncheck');
                var value = $(this).val();
                $('.' + isClass).attr('column','0');
                $('.check'+value).attr('checked',false);
                $('.check'+value).removeAttr('value');
                removeDisable();
                
            });
        }
    });
    $(document).on('ifChanged', '.rowsCount', function(){
        var isNow = $(this);
        if($(this).is(':checked')){
            isNow.closest('tr').find('td input').attr('row','1')
        }
        else{
            isNow.closest('tr').find('td input').attr('row','0')
        }
         removeDisable();
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
        $('.actualamountValid').each(function(){
            var column = $(this).attr('column');
            var row = $(this).attr('row');
            if(row == 1 && column == 1){
               $(this).removeAttr('disabled');
            }
            else{
                 $(this).attr('disabled','true');
            }
        }); 
       
    }
    $(document).on('keyup', '.multipleValue', function(){
    	var valul = $(this).val();
    	$(this).closest('tr').find('.amountValid').each(function(){
            var column = $(this).attr('column');
            var row = $(this).attr('row');
            if(row == 1 && column == 1){
            	if(valul==''){
            		valul=0;
            	}
                $(this).val(valul);
            } 
        });
    });
    
    $('.FormSubmit').submit(function() {
        var inputtes = $('.GrossAmount').val();
        if(inputtes != 0 ){
        }
        else
        {
            alert('Invalid Amount');
            return false; 
        }
    });
     
});
    
";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>