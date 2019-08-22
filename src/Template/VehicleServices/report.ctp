<div class="box box-primary">
	<div class="box-header with-border"> 
		<label> Vehicle Services</label>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class="box-body">
			  <?= $this->Form->create($vehicleservice,['id'=>'ServiceForm','type'=>'get']) ?>
					<div class="row"> 
						<div class="col-md-12">
							<div class="col-md-4">
								<label class="control-label">Search By Vehicle</label>
								<?= $this->Form->control('data[vehicle_id]', ['options' => $vehicles,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select All','dataplaceholder'=>'Select Vehicle'])?>
							</div>
							<div class="col-md-4">
								<label class="control-label"> Date From </label>
							   <?= $this->Form->control('data[service_date >=]', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','style'=>'height:40px;','value'=>@$_GET['data']['service_date >=']])?>
							</div> 
							<div class="col-md-4">
								<label class="control-label">Date To </label>
							   <?= $this->Form->control('data[service_date <=]', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','style'=>'height:40px;','value'=>@$_GET['data']['service_date <=']])?>
							</div> 
						</div> 
					</div>
					<div class="row ">
					 	<div class="col-md-12" align="center">
					 		 <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                            <?php echo $this->Form->button('Go',['class'=>'btn btn-sm button']); ?>
                     	</div> 
                    </div> 
			  	<?= $this->Form->end() ?>
			</div><br>

		<?php if($data_exist=='data_exist') { ?>
			<div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($vehicleservice,['autocomplete'=>'off','url'=>['action'=>'reportExport']]) ?>
                                            <?php if (isset($where)): ?>
                                                <?php foreach ($where as $key => $value): ?>
                                                    <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info'])?>
                                        <?= $this->Form->end() ?>
									</td>
								</tr>
                            </table>
                        </div>
                    </div>

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
				</tr>
			</thead>
			<tbody>
				<?php $i=1;foreach ($vehicleServices as $vehicleService): ?>
				<tr>
					<td><?= $i;?></td>
				  <!--  <td><?= $vehicleService->has('vehicle') ? $this->Html->link($vehicleService->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $vehicleService->vehicle->id]) : '' ?></td> -->
					<td><?= h($vehicleService->vehicle->vehicle_no) ?></td>
					<td><?= h(@$vehicleService->driver->name) ?></td>
					<td><?= h($vehicleService->service_date) ?></td>
					<td><?= $this->Number->format($vehicleService->km) ?></td>
					<td><?= h($vehicleService->bill_no) ?></td>
					<td><?= $this->Number->format($vehicleService->amount) ?></td>
					<td><?= h($vehicleService->vendor->name)?></td>
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
   
<?= $this->element('datepicker') ?> 
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