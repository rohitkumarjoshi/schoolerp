<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Student Wise Payment Report".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>

			     <?php
                                foreach ($studentLedgers as $studentLedger) 
                                {
                                    ?>
                                    <table  class="table" style="width:100%;">
                                        <tr>
                                            <th align="left">Scholar No.</th><td><?= $studentLedger->student->scholar_no ?></td>
                                            <th align="left">Name</th><td><?= $studentLedger->student->name ?></td>
                                            <th align="left">Father's Name</th><td><?= $studentLedger->student->father_name ?></td>
                                        </tr>
                                        <tr>
                                                <th align="left">Class</th> <td><?= $studentLedger->student_class->name ?></td>
                                                <th align="left">Stream</th><td><?= @$studentLedger->stream->name ?></td>
                                                <th align="left">section</th><td><?= @$studentLedger->section->name ?></td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered" style="text-align: center !important;" id="ledger">
                                        <thead>
                                            <th style="text-align: center;">Receipt No.</th>
                                            <th style="text-align: center;">Receipt Date</th>
                                            <th style="text-align: center;">Fee Type</th>
                                            <th style="text-align: right;">Amount</th>
                                            <th style="text-align: right;">Concession</th>
                                            <th style="text-align: right;">Fine</th>
                                            <th style="text-align: right;">Total Amount</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $grand_total=0;
                                            if(!empty($studentLedger->student->enquiry_receipt))
                                            {
                                                $grand_total+=$studentLedger->student->enquiry_receipt->total_amount;
                                                ?>
                                                <tr>
                                                    <td><?= $studentLedger->student->enquiry_receipt->receipt_no ?></td>
                                                    <td><?= $studentLedger->student->enquiry_receipt->receipt_date ?></td>
                                                    <td>
                                                        <?php
                                                        if($studentLedger->student->enquiry_receipt->receipt_fee_category->fee_collection=='Individual')
                                                        {
                                                            echo $studentLedger->student->enquiry_receipt->fee_type_role->name;
                                                        }
                                                        else
                                                        {
                                                            echo $studentLedger->student->enquiry_receipt->receipt_fee_category->name;
                                                        }
                                                        ?>    
                                                    </td>
                                                    <td style="text-align: right;"><?= $studentLedger->student->enquiry_receipt->amount ?></td>
                                                    <td style="text-align: right;"><?= $studentLedger->student->enquiry_receipt->concession_amount ?></td>
                                                    <td style="text-align: right;"><?= $studentLedger->student->enquiry_receipt->fine_amount ?></td>
                                                    <td style="text-align: right;"><?= $studentLedger->student->enquiry_receipt->total_amount ?></td>
                                                </tr>
                                                <?php
                                            }
                                            foreach ($studentLedger->fee_receipts as $fee_receipt) 
                                            {
                                                $grand_total+=$fee_receipt->total_amount;
                                                ?>
                                                <tr>
                                                    <td><?= $fee_receipt->receipt_no ?></td>
                                                    <td><?= $fee_receipt->receipt_date ?></td>
                                                    <td>
                                                        <?php
                                                        if($fee_receipt->receipt_fee_category->fee_collection=='Individual')
                                                        {
                                                            echo $fee_receipt->fee_type_role->name;
                                                        }
                                                        else
                                                        {
                                                            echo $fee_receipt->receipt_fee_category->name;
                                                        }
                                                        ?>    
                                                    </td>
                                                    <td style="text-align: right;"><?= $fee_receipt->amount ?></td>
                                                    <td style="text-align: right;"><?= $fee_receipt->concession_amount ?></td>
                                                    <td style="text-align: right;"><?= $fee_receipt->fine_amount ?></td>
                                                    <td style="text-align: right;"><?= $fee_receipt->total_amount ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <th colspan="17" style="text-align: right;"><?= $grand_total ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr/>
                                <?php
                            }
                            ?>
