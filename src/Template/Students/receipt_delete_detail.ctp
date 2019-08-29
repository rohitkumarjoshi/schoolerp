<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label>Receipt Delete Detail</label>
                <div class="actions pull-right">
                  <!--  <?php
                    @$url_excel="/?".$url;
                    echo $this->Html->link('<i class="fa fa-file-excel-o"></i> Excel','/Students/exportReceiptDeleteDetailReport/'.$url_excel,['class' =>'btn  green tooltips','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?> -->
                    <!-- <?php echo $this->Html->link('Excel',['controller'=>'Students','action' => 'exportStudentListReport',@$list_type,@$medium_id,@$student_class_id,@$stream_id,@$section_id],['target'=>'_blank']); ?> -->
               </div>
            </div>
            <div class="box-body">
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="form-group hide_print">
                    
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label"> Check All </label>
                            <?php echo $this->Form->control('', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>'Check All','class'=>'check_all']);?>
                        </div>
                        <?php $individual='';
                        foreach ($feeCategories as $feeCategory) {
                            if($feeCategory->fee_collection=='Individual')
                            {
                                foreach ($feeTypeRoles as $feeTypeRole) {
                                    ?>
                                    <div class="col-md-2">
                                        <label class="control-label"> <?= $feeTypeRole->name ?> </label>
                                        <?php echo $this->Form->control('fee_type_role_id[]', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>$feeTypeRole->id,'class'=>'checkone']);?>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                 ?>
                                <div class="col-md-2">
                                    <label class="control-label"> <?= $feeCategory->name;?> </label>
                                    <?php echo $this->Form->control('fee_category_id[]', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>$feeCategory->id,'class'=>'checkone']);?>
                                </div>
                                <?php
                            }
                        }
                        ?> 
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label"> Date Range <span class="required" aria-required="true"> * </span></label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'required'=>true,'placeholder'=>'Date range']) ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div  class="row">
                        <center>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </center>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <?php
                if(!empty($studentLedgers))
                { ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <h3>Receipt Delete Detail</h3>
                                </center>
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
                            </div>
                        </div>
                    </div>
                   
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('validate') ?> 
<?= $this->element('daterangepicker') ?>
<?= $this->element('icheck') ?>
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
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>