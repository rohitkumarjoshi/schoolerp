<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <label> <legend><?= __('Add Hostel Out Pass') ?></legend> </label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">
                    <?= $this->Form->create($hostelAttendance) ?>
                    <fieldset>
                        <legend><?= __('Add Hostel Attendance') ?></legend>
                        <?php
                            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
                            echo $this->Form->control('student_id', ['options' => $students]);
                            echo $this->Form->control('hostel_registration_id', ['options' => $hostelRegistrations]);
                            echo $this->Form->control('date');
                            echo $this->Form->control('time');
                        ?>
                    </fieldset>
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
