<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Concession List Report".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>

			   <table class="table table-bordered" style="text-align: center !important;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center !important;">Sr. No.</th>
                                            <th style="text-align: center !important;">Scholar No.</th>
                                            <th>Name</th>
                                            <th>Father's Name</th>
                                            <th style="text-align: center !important;">Date</th>
                                            <th style="text-align: left !important;">Concession Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                        $overall_gross_amount=0;
                                        $sr_no=0;
                                        
                                        foreach ($dailyCollection as $class_id => $classArray) 
                                        {
                                            foreach ($studentClasses as $studentClass_id => $studentClass_name) {
                                                if($studentClass_id==$class_id)
                                                {
                                                    $class_name=$studentClass_name;
                                                }
                                            }
                                            
                                            $rep=0;
                                            $gross_amount=0;
                                            foreach ($classArray as $key => $value)
                                            {
                                                if(empty(@$value['scholar_no']))
                                                {
                                                    ?>
                                                    <tr><th colspan="6">Class: <?= $class_name ?> Stream: <?= $key ?></th></tr>
                                                    <?php
                                                    $gross_amount=0;
                                                    foreach ($value as $key1 => $value1) 
                                                    {
                                                        $gross_amount+=$value1['concession_amount'];
                                                        ?>
                                                        <tr>
                                                            <td><?= ++$sr_no ?></td>
                                                            <td><?= $value1['scholar_no'] ?></td>
                                                            <td><?= $value1['name'] ?></td>
                                                            <td><?= $value1['father_name'] ?></td>
                                                            <td><?= $value1['date'] ?></td>
                                                            <td style="text-align: right;"><?= $value1['concession_amount'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    $overall_gross_amount+=$gross_amount;
                                                    ?>
                                                    <tr><th colspan="5" style="text-align: right;">Total </th><th style="text-align: right;"><?= $gross_amount ?></th>
                                                    <?php
                                                }
                                                else
                                                { 
                                                    $gross_amount+=$value['concession_amount'];
                                                    if($rep==0)
                                                    {
                                                        ?>
                                                        <tr><th colspan="6">Class: <?= $class_name ?></th></tr>
                                                        <?php
                                                        $rep++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?= ++$sr_no ?></td>
                                                        <td><?= $value['scholar_no'] ?></td>
                                                        <td><?= $value['name'] ?></td>
                                                        <td><?= $value['father_name'] ?></td>
                                                        <td><?= $value['date'] ?></td>
                                                        <td style="text-align: right;"><?= $value['concession_amount'] ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            if($rep > 0)
                                            {
                                                $overall_gross_amount+=$gross_amount;
                                                ?>
                                                <tr><th colspan="5" style="text-align: right;">Total </th><th style="text-align: right;"><?= $gross_amount ?></th></tr>
                                                <?php
                                            }
                                            
                                        }
                                        
                                        ?>
                                        
                                    </tbody>
                                    <tfoot>
                                            <tr>
                                                <th colspan="5" style="text-align: right;">Total Gross Amount </th><th style="text-align: right;"><?= $overall_gross_amount ?></th>
                                        </tr>
                                    </tfoot> 
                                </table>