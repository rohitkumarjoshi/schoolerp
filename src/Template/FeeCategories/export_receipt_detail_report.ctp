<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Receipt Detail Report".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );
//pr($OrderAcceptances->toArray()); exit;
?>

<?php
 $cash_amount=$cheque_amount=$imps_amount=$rtgs_amount=$online_amount=$others_amount=0;
                                    foreach ($dailyCollection as $key2 => $value2)
                                    {
                                        $sr_no=0;
                                        $total_amount=$amount=$concession_amount=$fine_amount=0;
                                   
                                        ?>

<table border="1">
      <thead>
                                                    <tr>
                                                        <th style="text-align: center !important;">Sr. No.</th>
                                                        <th style="text-align: center !important;">Receipt No.</th>
                                                        <th style="text-align: center !important;">Scholar No.</th>
                                                        <th>Name</th>
                                                        <th>Father's Name</th>
                                                        <th>Class</th>
                                                        <th style="text-align: center !important;">Date</th>
                                                        <th style="text-align: left !important;">Amount</th>
                                                        <th style="text-align: left !important;">Concession Amount</th>
                                                        <th style="text-align: left !important;">Fine Amount</th>
                                                        <th style="text-align: left !important;">Total Amount</th>
                                                        <th>Fee Type</th>
                                                        <th>Pay Mode</th>
                                                        <th>Bank Name</th>
                                                        <th>Cheque/Transaction No.</th>
                                                        <th>Cheque Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($value2 as $key => $value)
                                                {
                                                    foreach ($value as $key1 => $value1) 
                                                    {
                                                        $amount+=$value1['amount'];
                                                        $concession_amount+=$value1['concession_amount'];
                                                        $fine_amount+=$value1['fine_amount'];
                                                        $total_amount+=$value1['total_amount'];
                                                        if($value1['pay_mode']=='Cash')
                                                        {
                                                            $cash_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='Cheque')
                                                        {
                                                            $cheque_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='IMPS')
                                                        {
                                                            $imps_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='RTGS')
                                                        {
                                                            $rtgs_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='Online')
                                                        {
                                                            $online_amount+=$value1['total_amount'];
                                                        }
                                                        elseif($value1['pay_mode']=='Others')
                                                        {
                                                            $others_amount+=$value1['total_amount'];
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?= ++$sr_no ?></td>
                                                            <td><?= $value1['receipt_no'] ?></td>
                                                            <td><?= $value1['scholar_no'] ?></td>
                                                            <td><?= $value1['name'] ?></td>
                                                            <td><?= $value1['father_name'] ?></td>
                                                            <td><?= $value1['class'] ?>
                                                                <?php
                                                                if(!empty($value1['stream']))
                                                                {
                                                                    echo '-'.$value1['stream'];
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?= $value1['date'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['amount'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['concession_amount'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['fine_amount'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['total_amount'] ?></td>
                                                            <td><?= $value1['fee_type'] ?></td>
                                                            <td><?= $value1['pay_mode'] ?></td>
                                                            <td><?= $value1['bank'] ?></td>
                                                            <td><?= $value1['cheque_no'].''.$value1['transaction_no'] ?></td>
                                                            <td><?= $value1['cheque_date'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                   
                                                }
                                                ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7" style="text-align: right;">Total Gross Amount </th>
                                                        <th style="text-align: right;"><?= $amount ?></th>
                                                        <th style="text-align: right;"><?= $concession_amount ?></th>
                                                        <th style="text-align: right;"><?= $fine_amount ?></th>
                                                        <th style="text-align: right;"><?= $total_amount ?></th>
                                                        <th colspan="5"></th>
                                                    </tr>
                                                </tfoot> 
                                            </table>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                
                                        
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="text-align: center !important;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center !important;">Cash Amount</th>
                                                <th style="text-align: center !important;">Cheque Amount</th>
                                                <th style="text-align: center !important;">IMPS Amount</th>
                                                <th style="text-align: center !important;">RTGS Amount</th>
                                                <th style="text-align: center !important;">Online Amount</th>
                                                <th style="text-align: center !important;">Others Amount</th>
                                                <th style="text-align: center !important;">Expenses Amount</th>
                                                <th style="text-align: center !important;">Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <th style="text-align: center !important;"><?= $cash_amount ?></th>
                                            <th style="text-align: center !important;"><?= $cheque_amount ?></th>
                                            <th style="text-align: center !important;"><?= $imps_amount ?></th>
                                            <th style="text-align: center !important;"><?= $rtgs_amount ?></th>
                                            <th style="text-align: center !important;"><?= $online_amount ?></th>
                                            <th style="text-align: center !important;"><?= $others_amount ?></th>
                                            <th style="text-align: center !important;"><?= @$expenses->toArray()[0]->total_amount; ?></th>
                                            <th style="text-align: center !important;"><?= $cash_amount-$expenses->toArray()[0]->total_amount; ?></th>
                                        </tbody>
      </table>
			