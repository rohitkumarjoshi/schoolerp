<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
				 <label > Edit Class Mapping </label>
				<?php }else{ ?>
				 <label> Add Class Mapping </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($classMapping,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Medium<span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('medium_id', ['options' => $mediums,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('student_class_id', ['options' => $studentClasses,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Stream</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('stream_id', ['empty'=>'--- Select Stream ---','options' => $streams,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Section</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('section_id', ['empty'=>'--- Select Section ---','options' => $sections,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Class Teacher</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('employee_id', ['empty'=>'--- Select Class Teacher ---','options' => $employees,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
						</div>
					</div>
					<?php if(!empty($id)){ ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label">Status </label>
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
		                    <div class="col-sm-3">
		                        <div class="form-group">
		                            <label>Medium</label>
		                            <?php echo $this->Form->control('medium_id', ['empty'=>'---Select---','options' => $mediums,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$medium_id]);?>
		                        </div>
		                    </div>
		                    <div class="col-sm-3">
		                        <div class="form-group">
		                            <label>Class</label>
		                            <?php echo $this->Form->control('student_class_id', ['empty'=>'---Select---','options' => $studentClasses,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$student_class_id]);?>
		                        </div>
		                    </div>
		                    <div class="col-sm-3">
		                        <div class="form-group">
		                            <label>Stream</label>
		                            <?php echo $this->Form->control('stream_id', ['empty'=>'---Select---','options' => $streams,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$stream_id]);?>
		                        </div>
		                    </div>
		                    <div class="col-sm-3">
		                        <div class="form-group">
		                            <label>Section</label>
		                            <?php echo $this->Form->control('section_id', ['empty'=>'---Select---','options' => $sections,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$section_id]);?>
		                        </div>
		                    </div>
		                    <div class="col-sm-4">
		                        <div class="form-group">
		                            <label>Class Teacher</label>
		                            <?php echo $this->Form->control('employee_id', ['empty'=>'---Select---','options' => $employees,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$employee_id]);?>
		                        </div>
		                    </div>
		                    <div class="col-sm-3">
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
							<th scope="col"><?= __('Medium ') ?></th>
							<th scope="col"><?= __('Class ') ?></th>
							<th scope="col"><?= __('Stream ') ?></th>
							<th scope="col"><?= __('Section ') ?></th>
							<th scope="col"><?= __('Teacher ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($classMappings as $classMapping): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td><?php echo $classMapping->medium->name;?></td>
							<td><?php echo $classMapping->student_class->name;?></td>
							<td><?php echo @$classMapping->stream->name;?></td>
							<td><?php echo @$classMapping->section->name;?></td>
							<td><?php echo @$classMapping->employee->name;?></td>
							<td>
							<?php
							if($classMapping->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($classMapping->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Stream', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Stream']) ?>
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