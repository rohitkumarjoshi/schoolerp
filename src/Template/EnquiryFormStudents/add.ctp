<?php echo $this->Html->css('mystyles'); ?>
<?php
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
                    <label> Enquiry Form </label>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($enquiryFormStudent,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Student First Name <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('first_name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'First Name','oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Student Middle Name</label>
                                <?php echo $this->Form->control('middle_name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Middle Name','oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Student Last Name</label>
                                <?php echo $this->Form->control('last_name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Last Name','oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Gender<span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('gender_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Gender---','options'=>$genders,'required'=>true]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Father Name <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('father_name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Father Name','oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Mother Name <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('mother_name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Mother Name','oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Mobile No.<span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('mobile_no',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Mobile No.','data-role'=>'tagsinput','id'=>'mobile_no','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> RTE<span class="required" aria-required="true"> * </span></label>
                                <?php
                                $option['Yes']='Yes';
                                $option['No']='No';
                                ?>
                                <?php echo $this->Form->control('rte',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select RTE---','options'=>$option,'required'=>true]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Email</label>
                                <?php echo $this->Form->control('email',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Email']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Permanent Address <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('permanent_address',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Permanent Address','rows'=>2]);?>
                            </div>
                        </div>
                        <div class="row">
                            <fieldset>
                                <legend><?= __('Enquiry for which class ') ?></legend>
                                <div class="col-md-4">
                                    <label class="control-label"> Medium <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('medium_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'required'=>true,'id'=>'medium_id']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('student_class_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Class---','required'=>true,'id'=>'student_class_id']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Stream</label>
                                    <?php echo $this->Form->control('stream_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
                                </div>
                            </fieldset>
                        </div>
                        <div class="row">
                            <fieldset>
                                <legend><?= __('Information Regarding Previous Schoool') ?></legend>
                                <div class="col-md-4">
                                    <label class="control-label"> School Name </label>
                                    <?php echo $this->Form->control('last_school',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'School Name']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Medium</label>

                                    <?php echo $this->Form->control('last_medium_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums]);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Last Class</label>

                                    <?php echo $this->Form->control('last_class_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Class---','options'=>$studentClass]);?>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="control-label"> Stream</label>
                                    <?php echo $this->Form->control('last_stream_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','options'=>$stream]);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Percentage/Grade</label>
                                    <?php echo $this->Form->control('percentage_in_last_class',[
                                    'label' => false,'class'=>'form-control','placeholder'=>'Percentage/Grade']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Board</label>
                                    <?php echo $this->Form->control('board',[
                                    'label' => false,'class'=>'form-control','placeholder'=>'Board']);?>
                                </div>
                            </fieldset>
                        </div>
                        <span class="help-block"></span>
                        <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                                        </div>
                                    </div>
                                </center>       
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?= $this->element('taginput') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
    $('#ServiceForm').validate({ 
        rules: {
            first_name: {
                required: true
            },
            father_name: {
                required: true
            },
            mother_name: {
                required: true
            },
            gender_id: {
                required: true
            },
            
            rte: {
                required: true
            },
            permanent_address: {
                required: true
            },
            medium_id: {
                required: true
            },
            student_class_id: {
                required: true
            },
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

    $('#ServiceForm').find('[name=mobile_no]').change(function (e) 
    {
        $('#ServiceForm').bootstrapValidator('revalidateField', 'mobile_no');
    }).end().bootstrapValidator({
            excluded: ':disabled',
            fields: {
                mobile_no: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter at least one mobile no. you like the most.'
                        }
                    }
                }
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

