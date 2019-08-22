<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<style>
	.gallery img {
		height :127px;
		width:127px;
	}
</style>	
<div class="box box-primary">
		<div class="box-header with-border"> 
			<h3 class="box-title" style="padding:"> Edit Vehicle</h3>
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
                                    <label class="control-label">City of Registraion
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
                                    <label>Chasis Number
                                    </label>
                                    <?= $this->Form->control('chasis_no', ['label' => false, 'class'=>'form-control ','placeholder'=>'Enter Chasis Number'])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Fuel Type
                                        <span class="required" style="color: red;">*</span>
                                    </label>
									<?php 
									$options=['Petrol'=>'Petrol','Diesel'=>'Diesel'];
									?>
									<?= $this->Form->control('fuel_type', ['options' => $options,'label' => false, 'class'=>'form-control select2me','style'=>'width:100%'])?>
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
                                    <label>Insurance Date From to Expiry
                                    </label>
									<?= $this->Form->control('insurance_daterange', ['label' => false, 'class'=>'form-control daterangepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','value'=>(!empty($vehicle->insurance_date))?h(date('d-m-Y',strtotime($vehicle->insurance_date)).'/'.date('d-m-Y',strtotime($vehicle->insurance_expiry_date))):''])?>
                                </div>
                            </div>
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label style="margin-top:5px;">Upload Insurance Doc
                                    </label>
                                    <?= $this->Form->control('insurance_doc1', ['label' => false, 'class'=>'form-control  upload_doc','type'=>'file','onchange'=>'loadFile(event)','autocomplete'=>'false','id'=>'ins_photo'])?>
                                </div>
                            </div>
                             <div class="col-md-2 ins_photo">
								<?php
								if(!empty($vehicle->insurance_doc))
								{
									?>
									<?= $this->Html->image($cdn_path.'/'.$vehicle->insurance_doc,['style'=>'width:100px;height:100px;','id'=>'previewPhoto']) ?>
									<?php
								}
								?>
							</div>
                         </div>
						 <div class="row">
						   <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>POC Date From to Expiry
                                    </label>
									<?= $this->Form->control('poc_daterange', ['label' => false, 'class'=>'form-control daterangepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','value'=>(!empty($vehicle->poc_date))?h(date('d-m-Y',strtotime($vehicle->poc_date)).'/'.date('d-m-Y',strtotime($vehicle->poc_expiry_date))):''])?>
                                </div>
                            </div>
							  <div class="col-md-4">                         
                                <div class="form-group">
                                    <label style="margin-top:5px;">Upload POC Doc
                                    </label>
                                    <?= $this->Form->control('poc_doc1', ['label' => false, 'class'=>'form-control  upload_doc','type'=>'file','onchange'=>'loadFile(event)','autocomplete'=>'false','id'=>'poc_photo'])?>
                                </div>
                            </div>
                            <div class="col-md-2 poc_photo">
								<?php
								if(!empty($vehicle->poc_doc))
								{
									?>
									<?= $this->Html->image($cdn_path.'/'.$vehicle->poc_doc,['style'=>'width:100px;height:100px;','id'=>'previewPhoto']) ?>
									<?php
								}
								?>
							</div>
                        </div>
						 <div class="row">
						   <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Permit Date From to Expiry
                                    </label>
									<?= $this->Form->control('permit_daterange', ['label' => false, 'class'=>'form-control daterangepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','value'=>(!empty($vehicle->permit_date))?h(date('d-m-Y',strtotime($vehicle->permit_date)).'/'.date('d-m-Y',strtotime($vehicle->permit_expiry_date))):''])?>
                                </div>
                            </div>
							  <div class="col-md-4">                         
                                <div class="form-group">
                                    <label style="margin-top:5px;">Upload Permit Doc
                                    </label>
                                    <?= $this->Form->control('permit_doc1', ['label' => false, 'class'=>'form-control  upload_doc','type'=>'file','data-show-upload'=>false, 'data-show-caption'=>false,'autocomplete'=>'false','id'=>'permit_photo'])?>
                                </div>
                            </div>
                            <div class="col-md-2 permit_photo">
								<?php
								if(!empty($vehicle->permit_doc))
								{
									?>
									<?= $this->Html->image($cdn_path.'/'.$vehicle->permit_doc,['style'=>'width:100px;height:100px;','id'=>'previewPhoto']) ?>
									<?php
								}
								?>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">                         
                                <div class="form-group">
                                    <label>Status
                                        <span class="required" style="color: red;">*</span>
                                    </label>
                                     <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
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
<?= $this->element('daterangepicker') ?> 
<?= $this->element('validate') ?> 
<?= $this->Html->script('/assets/js/plugins/fileinput/fileinput.min.js',['block'=>'fileinputjs']) ?>
<?php
$js="
$(document).ready(function(){
    
	 $(document).on('change','#ins_photo',function(){
		 $('.ins_photo').hide();
	 });
	 $(document).on('change','#poc_photo',function(){
		 $('.poc_photo').hide();
	 });
	 $(document).on('change','#permit_photo',function(){
		 $('.permit_photo').hide();
	 });

	 $('.upload_doc').fileinput({
        showUpload: false,
        showCaption: false,
        showCancel: false,
        browseClass: 'btn btn-success',
        allowedFileExtensions: ['jpeg', 'jpg', 'png'],
        maxFileSize: 1024,
    });


    $('#ServiceForm').validate({ 
        rules: {
            name: {
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
