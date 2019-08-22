<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label >Search Receipt </label>
			</div>
            <div class="box-body hide_print">
                    <?= $this->Form->create('') ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <label>Cheque No.</label>
                                <?= $this->Form->control('cheque_no', ['class'=>'form-control','label'=>false,'required'=>true,'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'placeholder'=>'Cheque No.']); ?>
                            </div>
                            <div class="col-sm-2">
                                <label style="visibility: hidden;">Search</label>
                                <?= $this->Form->submit('Search',['class'=>'btn button','name'=>'search_cheque_no'])?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
                <hr/>
                 <div class="box-body hide_print">
                    <?= $this->Form->create('') ?>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label ">Receipt No.</label>
                                 <?php echo $this->Form->control('receipt_no',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Receipt No.','id'=>'accession_no','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'required'=>true]);?>
                            </div>
                            <div class="col-sm-2">
                                <label style="visibility: hidden;">Search</label>
                                <?= $this->Form->submit('Search',['class'=>'btn button','name'=>'search_receipt_no'])?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
			<div class="box-body">
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
                                    <h3>Search Receipt</h3>
                                </center>
                                
                    			<table class="table table-bordered" style="text-align: center !important;">
                    				<thead>
                    					<tr>
                    						<tr>
                                                <th style="text-align: center !important;">Sr. No.</th>
                                                <th style="text-align: center !important;">Receipt No.</th>
                                                <th style="text-align: center !important;">Scholar No.</th>
                                                <th>Name</th>
                                                <th style="text-align: center !important;">Rec. Date</th>
                                                <th style="text-align: right !important;">Amount</th>
                                                <th>Fee Type</th>
                                                <th>Pay Mode</th>
                                                <th>Cheque/Transaction No.</th>
                                                <th>Cheque Date</th>
                                                <th>Bank Name</th>
                                            </tr>
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
                                                
                                                
                                                <td style="text-align: left !important;"><?= h($feeReceipt->receipt_no) ?></td>
                                                <td style="text-align: center !important;">
                                                    <?php
                                                    if($feeReceipt->has('student_info'))
                                                    {
                                                        echo $feeReceipt->student_info->student->scholar_no;
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: left !important;">
                                                  
                                                    <?php
                                                    if($feeReceipt->has('student_info'))
                                                    {
                                                        echo $feeReceipt->student_info->student->name;
                                                    }
                                                    else if($feeReceipt->has('enquiry_form_student'))
                                                    {
                                                        echo $feeReceipt->enquiry_form_student->name;
                                                    }
                                                    else
                                                    {
                                                        echo h($feeReceipt->detail);
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: center !important;"><?= $feeReceipt->receipt_date ?></td>
                                                <td style="text-align: right !important;"><?= $this->Number->format($feeReceipt->total_amount) ?></td>
                                                <td style="text-align: right !important;"><?= $feeReceipt->fee_category->name ?></td>
                                                <td style="text-align: center !important;"><?= $feeReceipt->payment_type ?></td>
                                                <td style="text-align: center !important;"><?= $feeReceipt->cheque_no.$feeReceipt->transaction_no ?></td>
                                                <td style="text-align: center !important;"><?= $feeReceipt->cheque_date ?></td>
                                                <td style="text-align: center !important;"><?= $feeReceipt->bank ?></td>
                							</tr>
            								<?php
                						}
                						?>
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