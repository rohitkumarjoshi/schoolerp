<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Non Scholar Register Report".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );
//pr($OrderAcceptances->toArray()); exit;
?>


<table border="1">
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
			