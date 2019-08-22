<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
					<label> Purchase Order Receipt</label>
			</div>
			<?= $this->Form->create($purchaseOrder, ['id'=>'ServiceForm']) ?>
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
							<label class="control-lable">Transaction Date<span class="required" required name="vandors">*</span></label>
							<?= $this->Form->control('data[date_from >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-M-yyyy','name'=>'transaction_date','placeholder'=>'Transaction Date','required'=>'required'])?>
						</div>
						<div class="form-group col-md-4" >
							<label class="control-label" >Vendors<span class="required" required name="vandors">*</span></label>
							<?php echo $this->Form->control('vendor_id',['options' =>$Vendors,'label' =>false,'class'=>'select2 ','empty'=> 'Select...','required'=>'required','style'=>'width:100%']);?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12" style="margin-top:10px;padding: 0px 33px 0px 33px;" id="main">
						<table class="table " id="main_table">	
							<thead class="bg_color">
								<tr align="center">
									<th rowspan="2" style="text-align:center;">Sr</th>
									<th rowspan="2" style="text-align:center;">Item</th>
									<th rowspan="2" style="text-align:center;">Quantity</th>
									<th rowspan="2" style="text-align:center;">Rate</th>
									<th rowspan="2" style="text-align:center;">Total </th>
									<th rowspan="2" style="text-align:center;">Action</th>
								</tr>
							</thead>
							<tbody id="main_tbody">
								<tr class="main_tr">
									<td style="vertical-align: top !important;text-align:center;"></td>
									<td>
										<?php echo $this->Form->control('item_id',['options'=>$option,'class'=>'selectadd item_id ' ,'empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
									</td>
									<td id="staticParent">
										<?php echo $this->Form->control('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control  quantity rightAligntextClass calc','required'=>'required','id'=>'child','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
									</td>
									<td>
										<?php echo $this->Form->control('rate',['class'=>'form-control  rate numberOnly rightAligntextClass calc','placeholder'=>'Rate','label'=>false,'required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
									</td>		
									<td>
										<?php echo $this->Form->control('amount', ['style'=>'text-align:right','label' =>false,'class' => 'form-control   amount numberOnly','type'=>'text','value'=>0, 'readonly', 'tabindex' => '-1','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
									</td>
									<td>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="2"><?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).'Add Row',['class'=>'btn btn-info add_row','type'=>'button']); ?></td>
									<td  colspan="2" style ="text-align:right; font-weight:bold;">Grand Total</td>
									<td>
										<?php echo $this->Form->control('grand_total',['style'=>'text-align:right','label' => false,'class' => 'form-control input-sm grand_total','type'=>'text','readonly'=>'readonly', 'tabindex' => '-1','value'=>0]); ?>
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
								<?php echo $this->Form->button('Submit',['class'=>'btn   button submit','id'=>'submit_member']); ?>
							</div>
						</div>
					</center>		
				</div>
			</div>
			<?= $this->Form->end(['data-type' => 'hidden']);?>
		</div>
	</div>
</div>
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
				var qty  = parseFloat($(this).closest('tr').find('td:nth-child(3) input').val());
				if(isNaN(qty)){ qty=0;}
				var rate  = parseFloat($(this).closest('tr').find('td:nth-child(4) input').val());
				if(isNaN(rate)){ rate=0; }
				if(!isNaN(qty) && !isNaN(rate))
				{
					var total  = qty*rate;
					$(this).closest('tr').find('td:nth-child(5) input').val(total);
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
				$(this).find('td:nth-child(2) select').select2().attr({name:'purchase_order_rows['+i+'][item_id]', id:'purchase_order_rows-'+i+'-item_id'
					});
				$(this).find('td:nth-child(3) input').attr({name:'purchase_order_rows['+i+'][quantity]', id:'purchase_order_rows-'+i+'-quantity'
						});
				 $(this).find('td:nth-child(4) input').attr({name:'purchase_order_rows['+i+'][rate]', id:'purchase_order_rows-'+i+'-rate'
						});
				$(this).find('td:nth-child(5) input').attr({name:'purchase_order_rows['+i+'][amount]', id:'purchase_order_rows-'+i+'-amount'
						});
				
				i++;
			});
			calculation();
		}
		
		
	

	});
	";

echo $this->Html->scriptBlock($js, array('block' => 'block_js')); ?>
<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?>

<table id="sample" style="display:none;"width="1500px">
	<tbody>
		<tr class="main_tr">
			<td style="vertical-align: top !important;text-align:center;"></td>
			<td>
				<?php echo $this->Form->control('item_id',['options'=>$option,'class'=>'selectadd item_id ' ,'empty' => 'Select...','label'=>false,'required'=>'required','style'=>'width:100%']); ?>
			</td>
			<td id="staticParent">
				<?php echo $this->Form->control('quantity', ['label' => false,'placeholder'=>'Qty','class'=>'form-control  quantity rightAligntextClass calc','required'=>'required','id'=>'child','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
			</td>
			<td>
				<?php echo $this->Form->control('rate',['class'=>'form-control  rate numberOnly rightAligntextClass calc','placeholder'=>'Rate','label'=>false,'required'=>'required','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]); ?>	
			</td>		
			<td>
				<?php echo $this->Form->control('amount', ['style'=>'text-align:right','label' =>false,'class' => 'form-control   amount numberOnly','type'=>'text','value'=>0, 'readonly', 'tabindex' => '-1','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
			</td>
			<td>
				<?= $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger remove_row','type'=>'button']) ?>
			</td>
		</tr>
	</tbody>
</table>