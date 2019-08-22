<div class="row">
    <div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
				 <label> Edit Student Siblings </label>
				<?php }else{ ?>
				 <label> Add Student Siblings</label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($studentSibling,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Student :<span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
						   <?= $this->Form->control('student_id', ['options'=>$students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%','required'])?>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Sibling :<span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
						   <?= $this->Form->control('sibling_id', ['options'=>$siblings,'label' => false, 'class'=>'select2','empty'=>'Select Sibling','style'=>'width:100%','required'])?>
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
				<?php $page_no=$this->Paginator->current('StudentSiblings'); $page_no=($page_no-1)*20; ?> 
				<table id="example1" class="table" style="border-collapse:collapse;">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Student Name') ?></th>
							<th scope="col"><?= __('Sibling Name') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($studentSiblings as $studentSibling): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td>
							<?php echo $studentSibling->student->name;?>
							</td>
							<td>
							<?php echo $studentSibling->sibling->name;?>
							</td>
							<td class="actions">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($studentSibling->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Vehicle', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Vehicle']) ?>
							</td>
						</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
			</div>
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