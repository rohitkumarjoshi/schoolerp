<html>
<head>
<style media="print">
    .hide_print
    {
        display:none !important;
    }
    .tr_bg
    {
        background-color:#999;
    
    }

</style>
<style>
.report-logo
{
    align-content: center;
    display: ruby-base-container;
    position: absolute;
}
.report-header
{
    display: block;
}

.report-logo{
    align-content: center;
    display: ruby-base-container;
    position: absolute;
}
td.pad{
	padding: 5px;
}
</style>
</head>
    <body>
    	<table width="100%"  border="1"  style="border-collapse:collapse;font-family:Arial, Helvetica, sans-serif;">
    		<tr>
    			<td colspan="2">
    				<div class="report-header">
			            <div class="report-logo">
			                <?= $this->Html->image('school_logo/reportlogo.png',['style'=>  'height: 70px;']) ?> 
			            </div>
			            <table align="center"  cellpadding="0" cellspacing="0"  >
			                <tbody>
			                    <tr>
			                        <td  align="center" style="font-size:25px">
			                            <b style="text-transform: uppercase;"><?= $school->name ?></b>
			                        </td>
			                    </tr>
			                    <tr>
			                        <td align="center"  style="font-size:12px">
			                            <?= $school->affiliation_no ?>
			                        </td>
			                    </tr>
			                    <tr>
			                        <td align="center" style="font-size:12px" >
			                            <?= $school->agis ?>
			                        </td>
			                    </tr>
			                    <tr>
			                        <td align="center" style="font-size:12px">
			                            <?= $school->address ?>
			                    </tr>
			                </tbody>
			            </table> 
			        </div>
    			</td>
    		</tr>
	        <tr>
	        	<td class="pad" width="70%">
                    <span>Student's Name: </span>
                    <?= $feeReceipt->has('student_info')? $feeReceipt->student_info->receipt_student->name : $feeReceipt->enquiry_form_student->name ?>
                    <br/>
                    <span>Father's Name: </span>
                    <?= $feeReceipt->has('student_info')? $feeReceipt->student_info->receipt_student->father_name : $feeReceipt->enquiry_form_student->father_name ?>
                    <br/>
                    <span>Class: </span>
                    <?= $feeReceipt->has('student_info')? $feeReceipt->student_info->medium->name.' '.$feeReceipt->student_info->student_class->name:$feeReceipt->enquiry_form_student->medium->name.' '.$feeReceipt->enquiry_form_student->student_class->name ?>
                    &nbsp;
                    <?php
                        if($feeReceipt->has('student_info'))
                        {
                            echo $feeReceipt->student_info->has('stream')?$feeReceipt->student_info->stream->name:'';
                        }
                        else
                        {
                            echo $feeReceipt->enquiry_form_student->has('stream')?$feeReceipt->enquiry_form_student->stream->name:'';
                        }
                    ?>
                    <span>Section: </span>
                    <?= $feeReceipt->has('student_info')? $feeReceipt->student_info->section->name : '' ?>
                </td>
	        	<td class="pad" width="30%">
	        		<span>R.No.: </span><?= $feeReceipt->receipt_no ?><br/>
	        		<span>Date: </span><?= date('d-M-Y', strtotime($feeReceipt->receipt_date)) ?><br/>
	        		<span>Faculty: </span>
	        	</td>
	        </tr>
	        <tr>
	        	<td  class="pad" colspan="2" style="text-align: center;"> 
	        		<span style="color: #fff; background-color: #000;border-radius: 10px;padding: 3px; ">FEE STRUCTURE</span>
	        	</td>
	        </tr>
	        <tr>
	        	<td  class="pad" style="text-align: center;"> PARTICULARS</td>
	        	<td  class="pad" style="text-align: center;"> AMOUNTS</td>
	        </tr>
	        <?php
	        foreach ($feeReceipt->fee_receipt_rows as $fee_receipt_row) 
	        {
	            if(!empty($fee_receipt_row->fee_type_student_master))
	            {
	                $fee_type_name=$fee_receipt_row->fee_type_student_master->fee_type_master_row->fee_type_master->fee_type->name;
	            }
	            else if(!empty($fee_receipt_row->fee_type_master_row))
	            {
	                $fee_type_name=$fee_receipt_row->fee_type_master_row->fee_type_master->fee_type->name;
	            }
	            else
	            {
	                $fee_type_name=(!empty($feeReceipt->fee_type_role_id))?'Old '.@$feeReceipt->fee_type_role->name:'Old '.$feeReceipt->fee_category->name;
	            }
	            if($feeReceipt->fee_category_id==1)
	            {
	                if(!empty($fee_receipt_row->fee_type_student_master))
	                {
	                    $FeeName[$fee_type_name][]=['month'=>$fee_receipt_row->fee_month->name,'amount'=>$fee_receipt_row->amount];
	                }
	                else
	                {
	                    $FeeName[$fee_type_name][]=['month'=>$fee_receipt_row->fee_month->name,'amount'=>$fee_receipt_row->amount];
	                }
	            }
	            else
	            {
	                $FeeName[$fee_type_name][]=['month'=>'','amount'=>$fee_receipt_row->amount];
	            }
	        }
	        foreach ($FeeName as $key => $value_data) 
	        {
	            $month=[];
	            $amount=[];
	            ?>
	            <tr>
		            <td  class="pad">

		            <?php
		            echo $key;
		            foreach ($value_data as $key => $value) {
		                if($value['month']!='')
		                {
		                    $month[]=$value['month'];
		                }
		                
		                $amount[]=$value['amount'];
		            }
		           
		           
		            if(!empty($month))
		            {
		               // echo "(".implode(",", $month).")";
		            }
		            ?>
		        	</td>
		        	<td  class="pad" style="text-align: center;">
		        		<?= array_sum($amount) ?>
		        	</td>
		        </tr>
		       
	            <?php
	        }
	        if(!empty($feeReceipt->concession_amount))
	        {
	            ?>
	            <tr>
		            <td  class="pad">Concession</td>
		            <td  class="pad" style="text-align: center;">
		        		<?= $feeReceipt->concession_amount ?>
		        	</td>
			    </tr>
	            <?php
	        }
	        if(!empty($feeReceipt->fine_amount))
	        {
	            ?>
	            <tr>
		            <td  class="pad">Fine</td>
		            <td  class="pad" style="text-align: center;">
		        		<?= $feeReceipt->fine_amount ?>
		        	</td>
			    </tr>
	            <?php
	        }
	        ?>
	        <tr>
	        	<td class="pad">Grand Total</td>
	        	<td class="pad" style="text-align: center;"><?= $feeReceipt->total_amount ?></td>
	        </tr>
	        <tr>
	        	<td class="pad" colspan="2">Rupees: 
	        	<?= $this->Numbers->convertNumberToWord($feeReceipt->total_amount)." Only."; ?></td>
	        </tr>
	        <tr>
	        	<td class="pad" colspan="2">Payment Mode:- 
		        <?php
		        echo $feeReceipt->payment_type;
		        if($feeReceipt->payment_type=='Cash')
		        {
		            
		        }
		        else if($feeReceipt->payment_type=='Cheque')
		        {
		            echo ", Cheque No.- ".$feeReceipt->cheque_no.", Bank Name- ".$feeReceipt->bank;
		        }
		        else
		        {
		            echo ", Trans. No.- ".$feeReceipt->transaction_no;
		        }
		        ?>
	        	</td>
	        </tr>
        </table>
    </body>
</html>
<script>
	window.print();
	window.close();
</script>
<?php
$url=$this->url->build(['controller'=>$controller,'action' => $action,$student_info_id,$fee_type_role_ids]);
 echo "<meta http-equiv='Refresh' content='0 ;URL=".$url."'>";
 exit;
?>