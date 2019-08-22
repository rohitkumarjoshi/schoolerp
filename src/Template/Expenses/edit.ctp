<div class="box box-primary">
        <div class="box-header with-border"> 
            <label> <?= @$head_title ?></label>
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="box-body">
            <?= $this->Form->create($expense,['id'=>'ServiceForm']) ?>
                <div class="row">
                    <div class="col-md-4">                         
                                <div class="form-group">
                                    <div id="datetimepicker1">
                                        <label class="control-label">Select Category 
                                            <span class="required" style="color: red;">*</span>
                                        </label>
                                        <?= $this->Form->control('expense_category_id', ['options'=>$expenseCategories,'label' => false, 'class'=>'select2','empty'=>'Select Category','style'=>'width:100%','required'])?>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-4">                         
                                <div class="form-group">
                                    <div id="datetimepicker1">
                                        <label  class="control-label">Select Sub-Category 
                                        </label>
                                        <?= $this->Form->control('expense_subcategory_id', ['options'=>$expenseSubcategories,'label' => false, 'class'=>'select2','empty'=>'Select Sub-Category','style'=>'width:100%'])?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Vehicle Number
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('vehicle_id', ['options' => $vehicles,'label' => false, 'class'=>'select2','empty'=>'Select Vehicle','style'=>'width:100%','required'])?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Expense By
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('expense_by', ['options' => $employees,'label' => false, 'class'=>'select2','empty'=>'Select Vehicle','style'=>'width:100%','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Expense Date
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('expense_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Amount
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('amount', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Amount','type'=>'text','required'])?>
                                </div>
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Payment Type
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                        <?php $options['Cash']='Cash';?>
                                        <?php $options['Cheque']='Cheque';?>
                                        <?php $options['IMPS']='IMPS';?>
                                        <?php $options['RTGS']='RTGS';?>
                                        <?php $options['Online']='Online';?>
                                        <?php $options['Others']='Others';?>
                                     <?= $this->Form->control('payment_mode', ['label'=>false,'class'=>'form-control input-small paymentMethod','placeholder'=>'Cheque No.','options'=>$options])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <div id="datetimepicker1">
                                        <label  class="control-label">Cheque Number 
                                        </label>
                                        <?= $this->Form->control('cheque_no', ['label' => false, 'class'=>'form-control notApplicable','placeholder'=>'Enter Cheque Number','disabled'])?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Cheque Date
                                    </label>
                                    <?= $this->Form->control('cheque_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker notApplicable','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','disabled'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Bank Name
                                    </label>
                                    <?= $this->Form->control('bank', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small notApplicable','placeholder'=>'Bank Name','disabled'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Transaction No.
                                    </label>
                                   <?= $this->Form->control('transaction_no', ['type' => 'taxt','label'=>false,'class'=>'form-control input-small TrnotApplicable','placeholder'=>'Transaction No.','disabled','disabled'])?>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-4">                         
                                <div class ="form-group">
                                    <label  class="control-label">Bank Remarks
                                    </label>
                                    <?= $this->Form->control('bank_remarks', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Bank Remarks'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label  class="control-label">Remarks
                                    </label>
                                    <?= $this->Form->control('remark', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Remarks'])?>
                                </div>
                            </div>
                             <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Status
                                    </label>
                                     <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="box-footer">
                            <center>
                                <?= $this->Form->button(__('Submit'),['class'=>'btn  button','id'=>'submit_member']) ?>
                            </center>
                        </div>
            <?= $this->Form->end() ?>
        </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?>                   
<?= $this->element('validate') ?> 
<?php

$js="
$(document).ready(function(){
        $('#ServiceForm').validate({ 
        rules: {
            service_date: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
    $(document).on('change', '.paymentMethod', function(){
        var paymentMethod = $(this,'option:selected').val();
        var now = $(this);
        if(paymentMethod == 'Cash'){
            now.closest('form').find('input.notApplicable').attr('disabled','disabled');
            now.closest('form').find('input.TrnotApplicable').attr('disabled','disabled');
        }
        else if(paymentMethod=='Cheque'){
            now.closest('form').find('input.notApplicable').removeAttr('disabled');
        }
        else{
            now.closest('form').find('input.TrnotApplicable').removeAttr('disabled');
            now.closest('form').find('input.notApplicable').attr('disabled','disabled');
        }
    });
  }); ";
$this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>
