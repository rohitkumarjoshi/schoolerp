<style type="text/css">
th,td{
	border:0px !important;
	
}
.row{
	font-weight: 700 !important;
}
</style>
<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
  <div class="box box-primary">
				<div class="box-header with-border"> 
					<h3 class="box-title" > <?= @$title ?> of ( <?= h($vehicle->vehicle_no) ?> )</h3>
				</div>
                <div class="box-body" >
					<table class="table" >
						<tr >
							<th class="row" ><?= __(' Type') ?> :</th>
							<td><?= h($vehicle->vehicle_type) ?> ( <?= h($vehicle->fuel_type) ?> )</td>
							<th class="row"><?= __(' Company') ?> :</th>
							<td><?= h($vehicle->vechicle_company) ?></td>
							<th class="row"><?= __('City Of Registraion') ?> :</th>
							<td><?= h($vehicle->city_reg) ?></td>
							</tr>
							<tr>
							<th class="row"><?= __('Model No') ?> :</th>
							<td><?= h($vehicle->model_no) ?></td>
							<th class="row"><?= __('Engine No') ?> :</th>
							<td><?= h($vehicle->engine_no) ?></td>
							<th class="row"><?= __('Condition') ?> :</th>
							<td><?= h($vehicle->vehicle_condition) ?></td>
							</tr>
						<tr>
							<th class="row"><?= __('Manufacturing Year ') ?> :</th>
							<td><?= h($vehicle->year_manufacturing) ?></td>
							<th class="row"><?= __('Color') ?> :</th>
							<td><?= h($vehicle->color) ?></td>
							<th class="row"><?= __('Chasis No') ?> :</th>
							<td><?= h($vehicle->chasis_no) ?></td>
						</tr>
						
						<tr>
							<th class="row"><?= __('Insurance Date') ?> :</th>
							<td><?= h($vehicle->insurance_date) ?></td>
							<th class="row"><?= __('Insurance Expiry Date') ?> :</th>
							<td><?= h($vehicle->insurance_expiry_date) ?></td>
							<th class="row"><?= __('Insurance Doc') ?> :</th>
							<td>
									<a> 
										<?php
										if(!empty($vehicle->insurance_doc))
										{
											echo $this->Html->image($cdn_path.'/'.$vehicle->insurance_doc,['class'=>'img-responsive','style'=>'height:100px;width:100px;']);
										}
										?>
									 </a>
							</td>
						</tr>
							<tr>
							
							<th class="row"><?= __('Poc Date') ?> :</th>
							<td><?= h($vehicle->poc_date) ?></td>
							<th class="row"><?= __('Poc Expiry Date') ?> :</th>
							<td><?= h($vehicle->poc_expiry_date) ?></td>
							<th class="row"><?= __('Poc Doc') ?> :</th>
							<td>
								<a> 
									<?php
									if(!empty($vehicle->poc_doc))
									{
										echo $this->Html->image($cdn_path.'/'.$vehicle->poc_doc,['class'=>'img-responsive','style'=>'height:100px;width:100px;']);
									}
									?>
								 </a>
							</td>
						</tr>
						
						<tr>
							<th class="row"><?= __('Permit Date') ?> :</th>
							<td><?= h($vehicle->permit_date) ?></td>
							<th class="row"><?= __('Permit Expiry Date') ?> :</th>
							<td><?= h($vehicle->permit_expiry_date) ?></td>
							<th class="row"><?= __('Permit Doc') ?> :</th>
							<td>
								<a> 
									<?php
									if(!empty($vehicle->permit_doc))
									{
										echo $this->Html->image($cdn_path.'/'.$vehicle->permit_doc,['class'=>'img-responsive','style'=>'height:100px;width:100px;']);
									}
									?>
								 </a>
							</td>
						</tr>
					</table>
				</div>
