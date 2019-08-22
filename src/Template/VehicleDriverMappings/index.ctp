<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					<label > Edit Driver Mapping </label>
				<?php }else{ ?>
					 <label> Create Driver Mapping </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($vehicleDriverMapping,['id'=>'ServiceForm']) ?>
					 
					 <div class="row">
						<div class="col-md-4">
							<label class="control-label"> Vehicle <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							 <?= $this->Form->control('vehicle_id', ['options'=>$vehicles,'label' => false, 'class'=>'select2','empty'=>'Select Vehicle','style'=>'width:100%','required'])?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<label class="control-label">  Driver <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?= $this->Form->control('driver_id', ['options'=>$drivers,'label' => false, 'class'=>'select2','empty'=>'Select Driver','style'=>'width:100%','required'])?>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">  Conductor <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-11">
							<?= $this->Form->control('conductor_id', ['options'=>$conductors,'label' => false, 'class'=>'select2','empty'=>'Select Conductor','style'=>'width:100%','required'])?>
						</div>
					</div> 
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Assign Date <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
						   <?= $this->Form->control('assign_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','required'])?>
						</div>
					</div>
					<?php if(!empty($id)){ ?>
					<br>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Status </label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<div class="form-group">
								<?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
							</div>
						</div>
					</div>
					<?php } ?>
					<span class="help-block"></span>
					<div class="box-footer">
						<div class="row">
							<center>
								<div class="col-md-12">
									<div class="col-md-offset-3 col-md-6">  
										<?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
									</div>
								</div>
							</center>       
						</div>
					</div>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-7" style="padding-left: 5px !important">
		<div class="box box-primary">
			<div class="box-header with-border">
				 <label> View List </label>
			</div> 
			<div class="box-body">
				<?php $page_no=$this->Paginator->current('sections'); $page_no=($page_no-1)*10; ?>
				 <table id="example1" class="table ">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Vehicle No ') ?></th>
							<th scope="col"><?= __('Driver') ?></th>
							<th scope="col"><?= __('Conductor') ?></th>
							<th scope="col"><?= __('Assign Date') ?></th>
							<th scope="col"><?= __('Status') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($vehicleDriverMappings as $vehicleDriverMapping): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td>
							<?= $vehicleDriverMapping->has('vehicle') ? $vehicleDriverMapping->vehicle->vehicle_no : '' ?>
							</td> 
							<td >
							<?= $vehicleDriverMapping->has('driver') ? $vehicleDriverMapping->driver->name : '' ?>
							</td>
							 <td >
							 	<?=  $vehicleDriverMapping->has('conductor') ? $vehicleDriverMapping->conductor->name : '' ?>
							</td>
							 <td >
							<?php echo $vehicleDriverMapping->assign_date;?>
							</td>
							<td>
							<?php
							if($vehicleDriverMapping->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($vehicleDriverMapping->id)],['class'=>'btn btn-info  editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit Section', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Section']) ?>
							</td>
						</tr>
					<?php $i++; endforeach; ?>
					</tbody>
			</table>
			<div class="box-footer">
				<?= $this->element('pagination') ?> 
			</div>
			</div>
		</div>
	</div>
</div>

<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

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

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 