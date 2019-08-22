<div class="box box-primary">
    <div class="box-header with-border" >
        <label> Inwards Details </label>
    </div>
	<div class="box-body" >
		<div class="row">
			<div class="col-md-12">
				  <?= $this->Form->create(' ',['id'=>'ServiceForm']) ?>
							<div class="col-md-12 " >
								<div class="row"> 
									<div class="col-md-3">
										<div class="form-group">
                                            <label class="control-label"> Date From to To
                                              </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                              <?= $this->Form->control('form_to_date',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range','readonly'=>true]) ?>
                                            </div>
                                        </div>  
									</div>
									<div class="col-md-3">
										<label class="control-label">Search By Department</label>
										<?= $this->Form->control('departments_id',array('options' => $departments,'class'=>'select2','label'=>false,'style'=>'width:100%','empty'=>'Select Department')) ?>
									</div> 
									<div class="col-md-1">
										<label class="control-label"  style="visibility: hidden;">Search</label>
										 <?php echo $this->Form->button('Search',['class'=>'btn btn-md btn-success','id'=>'submit_member','name'=>'search_report','value'=>'yes']); ?> 
									</div>
								</div>
							</div>
				  <?= $this->Form->end() ?>
			</div>
		</div>
		<br>
		 <?php if($data_exist=='data_exist') { ?>
		<?php $page_no=$this->Paginator->current('Inwards'); $page_no=($page_no-1)*20; ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-body table-responsive content-scroll" style="width: 100% !important;">
						<div>
							<table class="table" >
								<thead>
									<tr style="white-space: nowrap;">
										<th>Sr</th>
										<th>Person Name</th>
										<th>Mobile No</th>
										<th>In Time</th>
										<th>Out Time</th>
										<th>Item Description</th>
										<th>Bill No</th>
										<th>Department</th>
										<th>Remarks</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=0; foreach ($inwards as $key => $inward): $i++;?>
									<tr>
										<td> <?php echo $i; ?></td>
										<td><?= h($inward->person_name) ?> </td>
										<td><?= h($inward->mobile_no) ?> </td>
										<td>
											<?php if(!empty($inward->in_date)) { ?>
												<?= date('d-M-Y',strtotime(h($inward->in_date))).' '.date('H:i:s',strtotime(h($inward->in_time))); ?>
											<?php } else { ?>
												<label> NA</label>
											<?php } ?>
										</td>
										<td>
											<?php if(!empty($inward->out_date)) { ?>
												<?= date('d-M-Y',strtotime(h($inward->out_date))).' '.date('H:i:s',strtotime(h($inward->out_time))); ?>
											<?php }  else { ?>
												<label> NA</label>
											<?php } ?>
										</td>
										<td><?= h($inward->item_description) ?> </td>
										<td><?= h($inward->bill_no) ?> </td>
										<td><?= h($inward->department->name) ?> </td>
										<td><?= h($inward->remarks) ?> </td>
										<td><?= $this->Html->link(__('<i class="fa fa-pencil-square-o"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($inward->id)],['class'=>'btn btn-info btn-xs','escape'=>false, 'data-widget'=>'Edit Inwards', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Inwards']) ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
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
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            vehicle_id: {
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
<?= $this->element('daterangepicker') ?> 