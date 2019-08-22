<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					<i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Religion </label>
				<?php }else{ ?>
					<i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Add Religion </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
					<?= $this->Form->create($religion,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Name <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
							<?php echo $this->Form->control('name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text']);?>
						</div>
					</div>
					<?php if(!empty($id)){ ?>
					<br>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Status </label>
						</div>
						<div class="col-md-8">
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
										<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','id'=>'submit_member']); ?>
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
				<?php $page_no = $this->Paginator->counter(['format' => __('{{page}}')]); ?>
                <?php $page_no=($page_no-1)*20; ?>
				 <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Name ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($Religions as $religion): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td width="25%"><?php echo $religion->name;?></td>
							<td>
							<?php
							if($religion->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil-square-o"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($religion->id)],['class'=>'btn btn-info btn-xs','escape'=>false, 'data-widget'=>'Edit Religion', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Religion']) ?>
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
			service: {
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