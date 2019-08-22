<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label >Non Scholars Register </label>
			</div>
			<div class="box-body">
				<?= $this->Form->create('',['id'=>'ServiceForm']) ?>
				<div class="form-group hide_print">
                    <div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<div class="input-group">
			                        <div class="input-group-addon">
			                            <i class="fa fa-calendar"></i>
			                        </div>
			                        <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'required'=>true,'placeholder'=>'Date range']) ?>
			                    </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
			                        <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
							</div>
						</div>
					</div>
                </div>
                <?= $this->Form->end() ?>
                <?php
                if(!empty($feeReceipts))
                { ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <div class="form-group">
                    	<div class="row">
                    		<div class="col-md-12">
                                <center>
                                    <h3>Non Scholars Register</h3>
                                    <h4><?= date('d-M-Y',strtotime($date_from)) ?> to <?= date('d-M-Y',strtotime($date_to)) ?></h4>
                                </center>
                                
                    			<table class="table table-bordered" style="text-align: center !important;">
                    				<thead>
                    					<tr>
                    						<th style="text-align: center !important;">Sr No.</th>
                                            <th style="text-align: center !important;">Receipt Date</th>
                    						<th style="text-align: center !important;">Name</th>
                    						<th style="text-align: center !important;">Receipt No.</th>
                                            <th style="text-align: center !important;">Fee Component</th>
                                            <th style="text-align: center !important;">Remarks</th>
                                            <th style="text-align: center !important;">Amount</th>
                    					</tr>
                                    </thead>
                					<tbody>
                						<?php
                                        $sr_no=0;
                                        $total_amount=0;
                						foreach ($feeReceipts as $feeReceipt) {
                                            
            								?>
            								<tr>
                								<td><?= ++$sr_no ?></td>
                                                <td style="text-align: center !important;"><?= $feeReceipt->receipt_date ?></td>
                                                <td style="text-align: left !important;"><?= h($feeReceipt->detail) ?></td>
                                                <td style="text-align: right !important;"><?= h($feeReceipt->receipt_no) ?></td>
                                                <td style="text-align: left !important;">
                                                    <?php
                                                    foreach ($feeReceipt->fee_receipt_rows as $fee_receipt_row) 
                                                    {
                                                        $fee_type_name[]=$fee_receipt_row->fee_type_master_row->fee_type_master->fee_type->name;
                                                    }
                                                    echo implode(',', $fee_type_name);
                                                    ?>    
                                                </td>
                                                <td style="text-align: left !important;"><?= h($feeReceipt->remark) ?></td>
                                                <td style="text-align: right !important;"><?= $this->Number->format($feeReceipt->amount) ?></td>
                							</tr>
            								<?php
                                            $total_amount+=$feeReceipt->amount;
                						}
                						?>
                						<tr>
                                            <th colspan="6" style="text-align: right !important;">Grand Total</th>
                                            <th  style="text-align: right !important;"><?= $this->Number->format($total_amount) ?></th>
                                        </tr>
                					</tbody>
                    			</table>
                    		</div>
                    	</div>
                    </div>
                <?php
                } ?>
			</div>
		</div>
	</div>
</div>
<?= $this->element('daterangepicker') ?>