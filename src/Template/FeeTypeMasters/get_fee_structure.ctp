<?php if(!empty($feeCategory->name) && !empty($feeType->name)){ ?>
<table class="table table-bordered table-hover" id="tab">
	<thead>
	<tr>
		<th width="15%">
			Fee Category:
		</th>
		<th width="35%">
			<?= $feeCategory->name;?>
		</th>
	 
		<th width="15%">
			Fee Type:
		</th>
		<th width="35%">
			<?= $feeType->name;?>
		</th> 
	</tr>
	</thead>
	<tbody>
 
	<?php if($feeCategory->id==1){ ?>
		<tr>
			<td colspan="10" >
				<table class="table table-bordered table-hover">
					<tr>
						<td>Month</td>
					<?php
						$y=0;
						foreach ($feeMonths as $key => $value) {
							echo " <td>".$value->name."</td>";
							echo $this->Form->control('fee_type_master_rows['.$y.'][fee_month_id]',['label' => false,'type'=>'hidden','value'=>$value->id]);
						 $y++;
						}

					?>
					</tr>
					<tr>
						<td>Fee</td>
					<?php
					
					$x=0;
						foreach ($feeMonths as $key => $value) { 
							echo " <td>".$this->Form->control('fee_type_master_rows['.$x.'][amount]',['label' => false,'class'=>'form-control input-small','placeholder'=>'Amount','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",'id'=>'fee_type_master_rows['.$x.'][amount]'])."</td>";
							$x++;
						}
					?>
					</tr>
				</table>
			</td>
		</tr>	
	<?php
	}
	else if($feeCategory->id==6){ ?>
		<tr id="install">
			<th> <lable style="line-height: 3.429;">Enter Installment</lable>
			</th>
			<td colspan="3">
				<?php echo $this->Form->control('installment',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Installment','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'id'=>'installmentWise','required'=>'required']);?>
			</td>
		<tr>
	<?php
	}
	else{ ?>
		<tr>
			<th> <lable style="line-height: 3.429;">Enter Fee</lable>
			</th>
			<td colspan="3">
				<?php echo $this->Form->control('fee_type_master_rows[0][amount]',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Fee Amount','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');,'id'=>'fee_type_master_rows[0][amount]'"]);
				echo $this->Form->control('fee_type_master_rows[0][fee_month_id]',['label' => false,'type'=>'hidden','value'=>0]);
				?>
			</td>
		<tr>
	<?php
	} ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="11" align="center">
				<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','type'=>'submit']); ?>
			</td>
		</tr>
	</tfoot>
</table>
<?php }
else {
	echo"<div align='center' ><h4> Please Select Fee Categoey and Fee type</h4></div>";
} ?>