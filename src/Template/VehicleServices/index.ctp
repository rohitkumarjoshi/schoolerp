<div class="box box-primary">
	<div class="box-header with-border"> 
		<label> <?= @$title ?></label>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
			  <?= $this->Form->create(' ',['id'=>'ServiceForm']) ?>
					<fieldset><legend>Filter</legend>
						<div class="col-md-12 " >
							<div class="row"> 
								<div class="col-md-3">
									<label class="control-label">Search By Vehicle</label>
									<?= $this->Form->control('vehicle_id', ['options' => $vehicles_list,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select All','dataplaceholder'=>'Select Vehicle'])?>
								</div>
								<div class="col-md-1">
									<label class="control-label" style="    visibility: hidden;">Search</label>
									<?php echo $this->Form->button('Go',['class'=>'btn btn-sm button','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'height:38px;']); ?> 
								</div>
							</div>
						</div>
					</fieldset>
			  <?= $this->Form->end() ?>
			</div>
		</div>
		<br>
		<?php if($data_exist=='data_exist') { ?>
		<table cellpadding="0" cellspacing="0" class="table">
			 <thead style="background-color: #21898e;color: #f1f2f3;">
				<tr>
					<th scope="col">Sr.No</th>
					 <th scope="col">Vehicle No</th>
					<th scope="col">Driver</th>
					<th scope="col">Service Date</th>
					<th scope="col">Km</th>
					<th scope="col">Bill No</th>
					<th scope="col">Amount</th>
					<th scope="col">Vendor</th>
					<th scope="col">Next Service Date</th>                               
					<th scope="col">Status</th>                               
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1;foreach ($vehicleServices as $vehicleService): ?>
				<tr>
					<td><?= $i;?></td>
				   <td><?= $vehicleService->has('vehicle') ? $vehicleService->vehicle->vehicle_no : '' ?></td>
					<td><?= $vehicleService->has('driver') ? $vehicleService->driver->name : '' ?></td>
					<td><?= h($vehicleService->service_date) ?></td>
					<td><?= $this->Number->format($vehicleService->km) ?></td>
					<td><?= h($vehicleService->bill_no) ?></td>
					<td><?= $this->Number->format($vehicleService->amount) ?></td>
					<td><?= $vehicleService->has('vendor') ? $vehicleService->vendor->name : '' ?></td>
					<td><?= h($vehicleService->next_service) ?></td>
					<td>
						<?php
						if($vehicleService->is_deleted=='Y')
						{
							echo 'Deactive';
						}
						else{
							echo 'Active';
						}
						?>
						</td>
					<td class="actions">

						<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($vehicleService->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Fuel', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Fuel']) ?>

						<!-- <?= $this->Html->link(__('<i class="fa fa-eye"></i>'), ['action' => 'view', $EncryptingDecrypting->encryptData($vehicleService->id)],['class'=>'btn btn-success btn-xs','escape'=>false, 'data-widget'=>'View', 'data-toggle'=>'tooltip', 'data-original-title'=>'View']) ?>  -->
						
						<!--<a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $vehicleService->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>

						<div id="deletemodal<?php echo $vehicleService->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
							<?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'vehicleServices','action'=>'delete',$vehicleService->id]]) ?>
									<div class="modal-content">
									  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title" >
											Confirm Header
											</h4>
										</div>
										<div class="modal-body">
										<h4 class="modal-title">
											Are you sure you want to remove this Vehicle Service ?
											</h4>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn  btn-sm btn-info">Yes</button>
											<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								<?= $this->Form->end() ?>
							</div>
						</div> -->
					</td>
				</tr>
				<?php $i++;endforeach; ?>
			</tbody>
		</table>
		<?php } else {  ?>
				 <div class="row text-center">
					 <h3> <?= $data_exist ?></h3>
				</div> 
		<?php } ?>
	</div>
</div>
   
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            vehicle_id: {
                required: false
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