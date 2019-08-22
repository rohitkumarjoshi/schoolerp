<?php
//pr($auth->User('login_type'));exit;
?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <label> Add Assignment </label>
                </div>
                <?= $this->Form->create($assignment,['id'=>'ServiceForm','type'=>'file']) ?>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Assignment Type </label>
                                <br>
                                <?php
                                echo $this->Form->radio(
                                'assignment_type',
                                [
                                    ['value' => 'Class', 'text' => ' Class Wise','checked'],
                                    ['value' => 'Student', 'text' => ' Student Wise'],
                                    
                                ],
                                ['class'=>'assignment_type']
                                ); ?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Topic <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('topic',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Topic','type'=>'text','required']);?>
                            </div>
                            
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('date',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                            
                                <?php echo $this->Form->control('faculty_class_mapping_id', ['empty'=>'--- Select---','options' => $option,'class'=>'select2 classMapping','style'=>'width:100%','label'=>false,'required']);?>
                            </div>

							<?php echo $this->Form->control('medium_id',['label' => false,'class'=>'medium_id','type'=>'hidden','required']);?>
							<?php echo $this->Form->control('student_class_id',['label' => false,'class'=>'student_class_id','type'=>'hidden','required']);?>
							<?php echo $this->Form->control('stream_id',['label' => false,'class'=>'stream_id','type'=>'hidden','required']);?>
							<?php echo $this->Form->control('section_id',['label' => false,'class'=>'section_id','type'=>'hidden','required']);?>
							<?php echo $this->Form->control('subject_id',['label' => false,'class'=>'subject_id','type'=>'hidden','required']);?>

                            <div class="col-md-4">
                                <label class="control-label"> Document <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('document',[
                                'label' => false,'class'=>'','type'=>'file','required']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-6 stdcheck" >
                                <label class="control-label"> Students <span class="required" aria-required="true"> * </span></label> 
                                <?php echo $this->Form->control('students', ['options' => '','class'=>'select2 students','style'=>'width:100%','label'=>false,'multiple'=>true,'placeholder'=>'Select...','required']);?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Description </label>
                                <?php echo $this->Form->control('description',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>2]);?>
                            </div>
                        </div> 
                    </div>
                </div>
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
<?= $this->element('validate') ?>
<?= $this->element('icheck') ?>
<?= $this->element('datepicker') ?> 
<?php $this->element('selectpicker') ?>  
<?php
$js="

$(document).ready(function(){
    $('.stdcheck').hide();
    $(document).on('ifChecked', '.assignment_type', function(){
        var isNow= $(this).val();
        if(isNow == 'Student'){
            $('.stdcheck').show();
        }
        else{
            $('.stdcheck').hide();
        }
    });

    var arr = {};

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

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        //id.trigger('change');
    }

    $(document).on('change','.classMapping',function(){
        
        var url = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getStudentsAssignment'])."'; 
        var mid =$('option:selected',this).attr('mid');
        var cid =$('option:selected',this).attr('cid');
        var stid =$('option:selected',this).attr('stid');
        var scid =$('option:selected',this).attr('scid');
        var subid =$('option:selected',this).attr('subid'); 

        $('.medium_id').val(mid);
        $('.student_class_id').val(cid);
        $('.stream_id').val(stid);
        $('.section_id').val(scid);
        $('.subject_id').val(subid);
        $('#students').empty();
        url=url+'?student_class_id='+cid+'&medium_id='+mid+'&stream_id='+stid+'&section_id='+scid;
        console.log(url);
        $.ajax({
            url: url,
        }).done(function(response) {
            console.log(response);
            $('#students').append(response);
        });
    }); 
    
    $('#ServiceForm').validate({ 
        rules: {
            topic: {
                required: true
            },
            date: {
                required: true
            }, 
            medium_id: {
                required: true
            },
            student_class_id: {
                required: true
            }, 
            subject_id: {
                required: true
            },
            document:{
                required: true
            },
            students:{
                required: true
            },
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
