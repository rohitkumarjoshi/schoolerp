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
hr.dash {
  border-top: 1px dashed black;
}
</style>
</head>
    <body class="main_body">
	<div class="watermark"><br/><div id="bg-text"><?= $this->Html->image('school_logo/reportlogo.png',['style'=>  'width:30%']) ?> </div></div>
    	<table class="campus" width="100%"  border="1"  style="border-collapse:collapse;font-family:Arial, Helvetica, sans-serif;">
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
			                        <td align="center" style="font-size:12px">
			                            <?= $school->address ?>
			                        </td>
			                    </tr>
			                    <tr>
			                        <td align="center" style="font-size:12px">
			                            Mob.: 9829104040, 9829104343<br/>
			                            E-mail: usois@ostwal.com
			                        </td>
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
	        		<?= $feeReceipt->has('student_info')? $feeReceipt->student_info->student_class->name:$feeReceipt->enquiry_form_student->student_class->name ?>
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
	        		<?= $feeReceipt->has('student_info')? $feeReceipt->student_info->section->name : '' ?><br/>
					<span>Mobile No.: </span><?= $feeReceipt->has('student_info')? $feeReceipt->student_info->receipt_student->parent_mobile_no : $feeReceipt->enquiry_form_student->parent_mobile_no ?>
	        	</td>
	        	<td class="pad" width="30%">
	        		<span>R.No.: </span><?= $feeReceipt->receipt_no ?><br/>
	        		<span>Date: </span><?= date('d-M-Y', strtotime($feeReceipt->receipt_date)) ?><br/>
	        		<span>Faculty: </span><?= $auth->User('employee.name') ?><br/>
					<span>Session: </span><?= $auth->User('session_name') ?>
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
	                $fee_type_name=(!empty($feeReceipt->fee_type_role_id))?'Old '.@$feeReceipt->fee_type_role->name:'Old Installment Fee';
					
	            }
	            $fee_category_id=$feeReceipt->fee_category_id;
	            if($feeReceipt->fee_category_id==1)
	            {
	                if(!empty($fee_receipt_row->fee_type_student_master))
	                {
	                    $FeeName[$fee_type_name][]=['month'=>$fee_receipt_row->fee_month->name,'amount'=>$fee_receipt_row->amount];
	                }
	                else
	                {
	                    $FeeName[$fee_type_name][]=['month'=>$fee_receipt_row->fee_month->name,'amount'=>$fee_receipt_row->amount];
						//print_r($FeeName);exit;
	                }
	            }
	            else
	            {
	                $FeeName[$fee_type_name][]=['month'=>'','amount'=>$fee_receipt_row->amount];
					
	            }
	        }
	        if($fee_category_id!=1)
	        {
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
			                echo "(".implode(",", $month).")";
			            }
			            ?>
			        	</td>
			        	<td  class="pad" style="text-align: center;">
			        		<?= array_sum($amount) ?>
			        	</td>
			        </tr>
		            <?php
		           
		        }
	        }
	        else
	        {
		        $month=[];
		        $amount=[];
		        foreach ($FeeName as $key => $value_data) 
		        {
		            
		            foreach ($value_data as $key => $value) {
			                if($value['month']!='')
			                {
			                    $month[]=$value['month'];
			                }
			                
			                $amount[]=$value['amount'];
			            }
		            
		        }
		         ?>
		        <tr>
		        	<td class="pad">
		        		<?php
			            if(!empty($month))
			            {
			            	$month=array_unique($month);
			            	foreach ($month as $key => $value) {
			            		if($value=='Apr')
			            		{
			            			echo ' I<sup>st</sup>';
			            		}
			            		if($value=='Jul')
			            		{
			            			echo ' II<sup>nd</sup>';
			            		}
			            		if($value=='Oct')
			            		{
			            			echo ' III<sup>rd</sup>';
			            		}
			            		if($value=='Oct')
			            		{
			            			echo ' IV<sup>th</sup>';
			            		}
			            	}
			            	echo ' Installment';
			            }
						else
						{
							echo 'Old Installment Fee';
						}
		        		?>
		        	</td>
		        	<td class="pad" style="text-align: center;"><?= array_sum($amount) ?></td>
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
	        <tr>
	        	<td class="pad" style="border-right: none;"><br/><br/>
	        		
	        		<br/></td>
	        	<td class="pad" style=" border-left: none;vertical-align: bottom;text-align: center;">Signature</td>
	        </tr>
        </table>
    </body>
</html>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
 
<style>.watermark {
    position: absolute;
    opacity: 0.25;
    font-size: 3em;
    width: 100%;
    text-align: center;
	 
    z-index: 1000;
	
} 
#bg-text
{
    color:lightgrey;
    font-size:100px;
    transform:rotate(300deg);
    -webkit-transform:rotate(340deg);
	margin-top:40px;
}

</style> 
<div class="watermark"><br/><div id="bg-text"><?= $this->Html->image('school_logo/reportlogo.png',['style'=>  'width:30%']) ?></div></div>
<script>
$(document).ready(function(){
	var clone_cmpus=$('table.campus').clone();
	$('body.main_body').append('<hr class="dash"/>');
 	clone_cmpus.appendTo('body.main_body');
 	
 	window.print();
	window.close();
 });
	
</script>
<?php
$url=$this->url->build(['controller'=>$controller,'action' => $action,$student_info_id,$fee_type_role_ids]);
 echo "<meta http-equiv='Refresh' content='0 ;URL=".$url."'>";
 exit;
?>