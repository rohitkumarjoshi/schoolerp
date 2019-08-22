<div class="box box-primary">
    <div class="box-header with-border" >
        <label> Visitor Details </label>
        
    </div>
        <div class="row">
            <div class="col-md-12">
                 <div class="box-body">
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
                                        <label class="control-label">Search By Visitors</label>
                                        <?= $this->Form->control('visitor_name',array('options' => $visitor_names,'class'=>'select2','label'=>false,'style'=>'width:100%','empty'=>'Select Visitor')) ?>
                                    </div> 
                                    <div class="col-md-1">
                                        <label class="control-label"  style="    visibility: hidden;">Search</label>
                                         <?php echo $this->Form->button('Search',['class'=>'btn btn-md btn-success','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'height:38px;']); ?> 
                                    </div>
                                  
                                </div>
                            </div>
                  <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
   <?php if($data_exist=='data_exist') { ?>
    <div class="box-body" >
        <?php $page_no=$this->Paginator->current('Visitors'); $page_no=($page_no-1)*20; ?>
        <div class="row">
            <div class="col-md-12">
             <table class="table" >
                 <thead>
                    <tr style="white-space: nowrap;">
                        <th>Sr</th>
                        <th>Visitor</th> 
                        <th>Meeting With</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Visiting Area</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach ($visitors as $key => $visitor): $i++;?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td><?= h($visitor->name) ?> </td>
                        <?php if($visitor->employee_id!='') 
                             { ?>
                            <td><?= h($visitor->employee->name) ?> </td>
                        <?php } ?>
                         <?php if($visitor->student_id!='') 
                             { ?>
                            <td><?= h($visitor->student->name) ?> </td>
                        <?php } ?>
                         <td><?php  
                      
                            echo $result = (!empty($visitor->in_time)) ? date('d-M-Y',strtotime($visitor->in_date)).', '.date('h:i:s A',strtotime($visitor->in_time)): '';
                        ?></td>
                        <td> <?php  
                            echo $result = (!empty($visitor->out_time)) ? date('d-M-Y',strtotime($visitor->out_date)).', '.date('h:i:s A',strtotime($visitor->out_time)): 'Visitor till inside the campus';
                        ?>
                        </td>
                        <td><?= h($visitor->visitor_type) ?> </td>
                        <td> 
                            <?= $this->Html->link(__('<i class="fa fa-pencil-square-o"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($visitor->id)],['class'=>'btn btn-info btn-xs','escape'=>false, 'data-widget'=>'Edit Visitor', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Visitor']) ?>

                               <a href="#view<?= $visitor->id ?>" class="btn btn-warning btn-xs" data-toggle="modal" /> <i class="fa fa-eye"></i> </a>
                               <a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $visitor->id; ?>" data-toggle="modal"> <i class="fa fa-sign-out"></i></a>
                         </td>
                         <div id="deletemodal<?php echo $visitor->id; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-md" >
                                    <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'Visitors','action'=>'checkout',$EncryptingDecrypting->encryptData($visitor->id)]]) ?>
                                            <div class="modal-content">
                                                <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                        Confirm Header
                                                        </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to Checked Out this visitor?
                                                    </h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn  btn-sm btn-primary">Yes</button>
                                                    <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                        <div class="modal fade" id="view<?= $visitor->id ?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Visitor Details</h4>
                                    </div>
                                    <div class="modal-body">
				           				<div class="row col-md-12">
				           					<div class="col-md-3">
				           						<label> In Time :</label>
			           						</div>							  <div class="col-md-3">
			           							<label><?= date('d-M-Y',strtotime($visitor->in_date))  ?></label>
			           						</div>
			           						<div class="col-md-3">
				           						<label> Out Time :</label>
			           						</div>							  
			           						<div class="col-md-3">	        	<label>
			           					<?php 
			           						if(!empty($visitor->out_date)) {
			           						echo  date('d-M-Y',strtotime($visitor->out_date)) ;?>
			           								<?php } else {

			           						echo "NA";
			           								} ?>
			           							</label>		
				           					</div>
				           				</div></br>
				           				<div class="row col-md-12">
				           					<div class="col-md-3">
				           						<label> Mobile No :</label>
			           						</div>							  <div class="col-md-3">
			           							<label><?= $visitor->mobile_no  ?></label>
			           						</div>
			           						<div class="col-md-3">
				           						<label> City :</label>
			           						</div>							  
			           						<div class="col-md-3">	        	<label>
			           							<?php echo $visitor->city->name ;?>
			           							</label>		
				           					</div>
				           				</div></br>
				           				<div class="row col-md-12">
				           					<div class="col-md-3">
				           						<label> Vehicle No :</label>
			           						</div>							  <div class="col-md-3">
			           							<label><?= $visitor->vehicle_no  ?></label>
			           						</div>
			           						<div class="col-md-3">
				           						<label> Reason :</label>
			           						</div>							  
			           						<div class="col-md-3">	        	<label>
			           							<?php echo $visitor->reason ;?>
			           							</label>		
				           					</div>
				           				</div></br>
				           				<div class="row col-md-12">
				           					<div class="col-md-3">
				           						<label> Id Card :</label>
			           						</div>							  <div class="col-md-3">
			           							<label><?= $visitor->id_card  ?></label>
			           						</div>
			           						<div class="col-md-3">
				           						<label> Id Card No :</label>
			           						</div>							  
			           						<div class="col-md-3">	        	<label>
			           							<?php echo $visitor->id_card_no ;?>
			           							</label>		
				           					</div>
				           				</div></br>
				           				<div class="row col-md-12">
				           					<div class="col-md-3">
				           						<label> Visiting Area :</label>
			           						</div>							  <div class="col-md-3">
			           							<label><?= $visitor->visitor_type  ?></label>
			           						</div>
			           						<div class="col-md-3">
				           						<label> Remarks:</label>
			           						</div>							  
			           						<div class="col-md-3">	        	<label>
			           							<?php echo $visitor->remarks ;?>
			           							</label>		
				           					</div>
				           				</div></br></br></br></br>
				           			</div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                            </div>
                        </div>
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
<?= $this->element('daterangepicker') ?>
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
