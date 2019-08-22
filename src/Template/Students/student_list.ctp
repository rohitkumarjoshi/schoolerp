<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Student List </label>
            </div>
            <div class="box-body">
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="form-group hide_print">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $checked='';
                            if(empty(@$list_type))
                            {
                                $checked="checked";
                            }
                            echo $this->Form->radio(
                            'list_type',
                            [
                                ['value' => 'rte', 'text' => ' RTE Students', $checked],
                                ['value' => 'discontinue', 'text' => ' Discontinue Students'],
                                ['value' => 'new_admission', 'text' => ' New Admission List'],
                                ['value' => 'new_old_list', 'text' => ' New and Old Students List'],
                                ['value' => 'new_hostel', 'text' => ' New Hostel List'],
                                ['value' => 'new_old_hostel', 'text' => ' New and Old Hostel List'],
                                ['value' => 'bus', 'text' => ' Bus List'],
                                ['value' => 'pending_document', 'text' => 'Pending Document'],
                                ['value' => 'tc', 'text' => 'TC Student List'],
                            ]
                            ); ?>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                                <label class="control-label"> Medium</label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class</label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('stream_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Section</label>
                            <?php echo $this->Form->control('section_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Section---','options'=>$sections,'id'=>'section_id']);?>
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
                if(!empty($studentLists))
                { ?>

                    <div class="pull-right box-tools hide_print">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label"> Check All </label>
                                <?php echo $this->Form->control('', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>'Check All','class'=>'check_all','checked'=>true]);?>
                            </div>
                        </div>
                        <div id="sample_2_column_toggler" class="displaynone">
                            <label><input type="checkbox" checked data-column="0" class="checkone">Sr. No.</label>
                            <label><input type="checkbox" checked data-column="1" class="checkone">Scholar No.</label>
                            <label><input type="checkbox" checked data-column="2" class="checkone">Name</label>
                            <label><input type="checkbox" checked data-column="3" class="checkone">Father's Name</label>
                            <label><input type="checkbox" checked data-column="4" class="checkone">Mother's Name</label>
                            <label><input type="checkbox" checked data-column="5" class="checkone">Medium</label>
                            <label><input type="checkbox" checked data-column="6" class="checkone">Class</label>
                            <label><input type="checkbox" checked data-column="7" class="checkone">Stream</label>
                            <label><input type="checkbox" checked data-column="8" class="checkone">Section</label>
                            <label><input type="checkbox" checked data-column="9" class="checkone">Date of Admission</label>
                            <label><input type="checkbox" checked data-column="10" class="checkone">Date of Birth</label>
                            <label><input type="checkbox" checked data-column="11" class="checkone">Permanent Address</label>
                            <label><input type="checkbox" checked data-column="12" class="checkone">Current Address</label>
                            <label><input type="checkbox" checked data-column="13" class="checkone">Mobile No.</label>
                            <label><input type="checkbox" checked data-column="14" class="checkone">Gender</label>
                            <label><input type="checkbox" checked data-column="15" class="checkone">Father's Proffession</label>
                            <label><input type="checkbox" checked data-column="16" class="checkone">Mother's Proffession</label>
                            <label><input type="checkbox" checked data-column="17" class="checkone">Category</label>
                            <label><input type="checkbox" checked data-column="18" class="checkone">Caste</label>
                            <label><input type="checkbox" checked data-column="19" class="checkone">Religon</label>
                            <label><input type="checkbox" checked data-column="20" class="checkone">Disability</label>
                            <label><input type="checkbox" checked data-column="21" class="checkone">Adhar Card No.</label>
                            <label><input type="checkbox" checked data-column="22" class="checkone">Hostler</label>
                            <label><input type="checkbox" checked data-column="23" class="checkone">Bus</label>
                            <label><input type="checkbox" checked data-column="24" class="checkone">Email Id</label>
                            <label><input type="checkbox" checked data-column="25" class="checkone">Pending Doc.</label>
                        </div>
                    </div>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <h3>Student List Report</h3>
                                </center>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="sample_2" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Sr. No.</th><th>Scholar No.</th><th>Name</th><th>Father's Name</th><th>Mother's Name</th><th>Medium</th><th>Class</th><th>Stream</th><th>Section</th>
                                            <th>Date of Admission</th><th>Date of Birth</th><th>Permanent Address</th><th>Current Address</th><th>Mobile No.</th><th>Gender</th>
                                            <th>Father's Profession</th>
                                            <th>Mother's Profession</th>
                                            <th>Category</th>
                                            <th>Caste</th><th>Religon</th><th>Disability</th><th>Aadhaar No.</th><th>Hosteller</th><th>Bus</th>
                                            <th>Email Id</th>
                                            <th>Pend. Doc</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sr_no=0;
                                            foreach ($studentLists as $studentList) {
                                                ?>
                                                <tr>
                                                    <td><?= ++$sr_no ?></td>
                                                    <td><?= $studentList->student->scholar_no ?></td>
                                                    <td><?= $studentList->student->name ?></td>
                                                    <td><?= $studentList->student->father_name ?></td>
                                                    <td><?= $studentList->student->mother_name ?></td>
                                                    <td><?= $studentList->medium->name ?></td>
                                                    <td><?= $studentList->student_class->name ?></td>
                                                    <td><?= @$studentList->stream->name ?></td>
                                                    <td><?= @$studentList->section->name ?></td>
                                                    <td><?= @$studentList->student->registration_date ?></td>
                                                    <td><?= @$studentList->student->dob ?></td>
                                                    <td><?= @$studentList->permanent_address ?></td>
                                                    <td><?= @$studentList->correspondence_address ?></td>
                                                    <td><?= @$studentList->student->parent_mobile_no ?></td>
                                                    <td><?= @$studentList->student->gender->name ?></td>
                                                    <td>
                                                        <?php
                                                        $student_father=[];
                                                        foreach ($studentList->student->student_father_professions as $student_father_profession) {
                                                           $student_father[]=h($student_father_profession->student_parent_profession->name);
                                                        }
                                                        echo implode(', ',$student_father);
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $student_mother=[];
                                                        foreach ($studentList->student->student_mother_professions as $student_mother_profession) {
                                                           $student_mother[]=h($student_mother_profession->student_parent_profession->name);
                                                        }
                                                        echo implode(', ',$student_mother);
                                                        ?> 
                                                    </td>
                                                    <td><?= @$studentList->reservation_category->short_name ?></td>
                                                    <td><?= @$studentList->caste->name ?></td>
                                                    <td><?= @$studentList->religion->name ?></td>
                                                    <td><?= @$studentList->student->disability->name ?></td>
                                                    <td><?= @$studentList->aadhaar_no ?></td>
                                                    <td><?= @$studentList->hostel_facility ?></td>
                                                    <td><?= h($studentList->bus_facility) ?></td>
                                                    <td><?= @$studentList->email ?></td>
                                                    <td>
                                                        <?php
                                                        $doc=[];
                                                        $doc_i=0;
                                                       foreach ($studentList->student->document_class_mappings as $document_class_mapping) 
                                                       {
                                                        $doc_i++;
                                                            $doc[]=$doc_i.'. '.$document_class_mapping->document->document_name;
                                                       }
                                                       echo implode(', ', $doc);
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('daterangepicker') ?>
<?= $this->element('data_table') ?>
<?= $this->element('icheck') ?>
<?php
$js="
$(document).ready(function(){
    var grand_total=0;";
    if(@$fee_collection=='paid')
    {
        $js.="$('input.grand_total').each(function(){
            grand_total=$(this).val();
            if(grand_total==0)
            {
                $(this).closest('tr').remove();
            }
        });";
    }

    
    $js.="
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