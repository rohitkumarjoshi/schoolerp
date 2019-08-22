<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border">
				<label> Promote Due Fees </label>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create('',['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Select Promote Session <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('next_session_year_id', ['options' => $sessionYears,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Select Classes <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('student_class_id', ['options' => $studentClasses,'class'=>'select2','style'=>'width:100%','label'=>false,'multiple'=>true]);?>
						</div>
					</div>
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
</div>

<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            next_session_year_id: {
                required: true
            },
            'student_class_id[]': {
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