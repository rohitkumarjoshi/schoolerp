<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label > Vehicle Routes </label>
				</div>	
				 <div class="row ">
					<div class="col-md-12">
					   <?= $this->Form->create($vehicle_route,['id'=>'ServiceForm','type'=>'get']) ?>
							<div class="col-md-3">
								<label class="control-label">Search By Vehicle</label>
								<?php echo $this->Form->control('data[vehicle_id]',['options' => $vehicles,
								'label' => false,'class'=>'select2','empty'=>'Select Vehicle','style'=>'width:100%;']);?>
							</div>
							 <div class="col-md-3">
								<label class="control-label">Search By Station</label>
								<?php echo $this->Form->control('data[vehicle_station_id]',['options' => $vehicleStations,
								'label' => false,'class'=>'select2','empty'=>'Select Station','style'=>'width:100%;']);?>
							</div> 
							<div class="col-md-1">
                                <label class="control-label"  style=" visibility: hidden;">Search</label>
                                    <?php echo $this->Form->button('Go',['class'=>'btn btn-md button filter','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'margin-top: 0px;color:white !important;height:38px;']); ?> 
                            </div>
						</div>
					</div>
					<?= $this->Form->end() ?>
				
				<?php if($data_exist=='data_exist') { ?>		
				<div class="box-body">
					<div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($vehicle_route,['autocomplete'=>'off','url'=>['action'=>'reportExport'],'target'=>'_blank']) ?>
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
                 <?php $page_no=$this->Paginator->current('vehicleRoutes'); $page_no=($page_no-1)*10; ?>  
				<div class="row"> 
                    <div class="col-md-12"> 
                        <table cellpadding="0" cellspacing="0" class="table">
					  <thead >
							<tr>
								<th scope="col">Sr.No</th>
								<th scope="col">Vehicle No</th>
								<th scope="col">Statation Name</th>
								<th scope="col">Pick-up Time</th>
								<th scope="col">Drop Time</th>
								<th scope="col">Station Order</th>
							</tr>
						</thead>
						<tbody>
						<?php 
								$i=1;foreach ($vehicleRoutes as $vehicleRoute): ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $vehicleRoute->has('vehicle') ? $vehicleRoute->vehicle->vehicle_no : '' ?></td>
								<td><?= h($vehicleRoute->vehicle_station->name) ?></td>
								<td><?= h($vehicleRoute->pickup_time) ?></td>
								<td><?= h($vehicleRoute->drop_time) ?></td>
								<td><?= $this->Number->format($vehicleRoute->station_order_by) ?></td>
								</tr>
							<?php $i++;endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		   <?php } else { ?>
	             <div class="row">
	                <div class="col-md-12 text-center">
	                    <h3> <?= $data_exist ?></h3>
	                </div>
	            </div>
	        <?php } ?>
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