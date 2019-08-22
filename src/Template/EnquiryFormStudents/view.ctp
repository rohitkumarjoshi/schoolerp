<style type="text/css">
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    
    border-top: none;
}
.enquiry_status{
    float: right !important;
    padding: 5px 12px !important;
    color: #fff;
    font-size: 14px !important;
    margin-top: 5px !important;
    letter-spacing: 1px !important;
    border-top-left-radius: 16px !important;
    border-bottom-left-radius: 16px !important;
    margin-right: -10px !important;
}
.selectpicker
{
    float: right !important;
    padding: 5px 12px !important;
}
.Pending{
    
    background-color: #ffbc1b;
}
th {
    font-weight: 700 !important;
}
.Approved{
    
    background-color: #56c066;
}
.Hold{
    
    background-color: #13cdd4;
}
.Reject{
    
    background-color: #f94c4c;
}
</style>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title" >Enquiry Details</h3>
        <?php
        /*if($enquiryFormStudent->admission_form_no > 0)
        {
            ?>
            <h3 class="box-title enquiry_status <?= h($enquiryFormStudent->enquiry_status) ?>"  ><?= h($enquiryFormStudent->enquiry_status) ?>
           </h3>
            <?php
        }
        else
        {
            ?>
            <div class="box-title selectpicker">
            <?= $this->Form->create($enquiryFormStudent,['id'=>'ServiceForm']) ?>
                <?php echo $this->Form->control('enquiry_status',[
                'label' => false,'class'=>'select2','empty'=>'','options'=>$enquiryStatuses,'required'=>true,'id'=>'enquiry_status']);?>
            <?= $this->Form->end() ?>
            </div>
            <?php
        }*/
        ?>

        
    </div>
    <div class="row">
        <div class="col-md-12"  style="padding: 0px 0px 0px 26px;" >
            <table class="table  "  style="border-collapse:collapse;">
                <tbody>
                    <tr>
                        <th>Enquiry  No.: </th>
                        <td><?= h($enquiryFormStudent->enquiry_no)?></td>
                         <th>Enquiry Mode: </th>
                        <td><?= $this->Text->autoParagraph(h($enquiryFormStudent->enquiry_mode)); ?></td>
                        <th>Enquiry Date: </th>
                        <td><?= h($enquiryFormStudent->enquiry_date) ?></td>
                    </tr>
                    <tr>
                        <th>Name: </th>
                        <td><?= h($enquiryFormStudent->name)?></td>
                        <th>Gender: </th>
                        <td><?= h($enquiryFormStudent->gender->name)?></td>
                        <th>Father Name: </th>
                        <td><?= h($enquiryFormStudent->father_name)?></td>
                    </tr>
                    <tr>
                        <th>Mother Name: </th>
                        <td><?= h($enquiryFormStudent->mother_name)?></td>
                        <th>Mobile No: </th>
                        <td><?= h($enquiryFormStudent->mobile_no)?></td>
                        <th>RTE: </th>
                        <td><?= h($enquiryFormStudent->rte)?></td>
                    </tr>
                    <tr>
                        <th>Mediums: </th>
                        <td><?= h($enquiryFormStudent->medium->name)?></td>
                        <th>Class: </th>
                        <td><?= h($enquiryFormStudent->student_class->name)?></td>
                        <th>Stream: </th>
                        <td><?= h(@$enquiryFormStudent->stream->name)?></td>
                        
                    </tr>
                    <tr>
                        <th>Last School: </th>
                        <td><?= h($enquiryFormStudent->last_school)?></td>
                        <th>Last Medium: </th>
                        <td><?= h(@$enquiryFormStudent->last_medium->name)?></td>
                        <th>Last Class: </th>
                        <td><?= h(@$enquiryFormStudent->last_class->name)?></td>
                        
                    </tr>
                    <tr>
                        <th>Last Stream: </th>
                        <td><?= h(@$enquiryFormStudent->last_stream->name)?></td>
                        <th>Percentage In Last Class: </th>
                        <td><?= h($enquiryFormStudent->percentage_in_last_class) ?></td>
                        <th>Board: </th>
                        <td><?= h($enquiryFormStudent->board) ?></td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                         <td><?= h($enquiryFormStudent->email) ?></td>
                        <th>Permanent Address: </th>
                        <td><?= $this->Text->autoParagraph(h($enquiryFormStudent->permanent_address)); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?>
<?php
$js="
$(document).ready(function(){
    $(document).on('change', '#enquiry_status', function(e){
        $('#ServiceForm').submit();
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>