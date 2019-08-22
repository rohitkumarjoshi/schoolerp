
<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
				 <label > Edit Room </label>
				<?php }else{ ?>
				 <label> Add Room </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($room,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Hostle <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
						   <?= $this->Form->control('hostel_id', ['options' => $hostels,'label' => false, 'class'=>'select2','empty'=>'Select Hostel','style'=>'width:100%','required'])?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Room Number <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('room_no',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Room Number','type'=>'text']);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Room Capacity <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('room_capacity',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Room Capacity','type'=>'text']);?>
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
                <?= $this->Form->create('',['type'=>'get']) ?>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Hostel</label>
                                    <?php echo $this->Form->control('hostel_id', ['empty'=>'---Select---','options' => $hostels,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$hostel_id]);?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Room No.</label>
                                    <?php echo $this->Form->control('room_no', ['class'=>'form-control','label'=>false,'value'=>@$room_no]);?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?= $this->Form->label('Search', null, ['class'=>'control-label','style'=>'visibility: hidden;']) ?>
                                    <div class="input-icon right">
                                       <?= $this->Form->button(__('Search'),['class'=>'btn text-uppercase btn-success','name'=>'search','value'=>'search']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="box-body">
                <?php $page_no = $this->Paginator->counter(['format' => __('{{page}}')]); ?>
                <?php $page_no=($page_no-1)*10; ?>
				 <table id="example1" class="table" >
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Hostel Name ') ?></th>
							<th scope="col"><?= __('Room No ') ?></th>
							<th scope="col"><?= __('Capacity') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($rooms as $room): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td >
							<?php echo $room->hostel->hostel_name;?>
							</td>
							<td >
							<?php echo $room->room_no;?>
							</td>
							<td >
							<?php echo $room->room_capacity;?>
							</td>
							<td>
							<?php
							if($room->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($room->id)],['class'=>'btn btn-info editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit room', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit room']) ?>
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

