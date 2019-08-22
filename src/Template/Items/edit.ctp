
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" > 
				<label>Edit Items</label>
			</div>
			<?= $this->Form->create($item, ['id'=>'ServiceForm']) ?>
			<div class="portlet-body">
				<div class="row">
					<div class="col-sm-12" style="margin-top:10px;padding: 0px 33px 0px 33px;" id="main">
						<table class="table " id="main_table">	
							<thead class="bg_color" style="background-color: #21898e;color: #f1f2f3;">
								<tr align="center">
									<th rowspan="2" style="text-align:center;">Sr</th>
									<th rowspan="2" style="text-align:center;">Item Categories</th>
									<th rowspan="2" style="text-align:center;">Item Sub Categories</th>
									<th rowspan="2" style="text-align:center;">New Item</th>
									<!-- <th rowspan="2" style="text-align:left;">Opening Balance </th> -->
									<th rowspan="2" style="text-align:center;">Status</th>
								</tr>
							</thead>
							<tbody id="main_tbody">
							
								<tr class="main_tr">
									<td style="vertical-align: top !important;text-align:center;"></td>
									<td>
										<?= $this->Form->control('item_category_id',['options' =>$itemCategories,'label' => false,'class'=>'selectState item_category_id','empty'=> 'Select...','name'=>'item_category_id','style'=>'width:100%','required','value'=>$item->item_category_id]);?>
									</td>
									<td class="item_subcategory_id">
										<?= $this->Form->control('item_subcategory_id',['options' =>$itemSubCategories,'label' => false,'class'=>'selectState','empty'=> 'Select...','name'=>'item_subcategory_id','required','style'=>'width:100%','value'=>$item->item_subcategory_id]);?>	
									</td>
									<td>
										<?= $this->Form->control('name',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text','required','id'=>'txtFirstName','name'=>'name','value'=>$item->name]);?>	
									</td>		
									<td>
										<?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'','label'=>false,'style'=>'width:100%','required')) ?>
									</td>
								</tr>
								
							</tbody>
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
<?= $this->element('datepicker') ?>
<?php
	$js="
	$(document).ready(function() {
		$(document).on('change','.item_category_id',function(e){
			var cur=$(this).closest('tr');
			var item_category_id=$(this).val();
	        var url = '".$this->Url->build(['controller'=>'Items','action'=>'getItemSubCategory.json'])."';
	        $.post(
	            url, 
	            {item_category_id: item_category_id}, 
	            function(result) {
	            	var obj = JSON.parse(JSON.stringify(result));
	               cur.find('.item_subcategory_id').html(obj.response);
	               cur.find('.item_subcategory_id').find('select').select2();
	        });

		});
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
	
		$(document).on('click', '.add_row', function(e){
			add_row();
		});
		rename_rows();
		function add_row(){
			var tr = $('#sample tbody tr.main_tr').clone();
			$('#main_table tbody#main_tbody').append(tr);
			
			
			
		}
		$(document).on('click', '.remove_row', function(e)
		{ 
			$(this).closest('tr').remove();
			rename_rows();
		});
		
		
		function rename_rows()
		{
			var i=0;
			$('#main_table tbody#main_tbody tr.main_tr').each(function(){
				var row_no = $(this).attr('row_no');					
				$(this).find('td:nth-child(1)').html(i+1);
				$(this).find('td:nth-child(2) select').select2().attr({name:'item_category_id', id:'items-'+i+'-item_category_id'
					});
				$(this).find('td:nth-child(3) select').select2().attr({name:'item_subcategory_id', id:'items-'+i+'-item_subcategory_id'
						});
				 $(this).find('td:nth-child(4) input').attr({name:'name', id:'items-'+i+'-name'
						});
				/*$(this).find('td:nth-child(5) input').attr({name:'quantity', id:'items-'+i+'-Quantity'
						});*/
				$(this).find('td:nth-child(5) select').select2().attr({name:'is_deleted', id:'items-'+i+'-is_deleted'
						});
				i++;
			});
			
		}
		
	
		
	

	});
	";

echo $this->Html->scriptBlock($js, array('block' => 'block_js')); ?>
<?= $this->element('selectpicker') ?> 
<?= $this->element('timepicker') ?> 
<?= $this->element('validate') ?>
