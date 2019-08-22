
<div class="box box-primary">
	<div class="box-header with-border"> 
		<label > <?= @$title ?></label>
		<!-- <div class="box-tools pull-right">
			<h3 class="box-title" style="padding:5px;color:gray;"><i class="fa fa-filter" data-target="#demo" data-toggle="collapse" aria-expanded="false" ></i></h3>
		</div> -->
	</div>
	<div class="box-body" >
		<div class="row">
			<div class="col-md-12">
				  <?= $this->Form->create(' ',['id'=>'ServiceForm','type'=>'get']) ?>
							<div class="col-md-12 " >
								<div class="row"> 
									 <div class="col-md-3">
										<label class="control-label">Search By Vehicle</label>
										<?= $this->Form->control('vehicle_no', ['options' => $vehicles_list,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'All Vehicle','dataplaceholder'=>'Select Vehicle'])?>
									</div>
									<div class="col-md-1">
									<label class="control-label" style="visibility: hidden;">Search</label>
									<?php echo $this->Form->button('Go',['class'=>'btn btn-sm button','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'height:38px;']); ?> 
									</div>
									<!-- <div class="col-md-1">
										<label class="control-label"  style=" visibility: hidden;">Search</label>
										  <?= $this->Html->link(__('Reset '), ['action' => 'index'],['class'=>'btn btn-danger btn-sm','escape'=>false, 'data-widget'=>'Home', 'data-toggle'=>'tooltip', 'data-original-title'=>'Home','style'=>'margin-top: 0px;color:white !important;margin-left:20px;']) ?>
									</div> -->
								 <!-- <div class="col-md-3">
										<label class="control-label">Search By Name</label>
										<?php //echo $this->Form->control('name',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Full Name']);?>
									</div> 
									<div class="col-md-1">
										<label class="control-label"  style="    visibility: hidden;">Search</label>
										 <?php //echo $this->Form->button('Go',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report','value'=>'yes']); ?> 
									</div>  -->
								  
								</div>
							</div>
				  <?= $this->Form->end() ?>
				
			</div>
		</div>
		<br>
		
	  <?php if($data_exist=='data_exist') { ?>
		<?php $page_no=$this->Paginator->current('Vehicles'); $page_no=($page_no-1)*20; ?>
		<div class="row">
			<div class="col-md-12">

				<div class="box box-primary">
				   
					<div class="box-body table-responsive content-scroll" style="width: 100% !important;">
						<table class="table ">
						 <thead>
							<tr style="white-space: nowrap;">
								<th>#</th>
								<th>Vehicle No</th>
								<th>Color</th>
								<th>Modal No</th>
								<th>Engine No</th>
								<th>Chasis No</th>
								<th>Insurance Expiry</th>
								<th>POC Expiry</th>
								<th>Permit Expiry</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; foreach ($vehicles as $key => $vehicle): $i++;?>
								<tr>
									<td> <?php echo $i; ?></td>
									<td><?= h($vehicle->vehicle_no).' ('.$vehicle->vehicle_name.')'?> </td>
									<td><?= h($vehicle->color) ?> </td>
									<td><?= h($vehicle->model_no) ?> </td>
									<td><?= h($vehicle->engine_no) ?> </td>
									<td><?= h($vehicle->chasis_no) ?> </td>
									<td><?= h($vehicle->insurance_expiry_date); ?></td>
									<td><?= h($vehicle->poc_expiry_date); ?></td>
									<td><?= h($vehicle->permit_expiry_date); ?></td>
									<td>
									<?php
									if($vehicle->is_deleted=='Y')
									{
										echo 'Deactive';
									}
									else{
										echo 'Active';
									}
									?>
									</td>
									 <td> 
										<?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($vehicle->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Vehicle', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Vehicle']) ?>
										<?= $this->Html->link(__('<i class="fa fa-eye"></i>'), ['action' => 'view', $EncryptingDecrypting->encryptData($vehicle->id)],['class'=>'btn viewbtn btn-xs','escape'=>false, 'data-widget'=>'View', 'data-toggle'=>'tooltip', 'data-original-title'=>'View']) ?> </td>
									<!--<td class="gallery" style="text-align:center;">
										<?php
									   // if(!empty($vehicle->vehicle_photo)){
											?>
											<?php //echo $this->Html->image($vehicle->vehicle_photo,['class'=>'img-responsive img-circle','style'=>"height:50px;width:55px"])?>
											<?php
									   // }
										?>
										
									</td>-->
								   
								</tr>
							<?php endforeach; ?>
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