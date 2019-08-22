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
		<div class="topheader" >
			<label> Enquiry Form </label>
        </div>
	</div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($enquiryFormStudent,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Student Name <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Enter Name']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Father Name <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('father_name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Father Name']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Mother Name <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('mother_name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Mother Name']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Gender<span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('gender_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Gender---','options'=>$genders,'required'=>true]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Mobile No.<span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('mobile_no',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Mobile No.']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Permanent Address <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('permanent_address',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Permanent Address','rows'=>2]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Correspondence Address. </label>
                                <?php echo $this->Form->control('correspondence_address',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Correspondence Address','rows'=>2]);?>
                            </div>
                        </div>
                        <div class="row">
                            <fieldset>
                                <legend><?= __('Admission for which class ') ?></legend>
                                <div class="col-md-4">
                                    <label class="control-label"> Medium <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('medium_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'required'=>true,'id'=>'medium_id']);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('student_class_id',['label' => false,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id','required'=>true]);?>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="control-label"> Stream</label>
                                    <?php echo $this->Form->control('stream_id',['label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
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
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Class---','options'=>$studentClasses]);?>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="control-label"> Stream</label>
                                    <?php echo $this->Form->control('last_stream_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','options'=>$streams]);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Percentage/Grade</label>
                                    <?php echo $this->Form->control('percentage_in_last_class',[
                                    'label' => false,'class'=>'form-control','placeholder'=>'Percentage/Grade']);?>
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


<?= $this->element('validate') ?> 
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
    $('#ServiceForm').validate({ 
        rules: {
            name: {
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
            mobile_no: {
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

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>

