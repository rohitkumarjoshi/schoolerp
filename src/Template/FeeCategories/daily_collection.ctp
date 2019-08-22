<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label >Daily Collection </label>
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
                if(!empty($dailyCollection))
                { ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <div class="form-group">
                    	<div class="row">
                    		<div class="col-md-12">
                                <center>
                                    <h3>Daily Collection</h3>
                                    <h4><?= date('d-M-Y',strtotime($date_from)) ?> to <?= date('d-M-Y',strtotime($date_to)) ?></h4>
                                </center>
                                
                    			<table class="table table-bordered" style="text-align: center !important;">
                    				<thead>
                    					<tr>
                    						<th style="text-align: center !important;">Receipt No.</th>
                    						<th style="text-align: center !important;">Fee Type</th>
                    						
                    						<th style="text-align: right !important;">Amount</th>
                    					</tr>
                                    </thead>
                					<tbody>
                						<?php
										//pr($dailyCollection); exit; 
                						foreach ($dailyCollection as $receiptDate => $value) {
                							?>
                							<tr>
                    							<td colspan="3" style="text-align: left !important;"><strong>Date of Receipt: <?= date('d-M-Y',$receiptDate) ?></strong></td>
                    						</tr>
                							<?php
                                            $total_amount=0;
                							foreach ($value as $feeType => $feeData) {
                                               
                    								?>
                    								<tr>
    	                								<td><?= $feeData['receipt_min_no'] ?>-<?= $feeData['receipt_max_no'] ?></td>
                                                        <td><?= $feeType ?></td>
                                                        <td style="text-align: right !important;"><?= $feeData['total_amount'] ?></td>
    	                							</tr>
                    								<?php
                                                    $total_amount+=$feeData['total_amount'];
                                                    //$gross_report[$feeType][]=[$feeData['receipt_min_no']]
                							}
                                            ?>
                                            <tr>
                                                <th colspan="3" style="text-align: right !important;"><?= $total_amount ?></th>
                                            </tr>
                                            <?php
                						}
                						?>
                						
                					</tbody>
                    			</table>
                    		</div>
                    	</div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" style="text-align: center !important;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center !important;">Receipt No.</th>
                                            <th style="text-align: center !important;">Fee Type</th>
                                            <th style="text-align: right !important;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_amount=0;
                                        if(!empty($feeGrossReceiptsMonthly))
                                        {

                                            foreach ($feeGrossReceiptsMonthly as $feeGrossReceiptsMonth) {
                                                foreach ($feeGrossReceiptsMonth->fee_types as $fee_type) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $fee_type->receipt_min_no ?>-<?= $fee_type->receipt_max_no ?></td>
                                                            <td><?= $fee_type->name ?></td>
                                                            <td style="text-align: right !important;"><?= $fee_type->total_amount ?></td>
                                                        </tr>
                                                    <?php
                                                    $total_amount+=$fee_type->total_amount;
													
                                                }
                                                
                                            }
                                        }
                                        ?>
                                        <?php
                                       $total_cash=0;$total_other=0;
                                        foreach ($feeGrossReceipts as $feeGrossReceipt) { 
                                            foreach ($feeGrossReceipt->fee_receipts as $fee_type) {
                                                ?>
                                                    <tr>
                                                        <td><?= $fee_type->receipt_min_no ?>-<?= $fee_type->receipt_max_no ?></td>
                                                        <td><?= $feeGrossReceipt->name ?></td>
                                                        <td style="text-align: right !important;"><?= $fee_type->total_amount ?></td>
                                                    </tr>
                                                <?php
                                                $total_amount+=$fee_type->total_amount;
												$total_cash+=$fee_type->number_published;
												$total_other+=$fee_type->number_unpublished;
                                            }
                                            
                                        }
                                        ?>
                                        <tr>
										<th style="text-align: right !important;"><font size="+1"> Cash Amount <?= $total_cash ?> </th>
										<th style="text-align: right !important;"> <font size="+1"> Other Amount <?= $total_other ?> </th>
                                            <th colspan="" style="text-align: right !important;"><font size="+1"><?= $total_amount ?></strong></th>
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