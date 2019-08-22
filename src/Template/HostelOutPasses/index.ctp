  <div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label>  Gate Pass Report </label>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="box-body " >
					<?= $this->Form->create(' ',['class'=>'ServiceForm']) ?>
							<div class="col-md-12 " >
								<div class="row"> 
									<div class="col-md-4">
										<label class="control-label">Search By Student</label>
										<?= $this->Form->control('student_id', ['options' => $students,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Student','dataplaceholder'=>'Select Student'])?>
									</div>
									<div class="col-md-3">
										<label class="control-label">Search By Date</label>
			                            <div class="form-group">
			                                <div class="input-group">
			                                    <div class="input-group-addon">
			                                        <i class="fa fa-calendar"></i>
			                                    </div>
			                                    <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range','style'=>'height:40px']) ?>
			                                </div>
			                            </div>
			                        </div>
									 <div class="col-md-1">
	                                    <label class="control-label"  style=" visibility: hidden;">Search</label>
	                                     <?php echo $this->Form->button('Search',['class'=>'btn btn-md btn-success filter','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'margin-right: 0px;color:white !important;height:38px;']); ?> 
	                                </div>
								</div>
							</div>
						<?= $this->Form->end() ?>
					</div>
				</div>
			</div>
			
			<?php if($data_exist=='data_exist') { ?>
			<div class="box-body " >
				<div class="form-group">   
					<table cellpadding="0" cellspacing="0" class="table">
						<thead>
							<tr style="background-color: #f3f2f1;">
								<th scope="col"><?= $this->Paginator->sort('Sr.No') ?></th>
								<th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
								<th scope="col"><?= $this->Paginator->sort('date_from') ?></th>
								<th scope="col"><?= $this->Paginator->sort('date_to') ?></th>
								<th scope="col"><?= $this->Paginator->sort('out_time') ?></th>
								<th scope="col"><?= $this->Paginator->sort('in_time') ?></th>
								<th style="text-align: center;" scope="col"><?= $this->Paginator->sort('status') ?></th>
								<th style="text-align: center;" scope="col"><?= $this->Paginator->sort('action') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach ($hostelOutPasses as $hostelOutPass): ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= h($hostelOutPass->student->name) ?></td>
								<td><?= h($hostelOutPass->date_from) ?></td>
								<td><?= h($hostelOutPass->date_to) ?></td>
								<td><?= h($hostelOutPass->out_time) ?></td>
								<td><?= h($hostelOutPass->in_time) ?></td>
								<td style="text-align: center;"><?= h($hostelOutPass->status) ?></td>
								<td class="actions"  style="text-align: center;">
									<?php 
									$combinedDT = strtotime(date('Y-m-d H:i:s', strtotime("$hostelOutPass->date_from $hostelOutPass->out_time")));
									$currentDT = strtotime(date('Y-m-d H:i:s'));
									if($combinedDT >= $currentDT)
									{
										if($hostelOutPass->status=='Rejected' ) 
										{ ?>
											<a href="#accept<?php echo $hostelOutPass->id ;?>" class="btn btn-info btn-xs" data-toggle="modal" /> Approve</a>
											<a href="#hold<?php echo $hostelOutPass->id ;?>" class="btn btn-warning btn-xs" data-toggle="modal" /> Hold</a> 
										<?php 
										} 
										else if($hostelOutPass->status=='Approved' ) 
										{	?>
											<a href="#reject<?php echo $hostelOutPass->id ;?>" class="btn btn-danger btn-xs" data-toggle="modal" /> Reject</a>
											<a href="#hold<?php echo $hostelOutPass->id ;?>" class="btn btn-warning btn-xs" data-toggle="modal" /> Hold</a>
										<?php 
										} 
										else if($hostelOutPass->status=='Hold' ) 
										{ ?>
											<a href="#accept<?php echo $hostelOutPass->id ;?>" class="btn btn-info btn-xs" data-toggle="modal" /> Approve</a>
											<a href="#reject<?php echo $hostelOutPass->id ;?>" class="btn btn-danger btn-xs" data-toggle="modal" /> Reject</a>
										<?php 
										} 
									}
								?>
								
								<div class="modal fade" id="accept<?php echo $hostelOutPass->id ;?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<?= $this->Form->create('',['class'=>'ServiceForm']) ?>
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Confirm Header</h4>
											</div>
											<div class="modal-body">
												<h4>Are you sure ,  you want to approve gate pass request ? </h4>
												<?php echo $this->Form->hidden('accept_request_id',[
												'value'=>$hostelOutPass->id]);?>
											</div>
											<div class="modal-footer">
												<?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
											</div>
											<?= $this->Form->unlockField('id') ;?>
											<?= $this->Form->end() ?>
										</div>
									</div>
								</div>
								<div class="modal fade" id="reject<?php echo $hostelOutPass->id ;?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<?= $this->Form->create('',['class'=>'ServiceForm']) ?>
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Confirm Header</h4>
											</div>
											<div class="modal-body">
												<h4>Are you sure ,  you want to reject this gate pass request ? </h4>
												<?php echo $this->Form->hidden('reject_request_id',[
												'value'=>$hostelOutPass->id]);?>
											</div>
											<div class="modal-footer">
												<?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
											</div>
											<?= $this->Form->unlockField('id') ;?>
											<?= $this->Form->end() ?>
										</div>
									</div>
								</div>
								<div class="modal fade" id="hold<?php echo $hostelOutPass->id ;?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<?= $this->Form->create('',['class'=>'ServiceForm']) ?>
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Confirm Header</h4>
											</div>
											<div class="modal-body">
												<h4>Are you sure ,  you want to hold this gate pass request ? </h4>
												<?php echo $this->Form->hidden('hold_request_id',['value'=>$hostelOutPass->id]);?>
											</div>
											<div class="modal-footer">
												<!--  <button type="submit" name="hold_submit" class="btn btn-info" data-dismiss="modal">Yes</button>  -->
												<?php echo $this->Form->button('Submit',['class'=>'btn btn-info submit_member']); ?>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Clo</button>
											</div>
												<?= $this->Form->unlockField('id') ;?>
												<?= $this->Form->end() ?>
										</div>
									</div>
								</div>
								</td>
							</tr>
							<?php $i++;endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="box-footer">
				<?= $this->element('pagination') ?> 
			</div>
		  <?php } else { ?>
             <div class="row">
                <div class="col-md-12 text-center">
                    <h3> <?= $data_exist ?></h3>
                </div>
            </div>
        <?php } ?>
		</div>
	</div>
</div>

<?= $this->element('daterangepicker') ?>
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
    $('.ServiceForm').validate({ 
        submitHandler: function () {
            $('#loading').show();
            $('.submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 