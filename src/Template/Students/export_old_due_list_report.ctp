<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Old Due List Report".$date.'_'.$time;

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
                                        <th style="text-align: center;">S.No.</th>
                                        <th style="text-align: center;">Scholar No.</th>
                                        <th>Name</th> 
                                        <th style="text-align: center;">Class</th> 
                                        <th style="text-align: center;">Fee Category</th> 
                                        <th style="text-align: right;">Fee Amount</th> 
                                        <th style="text-align: right;">Amount Due</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x=0;
                                    $totalAmounts=0;
                                    $totaldue=0;
                                    foreach ($students as $student) {
                                        foreach ($student->old_fees as $old_fee)
                                        {
                                            $gend=($student->gender_id==1)?'S/O':'D/O';
                                            ?> 
                                            <tr>
                                                <td><?= ++$x;?></td>
                                                <td><?= $student->scholar_no;?></td>
                                                
                                                <td style="text-align: left;"><?= $student->name.' '.$gend.' '.$student->father_name?></td> 
                                                <td>
                                                    <?= $student->student_infos[0]->student_class->roman_name ?>
                                                    </td>
                                                <td> <?= $old_fee->fee_category->name ?></td>
                                        
                                                <td style="text-align: right;"><?= $this->Number->format($old_fee->due_amount);?></td>
                                                <td style="text-align: right;">
                                                    <?php
                                                    if(!empty($old_fee->fee_receipts))
                                                    {
                                                        $total_paid=$old_fee->fee_receipts[0]->total_submit;
                                                        $totaldue+=$old_fee->due_amount-$total_paid;
                                                        echo $this->Number->format($old_fee->due_amount-$total_paid);
                                                    }
                                                    else
                                                    {
                                                        $totaldue+=$old_fee->due_amount;
                                                        echo $this->Number->format($old_fee->due_amount);
                                                    }
                                                    ?>
                                                        
                                                    </td>
                                            </tr>
                                            <?php
                                             $totalAmounts+=$old_fee->due_amount;
                                        }
                                      } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align: center;"><h4>Total</h3></th>
                                        <th style="text-align: right;"><h4><?= $this->Number->format($totalAmounts) ?></h3></th>
                                        <th style="text-align: right;"><h4><?= $this->Number->format($totaldue) ?></h3></th>
                                    </tr>
                                </tfoot>

      </table>
			