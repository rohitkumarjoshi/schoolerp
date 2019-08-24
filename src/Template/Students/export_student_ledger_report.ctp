<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Student Ledger Report".$date.'_'.$time;

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
                                        <th>Name</th>
                                        <th>Scholar No.</th>
                                        <th>Medium</th>
                                        <th>Class</th>
                                        <th>Stream</th>
                                        <?php
                                        foreach ($feeMonths as $key => $feeMonthName) {
                                            ?>
                                            <th><?= $feeMonthName ?></th>
                                            <?php
                                        }
                                        ?>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $overall_total=0;
                                        foreach ($studentLedgers as $studentLedger) {
                                            $grand_total=0;
                                            ?>
                                            <tr>
                                                <td style="text-align: left;"><?= $studentLedger->student->name ?></td>
                                                <td><?= $studentLedger->student->scholar_no ?></td>
                                                <td><?= $studentLedger->medium->name ?></td>
                                                <td><?= $studentLedger->student_class->name ?></td>
                                                <td><?= @$studentLedger->stream->name ?></td>
                                                <?php
                                                if(!empty($studentLedger->month))
                                                {
                                                     $amount=$studentLedger->total_amount;
                                                     $month_key=$studentLedger->month;
                                                }
                                                foreach ($feeMonths as $key => $feeMonthName) {
                                                    if(!empty($studentLedger->fee_receipts))
                                                    { 
                                                        $data='';
                                                        foreach ($studentLedger->fee_receipts as $fee_receipt) 
                                                        {
                                                            if($fee_receipt->month==$key)
                                                            {
                                                                $total_amount=$fee_receipt->total_amount;
                                                                if($key==$studentLedger->month)
                                                                {
                                                                    $total_amount+=$studentLedger->total_amount;
                                                                }
                                                                ?><td><?= ($total_amount > 0)?$total_amount:'-' ?></td><?php
                                                                $data='exist';
                                                                $grand_total+=$total_amount;
                                                            }
                                                            else if($studentLedger->month==$key)
                                                            {
                                                                ?><td><?= ($studentLedger->total_amount > 0)?$studentLedger->total_amount:'-' ?></td><?php
                                                                $data='exist';
                                                                $grand_total+=$studentLedger->total_amount;
                                                            }
                                                        }
                                                        if($data != 'exist')
                                                        {
                                                            if($studentLedger->month==$key)
                                                            {
                                                                ?><td><?= ($studentLedger->total_amount > 0)?$studentLedger->total_amount:'-' ?></td><?php
                                                                $data='exist';
                                                                $grand_total+=$studentLedger->total_amount;
                                                            } 
                                                            else{
                                                                ?><td>-</td><?php
                                                            } 
                                                            
                                                        }
                                                    }
                                                    else
                                                    {
                                                        ?><td>-</td><?php
                                                    }
                                                    
                                                }
                                                ?><td><?= $grand_total ?>
                                                <?php $overall_total+=$grand_total; ?>
                                                    <?= $this->Form->hidden('grand_total',['value'=>$grand_total,'class'=>'grand_total']) ?>
                                                </td><?php
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="18" style="text-align: right;"><?= $overall_total ?></th>
                                        </tr>
                                    </tfoot>
      </table>
			