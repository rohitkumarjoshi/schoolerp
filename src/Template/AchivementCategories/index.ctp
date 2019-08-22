<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					 <label > Edit Achivement Categories </label>
				<?php }else{ ?>
					 <label> Add Achivement Categories </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
					<?= $this->Form->create($achivementCategory,['id'=>'ServiceForm','type'=>'file']) ?>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Name <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text']);?>
						</div>
					</div>
					
					
					<?php if(!empty($id)){ ?>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Image</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('image_path_data',[
							'label' => false,'class'=>'','placeholder'=>'Enter Name','type'=>'file','accept'=>'image/x-png']);?>
						</div>
					</div>
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
					<?php }
					else{ ?>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Image <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('image_path_data',[
							'label' => false,'class'=>'','placeholder'=>'Enter Name','type'=>'file','accept'=>'image/x-png','required'=>true]);?>
						</div>
					</div>
					<?php
					} ?>
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
				<!--<?php $page_no=$this->Paginator->current('achivementCategories'); $page_no=($page_no-1)*10; ?>-->
				 <table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Name ') ?></th>
							<th scope="col"><?= __('Image ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($achivementCategories as $achivementCategorie): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td width="40%">
							<?php echo $achivementCategorie->name;?>
							</td>
							<td width="40%">
								<?= $this->Html->image($cdn_path.'/'.$achivementCategorie->image_path,['style'=>  'margin-top: 0px;height: 40px;align-content: center; background-color: #f9eded00 !important;width: 40px;']); ?> 
							</td>
							<td>
							<?php
							if($achivementCategorie->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($achivementCategorie->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Achivement Categorie', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Achivement Categorie']) ?>
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
			},
			image_path_data: {
				accept: 'image/png'
			}
		},
		messages: {
            image_path_data: { accept: 'Not an png image!'}
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