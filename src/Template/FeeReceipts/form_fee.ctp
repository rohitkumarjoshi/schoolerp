<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Admission Form </label>
            </div>
            <?php
            echo $this->Form->create($enquiryFormStudent,['id'=>'ServiceForm','type'=>'file']);
            ?>
            <div class="box-body">
                <?= $this->Form->control('fee_category_id',['label' => false,'type'=>'hidden','value'=>2])?>
                <?php
                if(!empty($enquiry_id))
                {
                    $name_separated=$enquiryFormStudent->name_separate;
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
                            <label class="control-label">Student Last Name</label>
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
                            <?php echo $this->Form->control('reservation_category_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Reservation Category---','options'=>$reservationCategories,'required'=>true]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> RTE<span class="required" aria-required="true"> * </span></label>
                            <?php
                            $option['Yes']='Yes';
                            $option['No']='No';
                            ?>
                            <?php echo $this->Form->control('rte',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select RTE---','options'=>$option,'required'=>true]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Hosteler<span class="required" aria-required="true"> * </span></label>
                            <?php
                            $hosteler['Yes']='Yes';
                            $hosteler['No']='No';
                            ?>
                            <?php echo $this->Form->control('hostel_facility',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Hostel Facility---','options'=>$hosteler,'required'=>true]);?>
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
                            <label class="control-label"> Mobile No.<span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('mobile_no',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Mobile No.','data-role'=>'tagsinput','id'=>'mobile_no','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Permanent Address <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('permanent_address',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Permanent Address','rows'=>2,'id'=>'permanent_address']);?>
                        </div>
                        <div class="col-md-3">
                          <label class="control-label"><input type="checkbox" id="sameasdata">Same as Permanent Address</label>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Correspondence Address</label>
                            <?php echo $this->Form->control('correspondence_address',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Correspondence Address','rows'=>2,'id'=>'correspondence_address']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Email</label>
                            <?php echo $this->Form->control('email',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Email']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Minority <span class="required" aria-required="true"> * </span></label>
                            <?php
                             echo $this->Form->radio(
                                'minority',
                                [
                                    ['value' => 'Yes', 'text' => ' Yes'],
                                    ['value' => 'No', 'text' => ' No'],
                                ]
                                ); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Living <span class="required" aria-required="true"> * </span></label>
                            <?php
                             echo $this->Form->radio(
                                'living',
                                [
                                    ['value' => 'Urban', 'text' => ' Urban'],
                                    ['value' => 'Rural', 'text' => ' Rural'],
                                ]
                                ); ?>
                        </div>
                    </div>
                    <div class="row">
                         <fieldset>
                            <legend><?= __('Guardian details') ?></legend>
                            <div class="col-md-3">
                                <label class="control-label">Name of local guardian</label>
                                <?php echo $this->Form->control('local_guardian',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Guardian Name','oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Address</label>
                                <?php echo $this->Form->control('guardian_address',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Guardian Address','rows'=>2]);?>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label"> Mobile No.</label>
                                <?php echo $this->Form->control('guardian_mobile_no',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Guardian Mobile No.','data-role'=>'tagsinput','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10']);?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row">
                         <fieldset>
                            <legend><?= __('Transportation') ?></legend>
                            <div class="col-md-4">
                                <label class="control-label"> Transportation<span class="required" aria-required="true"> * </span></label>
                                <?php
                                $transportation['School Bus']='School Bus';
                                $transportation['Own Arrangement']='Own Arrangement';
                                ?>
                                <?php echo $this->Form->control('transportation',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Transportation---','options'=>$transportation,'required'=>true]);?>
                            </div>
                            <div class="col-md-8">
                                <label class="control-label"> If student is coming by his own vehicle, please mention the Licence No.</label>
                                <?php echo $this->Form->control('licence_no',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Licence No.']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Vehicle</label>
                                <?php echo $this->Form->control('vehicle_id',[
                                'label' => false,'class'=>'select2','empty'=>'---Select Vehicle---','options'=>$vehicles,'id'=>'vehicle_id','style'=>'width:100%']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Vehicle Station</label>
                                <?php echo $this->Form->control('vehicle_station_id',[
                                'label' => false,'class'=>'select2','empty'=>'---Select Station---','options'=>$vehicleStations,'id'=>'vehicle_station_id','style'=>'width:100%']);?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row">
                        <fieldset>
                            <legend><?= __('Admission for which class') ?></legend>
                            <div class="col-md-4">
                                <label class="control-label"> Medium <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'required'=>true,'id'=>'medium_id']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('student_class_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Class---','required'=>true,'id'=>'student_class_id','options'=>$studentClasse]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Stream</label>
                                <?php echo $this->Form->control('stream_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id','options'=>$stream]);?>
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
                                'label' => false,'class'=>'form-control','empty'=>'---Select Class---','options'=>$studentClasse]);?>
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
                    <div class="row">
                        <fieldset>
                            <legend><?= __('Document') ?></legend>
                            <div class="col-md-12">
                                <?php echo $this->Form->hidden('student_photo',[
                                'label' => false,'id'=>'snapshot']);?>
                                 <div class="col-md-12">
                                 <input type="button" class="btn btn-info" value="Take Snapshot" id="take_snapshot">
                             </div>
                                <div id="my_camera" class="col-md-6" style="padding-left: 0px !important;padding-top: 5px"></div>
                                <div id="results" class="col-md-6" style="padding-top: 30px">Your captured image will appear here...</div>
                            </div>
                            <div class="col-md-12" id="document">
                            </div>
                        </fieldset>
                    </div>
                    <div id="replaceData">
                        <?= $this->element('get_form_fee') ?>
                    </div>

                
                <?php
                }
                else
                {
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Student First Name <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('first_name',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'First Name','oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Student Middle Name</label>
                            <?php echo $this->Form->control('middle_name',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Middle Name','oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Student Last Name</label>
                            <?php echo $this->Form->control('last_name',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Last Name','oninput'=>"this.value = this.value.replace(/[^a-zA-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
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
                            'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date of Birth','data-date-format'=>'dd-M-yyyy','type'=>'text']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Category<span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('reservation_category_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Reservation Category---','options'=>$reservationCategories,'required'=>true]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> RTE<span class="required" aria-required="true"> * </span></label>
                            <?php
                            $option['Yes']='Yes';
                            $option['No']='No';
                            ?>
                            <?php echo $this->Form->control('rte',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select RTE---','options'=>$option,'required'=>true]);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Hosteler<span class="required" aria-required="true"> * </span></label>
                            <?php
                            $hosteler['Yes']='Yes';
                            $hosteler['No']='No';
                            ?>
                            <?php echo $this->Form->control('hostel_facility',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Hostel Facility---','options'=>$hosteler,'required'=>true]);?>
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
                            <?php echo $this->Form->control('student_father_professions',[
                            'label' => false,'class'=>'select2','data-placeholder'=>'---Select Profession---','options'=>$studentParentProfessions,'id'=>'student_father_profession_id','multiple'=>true,'style'=>'width:100%;']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Mother Name <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('mother_name',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Mother Name','oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                        </div>
                         <div class="col-md-3">
                            <label class="control-label">Mother Profession</label>
                            <?php echo $this->Form->control('student_mother_professions',[
                            'label' => false,'class'=>'select2','data-placeholder'=>'---Select Profession---','options'=>$studentParentProfessions,'id'=>'student_mother_profession_id','multiple'=>true,'style'=>'width:100%;']);?>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label"> Mobile No.<span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('mobile_no',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Mobile No.','data-role'=>'tagsinput','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Permanent Address <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('permanent_address',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Permanent Address','rows'=>2,'id'=>'permanent_address']);?>
                        </div>
                        <div class="col-md-3">
                           <label class="control-label"> <input type="checkbox" id="sameasdata">Same as Permanent Address</label>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Correspondence Address </label>
                            <?php echo $this->Form->control('correspondence_address',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Correspondence Address','rows'=>2,'id'=>'correspondence_address']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Email</label>
                            <?php echo $this->Form->control('email',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Email']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Minority <span class="required" aria-required="true"> * </span></label>
                            <?php
                             echo $this->Form->radio(
                                'minority',
                                [
                                    ['value' => 'Yes', 'text' => ' Yes'],
                                    ['value' => 'No', 'text' => ' No'],
                                ]
                                ); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Living <span class="required" aria-required="true"> * </span></label>
                            <?php
                             echo $this->Form->radio(
                                'living',
                                [
                                    ['value' => 'Urban', 'text' => ' Urban'],
                                    ['value' => 'Rural', 'text' => ' Rural'],
                                ]
                                ); ?>
                        </div>
                    </div>
                    <div class="row">
                         <fieldset>
                            <legend><?= __('Guardian details') ?></legend>
                            <div class="col-md-3">
                                <label class="control-label">Name of local guardian</label>
                                <?php echo $this->Form->control('local_guardian',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Guardian Name']);?>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Address</label>
                                <?php echo $this->Form->control('guardian_address',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Guardian Address','rows'=>2]);?>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label"> Mobile No.</label>
                                <?php echo $this->Form->control('guardian_mobile_no',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Guardian Mobile No.','data-role'=>'tagsinput','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10']);?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row">
                         <fieldset>
                            <legend><?= __('Transportation') ?></legend>
                            <div class="col-md-4">
                                <label class="control-label"> Transportation<span class="required" aria-required="true"> * </span></label>
                                <?php
                                $transportation['School Bus']='School Bus';
                                $transportation['Own Arrangement']='Own Arrangement';
                                ?>
                                <?php echo $this->Form->control('transportation',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Transportation---','options'=>$transportation,'required'=>true]);?>
                            </div>
                            <div class="col-md-8">
                                <label class="control-label"> If student is coming by his own vehicle, please mention the Licence No.</label>
                                <?php echo $this->Form->control('licence_no',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Licence No.']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Vehicle</label>
                                <?php echo $this->Form->control('vehicle_id',[
                                'label' => false,'class'=>'select2','empty'=>'---Select Vehicle---','options'=>$vehicles,'id'=>'vehicle_id','style'=>'width:100%']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Vehicle Station</label>
                                <?php echo $this->Form->control('vehicle_station_id',[
                                'label' => false,'class'=>'select2','empty'=>'---Select Station---','options'=>$vehicleStations,'id'=>'vehicle_station_id','style'=>'width:100%']);?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row">
                        <fieldset>
                            <legend><?= __('Admission for which class') ?></legend>
                            <div class="col-md-4">
                                <label class="control-label"> Medium <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'required'=>true,'id'=>'medium_id']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('student_class_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Class---','required'=>true,'id'=>'student_class_id','options'=>$studentClasse]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Stream</label>
                                <?php echo $this->Form->control('stream_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id','options'=>$stream]);?>
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
                                'label' => false,'class'=>'form-control','empty'=>'---Select Class---','options'=>$studentClasse]);?>
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
                    <div class="row">
                        <fieldset>
                            <legend><?= __('Document') ?></legend>
                            <div class="col-md-12">
                                <?php echo $this->Form->hidden('student_photo',[
                                'label' => false,'id'=>'snapshot']);?>
                                 <div class="col-md-12">
                                 <input type="button" class="btn btn-info" value="Take Snapshot" id="take_snapshot">
                             </div>
                                <div id="my_camera" class="col-md-6" style="padding-left: 0px !important;padding-top: 5px"></div>
                                <div id="results" class="col-md-6" style="padding-top: 30px">Your captured image will appear here...</div>
                            </div>
                            <div class="col-md-12" id="document">
                            </div>
                        </fieldset>
                    </div>
                    <div id="replaceData">
                    </div>
                    <?php
                }
                ?>      
                <?= $this->element('payment_calculation') ?>       
                <?= $this->element('payment_detail') ?> 
                       
            </div>
            <div class="box-footer">
                <div class="row">
                    <center>
                        <div class="col-md-12">
                            <div class="col-md-offset-3 col-md-6">  
                                <?php echo $this->Form->button('Save',['class'=>'btn btn-info','type'=>'submit' ,'id'=>'submit']); ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#FeeDetails">Show Previous Detail</button>
                            </div>
                        </div>
                    </center>       
                </div>
            </div>

            <?= $this->Form->end() ?>  
        </div>
    </div>
</div>
<div id="FeeDetails" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Admission Fee Receipt</h4>
      </div>
      <div class="modal-body">
         <table class="table table-bordered table-hover" id="tab">
            <thead>
                <tr>
                    <th>Recipt No.</th> 
                    <th>Date of Payment</th>
                    <th>Amount Paid</th>
                    <th>Concession</th>
                    <th>Fine</th>
                    <th>Fee Type</th>
                    <th>Remarks</th> 
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($SubmittedFee as $Submittedlist) {
                    $FeeName=[];
                    foreach ($Submittedlist->fee_receipt_rows as $key => $value) { 
                        $FeeName[]=$value->fee_type_master_row->fee_type_master->fee_type->name;
                    } 
                    $Fees = implode(', <br>', $FeeName);
                    $receipt_id=$EncryptingDecrypting->encryptData($Submittedlist->id);
                    ?>
                    <tr>
                        <td><?= $Submittedlist->receipt_no ;?></td>
                        <td><?= $Submittedlist->receipt_date ;?></td>
                        <td><?= $Submittedlist->total_amount ;?></td>
                        <td><?= $Submittedlist->concession_amount ;?></td>
                        <td><?= $Submittedlist->fine_amount ;?></td>
                        <td><?= $Fees ?></td>
                        <td><?= $Submittedlist->remark ;?></td>
                        <td> 
                            <?= $this->Html->link('<i class="fa fa-print"></i>',['controller'=>'FeeReceipts','action'=>'receiptPrint','FeeReceipts','formFee',$receipt_id,$enquiry_id],['escape'=>false,'class'=>'btn btn-primary btn-xs']) ?>
                            <a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $Submittedlist->id; ?>" data-toggle=modal><i class="fa fa-trash-o "></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
              
            </tbody>
        </table>
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
foreach ($SubmittedFee as $Submittedlist) 
{ 
    $receipt_id=$EncryptingDecrypting->encryptData($Submittedlist->id);
    ?>
    <div id="deletemodal<?php echo $Submittedlist->id; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md" >
            <?= $this->Form->create('from',['url'=>['action'=>'delete','formFee',$receipt_id,$enquiry_id]]) ?>
                <div class="modal-content">
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                        Are you sure you want to delete this Receipt?
                        </h4>
                    </div>

                    <div class="modal-body">
                       <?= $this->Form->control('delete_date', ['type' => 'taxt','class'=>'form-control datepicker  input-small','placeholder'=>'Delete Date','required'=>true,'data-date-format'=>'dd-mm-yyyy'])?>
                       <?= $this->Form->control('remark', ['type' => 'taxt','class'=>'form-control input-small','placeholder'=>'Remarks','required'=>true])?>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn  btn-sm btn-info">Yes</button>
                        <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
             
            <?= $this->Form->end() ?>
        </div>
    </div> 
    <?php
}
?>
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
            father_name: {
                required: true
            },
            mother_name: {
                required: true
            },
            gender_id: {
                required: true
            },
            reservation_category_id: {
                required: true
            },
            transportation: {
                required: true
            },
            rte: {
                required: true
            },
            minority: {
                required: true
            },
            living: {
                required: true
            },
            dob: {
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
        invalidHandler: function (event, validator) { //display error alert on form submit   
           
            $('#ServiceForm').bootstrapValidator('revalidateField', 'mobile_no').end().bootstrapValidator({
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
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit').attr('disabled','disabled');
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
    $(document).on('click', '#get_fee', function(e){
        var medium_id = $('#medium_id').val();
        var student_class_id = $('#student_class_id').val();
        var stream_id = $('#stream_id').val();
        var gender_id = $('#gender_id').val();
        url = '".$this->Url->build(['controller'=>'FeeReceipts','action'=>'getFormFee'])."';
        $.post(
            url, 
            {medium_id: medium_id,student_class_id: student_class_id,stream_id: stream_id,gender_id: gender_id}, 
            function(result) {
                $('#replaceData').html(result);
                 var total_amount=0;
                $('.amount_add').each(function(){
                    total_amount+=parseFloat($(this).val());
                });
                $('#amount').val(total_amount);
                $('#total_amount').val(total_amount);
        });
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
                get_document();";
                if(empty($enquiry_id))
                {
                    $js.="get_fee();";
                }
                
        $js.="});
    });
    get_document();";
    if(empty($admission_form_no))
    {
        $js.="calculat_fee();";
    }
    

   $js.="function get_document()
   {
        var student_class_id = $('#student_class_id').val();
        url = '".$this->Url->build(['controller'=>'DocumentClassMappings','action'=>'getDocument'])."';
        $.post(
            url, 
            {student_class_id: student_class_id}, 
            function(result) {
                $('#document').html(result);
        });
    }
    function get_fee()
    {
        var medium_id = $('#medium_id').val();
        var student_class_id = $('#student_class_id').val();
        var stream_id = $('#stream_id').val();
        var gender_id = $('#gender_id').val();
        url = '".$this->Url->build(['controller'=>'FeeReceipts','action'=>'getFormFee'])."';
        $.post(
            url, 
            {medium_id: medium_id,student_class_id: student_class_id,stream_id: stream_id,gender_id: gender_id}, 
            function(result) {
                $('#replaceData').html(result);
                calculat_fee();
        });
    }
    function calculat_fee()
    {
        var total_amount=0;
        $('.amount_add').each(function(){
            total_amount+=parseFloat($(this).val());
        });
        $('#amount').val(total_amount);
        $('#total_amount').val(total_amount);
    }
    $(document).on('ifChanged', '.rowsCount', function(){
        var isNow = $(this);
        if($(this).is(':checked')){
            isNow.closest('tr').find('td input').attr('row','1')
        }
        else{
            isNow.closest('tr').find('td input').attr('row','0')
        }
         removeDisable();
    });
    $(document).on('ifChanged', '.checkDisable', function(){
        var isClass = $(this).attr('uncheck');
        if($(this).is(':checked')){
            $('.' + isClass).attr('column','1');
        }
        else{
            $('.' + isClass).attr('column','0');
        }
        removeDisable();
    });

    function removeDisable(){
        $('.amountValid').each(function(){
            var column = $(this).attr('column');
            var row = $(this).attr('row');
            if(row == 1 && column == 1){
               $(this).removeAttr('disabled');
            }
            else{
                 $(this).attr('disabled','true');
            }
        });
        calcuteAmount();
    }

    function calcuteAmount(){
        $('.checkDisable').each(function(){
            var isClass = $(this).attr('uncheck');
            var totalAmount = $(this).attr('totalAmount');
            var total = 0;
            $('.' + isClass).each(function(){
                var column = $(this).attr('column');
                var row = $(this).attr('row');
                if(row == 1 && column == 1){
                    var amount = parseInt($(this).val());
                    total=parseInt(total)+amount;
                }
            });
            $('.'+totalAmount).val(total);
        });
        grossTotal();
    }

    function grossTotal(){
        var totalAmount=0;
        $('.gross').each(function(){
            var amount = parseInt($(this).val());
            totalAmount=parseInt(totalAmount)+amount;
        });
        $('.GrossAmount').val(totalAmount);
        $('.totalFee').val(totalAmount);
    }

    $(document).on('keyup', '.amountValid', function(){
        var actualAmount=parseInt($(this).attr('actualAmount'));
        var isClass = $(this).attr('uncheck');
        var totalAmount = $(this).attr('totalAmount');

        var inputted = parseInt($(this).val());
        var total = 0; 
        if( (inputted > actualAmount) || (inputted < 1) || ($(this).val().length == 0)){
            alert('Invalid Amount'); 
            $(this).val(actualAmount);
            calcuteAmount();
        }
        else{
           calcuteAmount(); 
        }
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