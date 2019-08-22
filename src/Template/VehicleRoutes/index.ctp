<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
					 <label > Vehicle Routes </label>
				   <!--  <div class="box-tools pull-right">
					<h3 class="box-title" style="padding:5px;color:gray;"><i class="fa fa-filter" data-target="#demo" data-toggle="collapse" aria-expanded="false" ></i></h3>
					</div> -->
			</div>
			  <div class="box-body" >
					<div class="row ">
					<div class="col-md-12">
						
						   <?= $this->Form->create(' ',['id'=>'ServiceForm']) ?>
									<div class="col-md-12 " >
										<div class="row"> 
											<div class="col-md-3">
												<label class="control-label">Search By Vehicle</label>
											   <?= $this->Form->control('vehicle_id', ['options' => $vehicles,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Vehicle','dataplaceholder'=>'Select Vehicle'])?>
											</div>
											<div class="col-md-3">
												<label class="control-label">Search By Station</label>
												<?php echo $this->Form->control('vehicle_station_id',['options' => $vehicleStations,
												'label' => false,'class'=>'select2','empty'=>'Select Station','style'=>'width:100%;']);?>
											</div> 
											<div class="col-md-1">
												<label class="control-label" style="visibility: hidden;">Search</label>
												 <?php echo $this->Form->button('Go',['class'=>'btn btn-sm button','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'margin-top: 0px;height:38px']); ?>

											</div> 
										</div>
									<?= $this->Form->end() ?>
								
							</div>
						</div>
					<br></br>
					<?php if($data_exist=='data_exist') { ?>
						<div class="col-md-12">
					<table cellpadding="0" cellspacing="0" class="table">
					  <thead style="background-color: #21898e;color: #f1f2f3;">
							<tr>
								<th scope="col">sr</th>
								<th scope="col">Vehicle No</th>
								<th scope="col">Statation Name</th>
								<th scope="col">Pick-up Time</th>
								<th scope="col">Drop Time</th>
								<th scope="col">Station Order</th>
								<th scope="col" class="actions"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php 
									$i=1;foreach ($vehicleRoutes as $vehicleRoute): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= $vehicleRoute->has('vehicle') ? $vehicleRoute->vehicle->vehicle_no : '' ?></td>
									<td><?= $vehicleRoute->has('vehicle_station') ? $vehicleRoute->vehicle_station->name : '' ?></td>
									<td><?= h($vehicleRoute->pickup_time) ?></td>
									<td><?= h($vehicleRoute->drop_time) ?></td>
									<td><?= $this->Number->format($vehicleRoute->station_order_by) ?></td>
									<td class="actions">
											<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'edit', $EncryptingDecrypting->encryptData($vehicleRoute->vehicle_id)],['class'=>'btn btn-info editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit Vehicle', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Vehicle']) ?>
									</td>
								</tr>
							<?php $i++;endforeach; ?>
						</tbody>
					</table>
				</div>
				  <?php } else {  ?>
					 <div class="row text-center">
						 <h3> <?= $data_exist ?></h3>
					</div> 
			<?php } ?>
			</div>
			<div class="box-footer">
			</div>
		</div>
	</div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>