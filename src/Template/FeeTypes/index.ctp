<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
				<label > Edit Fee Types </label>
				<?php }else{ ?>
				<label> Add Fee Types </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($feeType,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Fee Category <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('fee_category_id', ['options' => $feeCategories,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Fee Type</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('name',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Fee Type','type'=>'text']);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Fee Type Role</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('fee_type_role_id', ['empty'=>'---Select Role','class'=>'select2','style'=>'width:100%','label'=>false]);?>
						</div>
					</div>
					<?php if(!empty($id)){ ?>
					<div class="row">
						<div class="col-md-4">
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
                                    <label>Fee Category</label>
                                    <?php echo $this->Form->control('fee_category_id', ['empty'=>'---Select---','options' => $feeCategories,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$fee_category_id]);?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Fee Type</label>
                                    <?= $this->Form->control('name',['label'=>false,'class'=>'form-control','placeholder'=>'Name','value'=>@$name]); ?>
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
				 <table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Fee Category ') ?></th>
							<th scope="col"><?= __('Fee Type ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($feeTypes as $feeType): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td><?php echo $feeType->fee_category->name;?></td>
							<td><?php echo $feeType->name;?></td>
							<td>
							<?php
							if($feeType->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($feeType->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Fee Type', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Fee Type']) ?>
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
            fee_category_id: {
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