<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
    .control-label{
        display: block;
    }
    .iradio_minimal{
        margin-right: 5px;
        margin-left: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                    <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Exam </label>
                <?php }else{ ?>
                    <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Add Exam </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($scaling,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="control-label"> Choose Class</label>
                            <?= $this->Form->control('scaling.subject.student_class_id',['options' => $studentClasses,'empty'=>'--Select--','class'=>'select2','style'=>'width:100%;','label'=>false,'val'=>'','required']);?>
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label"> Choose Stream</label>
                            <?php echo $this->Form->control('scaling.subject.stream_id', ['options' => $streams,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','val'=>'']);?>
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label"> Subject</label>
                            <?php echo $this->Form->control('subject_id', ['empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required']);?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label class="control-label"> Scale Number</label>
                            <?php echo $this->Form->control('scale_no', ['label'=>false,'class'=>'form-control']);?>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-6">  
                                        <?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','id'=>'submit_member']); ?>
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
<?= $this->element('selectpicker');?>
<?= $this->element('validate');?>
<?= $this->element('loading');?>

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
        var data2 = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'Subjects','action'=>'getSubjects.json'])."';
        
        $.post(url,data2,function(result){
            var response = JSON.parse(JSON.stringify(result));
            
            $.each(response.response, function (index, value) {
                var o = $('<option/>', {value: value.id, text: value.name});
                $('#subject-id').append(o);
            });
        });
    }

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }

    $(document).on('change','#scaling-subject-student-class-id',function(){
        var URL = '".$this->Url->build(['controller'=>'Subjects','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#scaling-subject-stream-id').empty();
        $('#subject-id').empty();

        $.post(URL,{class_id: id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#scaling-subject-stream-id').append(o);
                }); 
                $('#scaling-subject-stream-id').val($('#scaling-subject-stream-id option:first-child').val()).trigger('change');
                
            }
            else
            {
                appendEmpty($('#scaling-subject-stream-id'));
                var data = {};
                data['student_class_id'] = id;
                appendSubjects(data);               
            }
        });
    });

    $(document).on('change','#scaling-subject-stream-id',function(){
        $('#subject-id').empty();
        appendEmpty($('#subject-id'));
        var data = {};
        data['stream_id'] = $('#scaling-subject-stream-id').val();
        data['student_class_id'] = $('#scaling-subject-student-class-id').val();
        appendSubjects(data); 
    });
});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
    