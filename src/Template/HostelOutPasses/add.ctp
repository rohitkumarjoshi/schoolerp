<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
					<label><?= __('Add Hostel Out Pass') ?></label>
			</div>
			<div class="box-body">
				<div class="form-group">
					<?= $this->Form->create($hostelOutPass,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">                         
							<div class="form-group">
								<div id="datetimepicker1">
									<label class="control-label">Student
										<span class="required" style="color: red;">*</span>
									</label>
									<?= $this->Form->control('student_id', ['options'=>$students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%'])?>
								</div>
							</div>
						</div>
						<div class="col-md-4">  
							<div class="form-group">
								<label class="control-label"> Date Range
										<span class="required" style="color: red;">*</span>
									</label>
								<div class="input-group">
			                        <div class="input-group-addon">
			                            <i class="fa fa-calendar"></i>
			                        </div>
			                        <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepickermin','label'=>false,'required'=>true,'placeholder'=>'Date range','readonly'=>true]) ?>
			                    </div>
							</div>     
						</div> 
						<div class="col-md-4">                         
							<div class="form-group">
								<div id="datetimepicker1">
									<label class="control-label"> Out Time
										<span class="required" style="color: red;">*</span>
									</label>
									<div class="bootstrap-timepicker">
										<?php echo $this->Form->control('out_time',[
										'label' => false,'class'=>'form-control timepicker','type'=>'text']);?>
									</div>
								</div>
							</div>
						</div> 
					</div>
					<div class="row">
					   <div class="col-md-4">                         
							<div class="form-group">
								<div id="datetimepicker1">
									<label class="control-label"> In Time
										<span class="required" style="color: red;">*</span>
									</label>
									<div class="bootstrap-timepicker">
										<?php echo $this->Form->control('in_time',[
										'label' => false,'class'=>'form-control timepicker','type'=>'text']);?>
									</div>
								</div>
							</div>
						</div> 
					   <!--  <div class="col-md-4">                         
							<div class="form-group">
								<div id="datetimepicker1">
									<label> Status
										<span class="required" style="color: red;">*</span>
									</label>
									  <?php // $this->Form->control('status', ['options'=>$status,'label' => false, 'class'=>'select2','empty'=>'Select Status','style'=>'width:100%'])?>
								</div>
							</div>
						</div>  -->
					</div>
				</div>
			</div>
			<div class="box-footer">
				<div class="row">
					<center>
						<div class="col-md-12">
							<div class="col-md-offset-3 col-md-6">  
								<?php echo $this->Form->button('Submit',['class'=>'btn button submit','id'=>'submit_member']); ?>
							</div>
						</div>
					</center>       
				</div>
			</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>

<?= $this->element('selectpicker') ?> 
<?= $this->element('daterangepicker') ?>
<?= $this->element('timepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
	 
        $('#ServiceForm').validate({ 
        rules: {
            vehicle_id: {
                required: true
            },
            student_id: {
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
