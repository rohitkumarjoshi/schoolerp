<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <h3 class="box-title" >Student Profile</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="tab">
                            <tbody>
                                <?php foreach ($personal_infos as $personal_info) {?>
                                <tr>
                                    <th>Name : <?= $personal_info->student->name ?></th>
                                    <th>Class : <?= $personal_info->student_class->name?></th>
                                    <th>Section : <?= $personal_info->section->name?></th>
                                </tr>
                                <tr>
                                    <th rowspan="4"><?= $this->Html->image('/img/editicon.png', ['style'=>'width:50px; height:50px;']);?></th>
                                    <th>Scholar No.: <?=$personal_info->student->scholar_no?></th>
                                    <th>Admission Date: <?= date('d-m-Y',strtotime($personal_info->student->registration_date))?></th>
                                    
                                </tr>
                                <tr>
                                    <th>Father's Name : <?=$personal_info->student->father_name?></th>
                                    <th>Mother's Name : <?=$personal_info->student->mother_name?></th>
                                </tr>
                                 <tr>
                                    <th>Gender : <?=$personal_info->student->gender->name?></th>
                                    <th>DOB : <?=$personal_info->student->dob?></th>
                                </tr>
                                 <tr>
                                    <th>Email : <?=$personal_info->email?></th>
                                    <th>Mobile : <?=$personal_info->student->parent_mobile_no?></th>
                                </tr>
                                <?php } ?>
                            </tbody>
                </table> 
                <?php if(!empty($achivements))
                {?>
                <span><h4>Achivements</h4></span>
                <table class="table table-bordered" id="tab">
                    <thead>
                        <th>Achivement Category</th>
                        <th>Achivement Type</th>
                        <th>Achivement Date</th>
                    </thead>
                    <tbody>
                       <?php foreach ($achivements as $achivement) {?>
                        <tr>
                            <td><?= $achivement->achivement_category->name ?></td>
                            <td><?= $achivement->achivement_type?></td>
                            <td><?= date('d-m-Y',strtotime($achivement->achivement_date))?></td>
                        </tr>
                       <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- <div id="FeeDetails" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Monthly Fee Receipt</h4>
      </div>
      <div class="modal-body">
         <table class="table table-bordered table-hover" id="tab">
            <thead>
                <tr>
                    <th>Recipt No.</th> 
                    <th>Date of Payment</th>
                    <th>Amount Paid</th>
                    <th>Concession</th>
                    <th>Fine</th>
                    <th>Fee Type (Month)</th>
                    <th>Remarks</th> 
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($SubmittedFee as $Submittedlist) {
                    $FeeName=[];
                    foreach ($Submittedlist->fee_receipt_rows as $key => $value) {
                        $FeeName[$value->fee_type_master_row->fee_type_master->fee_type->name][]=$value->fee_month->name;
                    }
                    $receipt_id=$EncryptingDecrypting->encryptData($Submittedlist->id);
                    ?>
                    <tr>
                        <td><?= $Submittedlist->receipt_no ;?></td>
                        <td><?= $Submittedlist->receipt_date ;?></td>
                        <td><?= $Submittedlist->total_amount ;?></td>
                        <td><?= $Submittedlist->concession_amount ;?></td>
                        <td><?= $Submittedlist->fine_amount ;?></td>
                        <td>
                            <?php
                            foreach ($FeeName as $key => $value) {
                                echo $key;
                                echo '(';
                                echo implode(',', $value);
                                echo ')';
                            }
                            ?>
                                
                        </td>
                        <td><?= $Submittedlist->remark ;?></td>
                        <td> 
                            <?= $this->Html->link('<i class="fa fa-print"></i>',['controller'=>'FeeReceipts','action'=>'receiptPrint','FeeReceipts','monthlyFee',$receipt_id,$student_info_id,$fee_type_role_ids],['escape'=>false,'class'=>'btn btn-primary btn-xs']) ?>
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

foreach ($SubmittedFee as $Submittedlist) { 
   
    $receipt_id=$EncryptingDecrypting->encryptData($Submittedlist->id);
    ?>
<div id="deletemodal<?php echo $Submittedlist->id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md" >
            <?= $this->Form->create('from',['url'=>['action'=>'delete','monthlyFee',$receipt_id,$student_info_id,$fee_type_role_ids]]) ?>
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
<?= $this->element('validate') ?>  -->
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
    $('.checkDisable').each(function(){
        var isClass = $(this).attr('uncheck');
        var value = $(this).val();
        var obj_cur = $(this);
        var total = 0;
        var amount = 0;
        var Actualamount = 0;
        $('.removeDisable'+value).each(function(){
            amount += parseInt($(this).val());
            Actualamount += parseInt($(this).closest('td').find('label').html());
        });
        
        if(amount==0)
        {
            $('.removeDisable' + value).attr('column','0');
            $('.check'+value).attr('checked',false);
            $('.check'+value).removeAttr('value');
            if(Actualamount > 0)
            {
                obj_cur.attr('checked',true).iCheck({
                checkboxClass: 'icheckbox_minimal-blue'
                });
                obj_cur.closest('div').addClass('checked');
                obj_cur.closest('td').append('<span style=font-weight:bolder;> Paid</span>');
            }
            else
            {
                obj_cur.attr('checked',false).iCheck({
                checkboxClass: 'icheckbox_minimal-blue'
                });
            }
            
            obj_cur.attr('disabled',true);
            
            removeDisable();
            obj_cur.removeClass('checkDisable');
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
        calcuteAmount();
    }
    
    calcuteAmount(); 
    function calcuteAmount(){
        var concession_amount_1=0;
        var concession_amount_2=0;
        $('.checkDisable').each(function(){
            var isClass = $(this).attr('uncheck');
            var totalAmount = $(this).attr('totalAmount');
            var total = 0;
            $('.' + isClass).each(function(){
                var column = $(this).attr('column');
                var row = $(this).attr('row');
                var fee_concession_amount =  parseInt($(this).attr('feeConcessionAmount'));
                var fee_type_role_id = $(this).attr('fee_type_role_id');
                if(row == 1 && column == 1){
                    var amount = parseInt($(this).val());
                    total=parseInt(total)+amount;

                    if(fee_type_role_id==1)
                    {
                        concession_amount_1+=fee_concession_amount;
                    }
                    else if(fee_type_role_id==2)
                    {
                        concession_amount_2+=fee_concession_amount;
                    }
                }
            });
            $('.'+totalAmount).val(total);
            $('input[name=concession_amount_1]').val(concession_amount_1);
            $('input[name=concession_amount_2]').val(concession_amount_2);
        });

        grossTotal();
    }

    function grossTotal(){
        var totalAmount=0;
        $('.gross').each(function(){
            var amount = parseInt($(this).val());
            totalAmount=parseInt(totalAmount)+amount;
        });
        $('.GrossAmount').val(totalAmount);
        $('.totalFee').val(totalAmount);
        calAmount();
    }

    $(document).on('keyup', '.amountValid', function(){
        var actualAmount=parseInt($(this).attr('actualAmount'));
        var isClass = $(this).attr('uncheck');
        var totalAmount = $(this).attr('totalAmount');

        var inputted = parseInt($(this).val());
        var total = 0; 
        if( (inputted > actualAmount) || (inputted < 1) || ($(this).val().length == 0)){
            alert('Invalid Amount'); 
            $(this).val(actualAmount);
            calcuteAmount();
        }
        else{
           calcuteAmount(); 
        }
    });
    
     
});
    
";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>