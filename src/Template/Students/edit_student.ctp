<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
</style>
<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Student Edit </label>
            </div>
            <?php
            echo $this->Form->create($student,['id'=>'ServiceForm','type'=>'file']);

            ?>
             <?= $this->Form->hidden('student_infos[0][id]',['label'=>false,'value'=>$student->student_infos[0]->id]); ?>
            <div class="box-body">
                <?php
                $name_separated=$student->name_separate;
                $name_separate=explode(',',$name_separated);
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Student First Name <span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('first_name',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'First Name','value'=>$name_separate[0],'oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Student Middle Name</label>
                        <?php echo $this->Form->control('middle_name',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Middle Name','value'=>$name_separate[1],'oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Student Last Name </label>
                        <?php echo $this->Form->control('last_name',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Last Name','value'=>$name_separate[2],'oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Gender<span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('gender_id',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select Gender---','options'=>$genders,'required'=>true,'id'=>'gender_id']);?>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-3">
                        <label class="control-label"> Date of Birth<span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('dob',[
                        'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date of Birth','data-date-format'=>'dd-M-yyyy','type'=>'text']); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Category<span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('student_infos[0][reservation_category_id]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Reservation Category---','options'=>$reservationCategories,'required'=>true,'value'=>$student->student_infos[0]->reservation_category_id]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> RTE<span class="required" aria-required="true"> * </span></label>
                        <?php
                        $option['Yes']='Yes';
                        $option['No']='No';
                        ?>
                        <?php echo $this->Form->control('student_infos[0][rte]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select RTE---','options'=>$option,'required'=>true,'value'=>$student->student_infos[0]->rte]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Hosteler<span class="required" aria-required="true"> * </span></label>
                        <?php
                        $hosteler['Yes']='Yes';
                        $hosteler['No']='No';
                        ?>
                        <?php echo $this->Form->control('student_infos[0][hostel_facility]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select Hostel Facility---','options'=>$hosteler,'required'=>true,'value'=>$student->student_infos[0]->hostel_facility]);?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label"> Father Name <span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('father_name',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Father Name','oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Father Profession</label>
                        <?php 
                        echo $this->Form->control('student_father_professions',[
                        'label' => false,'class'=>'select2','data-placeholder'=>'---Select Profession---','options'=>$studentParentProfessions,'id'=>'student_father_profession_id','multiple'=>true,'style'=>'width:100%;','value'=>$student_father]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Mother Name <span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('mother_name',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Mother Name','oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Mother Profession</label>
                        <?php 
                        echo $this->Form->control('student_mother_professions',[
                        'label' => false,'class'=>'select2','data-placeholder'=>'---Select Profession---','options'=>$studentParentProfessions,'id'=>'student_mother_profession_id','multiple'=>true,'style'=>'width:100%;','value'=>$student_mother]);?>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Permanent Address <span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('student_infos[0][permanent_address]',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Permanent Address','rows'=>2,'value'=>$student->student_infos[0]->permanent_address,'id'=>'permanent_address']);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> <input type="checkbox" id="sameasdata">Same as Permanent Address</label>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Correspondence Address </label>
                        <?php echo $this->Form->control('student_infos[0][correspondence_address]',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Correspondence Address','rows'=>2,'value'=>$student->student_infos[0]->correspondence_address,'id'=>'correspondence_address']);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Mobile No.<span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('parent_mobile_no',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Mobile No.','data-role'=>'tagsinput','value'=>$student->parent_mobile_no,'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10']);?>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-3">
                        <label class="control-label"> Nationality</label>
                        <?php echo $this->Form->control('nationality',[
                        'label' => false,'class'=>'form-control','placeholder'=>'Nationality','value'=>$student->nationality,'oninput'=>"this.value = this.value.replace(/[^a-zA-Z]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                    </div>
                     <div class="col-md-3">
                        <label class="control-label"> House</label>
                        <?php echo $this->Form->control('student_infos[0][house_id]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select House---','options'=>$houses,'id'=>'house_id','value'=>$student->student_infos[0]->house_id]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Caste</label>
                        <?php echo $this->Form->control('student_infos[0][caste_id]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select Caste---','options'=>$castes,'id'=>'caste_id','value'=>$student->student_infos[0]->caste_id]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Religion</label>
                        <?php echo $this->Form->control('student_infos[0][religion_id]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select Religion---','options'=>$religions,'id'=>'religion_id','value'=>$student->student_infos[0]->religion_id]);?>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-3">
                        <label class="control-label">Student Mobile No.</label>
                        <?php echo $this->Form->control('student_mobile_no',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Mobile No.','data-role'=>'tagsinput','value'=>$student->student_mobile_no,'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10']);?>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="control-label"> State</label>
                        <?php echo $this->Form->control('student_infos[0][state_id]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select ---','options'=>$states,'id'=>'state_id','value'=>$student->student_infos[0]->state_id]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> City</label>
                        <?php echo $this->Form->control('student_infos[0][city_id]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select ---','options'=>$cities,'id'=>'city_id','value'=>$student->student_infos[0]->city_id]);?>
                    </div>  
                     <div class="col-md-3">
                        <label class="control-label"> Disability</label>
                        <?php echo $this->Form->control('disability_id',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select ---','options'=>$disabilities,'value'=>$student->disability_id]);?>
                    </div>
                     
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label"> Scholar No.<span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('scholar_no',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Scholar No.','value'=>$student->scholar_no]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Roll No.</label>
                        <?php echo $this->Form->control('student_infos[0][roll_no]',[
                        'label' => false,'class'=>'form-control ','placeholder'=>' Roll No.','value'=>$student->student_infos[0]->roll_no]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Registration Date<span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('registration_date',[
                        'label' => false,'class'=>'form-control datepicker','placeholder'=>'Registration Date','type'=>'text','data-date-format'=>'dd-M-yyyy']);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Student Status<span class="required" aria-required="true"> * </span></label>
                        <?php
                        $options['Continue']='Continue';
                        $options['Discontinue']='Discontinue';
                        $options['Temporary Discontinue']='Temporary Discontinue';
                        ?>
                        <?php echo $this->Form->control('student_infos[0][student_status]',[
                        'label' => false,'class'=>'form-control','empty'=>'---Select ---','options'=>$options,'required'=>true,'value'=>$student->student_infos[0]->student_status]);?>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Minority <span class="required" aria-required="true"> * </span></label>
                        <?php
                         echo $this->Form->radio(
                            'student_infos[0][minority]',
                            [
                                ['value' => 'Yes', 'text' => ' Yes'],
                                ['value' => 'No', 'text' => ' No']
                            ],
                            ['value'=>$student->student_infos[0]->minority]
                            ); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Living <span class="required" aria-required="true"> * </span></label>
                        <?php
                         echo $this->Form->radio(
                            'student_infos[0][living]',
                            [
                                ['value' => 'Urban', 'text' => ' Urban'],
                                ['value' => 'Rural', 'text' => ' Rural']
                            ],['value'=>$student->student_infos[0]->living]
                            ); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Email</label>
                        <?php echo $this->Form->control('student_infos[0][email]',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'Email','value'=>$student->student_infos[0]->email]);?>
                    </div>
                </div>
                <div class="row">
                    <fieldset>
                        <legend><?= __('Transport') ?></legend>
                        <div class="col-md-3">
                            <label class="control-label">Bus Facility <span class="required" aria-required="true"> * </span></label>
                            <?php
                             echo $this->Form->radio(
                                'student_infos[0][bus_facility]',
                                [
                                    ['value' => 'Yes', 'text' => ' Yes'],
                                    ['value' => 'No', 'text' => ' No']
                                ],['value'=>$student->student_infos[0]->bus_facility]
                                ); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Pickup Vehicle</label>
                            <?php echo $this->Form->control('student_infos[0][vehicle_id]',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Vehicle---','options'=>$vehicles,'id'=>'vehicle_id','value'=>$student->student_infos[0]->vehicle_id]);?>
                        </div>
						<div class="col-md-3">
                            <label class="control-label">Drop Vehicle</label>
                            <?php echo $this->Form->control('student_infos[0][drop_vechile_id]',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Vehicle---','options'=>$vehicles,'id'=>'vehicle_id','value'=>$student->student_infos[0]->drop_vechile_id]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Vehicle Station</label>                                
                            <?php echo $this->Form->control('student_infos[0][vehicle_station_id]',[
                            'label' => false,'class'=>'select2','empty'=>'---Select Station---','options'=>$vehicleStations,'id'=>'vehicle_station_id','value'=>$student->student_infos[0]->vehicle_station_id,'style'=>'width:100%']);?>
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <fieldset>
                        <legend><?= __('Current class') ?></legend>
                        <div class="col-md-3">
                            <label class="control-label"> Medium <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('student_infos[0][medium_id]',[
                            'label' => false,'class'=>'form-control medium_id','empty'=>'---Select Medium---','options'=>$mediums,'required'=>true,'id'=>'medium_id','value'=>$student->student_infos[0]->medium_id]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('student_infos[0][student_class_id]',[
                            'label' => false,'class'=>'form-control student_class_id','empty'=>'---Select Class---','required'=>true,'id'=>'student_class_id','options'=>$admissionClasses,'value'=>$student->student_infos[0]->student_class_id]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('student_infos[0][stream_id]',[
                            'label' => false,'class'=>'form-control stream_id','empty'=>'---Select Stream---','id'=>'stream_id','options'=>$admissionStreams,'value'=>$student->student_infos[0]->stream_id]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Section</label>
                            <?php echo $this->Form->control('student_infos[0][section_id]',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Section---','options'=>$sections,'id'=>'section_id','value'=>$student->student_infos[0]->section_id]);?>
                        </div> 
                    </fieldset>
                </div>
                <div class="row">
                    <fieldset>
                        <legend><?= __('Admission for which class') ?></legend>
                        <div class="col-md-3">
                            <label class="control-label"> Medium <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('admission_medium_id',[
                            'label' => false,'class'=>'form-control medium_id','empty'=>'---Select Medium---','options'=>$mediums,'required'=>true,'id'=>'medium_id','value'=>$student->admission_medium_id]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('admission_class_id',[
                            'label' => false,'class'=>'form-control student_class_id','empty'=>'---Select Class---','required'=>true,'id'=>'student_class_id','options'=>$admissionClasses,'value'=>$student->admission_class_id]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('stream_id',[
                            'label' => false,'class'=>'form-control stream_id','empty'=>'---Select Stream---','id'=>'stream_id','options'=>$admissionStreams,'value'=>$student->admission_stream_id]);?>
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <fieldset>
                        <legend><?= __('Document') ?></legend>
                        <div class="col-md-12">
                            <?php echo $this->Form->hidden('student_photo',[
                            'label' => false,'id'=>'snapshot']);?>
                             <div class="col-md-12">
                                 <input type="button" class="btn btn-info" value="Take Snapshot" id="take_snapshot">
                             </div>
                            <div id="my_camera" class="col-md-6" style="padding-left: 0px !important;"></div>
                            <div id="results" class="col-md-6" style="padding-top: 5px;margin-top: 20px;">
                                <?php
                                if(!empty($studentDocumentPhotos))
                                {
                                    echo $this->Html->image($cdn_path.'/'.$studentDocumentPhotos->image_path,['style'=>  'margin-top: 0px;height: 150px;align-content: center; background-color: #f9eded00 !important;width: 200px;']);
                                }
                                else
                                {
                                    echo 'Your captured image will appear here...';
                                }
                                ?>
                           
                            </div>
                        </div>
                        <?php
                        foreach ($documentClassMappings as $documentClassMapping) {
                            ?>
                            <div class="col-md-3">                     
                                <div class="form-group">
                                    <label style="margin-top:5px;"><?= $documentClassMapping->document->document_name ?></label><br/>
                                    <?php
                                    if(!empty($documentClassMapping->student_documents))
                                    {
                                        echo $this->Html->image($cdn_path.'/'.$documentClassMapping->student_documents[0]->image_path,['style'=>  'margin-top: 0px;height: 150px;align-content: center; background-color: #f9eded00 !important;width: 200px;']);
                                    }
                                    ?>
                                    <?= $this->Form->hidden('document_class_mapping[]',['value'=>$documentClassMapping->id,'label'=>false]); ?>
                                    <?= $this->Form->control('document[]', ['label' => false, 'type'=>'file','autocomplete'=>'false','id'=>'document_0', 'accept'=>'image/jpeg,image/jpeg'])?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </fieldset>
                </div>
               
            </div>
            <div class="box-footer">
                <div class="row">
                    <center>
                        <div class="col-md-12">
                            <div class="col-md-offset-3 col-md-6">  
                                <?php echo $this->Form->button('Save',['class'=>'btn btn-info','type'=>'submit' ,'id'=>'submit']); ?>
                            </div>
                        </div>
                    </center>       
                </div>
            </div>

              
            <?= $this->Form->end() ?>  
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('taginput') ?> 
<?= $this->element('validate') ?> 
<?= $this->element('webcam') ?> 
<?= $this->element('icheck') ?> 
<?php
$js="
 $(document).ready(function(){
    $('select2').select2();
    $('#ServiceForm').validate({ 
        rules: {
            first_name: {
                required: true
            },
            gender_id: {
                required: true
            },
            'student_infos[0][reservation_category_id]': {
                required: true
            },
            transportation: {
                required: true
            },
            'student_infos[0][rte]': {
                required: true
            },
            'student_infos[0][permanent_address]': {
                required: true
            },
            'student_infos[0][medium_id]': {
                required: true
            },
            'student_infos[0][student_class_id]': {
                required: true
            },
            dob: {
                required: true
            },
        },
        invalidHandler: function (event, validator) { //display error alert on form submit   
           
            $('#ServiceForm').bootstrapValidator('revalidateField', 'parent_mobile_no').end().bootstrapValidator({
                excluded: ':disabled',
                fields: {
                    parent_mobile_no: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter at least one mobile no. you like the most.'
                            }
                        }
                    }
                }
            });
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit').attr('disabled','disabled');
            form.submit();
        }
    });
    $('#ServiceForm').find('[name=parent_mobile_no]').change(function (e) 
    {
        $('#ServiceForm').bootstrapValidator('revalidateField', 'parent_mobile_no');
    }).end().bootstrapValidator({
            excluded: ':disabled',
            fields: {
                parent_mobile_no: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter at least one mobile no. you like the most.'
                        }
                    }
                }
            }
    });
    /*$(document).on('click', '#get_document', function(e){
        var student_class_id = $('#student_class_id').val();
        url = '".$this->Url->build(['controller'=>'DocumentClassMappings','action'=>'getDocument'])."';
        $.post(
            url, 
            {student_class_id: student_class_id}, 
            function(result) {
                $('#document').html(result);
        });
    });*/
    $(document).on('change', '.medium_id', function(e){
        var medium_id = $(this).val();
        var fieldset=$(this).closest('fieldset');
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getClass.json'])."';
        $.post(
            url, 
            {medium_id: medium_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                fieldset.find('.student_class_id').html(obj.response);
        });
    });
    $(document).on('change', '.student_class_id', function(e){
        var student_class_id = $(this).val();
        var fieldset=$(this).closest('fieldset');
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getStream.json'])."';
        $.post(
            url, 
            {student_class_id: student_class_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                fieldset.find('.stream_id').html(obj.response);
        });
    });
    $(document).on('ifChanged', '#sameasdata', function(){
        
        if($(this).is(':checked')){
            $('#correspondence_address').val($('#permanent_address').val());
        }
        else{
            var emptydata='';
           $('#correspondence_address').val(emptydata);
        }
        
    });
    
     
});

";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>