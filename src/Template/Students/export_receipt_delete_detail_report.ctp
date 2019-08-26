<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Receipt Delete Detail Report".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>

			    <table class="table table-bordered" style="text-align: center !important;" id="ledger">
                                        <thead>
                                            <th style="text-align: center;">#</th>
                                            <th style="text-align: center;">Scholar/Form No.</th>
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;"> Delete Date </th>
                                            <th style="text-align: center;">Receipt No.</th>
                                            <th style="text-align: center;">Fee Type</th>
                                            <th style="text-align: center;">Remark</th>
                                            <th style="text-align: right;">Amount</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=0;
                                        $grand_total=0;
                                        foreach ($studentLedgers as $studentLedger) 
                                        {
                                            ?>
                                    
                                            <?php
                                            $grand_total+=$studentLedger->total_amount;
                                                ?>
                                            <tr>
                                                <td><?= ++$i ?></td>
                                                <?php
                                                if(!empty($studentLedger->student_info))
                                                {
                                                    ?>
                                                    <td><?= $studentLedger->student_info->student->scholar_no ?></td>
                                                    <td style="text-align: left;"><?= $studentLedger->student_info->student->name ?></td>
                                                    <?php
                                                }
                                                else if(!empty($studentLedger->enquiry_form_student))
                                                {
                                                    ?>
                                                    <td><?= $studentLedger->enquiry_form_student->admission_form_no ?></td>
                                                    <td style="text-align: left;"><?= $studentLedger->enquiry_form_student->name ?></td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td>Non Scholar</td>
                                                    <td style="text-align: left;"><?= $studentLedger->detail ?></td>
                                                    <?php
                                                }
                                                ?>
                                                
                                                <td><?= $studentLedger->delete_date ?></td>
                                                <td><?= $studentLedger->receipt_no ?></td>
                                                
                                                <td>
                                                    <?php
                                                    if($studentLedger->receipt_fee_category->fee_collection=='Individual')
                                                    {
                                                        echo $studentLedger->fee_type_role->name;
                                                    }
                                                    else
                                                    {
                                                        echo $studentLedger->receipt_fee_category->name;
                                                    }
                                                    ?>    
                                                </td>
                                                <td style="text-align: left;"><?= $studentLedger->deleted_remark ?></td>
                                                <td style="text-align: right;"><?= $studentLedger->total_amount ?></td>
                                            </tr>
                                        
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="17" style="text-align: right;"><?= $grand_total ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>