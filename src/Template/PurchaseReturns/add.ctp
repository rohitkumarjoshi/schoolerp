<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
					<label> Purchase Return</label>
			</div>
			<?= $this->Form->create($purchaseReturn, ['id'=>'ServiceForm']) ?>
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-sm-4">
                            <label class="control-lable">Transaction Date<span class="required" required name="vandors">*</span></label>
                            <?= $this->Form->control('data[date_from >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy','name'=>'transaction_date','placeholder'=>'Transaction Date'])?>
                        </div>
						<div class="form-group col-md-4" >
							<label class="control-label" >Vendors<span class="required" required name="vandors">*</span></label>
							<?php echo $this->Form->control('vendor_id',['options' =>$vendors,'label' =>false,'class'=>'select2 ','empty'=> 'select...','required'=>'required','style'=>'width:100%']);?>
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
										<?php echo $this->Form->control('location_id',['options'=>$Dropdown,'class'=>'item_id','empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
									</td>
									<td>
										<?php echo $this->Form->control('item_id',['options'=>$option,'class'=>'item_id','empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
									</td>
									<td>
										<?php echo $this->Form->control('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control input-sm quantity rightAligntextClass calc numericOnly','required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
									</td>
									<td>
										<?php echo $this->Form->control('rate',['class'=>'form-control input-sm rate numericOnly rightAligntextClass calc ','placeholder'=>'Rate','label'=>false,'required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
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
									<td colspan="2"><?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).' Add Row',['class'=>'btn btn-info add_row','type'=>'button']); ?></td>
									<td  colspan="3" style ="text-align:right; font-weight:bold;">Grand Total </td>
									<td>
										<?php echo $this->Form->control('grand_total',['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm grand_total','type'=>'text','readonly'=>'readonly', 'tabindex' => '-1','value'=>0]); ?>
										
									</td>
									<td></td>
									
								</tr>
								<tr>
									<td  style ="text-align:right; font-weight:bold;" colspan="5">Remark</td>
									<td colspan="2">
										<?php echo $this->Form->control('remark', ['label' => false,'placeholder'=>'Remark','class'=>'form-control input-sm quantity rightAligntextClass calc','required'=>'required','style'=>'resize:none']); ?>	
									</td>
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

<?php
	$js="
	$(document).ready(function() {
		$('#ServiceForm').validate({ 
			rules: {
				transaction_date: {
					required: true
				},
				vendor_id: {
					required: true
				}
			},
			submitHandler: function () {
				$('#loading').show();
				$('#submit_member').attr('disabled','disabled');
				form.submit();
			}
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
				$(this).find('td:nth-child(2) select').select2().attr({name:'purchase_return_rows['+i+'][location_id]', id:'purchase_return_rows-'+i+'-location_id'
					});
				$(this).find('td:nth-child(3) select').select2().attr({name:'purchase_return_rows['+i+'][item_id]', id:'purchase_return_rows-'+i+'-item_id'
					});
				$(this).find('td:nth-child(4) input').attr({name:'purchase_return_rows['+i+'][quantity]', id:'purchase_return_rows-'+i+'-quantity'
						});
				 $(this).find('td:nth-child(5) input').attr({name:'purchase_return_rows['+i+'][rate]', id:'purchase_return_rows-'+i+'-rate'
						});
				$(this).find('td:nth-child(6) input').attr({name:'purchase_return_rows['+i+'][amount]', id:'purchase_return_rows-'+i+'-amount'
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
				<?php echo $this->Form->control('location_id',['options'=>$Dropdown,'class'=>'item_id','empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
			</td>
			<td>
				<?php echo $this->Form->control('item_id',['options'=>$option,'class'=>'item_id','empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
			</td>
			<td>
				<?php echo $this->Form->control('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control input-sm quantity rightAligntextClass calc numericOnly','required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
			</td>
			<td>
				<?php echo $this->Form->control('rate',['class'=>'form-control input-sm rate numericOnly rightAligntextClass calc ','placeholder'=>'Rate','label'=>false,'required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
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