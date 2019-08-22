
<style>
	.gallery img {
		height :127px;
		width:127px;
	}
</style>	
<div class="box box-primary">
		<div class="box-header with-border"> 
			<label> <?= @$title ?></label>
			<div class="box-tools pull-right">
			</div>
		</div>
				<div class="box-body">
					<?= $this->Form->create($vehicle,['id'=>'ServiceForm','type'=>'file']) ?>
						<div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <div id="datetimepicker1">
                                        <label class="control-label">Vehicle Number
                                            <span class="required" style="color: red;">*</span>
                                        </label>
                                        <?= $this->Form->control('vehicle_no', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Vehicle Number','required'])?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Vehicle Type
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('vehicle_type', ['label' => false, 'class'=>'form-control','placeholder'=>'Example-Bus,Car','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Company Name
                                    </label>
                                    <?= $this->Form->control('vechicle_company', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Company Name'])?>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Modal Number
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('model_no', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Modal Number','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">City Of Registraion
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('city_reg', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter City Of Registraion','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Engine Number
                                    </label>
                                    <?= $this->Form->control('engine_no', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Engine Number'])?>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Condition
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('vehicle_condition', ['label' => false, 'class'=>'form-control','placeholder'=>'Ex. - New, used','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Manufacturing Year
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                    <?= $this->Form->control('year_manufacturing', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Manufacturing Year','required'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Color
                                    </label>
                                    <?= $this->Form->control('color', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Color of Vehicle'])?>
                                </div>
                            </div>
                           </div>
						   <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Chasis Number
                                    </label>
                                    <?= $this->Form->control('chasis_no', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Chasis Number'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Fuel Type
                                        <span class="required" style="color: red;">*</span>
                                    </label>
									<?php 
									$options=['Petrol'=>'Petrol','Diesel'=>'Diesel'];
									?>
									<?= $this->Form->control('fuel_type', ['options' => $options,'label' => false, 'class'=>'form-control select2me','style'=>'width:100%','value'=>'Diesel','required'])?>
                                </div>
                            </div>
                             <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label"> Vehicle Name
                                    </label>
                                    <?= $this->Form->control('vehicle_name', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Vehicle Name'])?>
                                </div>
                            </div>
                        </div>
						<div class="row">
						  <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Insurance Date From to Expiry
                                    </label>
									<?= $this->Form->control('insurance_daterange', ['label' => false, 'class'=>'form-control daterangepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label style="margin-top:5px;" class="control-label">Upload Insurance Doc
                                    </label>
                                    <?= $this->Form->control('insurance_doc', ['label' => false, 'class'=>' upload_doc','type'=>'file','onchange'=>'loadFile(event)','autocomplete'=>'false','id'=>'test'])?>
                                </div>
                            </div>
                         </div>
						 <div class="row">
						   <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">POC Date From to Expiry
                                    </label>
									<?= $this->Form->control('poc_daterange', ['label' => false, 'class'=>'form-control daterangepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy'])?>
                                </div>
                            </div>
							  <div class="col-md-4">                         
                                <div class="form-group">
                                    <label style="margin-top:5px;" class="control-label">Upload POC Doc
                                        
                                    </label>
                                    <?= $this->Form->control('poc_doc', ['label' => false, 'class'=>'  upload_doc','type'=>'file','onchange'=>'loadFile(event)','autocomplete'=>'false','id'=>'test'])?>
                                </div>
                            </div>
                        </div>
						 <div class="row">
						   <div class="col-md-4">                         
                                <div class="form-group">
                                    <label class="control-label">Permit Date From to Expiry
                                    </label>
									<?= $this->Form->control('permit_daterange', ['label' => false, 'class'=>'form-control daterangepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy'])?>
                                </div>
                            </div>
							  <div class="col-md-4">                         
                                <div class="form-group">
                                    <label style="margin-top:5px;" class="control-label">Upload Permit Doc
                                    </label>
                                <?= $this->Form->control('permit_doc', ['label' => false, 'class'=>'  upload_doc','type'=>'file','data-show-upload'=>false, 'data-show-caption'=>false,'autocomplete'=>'false','id'=>'employee_photo'])?>
                                </div>
                            </div>
                        </div>
						<div class="box-footer">
							<center>
								<?= $this->Form->button(__('Submit'),['class'=>'btn button','id'=>'submit_member']) ?>
							</center>
						</div>
                        <?= $this->Form->end() ?>
				</div>
			</div>

<?= $this->element('selectpicker') ?> 
<?= $this->element('daterangepicker') ?> 
<?= $this->element('validate') ?>       				 
<?php
$js="
 
$(document).ready(function(){
    
  $('#ServiceForm').validate({ 
        rules: {
            vehicle_no: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
});
";
     $this->Html->scriptBlock($js,['block'=>'block_js']);
 ?>
