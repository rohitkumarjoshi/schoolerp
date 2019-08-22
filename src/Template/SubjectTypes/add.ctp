<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>

<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
				 <label > Edit Subject Type </label>
				<?php }else{ ?>
				 <label> Add Subject Type </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
					<?= $this->Form->create($subjectType,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Name<span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('name',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text','id'=>'txtFirstName']);?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Details<span class="required" aria-required="true">* </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('details',['label' => false,'class'=>'form-control ','type'=>'text','id'=>'txtFirstName']);?>
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
								<?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'class'=>' select2 selectState','style'=>'width:100%')) ?>
							</div>
						</div>
					</div>
					<?php } ?>
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
					<?= $this->Form->end()?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="box box-primary">
			<div class="box-header with-border">
				<label>View List </label>
			</div> 
			<div class="box-body">
				<table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No')?></th>
							<th scope="col"><?= __('Name ')?></th>
							<th scope="col"><?= __('Details ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
					<?php  $x=0; foreach($subjectTypes as $subjectType){?>
						<tr>
							<td><?= ++$x; ?></td>
							<td><?= h($subjectType->name)?></td>
							<td><?= h($subjectType->details)?></td>
							<td>
							<?php
							if($subjectType->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'add', $EncryptingDecrypting->encryptData($subjectType->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Subject Type', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Subject Type']) ?>
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>
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
	$(function() {
		$('#txtFirstName').keydown(function(e) {
		  if (e.shiftKey || e.ctrlKey || e.altKey) {
			e.preventDefault();
		  } else {
			var key = e.keyCode;
			if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
			  e.preventDefault();
			}
		  }
		});
	});

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?>  
