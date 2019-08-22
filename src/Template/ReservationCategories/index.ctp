<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					<label > Edit Reservation Category </label>
				<?php }else{ ?>
					<label> Add Reservation Category </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
					<?= $this->Form->create($reservationCategory,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Full Name <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('full_name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Full Name','type'=>'text']);?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Short Name <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('short_name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Short Name','type'=>'text']);?>
						</div>
					</div>
					<?php if(!empty($id)){ ?>
					<br>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Status</label>
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
				<?php $page_no = $this->Paginator->counter(['format' => __('{{page}}')]); ?>
        		<?php $page_no=($page_no-1)*20; ?>
				<table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Full Name ') ?></th>
							<th scope="col"><?= __('Short Name ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($ReservationCategories as $ReservationCategory): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td width="25%"><?= h($ReservationCategory->full_name) ?></td>
							<td width="25%"><?= h($ReservationCategory->short_name) ?></td>
							<td>
							<?php
							if($ReservationCategory->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($ReservationCategory->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Reservation Category', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Reservation Category']) ?>
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
			full_name: {
				required: true
			},
			short_name: {
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