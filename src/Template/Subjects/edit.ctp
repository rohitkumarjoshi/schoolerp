<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject
 */
?>

<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
    .control-label{
        display: block;
    }
    .iradio_minimal-blue{
        margin-right: 5px;
        margin-left: 5px;
    }
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                        <label > Edit Subjects </label>
                    <?php }else{ ?>
                        <label> Add Subject </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($subject,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Choose Class</label>
                                <?php echo $this->Form->control('student_class_id', ['options' => $studentClasses,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Choose Stream</label>
                                <?php echo $this->Form->control('stream_id', ['options' => $streams,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','s-val'=>$subject->stream_id]);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Parent Subject</label>
                                <?php echo $this->Form->control('parent_id', ['options' => $parentSubjects,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','s-val'=>$subject->parent_id]);?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Subject Name </label>

                                <?php echo $this->Form->control('name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Subject Name','type'=>'text']);?>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label"> Elective ?</label>
                                <?php $options = array('Yes' => 'Yes','No'=>'No' ); ?>
                                <?php echo $this->Form->radio('elective',[
                                    ['value'=>'No','text'=>'No','checked','class'=>'radio-inline'],
                                    ['value'=>'Yes','text'=>'Yes','class'=>'radio-inline'],
                                ]);?>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label"> Order Number</label>
                                <?php echo $this->Form->control('order_number',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Order No.']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Subject Type</label>
                                <?php echo $this->Form->control('subject_type_id', ['options' => $subjectTypes,'label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
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

<?= $this->element('selectpicker') ?>
<?= $this->element('validate') ?>
<?= $this->element('loading') ?>
<?= $this->element('icheck') ?>

<?php
$js="
$(document).ready(function(){
    var id = $('#student-class-id').val();
    if(id != '')
    {
        var URL = '".$this->Url->build(['controller'=>'StudentClasses','action'=>'getStreams.json'])."';
        $('#stream-id').empty();
        $('#stream-id').select2();
        $('#parent-id').empty();

        $.post(URL,{class_id: id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#stream-id').append(o);
                }); 
                if($('#stream-id').attr('s-val'))
                    $('#stream-id').val($('#stream-id').attr('s-val')).trigger('change');
                else
                    $('#stream-id').val($('#stream-id option:first-child').val()).trigger('change');
            }
            else
            {
                var data = {};
                data['student_class_id'] = id;
                appendSubjects(data);               
            }
        });
    }

    function appendSubjects(arrayData)
    {
        var order = '';
        var data2 = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'Subjects','action'=>'getParent.json'])."';
        
        $.post(url,data2,function(result){
            var response = JSON.parse(JSON.stringify(result));
            
            $.each(response.response, function (index, value) {
                var val = '';
                order = value.order_number || 0;
                if(value.parent != null)
                    val+= value.parent+' > ';
                val+= value.name;
                var o = $('<option/>', {value: value.id, text: val});
                $('#parent-id').append(o);
            });
            $('#order-number').attr('placeholder','Last Order = '+order);
            if($('#parent-id').attr('s-val'))
                $('#parent-id').val($('#parent-id').attr('s-val')).trigger('change');
            else
                $('#parent-id').val($('#parent-id option:first-child').val()).trigger('change');
        });
    }

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }

    $(document).on('change','#student-class-id',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentClasses','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#stream-id').empty();
        $('#stream-id').select2();
        $('#parent-id').empty();
        appendEmpty($('#parent-id'));
        $('#parent-id').select2();

        if(id)
        {
            $.post(URL,{class_id: id},function(result){
                var response = JSON.parse(JSON.stringify(result));
                if(response.success)
                {
                    $.each(response.response, function(key,value) {
                        var o = $('<option/>', {value: key, text: value});
                        $('#stream-id').append(o);
                    });
                }
                else
                {
                    var data = {};
                    data['student_class_id'] = id;
                    appendSubjects(data);               
                }
            });
        }
    });

    $(document).on('change','#stream-id',function(){
        $('#parent-id').empty();
        appendEmpty($('#parent-id'));
        var data = {};
        data['stream_id'] = $('#stream-id').val();
        data['student_class_id'] = $('#student-class-id').val();
        appendSubjects(data); 
    });
});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>