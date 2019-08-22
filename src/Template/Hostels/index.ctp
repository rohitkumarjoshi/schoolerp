<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
				 <label > Edit hostel </label>
				<?php }else{ ?>
				 <label> Add hostel </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($hostel,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Hostel Name <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('hostel_name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Hostel Name','type'=>'text','required']);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Warden <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
						   <?= $this->Form->control('warden_id', ['options' => $wardens,'label' => false, 'class'=>'select2','empty'=>'---Select Warden---','style'=>'width:100%','required'])?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label">Assistant Warden </label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
						   <?= $this->Form->control('assistant_warden_id', ['options' => $assistantWardens,'label' => false, 'class'=>'select2','empty'=>'---Select Assistant Warden---','style'=>'width:100%'])?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> No of Rooms<span class="required" aria-required="true"> * </span></label>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('no_of_rooms',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Number of Rooms','type'=>'text']);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Address <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('address',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Address','type'=>'text']);?>
						</div>
					</div>
					<?php if(!empty($id)){ ?>
					<br>
					<div class="row">
						<div class="col-md-11">
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
	<div class="col-md-7">
		<div class="box box-primary">
			<div class="box-header with-border">
				<label> View List</label>
			</div> 
			<div class="box-body">
				<?php $page_no=$this->Paginator->current('Hostels'); $page_no=($page_no-1)*10; ?>
				<table id="example1" class="table" >
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Name ') ?></th>
							<th scope="col"><?= __('Warden ') ?></th>
							<th scope="col"><?= __('Assistant Warden ') ?></th>
							<th scope="col"><?= __('Rooms ') ?></th>
							<th scope="col"><?= __('Address ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($hostels as $hostel): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td >
							<?php echo $hostel->hostel_name;?>
							</td>
							<td >
							<?php echo $hostel->warden->name;?>
							</td>
							<td >
							<?php echo @$hostel->assistant_warden->name;?>
							</td>
							 <td >
							<?php echo $hostel->no_of_rooms;?>
							</td>
							 <td >
							<?php echo $hostel->address;?>
							</td>
							<td>
							<?php
							if($hostel->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($hostel->id)],['class'=>'btn btn-info editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit hostels', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit hostels']) ?>
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

