<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExamMaxMark[]|\Cake\Collection\CollectionInterface $examMaxMarks
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\examMaxMark[]|\Cake\Collection\CollectionInterface $examMaxMarks
 */
?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                      <label > Edit Subject Max Marks </label>
                    <?php }else{ ?>
                      <label> Add Subject Max Marks </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($examMaxMark,['id'=>'ServiceForm','url'=>['action'=>'add','autocomplete'=>false]]) ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                            
                                <?php echo $this->Form->control('class_mapping_id', ['empty'=>'--- Select---','options' => $classMappings,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label"> Exam</label>
                            
                                <?php echo $this->Form->control('exam_master_id', ['empty'=>'--- Select ---','options' => '','class'=>'select2','style'=>'width:100%','label'=>false]);?>
                            </div>
                        </div>
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-6">  
                                        <a id="add_subjects" href="" class="btn btn-default btn-primary btnClass"> Find Subjects</a>
                                    </div>
                                </div>
                            </center>       
                        </div>
                        <?= $this->Form->end() ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <th>Sr. No.</th>
                                        <th>Subject</th>
                                        <th>Max-Marks</th>
                                    </thead>
                                    <tbody id="main">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->element('selectpicker') ?> 
<?= $this->element('validate') ?>
<?= $this->element('loading') ?>
<?= $this->element('medium-class-all') ?>
<?php
$js="
$(document).ready(function(){

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }
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

    $(document).on('click','#add_subjects',function(e){
        $('#main').html('');
        e.preventDefault();
        var arrayData = {};
        arrayData['class_mapping_id'] = $('#class-mapping-id').val();
        arrayData['exam_master_id'] = $('#exam-master-id').val();
        var data2 = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['action'=>'getSubjects.json'])."';
        
        $.post(url,data2,function(result){
            var response = JSON.parse(JSON.stringify(result));
            var og = null;
            var optgroup = $();
            var i =0;
            $.each(response.response, function (index, value) {
                i++;
                subject = '';
                if(value.parent != null)
                    subject+= value.parent+' > ';
                subject+= value.name;
                var o = \"<tr> \\
                            <td>\"+i+\"</td>\\
                            <td>\"+subject+\"</td>\\
                            <td>\\
                                <input type='hidden' class='subject_id' name='subject_id' value = \"+value.id+\" >\\
                                <input type='text' placeholder='Enter Max Marks' value='\"+(value.max_marks !== null ? value.max_marks : '')+\"' class='form-control max_marks' required>\\
                            </td>\\
                        </tr>\";
                $('#main').append(o);
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
    });

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

    $(document).on('change','#class-mapping-id',function()
    {
        var arrayData = {}
        arrayData['class_mapping_id'] = $(this).val();
        appendExams(arrayData);
    });

    $(document).on('focusin', '.max_marks', function(){
        $(this).data('val', $(this).val());
    }).on('change','.max_marks', function(){

        var arrayData = {}
        arrayData['exam_master_id'] = $('#exam-master-id').val();
        arrayData['subject_id'] = $(this).parent().find('.subject_id').val();
        arrayData['max_marks'] = $(this).val();

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
    });

    $(document).on('change','select',function(){
        $('#main').html('');
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
