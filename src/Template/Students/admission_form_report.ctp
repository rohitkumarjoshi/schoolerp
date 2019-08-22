<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Admission Form Report </label>
            </div>
            <div class="box-body">
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label"> Class </label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Entrance Exam Result </label>
                            <?= $this->Form->control('entrance_exam_resulte',['empty'=>'---Select Result---','options' => ['Passed'=>'Passed','Hold'=>'Hold','Pending'=>'Pending','Faild'=>'Faild'],'class'=>'form-control ','label'=>false,'style'=>'width:100%']) ?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Admission Generated </label>
                             <?= $this->Form->control('admission_generated',['empty'=>'---Select Status---','options' => ['Y'=>'Yes','N'=>'No'],'class'=>'form-control ','label'=>false,'style'=>'width:100%']) ?>
                        </div>
                        <div class="col-md-3"><br/>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <?php
                if(!empty($enquiryFormStudents))
                { ?>
                    <div class="row">
                        <div class="col-md-12">
                           <div class="box-body table-responsive content-scroll" style="width: 100% !important;">
                               <table class="table" >
                                    <thead>
                                        <tr style="white-space: nowrap;">
                                            <th>#</th>
                                            <th scope="col"><?=__('Enquiry No.')?></th>
                                            <th scope="col"><?=__('Form No.')?></th>
                                            <th scope="col"><?=__('Name') ?></th>
                                            <th scope="col"><?=__('Gender') ?></th>
                                            <th scope="col"><?= __('Father Name ') ?></th>
                                            <th scope="col" style="text-align:center;"><?= __('Medium ') ?></th>
                                            <th scope="col" style="text-align:center;"><?= __('Class ') ?></th>
                                            <th scope="col" style="text-align:center;"><?= __('Stream ') ?></th>
                                            <th scope="col" style="text-align:center;"><?= __('Result ') ?></th>
                                            <th scope="col" style="text-align:center;"><?= __('Adm. Gen. ') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="replace_data">
                                        <?php
                                        $i=0;
                                        foreach($enquiryFormStudents as $enquiryFormStudent){ ?>
                                        <tr>
                                            <td><?= ++$i; ?></td>
                                            <td><?=h ($enquiryFormStudent->enquiry_no > 0 ? $enquiryFormStudent->enquiry_no : '-')?></td>
                                            <td><?=h ($enquiryFormStudent->admission_form_no)?></td>
                                            <td><?=h ($enquiryFormStudent->name)?></td>
                                            <td><?=h ($enquiryFormStudent->gender->name)?></td>
                                            <td><?=h ($enquiryFormStudent->father_name)?></td>
                                            <td style="text-align:center;"><?=h ($enquiryFormStudent->medium->name)?></td>
                                            <td style="text-align:center;"><?=h ($enquiryFormStudent->student_class->name)?></td>
                                            <td style="text-align:center;"><?=h (@$enquiryFormStudent->stream->name)?></td>
                                            <td style="text-align:center;"><?=h (@$enquiryFormStudent->entrance_exam_resulte)?></td>
                                            <td style="text-align:center;"><?=h (@$enquiryFormStudent->admission_generated)?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
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
