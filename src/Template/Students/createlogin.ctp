<div class="row">
	
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				 <label> Credential List </label>
			</div> 
			<div class="box-body">
		        <?= $this->Form->create('',['type'=>'get']) ?>
		            <div class="form-body hide_print">
		                <div class="row">
		                    
		                    <div class="col-sm-3">
		                        <div class="form-group">
		                            <label>Class</label>
		                            <?php echo $this->Form->control('student_class_id', ['empty'=>'---Select---','options' => $studentClasses,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$student_class_id]);?>
		                        </div>
		                    </div>
		                   
		                    <div class="col-sm-3">
		                        <div class="form-group">
		                            <label>Section</label>
		                            <?php echo $this->Form->control('section_id', ['empty'=>'---Select---','options' => $sections,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$section_id]);?>
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
		        <div class="pull-right box-tools">
                        <a href="javascript:window.print();" class="btn bg-maroon hide_print" style="color:#fff !important;padding-bottom: 10px;">Print</a> 
					
				</div>
				
				<table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Name') ?></th>
							<th scope="col"><?= __('Father Name') ?></th>
							<th scope="col"><?= __('Mother Name') ?></th>
							<th scope="col"><?= __('Username') ?></th>
							<th scope="col"><?= __('Password') ?></th>
							
						</tr>
					</thead>
					<tbody>
						<?php $i=0;  foreach ($StudentInfosnew as $StudentInfo): ?>
						<tr>
							<td><?php echo ++$i;?></td>
							<td><?php echo $StudentInfo->student->name;?></td>
							<td><?php echo $StudentInfo->student->father_name;?></td>
							<td><?php echo @$StudentInfo->student->mother_name;?></td>
							<td><?php echo @$StudentInfo->user->username;?></td>
							<td><?php echo @$StudentInfo->user->passwordnew;?></td>
							
						</tr>
					<?php  endforeach; ?>
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

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 