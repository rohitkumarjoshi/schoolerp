<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentElectiveSubject[]|\Cake\Collection\CollectionInterface $studentElectiveSubjects
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                  <label > Edit Elective Subject </label>
                <?php }else{ ?>
                  <label> Add Elective Subject </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($studentElectiveSubject,['id'=>'ServiceForm','url'=>['action'=>'add','autocomplete'=>false]]) ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Medium <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('medium_id', ['options' => $mediums,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required','val'=>'']);?>
                        </div>

                        <div class="col-md-3">
                            <label class="control-label">Class <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('student_class_id', ['options' =>[],'label'=>false,'class'=>'select2','style'=>'width:100%;','required','val'=>'']);?>
                        </div>
                    
                        <div class="col-md-3">
                            <label class="control-label"> Stream </label>
                            <?php echo $this->Form->control('stream_id', ['options' =>[],'label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                    
                        <div class="col-md-3">
                            <label class="control-label"> Section </label>
                            <?php echo $this->Form->control('section_id', ['options' =>[],'label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <th>Sr. No.</th>
                                    <th>Student</th>
                                    <th>Scoller No.</th>
                                    <th>Roll No.</th>
                                    <th>Subjects</th>
                                </thead>
                                <tbody id="main">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <span class="help-block"></span>
                    <div class="box-footer">
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <a href="" onclick="addStudent(event)" class="btn btn-success button"><i class="fa fa-plus"></i> ADD 
                                    Student</a>
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

<?= $this->element('loading') ?>
<?= $this->element('selectpicker') ?>
<?= $this->element('validate') ?>
<?= $this->element('medium class stream filter all') ?>

<?php 
$js = "
    function addStudent(e)
    {
        e.preventDefault();
        var arrayData = {};
        var studentInfos = {}
        studentInfos['student_class_id'] = $('#student-class-id').val();
        studentInfos['stream_id'] = $('#stream-id').val();
        studentInfos['section_id'] = $('#section-id').val();

        arrayData['StudentInfos'] = studentInfos;
        var data = JSON.parse(JSON.stringify(arrayData));

        var url = '".$this->Url->build(['controller'=>'StudentElectiveSubjects','action'=>'getStudents.json'])."';        
        $('#main').html('');
        if(!studentInfos['student_class_id'] && !$('#medium_id').val())
            return false;
        $.post(url,data,function(result){
            var response = JSON.parse(JSON.stringify(result));
            var i = 0;
            $.each(response.response, function(key,student) {
                i++;
                var o = \"<tr> \\
                            <td>\"+i+\"</td>\\
                            <td>\"+student.name+\"</td>\\
                            <td>\"+student.scholer+\"</td>\\
                            <td>\"+student.rollno+\"</td>\\
                            <td>\";
                            $.each(response.subject, function(key2,subject) {
                                cked = '';
                                if(student.student_elective_subjects.length)
                                {
                                    $.each(student.student_elective_subjects, function(key3,elective)
                                    {
                                        if(subject.id == elective.subject_id)
                                            cked = 'checked';
                                    });
                                }
                                o+=\" <label class='checkbox-inline'><input name='subject_id' student_id='\"+student.id+\"' type='checkbox' value='\"+subject.id+\"' \"+cked+\">\"+subject.parent+ ' > ' +subject.name+\"</label> \";
                            });
                                
                    o+=     \"</td>\\
                        </tr>\";
                $('#main').append(o);
            });
        });
    }

    $(document).on('click','input[type=checkbox]',function(){
        if($(this).is(':checked'))
        {
            url = '".$this->Url->build(['action'=>'add.json'])."';
            student = $(this).attr('student_id');
            subject = $(this).val();
            if(student && subject)
            {
                $.post(url,{student_info_id: student, subject_id: subject},function(result){
                    var obj = JSON.parse(JSON.stringify(result));
                    
                    if(obj.success)
                    {
                        toastr.options.closeButton = true;
                        toastr.success('Saved');
                    }
                    else
                    {
                        toastr.options.closeButton = true;
                        toastr.error('Unable to save');
                        checkbox.prop('checked','false');
                    }
                });
            }
        }
        else
        {
            url = '".$this->Url->build(['action'=>'delete.json'])."';
            student = $(this).attr('student_id');
            subject = $(this).val();
            if(student && subject)
            {
                $.post(url,{student_info_id: student, subject_id: subject},function(result){
                    var obj = JSON.parse(JSON.stringify(result));
                    
                    if(obj.success)
                    {
                        toastr.options.closeButton = true;
                        toastr.success('removed');
                    }
                    else
                    {
                        toastr.options.closeButton = true;
                        toastr.error('Unabel to remove');
                        checkbox.prop('checked','true');
                    }
                });
            }
        }
    });
";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
 ?>