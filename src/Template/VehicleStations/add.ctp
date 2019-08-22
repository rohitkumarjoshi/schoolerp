<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					<label > Edit Vehicle Station </label>
				<?php }else{ ?>
					 <label> Add Vehicle Station </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
					<?= $this->Form->create($vehicleStation,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Name <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text']);?>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Latitude <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('latitude',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Latitude','type'=>'text']);?>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">longitude <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('longitude',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Longitude','type'=>'text']);?>
						</div>
					</div>
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
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
			</div> 
			<div class="box-body">
				<!--<?php $page_no=$this->Paginator->current('vehicleStations'); $page_no=($page_no-1)*20; ?>-->
				 <table id="example1" class="table " >
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Name ') ?></th>
							<th scope="col"><?= __('Latitude') ?></th>
							<th scope="col"><?= __('longitude') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($vehicleStations as $vehicleStation): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td>
							<?php echo $vehicleStation->name;?>
							</td>
							<td>
							<?php echo $vehicleStation->latitude;?>
							</td>
							<td>
							<?php echo $vehicleStation->longitude;?>
							</td>
						<td class="actions">
										<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'add', $EncryptingDecrypting->encryptData($vehicleStation->id)],['class'=>'btn btn-info editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit Vehicle', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Vehicle']) ?>

										<?php //echo  $this->Form->postLink(__('Delete'), ['action' => 'delete', $vehicleStation->id], ['confirm' => __('Are you sure you want to delete # '.$i.' ?', $vehicleStation->id),'class'=>'btn btn-danger btn-xs']) ?>
										<a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $vehicleStation->id; ?>" data-toggle="modal"> <i class="fa fa-trash-o"></i></a>
									<div id="deletemodal<?php echo $vehicleStation->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
									<?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'VehicleStations','action'=>'delete',$vehicleStation->id]]) ?>
											<div class="modal-content">
											  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title" >
													Confirm Header
													</h4>
												</div>
												<div class="modal-body">
												<h4 class="modal-title">
													Are you sure you want to remove this vehicle Station?
													</h4>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn  btn-sm btn-info">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										<?= $this->Form->end() ?>
									</div>
								</div>
									</td>
							</tr>
					<?php $i++; endforeach; ?>
					</tbody>
			</table>
			<!-- <div class="box-footer">
				<?= $this->element('pagination') ?> 
			</div> -->
			</div>
		</div>
	</div>
</div>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() {
	// validate signup form on keyup and submit
	 $("#ServiceForm").validate({ 
		rules: {
			service: {
				required: true
			}
		},
		submitHandler: function () {
			$("#submit_member").attr('disabled','disabled');
			form.submit();
		}
	}); 

});
</script>