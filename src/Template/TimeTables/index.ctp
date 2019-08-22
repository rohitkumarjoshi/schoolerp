<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<?php if(!empty($id)){ ?>
				<label > Edit TimeTable  </label>
				<?php }else{ ?>
				<label> Add TimeTable  </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">    
					<?= $this->Form->create($timeTable,['id'=>'ServiceForm','type'=>'file']) ?>
					<div class="row">
						<div class="col-md-11">  
								<label class="control-label"> Valid From to Valid To
										<span class="required" style="color: red;">*</span>
									</label>
								<div class="input-group">
			                        <div class="input-group-addon">
			                            <i class="fa fa-calendar"></i>
			                        </div>
			                        <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepickermin','label'=>false,'required'=>true,'placeholder'=>'Date range','readonly'=>true,'value'=>$daterange]) ?>
			                    </div>
						</div> 
					</div>
					<?php if(!empty($id)){ ?>
					<div class="row">
						<div class="col-md-11">
							<label class="control-label"> Upload Time Table</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('image_path_data',[
							'label' => false,'class'=>'','placeholder'=>'Enter Name','type'=>'file','accept'=>'image/jpg,image/png,image/jpeg']);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
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
					<?php }
					else{
						?>
						<div class="row">
							<div class="col-md-11">
								<label class="control-label">Upload Time Table<span class="required" aria-required="true"> * </span></label>
							</div>
							<div class="col-md-11">
								<?php echo $this->Form->control('image_path_data',[
								'label' => false,'class'=>'','placeholder'=>'Enter Name','type'=>'file','required'=>true,'accept'=>'image/png,image/jpeg,application/pdf']);?>
							</div>
						</div>
						<?php
					} ?>
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
				<?php $page_no=$this->Paginator->current('NoticeCategories'); $page_no=($page_no-1)*10; ?>
				 <table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('#') ?></th>
							<th scope="col"><?= __('Validity') ?></th>
							<th scope="col"><?= __('Doc ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
							<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($TimeTables as $timeTable): ?>
						<tr>
							<td><?php echo ++$page_no;?></td>
							<td >
							<?php echo $timeTable->valid_from. " To ".$timeTable->valid_to;?>
							</td>
							 <td width="20%">
								<a href="#view<?php echo $timeTable->id ;?>" class="btn btn-danger btn-xs" data-toggle="modal" /> View</a>
								
							</td>
							<td>
							<?php
							if($timeTable->is_deleted=='Y')
							{
								echo 'Deactive';
							}
							else{
								echo 'Active';
							}
							?>
							</td>
							<td class="actions" align="center">
								<?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($timeTable->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit TimeTable', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit TimeTable']) ?>
							</td>
						<div class="modal fade" id="view<?php echo $timeTable->id ;?>" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title">View Time Table</h4>
									</div>
									<div class="modal-body">
									 <iframe height="400px;" width="100%" src="<?= $cdn_path.'/'.$timeTable->doc ?>"></iframe>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								  </div>
							</div>
						</div>
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
<?= $this->element('selectpicker') ?> 
<?= $this->element('daterangepicker') ?> 
<?php
$js="
$(document).ready(function(){

     
    $('#ServiceForm').validate({ 
        rules: {
            daterange: {
                required: true
            },
            image_path_data: {
                accept: ['image/jpeg', 'image/png','application/pdf']
            }
        },
         messages: {
            image_path_data: { accept: 'Not an png/jpeg/pdf file!'}
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