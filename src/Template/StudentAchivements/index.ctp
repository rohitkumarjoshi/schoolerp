<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					<label> Edit Achivement </label>
				<?php }else{ ?>
				   <label> Add Achivement </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($studentAchivement,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-12">
							<label class="control-label"> Category <span class="required" aria-required="true"> * </span></label>
							<?= $this->Form->control('achivement_category_id', ['options'=>$achivementCategories,'label' => false, 'class'=>'select2','empty'=>'Select Category','style'=>'width:100%','required'])?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label class="control-label"> Achivement Type <span class="required" aria-required="true"> * </span></label>
							 <?= $this->Form->control('achivement_type', ['options'=>$types,'label' => false, 'class'=>'select2','empty'=>'Select Type','style'=>'width:100%'])?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label class="control-label"> Student Name <span class="required" aria-required="true"> * </span></label>
							 <?= $this->Form->control('student_id', ['options'=>$students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%','required'])?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<label class="control-label"> Achivement Date <span class="required" aria-required="true"> * </span></label>
							<?php echo $this->Form->control('achivement_date',[
							'label' => false,'class'=>'form-control datepicker','placeholder'=>'DD-MM-YYYY','type'=>'text','data-date-format'=>'dd-mm-yyyy','required']);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
							<?php echo $this->Form->control('description',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter Description','type'=>'textarea','rows'=>2]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label class="control-label"> Rank </label>
							<?php echo $this->Form->control('rank',[
							'label' => false,'class'=>'form-control ','placeholder'=>'Enter rank','type'=>'text']);?>
						</div>
					</div>
					<?php if(!empty($id)){ ?>
					<br>
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
				<?php $page_no=$this->Paginator->current('sections'); $page_no=($page_no-1)*10; ?>
				<div class="table-responsive">
				<table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Category ') ?></th>
							<th scope="col"><?= __('Type ') ?></th>
							<th scope="col"><?= __('Student Name ') ?></th>
							<th scope="col"><?= __('Date ') ?></th>
							<th width="20%" scope="col"><?= __('Description ') ?></th>
							<th scope="col"><?= __('Rank ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($studentAchivements as $studentAchivements): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td >
							<?php echo $studentAchivements->achivement_category->name;?>
							</td> 
							<td >
							<?php echo $studentAchivements->achivement_type;?>
							</td>
							<td >
							<?php echo $studentAchivements->student->name;?>
							</td>
							<td>
							 <?php echo @$studentAchivements->achivement_date;?>
							</td>
							<td width="20%">
							<?php echo $studentAchivements->description;?>
							</td>
							<td >
							<?php echo @$studentAchivements->rank;?>
							</td>
							<td >
								<?php
							if($studentAchivements->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($studentAchivements->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Section', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Section']) ?>
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

<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
       
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