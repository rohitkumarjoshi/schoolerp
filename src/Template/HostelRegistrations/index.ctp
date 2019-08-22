<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
				<label > Edit Hostel Registration </label>
				<?php }else{ ?>
				 <label> Add Hostel Registration </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($hostelRegistration,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Student <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
						   <?= $this->Form->control('student_id', ['options' => $students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%','required'])?>
						</div>
					</div> 
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Hostel <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
						   <?= $this->Form->control('hostel_id', ['options' => $hostels,'label' => false, 'class'=>'select2','empty'=>'Select Hostel','style'=>'width:100%','required'=>true,'id'=>'hostel_id'])?>
						</div>
					</div>
					 <div class="row">
						<div class="col-md-11">
							<label class="control-label"> Room <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11" id="room_no">
						   <?= $this->Form->control('room_id', ['options' => $rooms,'label' => false, 'class'=>'select2','empty'=>'Select Room','style'=>'width:100%','required'])?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label">Registration Date <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?= $this->Form->control('registration_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','default'=>date('d-M-Y'),'required'])?>
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
				<label> View List </label>
			</div> 
			<div class="box-body">
				<?php $page_no=$this->Paginator->current('Hostels'); $page_no=($page_no-1)*10; ?>
				 <table id="example1" class="table" >
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Student ') ?></th>
							<th scope="col"><?= __('Hostel') ?></th>
							<th scope="col"><?= __('Room') ?></th>
							<th scope="col"><?= __('Reg. No') ?></th>
							<th scope="col"><?= __('Reg. Date') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($hostelRegistrations as $hostelRegistration): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td >
							<?php echo $hostelRegistration->student->name;?>
							</td> 
							<td >
							<?php echo $hostelRegistration->hostel->hostel_name;?>
							</td>
							<td >
							<?php echo $hostelRegistration->room->room_no;?>
							</td>
							<td >
							<?php 
						   $count= strlen($hostelRegistration->registration_no);
							if($count<3){
							echo "000".$hostelRegistration->registration_no;
							}else
							 {
								echo $hostelRegistration->registration_no;
							}
						?>
							</td>
							 <td >
							<?php echo $hostelRegistration->registration_date;?>
							</td>
							<td>
							<?php
							if($hostelRegistration->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($hostelRegistration->id)],['class'=>'btn btn-info editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit registration', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit registration']) ?>
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
	$(document).on('change','#hostel_id',function(e){
		var hostel_id=$(this).val();
        var url = '".$this->Url->build(['controller'=>'HostelRegistrations','action'=>'getRoomno'])."';
        $.post(
            url, 
            {hostel_id: hostel_id}, 
            function(result) {
                $('#room_no').html(result);
                $('#room_no').find('select').select2();
        });

	});
	
    $('#ServiceForm').validate({ 
        rules: {
            registration_date: {
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
<?= $this->element('datepicker') ?> 

