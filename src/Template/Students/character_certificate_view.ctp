 <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label>Character Certificate</label>
                <div class="pull-right box-tools">
                    <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                </div>
            </div>
            <div class="box-body" style="font-size: 15px; ">
                <div class="row">
                    <div class="col-md-12">
                    	<?php $gender=($studentLedgers->student->gender_id==1)?'D/O':'S/O'; ?>
                    	<?php $gender_type=($studentLedgers->student->gender_id==1)?'She':'He'; ?>
                        <center>
                        	<h3><u>CERTIFICTE</u></h3>
                            <p>(TO WHOM SO EVER IT MAY CONCERN)</p>
                        </center>
                        <p style="text-align: justify;">
                        	This is to Certify that <u style="font-weight: 700;text-transform: uppercase;"><?= $studentLedgers->student->name ?></u> (<u>Scholar No. <strong><?= $studentLedgers->student->scholar_no ?></strong></u>) <?= $gender ?> <u style="font-weight: 700;text-transform: uppercase;">MR. <?= $studentLedgers->student->father_name ?></u> & <u style="font-weight: 700;text-transform: uppercase;">MRS. <?= $studentLedgers->student->mother_name ?></u> is a regular student of <?= $school->name.', '.$school->address ?>. <?= $gender_type ?> is studying in Class <strong><?= $studentLedgers->student_class->roman_name ?></strong> (<?= $studentLedgers->student_class->name ?>) in present session i.e. <?= $auth->User('session_name') ?>.
                        </p>
                        <p style="text-align: justify;">
                        	As per our school record <span style="text-transform: lowercase;"><?= $gender_type ?></span> <u style="font-weight: 700;">Date of Birth</u> is <u style="font-weight: 700;"><?= $studentLedgers->student->dob ?></u> (<u><?= $this->Numbers->convertNumberToWord($studentLedgers->student->dob->format('j')).' '.$studentLedgers->student->dob->format('F').', '.$this->Numbers->convertNumberToWord($studentLedgers->student->dob->format('Y')) ?></u>).
                        </p>
                        <p style="margin-top:30px;">
                        	<?= $gender_type ?> bears a good moral character.
                        </p>
                        <p style="margin-top:80px;">
                        	(Principal)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>