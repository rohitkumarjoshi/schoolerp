<?php echo $this->Html->css('mystyles'); ?>
<?php
use Cake\Controller\Component;
 
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>
<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Due List</label>
            </div>
            <div class="actions">
                    <div class="actions">
                     <!-- <?php echo $this->Html->link('Excel',['controller'=>'Students','action' => 'exportDueListReport'],['target'=>'_blank']); ?> -->
                     <button onclick="exportTableToExcel('due')">Export Table Data To Excel File</button>



            </div>
            <div class="box-body">
                <?= $this->Form->create('form1',['class'=>'FormSubmit','id'=>'ServiceForm']) ?>
                <div class="form-group hide_print">    
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label"> Medium </label>
                            <?php echo $this->Form->control('medium_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class </label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id']);?>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('stream_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
                        </div>
						<div class="col-md-2">
                            <label class="control-label"> Section</label>
                            <?php echo $this->Form->control('section_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Section---','options'=>$sections,'id'=>'section_id']);?>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label"> Months</label>
                            <?php echo $this->Form->control('month_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Month---','id'=>'month_id','options'=>$feeMonths]);?>
                        </div> 
                    </div>   
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label" style="color: #ff6468;"> Check All </label>
                            <?php echo $this->Form->control('', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>'Check All','class'=>'check_all']);?>
                        </div>
                        <?php $individual='';
                        foreach ($feeCategories as $feeCategory) {
                            
                                 ?>
                                <div class="col-md-2">
                                    <label class="control-label"> <?= $feeCategory->name;?> </label>
                                    <?php echo $this->Form->control('fee_category_id[]', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>$feeCategory->id,'class'=>'checkone']);?>
                                </div>
                                <?php
                        }
                        ?> 
                    </div>
                    <span class="help-block"></span>
                    <div class="box-footer">
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-6">  
                                        <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                                    </div>
                                </div>
                            </center>       
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>

                <?php
                if(@sizeof(@$studentClasses) > 0 ){ ?>
                <div class="pull-right box-tools">
                    <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        
                            <center>
                                <h3>Due List</h3>
                            </center>
                            <?php
                         // pr($section_data[$section_id]); exit;
                            $totalAmounts=0;
                            $grand_amount=[];
                                    $grand_old_amount=[];
                                    $div=0;
                            foreach ($studentClasses as $studentClass) 
                            { 
                                $x=0;
                                $div++;
                                $class_row=[];
                                ?>
                                <div class="col-md-12 <?php echo "div".$div; ?>">
                                <p><h4>Class:- <?= h($studentClass->name) ?> <?php if(!empty($section_id)){echo $section_data[$section_id]; }?></h4></p>
                               
                                <table class="table table-bordered" style="text-align: center !important;" id="due">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">S.No.</th>
                                            <th style="text-align: center;">Scholar No.</th>
                                            <th>Name</th> 
                                            <?php
                                            if(in_array(1,$fee_category_ids))
                                            {
                                                ?>
                                                <th style="text-align: center;">Months for which the Fee is Due</th> 
                                                <?php
                                                $colspan=4;
                                            }
                                            else
                                            {
                                                $colspan=3;
                                            }
                                            foreach ($feeCategories as $feeCategory) 
                                            {
                                                if(in_array($feeCategory->id,$fee_category_ids))
                                                {
                                                ?>
                                                <th style="text-align: right;"><?= h($feeCategory->name) ?></th> 
                                                <th style="text-align: right;">Old <?= h($feeCategory->name) ?></th> 
                                                <?php
                                                }
                                            }
                                            ?>
                                            <th style="text-align: right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                    foreach ($studentClass->student_infos as $StudentInfo) 
                                    {
                                        $current_session_year_id=$StudentInfo->student->session_year_id;
                                        if($current_session_year_id!=$sessionYears)
                                        {
                                            if(in_array(3,$fee_category_ids) || in_array(2,$fee_category_ids))
                                            {
                                                goto a;
                                            }
                                        }
                                        $row_show=0;
                                        $monthsSubmitArray=[];
                                        $monthsArray=[];
                                        foreach ($fee_category_ids as $key => $category_id) 
                                        {
                                            $feeData=[];
                                            if($StudentInfo->hostel_facility=='Yes' && $category_id==6)
                                            {
                                                $feeData=$Component->dueFee($StudentInfo->id,$sessionYears,$category_id,$month_id);
                                            }
                                            if($category_id != 6)
                                            {
                                                $feeData=$Component->dueFee($StudentInfo->id,$sessionYears,$category_id,$month_id);
                                            }
                                            $old_fee_amount=$Component->getOldFee($StudentInfo->student_id,$sessionYears,$category_id);
                                            

                                            $monthlyDues=0;
                                            $FeeAmount=0;
                                            $submittedAmounts=0;
                                            
                                            $totalSubmitted=0;
                                            $totalFee=0;
                                            foreach ($feeData as $feeTypeMaster)
                                            {
                                                foreach ($feeTypeMaster->fee_type_master_rows as $fee_type_master_row) 
                                                {
                                                    if(!empty($fee_type_master_row->fee_type_student_masters))
                                                    {
                                                        foreach ($fee_type_master_row->fee_type_student_masters as $fee_type_student_master) {
                                                            $FeeAmount=$fee_type_student_master->amount;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $FeeAmount=$fee_type_master_row->amount;
                                                    }
                                                    
                                                    $fee_type_master_row->fee_receipt_rows;
                                                    $submittedAmounts = @$fee_type_master_row->fee_receipt_rows[0]->total_amount;
                                                    $totalFee+=$FeeAmount;
                                                    $totalSubmitted+=$submittedAmounts;
                                                    $monthlyDues+=$FeeAmount-$submittedAmounts;

                                                    if(@$fee_type_master_row->fee_receipt_rows[0]->fee_month)
                                                    {
                                                        $monthsSubmitArray[]=@$fee_type_master_row->fee_receipt_rows[0]->fee_month->name;
                                                    }
                                                    if(@$fee_type_master_row['_matchingData']['FeeMonths'])
                                                    {
                                                        $monthsArray[]=@$fee_type_master_row['_matchingData']['FeeMonths']['name'];
                                                    }

                                                }

                                            }
                                            $row_show+=$monthlyDues;
                                            $row_show+=$old_fee_amount;
                                            $row_amount[$category_id]=$monthlyDues;
                                            $row_old_amount[$category_id]=$old_fee_amount;
                                            
                                        }
                                        if($row_show > 0)
                                        {
                                            $gend=($StudentInfo->student->gender_id==1)?'S/O':'D/O';
                                            ?> 
                                            <tr>
                                                <td><?= ++$x;?></td>
                                                <td><?= $StudentInfo->student->scholar_no;?></td>
                                                
                                                <td style="text-align: left;"><?= $StudentInfo->student->name.' '.$gend.' '.$StudentInfo->student->father_name?></td> 
                                            <?php 
                                            $showDueMonth='';
                                            $dueMonth=[];
                                            if(in_array(1,$fee_category_ids))
                                            {
                                                $dueMonth=array_merge(array_diff($monthsSubmitArray, $monthsArray), array_diff($monthsArray, $monthsSubmitArray));
                                                $showDueMonth=implode(', ', array_unique($dueMonth));
                                                ?>
                                                <td><?= $showDueMonth ?></td> 
                                                <?php
                                            }
                                            $row_no=0;
                                            $total=0;
                                            foreach ($feeCategories as $feeCategory) 
                                            {
                                                if(in_array($feeCategory->id,$fee_category_ids))
                                                {
                                                    $class_row[++$row_no][]=$row_amount[$feeCategory->id];
                                                    $class_row[++$row_no][]=$row_old_amount[$feeCategory->id];
                                                    $total+=$row_amount[$feeCategory->id];
                                                    $total+=$row_old_amount[$feeCategory->id];
                                                    $grand_amount[$feeCategory->id][]=$row_amount[$feeCategory->id];
                                                    $grand_old_amount[$feeCategory->id][]=$row_old_amount[$feeCategory->id];
                                                    ?>
                                                    <td style="text-align: right;"><?= $this->Number->format($row_amount[$feeCategory->id]);?></td>
                                                    <td style="text-align: right;"><?= $this->Number->format($row_old_amount[$feeCategory->id]);?></td>
                                                    <?php
                                                }
                                            }
                                            ?>   
                                               <th style="text-align: right;"><?= $this->Number->format($total);?></th>  
                                            </tr>
                                            <?php
                                             //$totalAmounts+=$row_amount;
                                        }
                                        a:    
                                        
                                    }
                                   // pr($class_row);
                                    ?>
                                        <tr>
                                            <th colspan="<?= $colspan ?>" style="text-align: center;">Total</th>
                                            <?php
                                            $total_class=0;
                                            foreach ($class_row as $key) 
                                            {
                                                $total_class+=array_sum($key);
                                                ?>
                                                <th style="text-align: right;"><?= $this->Number->format(array_sum($key)) ?></th>
                                                <?php
                                            }
                                            ?>
                                            <th style="text-align: right;"><?= $this->Number->format($total_class) ?></th>
                                            
                                        </tr>
                                         <p><h4>Total no. of students whose fee is due :- <?= $x ?></h4></p>
                                        
                                    </tbody>
                                </table>
                                </div>
                                 <?php
                                 if($x == 0)
                                 {
                                    ?>
                                    <style type="text/css">
                                        .div<?php echo $div; ?>
                                        {
                                            display: none;
                                        }
                                    </style>
                                    <?php
                                 }
                                 
                            }
                            ?>
                        
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <?php
                                    foreach ($feeCategories as $feeCategory) 
                                    {
                                        if(in_array($feeCategory->id,$fee_category_ids))
                                        {
                                        ?>
                                        <th style="text-align: center;"><?= h($feeCategory->name) ?></th> 
                                        <th style="text-align: center;">Old <?= h($feeCategory->name) ?></th> 
                                        <?php
                                        }
                                    }
                                    ?>
                                     <th style="text-align: center;">Total</th> 
                                </tr>
                                <tr>
                                    <?php
                                    $grand_total=0;
                                    foreach ($feeCategories as $feeCategory) 
                                    {
                                        if(in_array($feeCategory->id,$fee_category_ids))
                                        {
                                            $grand_total+=array_sum($grand_amount[$feeCategory->id]);
                                            $grand_total+=array_sum($grand_old_amount[$feeCategory->id]);
                                            ?>
                                            <th style="text-align: center;"><?= $this->Number->format(array_sum($grand_amount[$feeCategory->id])) ?></th> 
                                            <th style="text-align: center;"><?= $this->Number->format(array_sum($grand_old_amount[$feeCategory->id])) ?></th>  
                                            <?php
                                        }
                                    }
                                    ?>
                                    <th style="text-align: center;"><?= $this->Number->format($grand_total) ?></th> 
                                </tr>
                            </table>                            
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('validate') ?> 
<?= $this->element('icheck') ?>
<script type="text/javascript">
   function exportTableToExcel(due, filename = 'DueListReport'){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>

<?php
$js="
$(document).ready(function(){
    
     $('#ServiceForm').validate({ 
        rules: {
            'fee_category_id[]': {
              required: true,
              minlength: 1
          }
        }
    });
    $(document).on('ifChanged', '.check_all', function(){
        if($(this).is(':checked')){
            $('.checkone').each(function(){
                $(this).attr('checked',true).iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });
                $(this).closest('div').addClass('checked');
            });
        }
        else
        {
            $('.checkone').each(function(){
                $(this).attr('checked',false).iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });
            });
        }
    });
    $(document).on('change', '#medium_id', function(e){
        var medium_id = $(this).val();
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getClass.json'])."';
        $.post(
            url, 
            {medium_id: medium_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#student_class_id').html(obj.response);
        });
    });
    $(document).on('change', '#student_class_id', function(e){
        var student_class_id = $(this).val();
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getStream.json'])."';
        $.post(
            url, 
            {student_class_id: student_class_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#stream_id').html(obj.response);
        });
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>

