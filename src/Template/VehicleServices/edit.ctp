<div class="box box-primary">
        <div class="box-header with-border"> 
            <h3 class="box-title" style="padding:"> Edit Vehicle Service</h3>
            
        </div>
        <div class="box-body">
            <?= $this->Form->create($vehicleService,['id'=>'ServiceForm','type'=>'file']) ?>
                <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Service Date
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('service_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <div id="datetimepicker1">
                                        <label>Driver 
                                            <span class="required" style="color: red;">*</span>
                                        </label>
                                        <?= $this->Form->control('driver_id', ['options'=>$drivers,'label' => false, 'class'=>'select2','empty'=>'Select Driver','style'=>'width:100%','required'])?>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Vehicle Number
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('vehicle_id', ['options' => $vehicles,'label' => false, 'class'=>'select2','empty'=>'Select Vehicle','style'=>'width:100%','required'])?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Bill No
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('bill_no', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Bill Number','type'=>'text','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>KM
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('km', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Km','type'=>'text','required'])?>
                                </div>
                            </div>
                             <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Amount
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('amount', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Amount','type'=>'text','required'])?>
                                </div>
                            </div>
                        </div>
                           <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Next Service Date
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('next_service', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <div id="datetimepicker1">
                                        <label> Vendor 
                                            <span class="required" style="color: red;">*</span>
                                        </label>
                                        <?= $this->Form->control('vendor_id', ['options'=>$vendors,'label' => false, 'class'=>'select2','empty'=>'Select Vendor','style'=>'width:100%','required'])?>
                                    </div>
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
                        </div>
                    <div class="row">                         
                      <div class="col-md-12">                         
                                <div class="form-group">
                                    <label>Remarks
                                        
                                    </label>
                                    <?= $this->Form->control('remark', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Remarks'])?>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="box-footer">
                            <center>
                                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary','id'=>'submit_member']) ?>
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
  }); ";
$this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>
