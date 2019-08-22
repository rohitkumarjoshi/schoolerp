<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					 <label > Edit Vehicle Check-In</label>
				<?php }else{ ?>
					 <label>  Vehicle Check-In </label>
				<?php } ?>
			</div>
			<div class="box-body">
				
				<div class="form-group">   
					<div class="row">
					<div class="col-md-4">
						<label class="control-label"> Vehicle Type: </label>
					</div>
					<div class="col-md-8" style="display: contents;">
						 <?php
						if(!empty($vehicleInOut->vehicle_no))
						{
							$other_is='Checked';
							$other_div='';
							$campus_div='hidden';
							$campus_is='';
						}
						else
						{
							$campus_is='Checked';
							$campus_div='';
							$other_div='hidden';
							$other_is='';
						}
						?>
						<label class="radio-inline" >
							<input type="radio" id="campus" value="campus" name="whom_to_meet" <?= $campus_is ?>  > Campus
						</label>
						<label class="radio-inline" >
							<input type="radio" id="other" value="other" name="whom_to_meet" <?= $other_is ?> > Out Of Campus
						</label>
					</div>
				</div> 
					<?= $this->Form->create($vehicleInOut,['id'=>'ServiceForm']) ?>
					<div class="row other <?= $other_div ?>">
						<div class="col-md-4">
							<label class="control-label"> Vehicle No <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?= $this->Form->control('vehicle_no',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Vehicle Number','type'=>'text','id'=>'vehicle_no']) ?>
						</div>
					</div><br>
					<div class="row campus <?= $campus_div ?>">
						<div class="col-md-4">
							<label class="control-label"> Vehicle No <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?= $this->Form->control('vehicle_id', ['options' => $vehicles, 'empty' => '--Select--','class'=>'select2','label'=>false,'id'=>'vehicle_id','required','style'=>'width:100%']);?>
						</div>
					</div><br>
					<div class="row ">
						<div class="col-md-4">
							<label class="control-label"> Remarks <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?php echo $this->Form->control('remarks',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Remarks','type'=>'textarea','style'=>'resize:none;','required'=>true]);?>
						</div>
					</div>
					 <?php if(!empty($id)){ ?>
					<br>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Status <span class="required" aria-required="true"> * </span></label>
						</div>
					   <div class="col-md-8">
							   <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
						</div>
					</div> 
					<?php } ?>
				</div>
			</div>
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
	<div class="col-md-7">
		<div class="box box-primary">
			<div class="box-header with-border">
				<label>View List </label>
				<!-- <div class="box-tools pull-right">
					<h3 class="box-title" style="padding:5px;color:gray;"><i class="fa fa-filter" data-target="#demo" data-toggle="collapse" aria-expanded="false" ></i></h3>
				</div> -->
			</div> 
			<div class="box-body">
				<?php $page_no=$this->Paginator->current('VehicleInOuts'); $page_no=($page_no-1)*20; ?>
				<table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Vehicle ') ?></th>
							<th scope="col"><?= __('In Time') ?></th>
							<th scope="col"><?= __('Out Time') ?></th>
							<th scope="col"><?= __('Remarks') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						//pr($vehicleInOuts->toArray());exit;
						$i=1; foreach ($vehicleInOuts as $vehicleInOut): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td>
								<?php
								if(!empty($vehicleInOut->vehicle_no)) 
									{
										echo $vehicleInOut->vehicle_no;
									}else {
									echo $vehicleInOut->vehicle->vehicle_no;
									} ?>
							</td> 
							<td>
								<?php echo date('d-M-Y',strtotime($vehicleInOut->in_date)).' , '.date('h:i:s A',strtotime($vehicleInOut->in_time));?>
							</td>
							<td>
								<?php  
								echo $result = ($vehicleInOut->out_time != '') ? date('d-M-Y',strtotime($vehicleInOut->out_date)).', '.date('h:i:s A',strtotime($vehicleInOut->out_time)): '';
									?>
							</td>
							<td>
								<?php echo $vehicleInOut->remarks;?>
							</td>
							<td class="actions">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'add', $EncryptingDecrypting->encryptData($vehicleInOut->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Vehicle', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Vehicle']) ?>
									   
								<a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $vehicleInOut->id; ?>" data-toggle="modal"> <i class="fa fa-sign-out"></i></a>
								</td>
								<div id="deletemodal<?php echo $vehicleInOut->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
									<?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'VehicleInOuts','action'=>'checkout',$EncryptingDecrypting->encryptData($vehicleInOut->id)]]) ?>
											<div class="modal-content">
												<div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title" >
														Confirm Header
														</h4>
												</div>
												<div class="modal-body">
													<h4 class="modal-title">
														Are you sure you want to Checked Out this vehicle?
													</h4>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn  btn-sm btn-primary">Yes</button>
													<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										<?= $this->Form->end() ?>
									</div>
								</div>
							
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
<?= $this->element('selectpicker') ?> 
<?= $this->element('icheck') ?> 
<?= $this->element('validate') ?> 
<?= $this->Html->script('/assets/js/plugins/fileinput/fileinput.min.js',['block'=>'fileinputjs']) ?>

<?php
$js="
$(document).ready(function(){

        $('#campus').on('ifChecked', function () {
                $('.other').addClass('hidden');
                $('.campus').removeClass('hidden');
                $('#vehicle_id').attr('required','required');
                $('#vehicle_no').removeAttr('required');
        });

        $('#other').on('ifChecked', function () {
                $('.campus').addClass('hidden');
                $('.other').removeClass('hidden');
                $('#vehicle_no').attr('required','required');
                $('#vehicle_id').removeAttr('required');
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

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>