<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
					<label > Edit Red Diaries </label>
				<?php }else{ ?>
					<label> Add Red Diaries </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($studentRedDiary,['id'=>'ServiceForm']) ?>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Student :<span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
						   <?= $this->Form->control('student_id', ['options'=>$students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%','required'])?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Punished Date <span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                  <?= $this->Form->control('form_to_date',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range','readonly'=>true,'required'=>true,'value'=>(!empty($studentRedDiary->punished_from))?$studentRedDiary->punished_from.'/'.$studentRedDiary->punished_to:'']) ?>
                                </div>
						 
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Reason :<span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
						   <?= $this->Form->control('reason', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Reason','type'=>'textarea','style'=>'resize:none;'])?>
						</div>
					</div> 
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Description :<span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
						   <?= $this->Form->control('description', ['label' => false, 'class'=>'form-control','placeholder'=>'Enter Description','type'=>'textarea','style'=>'resize:none;','required'=>true])?>
						</div>
					</div>
					 <div class="row">
						<div class="col-md-4">
							<label class="control-label"> Punished By :<span class="required" aria-required="true"> * </span></label>
						</div>
						<div class="col-md-8">
						   <?= $this->Form->control('punished_by', ['options'=>$punishers,'label' => false, 'class'=>'select2','empty'=>'Select Punisher','style'=>'width:100%','required'])?>
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
				<?php $page_no=$this->Paginator->current('StudentRedDiaries'); $page_no=($page_no-1)*20; ?> 
				 <table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr') ?></th>
							<th scope="col"><?= __('Student ') ?></th>
							<th scope="col"><?= __('Duration') ?></th>
							<th scope="col"><?= __('Punisher By') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($studentRedDiaries as $studentRedDiary): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td>
							<?php echo $studentRedDiary->student->name;?>
							</td>
							<td>
							<?php echo date('d-M-Y',strtotime($studentRedDiary->punished_from)).' To '.date('d-M-Y',strtotime($studentRedDiary->punished_to));?>
							</td>
							<td>
							<?php echo $studentRedDiary->employee->name;?>
							</td>
								<td class="actions">
									<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($studentRedDiary->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Vehicle', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Vehicle']) ?>
									<a class=" btn btn-warning btn-xs viewbtn" data-target="#view<?php echo $studentRedDiary->id; ?>" data-toggle="modal"><i class="fa fa-eye"></i></a>
								</td>
								<div id="view<?php echo $studentRedDiary->id; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<div class="modal-content">
											<div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title" >
													Details
												</h4>
											</div>
											<div class="modal-body">
												<div class="row col-md-12">
													<div class="col-md-2">
														<label class="control-label">Reason:</label>
													</div>
													<div class="col-md-10">
														<span><?= $studentRedDiary->reason ?></span>
													</div>
												</div><br>
												<div class="row col-md-12">
													<div class="col-md-2">
														<label class="control-label">Description</label>
													</div>
													<div class="col-md-10">
														<span><?= $studentRedDiary->description ?></span>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
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
<?= $this->element('daterangepicker') ?> 
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