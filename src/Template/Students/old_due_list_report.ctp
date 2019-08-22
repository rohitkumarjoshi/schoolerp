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
                <label >Old Due List</label>
            </div>
            <div class="box-body">

                <?php
                    if(@sizeof(@$students) > 0 ){ ?>
                <div class="pull-right box-tools">
                    <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h3>Old Due Report</h3>
                            </center>
                            <table class="table table-bordered" style="text-align: center !important;">
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
<?php
$js="
$(document).ready(function(){
     
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

