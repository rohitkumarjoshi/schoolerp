
<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					 <label > Edit Vendor </label>
				<?php }else{ ?>
					 <label> Add Vendor </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
					<?= $this->Form->create($vendor,['id'=>'ServiceForm']) ?>
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
							<label class="control-label">Address <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('address',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Address','type'=>'text']);?>
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
	<div class="col-md-7">
		<div class="box box-primary">
			<div class="box-header with-border">
				<label> View List </label>
			</div> 
			<div class="box-body">
				<!-- <?php $page_no=$this->Paginator->current('Vendors'); $page_no=($page_no-1)*20; ?> -->
				 <table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Name ') ?></th>
							<th scope="col"><?= __('Address') ?></th>
							<th scope="col"><?= __('Status') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($vendors as $vendor): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td>
							<?php echo $vendor->name;?>
							</td>
							<td>
							<?php echo $vendor->address;?>
							</td>
							<td>
							<?php
							if($vendor->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
						<td class="actions">
							  
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'add', $EncryptingDecrypting->encryptData($vendor->id)],['class'=>'btn btn-info editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit Vehicle', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Vehicle']) ?>
									</td>
							</tr>
					<?php $i++; endforeach; ?>
					</tbody>
			</table>
			<!-- </div>
			<div class="box-footer">
				<?= $this->element('pagination') ?> 
			</div> -->
		</div>
	</div>
</div>
<?= $this->element('validate') ?> 
<script>
$(document).ready(function() {
	// validate signup form on keyup and submit
	 $("#ServiceForm").validate({ 
		rules: {
			name: {
				required: true
			},
			address: {
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
<?= $this->element('selectpicker') ?> 