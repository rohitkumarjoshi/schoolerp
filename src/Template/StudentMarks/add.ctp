<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentMark $studentMark
 */
?>
<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                         <label > Edit Marks </label>
                    <?php }else{ ?>
                         <label> Add Marks </label>
                    <?php } ?>
                    <div class="col-md-3 pull-right text-right">
                        <a href="<?= $this->Url->build(['action'=>'excelUpload'])?>" class="btn btn-default btn-warning "><i class="fa fa-upload"></i> Excel Upload</a>
                    </div>
                </div>
                <?= $this->Form->create($studentMark,['id'=>'ServiceForm']) ?>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                            
                                <?php echo $this->Form->control('class_mapping_id', ['empty'=>'--- Select---','options' => $classMappings,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label"> Exam</label>
                            
                                <?php echo $this->Form->control('exam_master_id', ['empty'=>'--- Select ---','options' => [],'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label"> Subjects</label>
                            
                                <?php echo $this->Form->control('subject_id', ['empty'=>'--- Select ---','options' => [],'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                            </div>

                            <div class="col-md-3">
                                <a id="add_student" href="" class="btn btn-default btn-primary btnClass"> Find Student</a>
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
                                        <th>Marks</th>
                                    </thead>
                                    <tbody id="main">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <span class="help-block"></span>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
<?= $this->element('validate') ?> 
<?= $this->element('selectpicker') ?> 
<?= $this->element('loading') ?> 
<?php
$js="

$(document).ready(function(){

    var arr = {};

    function rr(obj)
    {
        $.each(obj, function(key,value) {
            if(value.children == '')
            {
                arr[value.id] = value.name;
            }
            else
            {
                var response = JSON.parse(JSON.stringify(value.children));
                rr(response);
            }
        });
    }

    function appendSubjects(arrayData)
    {
        $('#subject-id').empty();
        $('#subject-id').select2();
        var data2 = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getSubjects.json'])."';
        
        $.post(url,data2,function(result){
            var response = JSON.parse(JSON.stringify(result));
            var og = null;
            var optgroup = $();
            $.each(response.response, function (index, value) {
                if(value.parent != og)
                {
                    og = value.parent;
                    if(optgroup.children().length > 0)
                        $('#subject-id').append(optgroup);

                    optgroup = $('<optgroup/>');
                    optgroup.attr('label',value.parent);
                }

                var o = $('<option/>', {value: value.id, text: value.name});

                if(optgroup.attr('label') !== null && optgroup.attr('label') !== undefined)
                    optgroup.append(o);
                else
                    $('#subject-id').append(o);
            });

            if(optgroup.children().length > 0)
                $('#subject-id').append(optgroup);
        });
    }

    function appendExams(arrayData)
    {
        $('#exam-master-id').empty();
        $('#exam-master-id').select2();
        var data = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'ExamMasters','action'=>'getExamsThreaded.json'])."';
        
        $.post(url,data,function(result){
            var response = JSON.parse(JSON.stringify(result));
            rr(response.response);
            
            $.each(arr, function (index, value) {
                var o = $('<option/>', {value: index, text: value});
                o.attr('save_to','exam_master_id');
                $('#exam-master-id').append(o);
            });

            $.each(response.sub_exams, function (key, value) {
                var optgroup = $('<optgroup/>');
                optgroup.attr('label',value.name);
                
                $.each(value.sub_exams, function (key, value2) {
                    var o = $('<option/>', {value: value2.id, text: value2.name});
                    o.attr('save_to','sub_exam_id');
                    optgroup.append(o);
                });
                if(optgroup.children().length > 0)
                    $('#exam-master-id').append(optgroup);
            });
            $('#exam-master-id').val($('#exam-master-id option:first-child').val()).trigger('change');

            arr = {};
        });
    }

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }

    $(document).on('change','#class-mapping-id',function()
    {
        var arrayData = {}
        arrayData['class_mapping_id'] = $(this).val();
        appendExams(arrayData);
        appendSubjects(arrayData);

        //var url = '".$this->Url->build(['action'=>'getParentExams.json'])."';
        
        // $.post(url,{class_mapping_id: $(this).val()},function(result){
        //     var response = JSON.parse(JSON.stringify(result));
        //     $.each(response.response, function (index, value) {
        //         var o = $('<option/>', {value: value.id, text: value.name});
        //         o.attr('save_to','exam_master_id');
        //         $('#exam-master-id').append(o);
        //     });

        //     $('#exam-master-id').val($('#exam-master-id option:first-child').val()).trigger('change');

        //     arr = {};
        // });
    });

    $(document).on('click','#add_student',function(e){
        e.preventDefault();

        //getting max Marks
        var URL = '".$this->Url->build(['action'=>'getMaxMarks.json'])."';
        save_to = $('#exam-master-id :selected').attr('save_to');
        var data = {};
        data['subject_id'] = $('#subject-id').val();
        data['exam_master_id'] = $('#exam-master-id').val();
        data['save_to'] = save_to;
        data = JSON.parse(JSON.stringify(data));

        $.post(URL,data,function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                var a = parseInt(response.response) || 0;
                if(a == 0)
                    $('.marks').attr('type','text');

                $('#class-mapping-id').attr('max',a);
            }
        });

        //appending students
        var arrayData = {};
        var studentInfos = {}
        var ExamMasters = {}
        save_to = $('#exam-master-id :selected').attr('save_to');
        arrayData['class_mapping_id'] = $('#class-mapping-id').val();
        arrayData[save_to] = $('#exam-master-id').val();
        arrayData['subject_id'] = $('#subject-id').val();

        var data = JSON.parse(JSON.stringify(arrayData));

        var url = '".$this->Url->build(['controller'=>'StudentMarks','action'=>'getStudentsSingle.json'])."';        
        $('#main').html('');
        $.post(url,data,function(result){
            var response = JSON.parse(JSON.stringify(result));
            var i = 0;
            $.each(response.response, function(key,value) {
                i++;
                var o = \"<tr> \\
                            <td>\"+i+\"</td>\\
                            <td>\"+value.name+\"</td>\\
                            <td>\"+value.scholer+\"</td>\\
                            <td>\"+value.rollno+\"</td>\\
                            <td>\\
                                <input type='hidden' class='student_info_id' name='data[\"+i+\"][student_info_id]' value = \"+value.id+\" >\\
                                <input type='hidden' name='data[\"+i+\"][id]' value = '\"+(value.marks_id !== null ? value.marks_id : '')+\"' class = '\"+(value.marks_id !== null ? 'student_number' : 'disabled')+\"' >\\
                                <input type='text' name='data[\"+i+\"][student_number]' placeholder='Enter Marks' value='\"+(value.marks !== null ? value.marks : '')+\"' class='form-control marks' required>\\
                            </td>\\
                        </tr>\";
                $('#main').append(o);
            });
        });
    });

    $(document).on('focusin', '.marks', function(){
        $(this).data('val', $(this).val());
    }).on('change','.marks', function(){
        var textbox = parseInt($(this).val());
        var max = parseInt($('#class-mapping-id').attr('max')) || 0;
        if(max == 0 && $.isNumeric($(this).val()))
        {
            alert('Either enter max marks or enter grade.');
            $(this).val($(this).data('val'));
            $(this).focus();
        }
        else
        if(textbox > max)
        {
            alert('value should be less then or equal to '+max)
            $(this).val($(this).data('val'));
            $(this).focus();
        }
        else
        {
            var arrayData = {}
            save_to = $('#exam-master-id :selected').attr('save_to');
            arrayData[save_to] = $('#exam-master-id').val();
            arrayData['subject_id'] = $('#subject-id').val();
            arrayData['student_info_id'] = $(this).parent().find('.student_info_id').val();
            arrayData['student_number'] = $(this).val();

            var data = JSON.parse(JSON.stringify(arrayData));

            var url = '".$this->Url->build(['action'=>'saveMarks.json'])."';        
            
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function(result){
                    var response = JSON.parse(JSON.stringify(result));
                    if(response.success)
                    {
                        toastr.options.closeButton = true;
                        toastr.options.timeOut = 900;
                        toastr.success('Saved');
                    }
                    else
                    {
                        toastr.options.closeButton = true;
                        toastr.options.timeOut = 900;
                        toastr.error('Unabel to save');
                        $(this).val($(this).data('val'));
                        $(this).focus();
                    }
                },
                global: false
            });
        }
    });

    $(document).on('change','select',function(){
        $('#main').html('');
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
