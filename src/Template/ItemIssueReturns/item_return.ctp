<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label>Item Return </label>
			</div>
			<?= $this->Form->create($itemReturn, ['id'=>'ServiceForm']) ?>
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-sm-4">
                            <label class="control-lable">Transaction Date</label>
                            <?= $this->Form->control('transaction_date',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','placeholder'=>'Transaction Date','type'=>'text'])?>
                        </div>
						<div class="form-group col-md-4 employee hidden"  >
							<label class="control-label" >Employee<span class="required" required name="vandors">*</span></label>
							<?php echo $this->Form->control('employee_id',['options'=>$employees,'label' =>false,'class'=>'select2 ','empty'=> 'select...','required'=>'required','style'=>'width:100%']);?>
						</div>
						<div class="form-group col-md-4 student">
							<label class="control-label" >Student<span class="required" required name="vandors">*</span></label>
							<?php echo $this->Form->control('student_id',['options'=>$students,'label' =>false,'class'=>'select2 ','empty'=> 'select...','required'=>'required','style'=>'width:100%']);?>
						</div>
						<div class="col-md-4">
						<br/><br/>
							<label class="radio-inline" id="student">
								<input type="radio" id="option1" value="Student" name="issue_to" checked>Student
							</label>
							<label class="radio-inline" id="employee">
								<input type="radio" id="option2" value="Employee" name="issue_to">Employee
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12" style="margin-top:10px;padding: 0px 33px 0px 33px;" id="main">
						<table class="table " id="main_table">	
							<thead class="bg_color">
								<tr align="center">
									<th rowspan="2" style="text-align:left;">Sr</th>
									<th rowspan="2" style="text-align:left;">Location</th>
									<th rowspan="2" style="text-align:left;">Item</th>
									<th rowspan="2" style="text-align:left;">Quantity</th>
									<th rowspan="2" style="text-align:left;">Rate</th>
									<th rowspan="2" style="text-align:left;">Total </th>
									<th rowspan="2" style="text-align:left;">Action</th>
								</tr>
							</thead>
							<tbody id="main_tbody">
								<tr class="main_tr">
									<td style="vertical-align: top !important;"></td>
									<td>
										<?php echo $this->Form->control('location_id',['options'=>$Dropdown,'class'=>' location_id','empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
									</td>
									<td>
										<?php echo $this->Form->control('item_id',['options'=>$option,'class'=>' item_id ' ,'empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
									</td>
									<td>
										<?php echo $this->Form->control('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control input-sm quantity rightAligntextClass calc numericOnly','required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
									</td>
									<td>
										<?php echo $this->Form->control('rate',['class'=>'form-control input-sm rate numericOnly rightAligntextClass calc','placeholder'=>'Rate','label'=>false,'required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
									</td>		
									<td>
										<?php echo $this->Form->control('amount', ['style'=>'text-align:right','label' =>false,'class' => 'form-control input-sm  amount numericOnly','type'=>'text','value'=>0, 'readonly', 'tabindex' => '-1','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
									</td>
									<td>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2"><?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).'Add Row',['class'=>'btn btn-info add_row','type'=>'button']); ?></td>
									<td  colspan="3" style ="text-align:right; font-weight:bold;">Grand Total</td>
									<td>
										<?php echo $this->Form->control('grand_total',['style'=>'text-align:right','label' => false,'class' => 'form-control input grand_total','type'=>'text','readonly'=>'readonly', 'tabindex' => '-1','value'=>0,'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>
									</td>
									<td></td>
								</tr>
							</tfoot>
						</table>
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
			<?= $this->Form->end(['data-type' => 'hidden']);?>
		</div>
	</div>
</div>
<?= $this->element('validate') ?>
<?= $this->element('datepicker') ?>
<?= $this->element('icheck') ?>
<?php
	$js="
	$(document).ready(function() {
		
		$('#ServiceForm').validate({ 
			rules: {
				rules: {
					transaction_date: {
						required: true
					}
				},
			},
			submitHandler: function () {
				$('#loading').show();
				$('#submit_member').attr('disabled','disabled');
				form.submit();
			}
		});
		
		$('#option1').on('ifChecked', function () {
                $('.employee').addClass('hidden');
                $('.student').removeClass('hidden');
                $('#student-id').attr('required','required');
                $('#employee-id').removeAttr('required');
        });

        $('#option2').on('ifChecked', function () {
                $('.student').addClass('hidden');
                $('.employee').removeClass('hidden');
                $('#employee-id').attr('required','required');
                $('#student-id').removeAttr('required');
        });
		$(document).on('click', '.add_row', function(e){
			add_row();
		});
		rename_rows();
		function add_row(){
			var tr = $('#sample tbody tr.main_tr').clone();
			$('#main_table tbody#main_tbody').append(tr);
			rename_rows();
			
		}
		$(document).on('click', '.remove_row', function(e)
		{ 
			$(this).closest('tr').remove();
			rename_rows();
		});
		
		$(document).on('keyup','.quantity,  .rate',  function(e){
			calculation();
		});
		$(document).on('change','.item_id', function(e){ 
			calculation();
		});
		function calculation(){
			
			var grand_total = 0;
			
			$('#main_table tbody#main_tbody tr.main_tr').each(function()
			{
				var qty  = parseFloat($(this).closest('tr').find('td:nth-child(4) input').val());
				if(isNaN(qty)){ qty=0;}
				var rate  = parseFloat($(this).closest('tr').find('td:nth-child(5) input').val());
				if(isNaN(rate)){ rate=0; }
				if(!isNaN(qty) && !isNaN(rate))
				{
					var total  = qty*rate;
					$(this).closest('tr').find('td:nth-child(6) input').val(total);
				}
				
				grand_total += total;
			
			});
			$('.grand_total').val(round(grand_total,2));


		}
		function rename_rows()
		{
			var i=0;
			$('#main_table tbody#main_tbody tr.main_tr').each(function(){
				var row_no = $(this).attr('row_no');					
				$(this).find('td:nth-child(1)').html(i+1);
				$(this).find('td:nth-child(2) select').select2().attr({name:'item_issue_return_rows['+i+'][location_id]', id:'item_issue_return_rows-'+i+'-location_id'
					});
				$(this).find('td:nth-child(3) select').select2().attr({name:'item_issue_return_rows['+i+'][item_id]', id:'item_issue_return_rows-'+i+'-item_id'
					});
				$(this).find('td:nth-child(4) input').attr({name:'item_issue_return_rows['+i+'][quantity]', id:'item_issue_return_rows-'+i+'-quantity'
						});
				 $(this).find('td:nth-child(5) input').attr({name:'item_issue_return_rows['+i+'][rate]', id:'item_issue_return_rows-'+i+'-rate'
						});
				$(this).find('td:nth-child(6) input').attr({name:'item_issue_return_rows['+i+'][amount]', id:'item_issue_return_rows-'+i+'-amount'
						});
				
				i++;
			});
			calculation();
		}
		
	});
	";

echo $this->Html->scriptBlock($js, array('block' => 'block_js')); ?>
<?= $this->element('selectpicker') ?> 


<table id="sample" style="display:none;"width="1500px">
	<tbody>
		<tr class="main_tr">
			<td style="vertical-align: top !important;"></td>
			<td>
				<?php echo $this->Form->control('location_id',['options'=>$Dropdown,'class'=>' location_id','empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
			</td>
			<td>
				<?php echo $this->Form->control('item_id',['options'=>$option,'class'=>' item_id ' ,'empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
			</td>
			<td>
				<?php echo $this->Form->control('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control input-sm quantity rightAligntextClass calc numericOnly','required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
			</td>
			<td>
				<?php echo $this->Form->control('rate',['class'=>'form-control input-sm rate numericOnly rightAligntextClass calc','placeholder'=>'Rate','label'=>false,'required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
			</td>		
			<td>
				<?php echo $this->Form->control('amount', ['style'=>'text-align:right','label' =>false,'class' => 'form-control input-sm  amount numericOnly','type'=>'text','value'=>0, 'readonly', 'tabindex' => '-1','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
			</td>
			<td>
				<?= $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger remove_row','type'=>'button']) ?>
			</td>
		</tr>
	</tbody>
</table>