
<style>
    .gallery img {
        height :127px;
        width:127px;
    }
</style>    
<div class="box box-primary">
        <div class="box-header with-border"> 
            <label> <?= @$head_title ?></label>
        
        </div>
                <div class="box-body">
                    <?= $this->Form->create($vehicleFuelEntry,['id'=>'form_sample_3','type'=>'file']) ?>
                        <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Filling Date
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('fill_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <div id="datetimepicker1">
                                        <label class="control-label">Filled By
                                            <span class="required" style="color: red;">*</span>
                                        </label>
                                        <?= $this->Form->control('filled_by', ['options'=>$drivers,'label' => false, 'class'=>'select2','empty'=>'Select Driver','style'=>'width:100%','required'])?>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Vehicle Number
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('vehicle_id', ['options' => $vehicles,'label' => false, 'class'=>'select2','empty'=>'Select Vehicle','style'=>'width:100%','required'])?>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Bill No
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('bill_no', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Bill Number','type'=>'text','required'])?>
                                </div>
                            </div>
                             <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Amount
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('amount', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Amount','type'=>'text','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Liter
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('liter', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter liter','type'=>'text','required'])?>
                                </div>
                            </div>
                          
                           </div>
                            <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Prevoious Km
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('previous_km', ['label' => false, 'class'=>'form-control previous_km','placeholder'=>'Enter Prevoious Km','type'=>'text','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Current Km
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('current_km', ['label' => false, 'class'=>'form-control current_km','placeholder'=>'Enter Current Km','type'=>'text','required'])?>
                                </div>
                            </div>
                             <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Difference Km
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('difference_km', ['label' => false, 'class'=>'form-control difference_km','placeholder'=>' Difference Km','type'=>'text','readonly'])?>
                                </div>
                            </div>
                        </div>
                           <div class="row">
                              <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Milege
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('milege', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Manufacturing Year','type'=>'text','required'])?>
                                </div>
                            </div>
                             <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Status
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                     <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Remarks
                                       
                                    </label>
                                     <?= $this->Form->control('remark', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Remarks'])?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <center>
                                <?= $this->Form->button(__('Submit'),['class'=>'btn button','id'=>'submitbtn']) ?>
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
     $(document).on('keyup','.current_km,.previous_km',function(){
            calculate();
        });
         $(document).on('keyup','.previous_km',function(){
            calculate();
        });
            function calculate(){
                var current_km=$('.current_km').val();
                var previous_km=$('.previous_km').val();
                var difference_km=parseFloat(current_km)-parseFloat(previous_km);
                if(difference_km > 0)
                {
                    $('.difference_km').val(difference_km);   
                }
                else
                {
                    $('.difference_km').val(''); 
                }   
            }
  }); ";
$this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>
