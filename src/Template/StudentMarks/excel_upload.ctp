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
                        <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Marks </label>
                    <?php }else{ ?>
                        <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Add Marks </label>
                    <?php } ?>
                </div>
                <?= $this->Form->create($studentMark,['id'=>'ServiceForm','url'=>['action'=>'excelDownload'],'target'=>'_blank']) ?>
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
                                <?= $this->Form->hidden('save_to',['id'=>'save_to']) ?>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label"> Subjects</label>
                            
                                <?php echo $this->Form->control('subject_id', ['empty'=>'--- Select ---','options' => [],'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                            </div>

                            <div class="col-md-3">  
                                <?php echo $this->Form->submit('Download CSV',['class'=>'btn btn-primary btnClass']); ?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <?= $this->Form->create($studentMark,['id'=>'ServiceForm','type'=>'file']) ?>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-3">
                            <label>Upload CSV</label>
                            <input type="file" name="csv" class="form-control">
                        </div>   
                        <div class="col-md-3">  
                            <?php echo $this->Form->button('submit',['class'=>'btn btn-primary btnClass']); ?>
                        </div>  
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
<?= $this->element('validate') ?> 
<?= $this->element('selectpicker') ?> 
<?= $this->element('loading') ?> 
<?php $this->element('excelexport',['table'=>'example1']) ?>
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
            $('#save_to').val($('#exam-master-id option:first-child').attr('save_to'));

            arr = {};
        });
    }

    function getData()
    {
        var arrayData = {}
        arrayData['student_class_id'] = $('#student-class-id').val();
        arrayData['stream_id'] = $('#stream-id').val();
        arrayData['section_id'] = $('#section-id').val();

        var data = JSON.parse(JSON.stringify(arrayData));
        return data;
    }

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
    }

    $(document).on('change','#class-mapping-id',function()
    {
        var arrayData = {}
        arrayData['class_mapping_id'] = $(this).val();
        appendExams(arrayData);
        appendSubjects(arrayData);
    });

    

    $(document).on('change','#exam-master-id',function(){
        $('#save_to').val($(this).find(':selected').attr('save_to'));
        
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
