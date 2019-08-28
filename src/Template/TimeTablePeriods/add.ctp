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
                    <label> Time Table </label>
                </div>
                <?= $this->Form->create($timeTablePeriod,['id'=>'ServiceForm','type'=>'file']) ?>
                <div class="box-body">
                    <div class="form-group">
                        <span class="help-block"></span>
                        <div class="row">
                            <fieldset><legend>Time Table Schedule</legend>
                                <center>                        
                                <table style="width:90%;align:center" class="table table-bordered table-hover" id="parant_table">
                                    <thead>
                                        <tr style="background-color:#8a8a8a2e;">  
                                            <th style="text-align:center">Select Class</th>
                                            <th style="text-align:center">Day </th>
                                            <th style="text-align:center">Time From</th>
                                            <th style="text-align:center">Time to</th>
                                            <th style="text-align:center">Teacher</th>
                                            <th colspan="2" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="parant_table">
                                    <tr class="hello">
                                        <td>
                                            <?php echo $this->Form->control('facultiy[]', ['empty'=>'--- Select ---','options' => $option,'class'=>'form-control subject_id classMapping','style'=>'width:100%','label'=>false,'required']);?>
                                        </td>

                                        <td>
            <?php echo $this->Form->hidden('medium_id[]', ['label'=>false,'class'=>'medium_id']);?>
            <?php echo $this->Form->hidden('student_class_id[]', ['label'=>false,'class'=>'student_class_id']);?>
            <?php echo $this->Form->hidden('stream_id[]', ['label'=>false,'class'=>'stream_id']);?>
            <?php echo $this->Form->hidden('section_id[]', ['label'=>false,'class'=>'section_id']);?>
            <?php echo $this->Form->hidden('subject_id[]', ['label'=>false,'class'=>'subject_id']);?>
                                        
                                            <?php $types['Monday']='Monday';?>
                                            <?php $types['Tuesday']='Tuesday';?>
                                            <?php $types['Wednesday']='Wednesday';?>
                                            <?php $types['Thursday']='Thursday';?>
                                            <?php $types['Friday']='Friday';?>
                                            <?php $types['Saturday']='Saturday';?>
                                            <?php $i=0;echo  $this->Form->control('day'.$i, ['options' => $types,'class'=>"select2 day", 'data-placeholder'=>'Select...','empty'=>'Select...','label'=>false,'required'=>'required','multiple'=>true,'style'=>'width:100%']);$i++;?>

                                        </td>
                                        <td>
                                            <div class="bootstrap-timepicker"> 
                                                <?php echo $this->Form->control('time_from[]',[
                                    'label' => false,'class'=>'form-control timepicker time_from','placeholder'=>'Time','type'=>'type','required'=>true]);?>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="bootstrap-timepicker" > 
                                            <?php echo $this->Form->control('time_to[]',[
                                                                'label' => false,'class'=>'form-control time_to timepicker','placeholder'=>'Time','type'=>'text','required'=>true]);?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $this->Form->control('employee_id[]',[
                                            'label' => false,'class'=>'employee_id select2','empty'=>'Select...','options' => $employees,'required'=>true]);?> 
                                        </td>
                                        <td>
                                            <button type="button" onClick="add_row()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </center>
                            </fieldset>
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
<table id="sample" style="display:none;">
    <tbody>
        <tr>
    
        <tr class="hello">
            
        <td><?php echo $this->Form->control('facultiy[]', ['empty'=>'--- Select ---','options' => $option,'class'=>'form-control classMapping','style'=>'width:100%','label'=>false]);?>
        </td>
        <td>
           <?php echo $this->Form->hidden('medium_id[]', ['label'=>false,'class'=>'medium_id']);?>
            <?php echo $this->Form->hidden('student_class_id[]', ['label'=>false,'class'=>'student_class_id']);?>
            <?php echo $this->Form->hidden('stream_id[]', ['label'=>false,'class'=>'stream_id']);?>
            <?php echo $this->Form->hidden('section_id[]', ['label'=>false,'class'=>'section_id']);?>
            <?php echo $this->Form->hidden('subject_id[]', ['label'=>false,'class'=>'subject_id']);?>
            <?php $types['Monday']='Monday';?>
            <?php $types['Tuesday']='Tuesday';?>
            <?php $types['Wednesday']='Wednesday';?>
            <?php $types['Thursday']='Thursday';?>
            <?php $types['Friday']='Friday';?>
            <?php $types['Saturday']='Saturday';?>
            <?php echo  $this->Form->control('day'.$i, ['options' => $types,'class'=>"day", 'data-placeholder'=>'Select...','empty'=>'Select...','label'=>false,'required'=>'required','multiple'=>true]);$i++;?>
        </td>
        <td>
            <div class="bootstrap-timepicker" > 
            <?php echo $this->Form->control('time_from[]',[
                                'label' => false,'class'=>'form-control time_from timepicker','placeholder'=>'Time','type'=>'text','required'=>true]);?>
            </div>
        </td>
        <td>
            <div class="bootstrap-timepicker" > 
            <?php echo $this->Form->control('time_to[]',[
                                'label' => false,'class'=>'form-control time_to timepicker','placeholder'=>'Time','type'=>'text','required'=>true]);?>
            </div>
        </td>
        <td>
            <?php echo $this->Form->control('employee_id[]',[
            'label' => false,'class'=>'employee_id','empty'=>'Select...','options' => $employees,'required'=>true]);?> 
        </td>
        <td>
            <button type="button" onClick="add_row()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
        </td>
        <td>
            <button type="button"  class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o"></i></button>
        </td>
        </tr>
    </tbody> 
</table>
<?= $this->element('validate') ?>
<?= $this->element('timepicker') ?> 
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
        $('.subject-id').empty(); 
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
                        $('.subject-id').append(optgroup);

                    optgroup = $('<optgroup/>');
                    optgroup.attr('label',value.parent);
                }

                var o = $('<option/>', {value: value.id, text: value.name});

                if(optgroup.attr('label') !== null && optgroup.attr('label') !== undefined)
                    optgroup.append(o);
                else
                    $('.subject-id').append(o);
            });

            if(optgroup.children().length > 0)
                $('.subject-id').append(optgroup);
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
        //id.trigger('change');
    }

    $(document).on('change','#medium-id',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getClasses.json'])."';
 
        $('#student-class-id').empty();
        //$('#student-class-id').select2();
        appendEmpty($('#student-class-id'));
        id = $(this).val();
        if(id)
        {
            $.post(URL,{medium_id: id},function(result){
                var response = JSON.parse(JSON.stringify(result));
                if(response.success)
                {
                    $.each(response.response, function(key,value) {
                        var o = $('<option/>', {value: key, text: value});
                        $('#student-class-id').append(o);
                    });
                }
            });
        }
    });

    $(document).on('change','#student-class-id',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getStreams.json'])."';
        var URL2 = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getSections.json'])."';
        var URL3 = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getStudents.json'])."';
        var data = {};
        var datas = {};
        var id = $(this).val();

        $('#stream-id').empty();
        appendEmpty($('#stream-id'));

        $('#section-id').empty();
        appendEmpty($('#section-id'));

        if(id)
        {
            data['student_class_id'] = id;
            data = JSON.parse(JSON.stringify(data));

            $.post(URL,data,function(result){
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
                    var arrData = {};
                    arrData['student_class_id'] = $('#student-class-id').val();
                    appendSubjects(arrData); 

                    $.post(URL2,data,function(result){
                        var response = JSON.parse(JSON.stringify(result));
                        if(response.success)
                        {
                            $.each(response.response, function(key,value) {
                                var o = $('<option/>', {value: key, text: value});
                                $('#section-id').append(o);
                            });
                            
                        }
                    });
               
                    datas['student_class_id'] = id;
                    datas['medium_id'] = $('#medium-id').val();;
                    datas = JSON.parse(JSON.stringify(datas));
                    $.post(URL3,datas,function(result){
                        var response = JSON.parse(JSON.stringify(result));
                        if(response.success)
                        {
                             
                            $.each(response.response, function(key,value) {
                                var o = $('<option/>', {value: key, text: value});
                                $('#students').append(o);
                            });
                            //$('.students').val($('.students option:first-child').val()).trigger('change');
                        }
                    });
                }
            });
        }
    });

    $(document).on('change','#stream-id',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getSections.json'])."';
        var URL3 = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getStudents.json'])."';
        var class_id = $('#student-class-id').val();
        var id = $(this).val();
        var datas = {};
        $('#section-id').empty();
        //$('#section-id').select2();
        appendEmpty($('#section-id'));
        
        $('#exam-master-id').empty();
        //$('#exam-master-id').select2();
        appendEmpty($('#exam-master-id'));
        
        $('.subject-id').empty(); 
        appendEmpty($('.subject-id'));
        if(id)
        {
            $.post(URL,{student_class_id: class_id, stream_id: id},function(result){
                var response = JSON.parse(JSON.stringify(result));
                if(response.success)
                {
                    $.each(response.response, function(key,value) {
                        var o = $('<option/>', {value: key, text: value});
                        $('#section-id').append(o);
                    });
                }
            });

            datas['stream_id'] = id;
            datas['student_class_id'] = $('#student-class-id').val();;
            datas['medium_id'] = $('#medium-id').val();;
            datas = JSON.parse(JSON.stringify(datas));
            $.post(URL3,datas,function(result){
                var response = JSON.parse(JSON.stringify(result));
                if(response.success)
                {
                    $.each(response.response, function(key,value) {
                        var o = $('<option/>', {value: key, text: value});
                        $('#students').append(o);
                    });
                }
            });


            var arrData = {};
            arrData['student_class_id'] = $('#student-class-id').val();
            arrData['stream_id'] = $('#stream-id').val();
            appendSubjects(arrData);
             
        }
    });

    $(document).on('change','#section-id',function(){
        var URL3 = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getStudents.json'])."';
        var id = $(this).val(); 
        var datas = {};
        if(id)
        {   
            datas['section_id'] = id;
            datas['stream_id'] = $('#stream-id').val();
            datas['student_class_id'] = $('#student-class-id').val();;
            datas['medium_id'] = $('#medium-id').val();;
            datas = JSON.parse(JSON.stringify(datas));
            $.post(URL3,datas,function(result){
                var response = JSON.parse(JSON.stringify(result));
                if(response.success)
                {   $('#students').empty();
                    $('#students').select2();
                    appendEmpty($('#students'));

                    $.each(response.response, function(key,value) {
                        var o = $('<option/>', {value: key, text: value});
                        $('#students').append(o);
                    });
                }
            });


            var arrData = {};
            arrData['student_class_id'] = $('#student-class-id').val();
            arrData['stream_id'] = $('#stream-id').val();
            appendSubjects(arrData);
             
        }
    });

    $(document).on('change','.classMapping',function(){
        
        
        var mid =$('option:selected',this).attr('mid');
        var cid =$('option:selected',this).attr('cid');
        var stid =$('option:selected',this).attr('stid');
        var scid =$('option:selected',this).attr('scid');
        var subid =$('option:selected',this).attr('subid'); 

        $(this).closest('tr').find('.medium_id').val(mid);
        $(this).closest('tr').find('.student_class_id').val(cid);
        $(this).closest('tr').find('.stream_id').val(stid);
        $(this).closest('tr').find('.section_id').val(scid);
        $(this).closest('tr').find('.subject_id').val(subid);
       
       
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
            description: {
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



$js.='
$(document).ready(function() { 
    $(document).on("click", ".remove_row", function(){
        $(this).closest("#parant_table tr").remove();
    });
});
function add_row(){  
    var new_line=$("#sample tbody").html();
    $("#parant_table tbody.parant_table").append(new_line);
    $(".parant_table>tr:last").find(".day").select2();
    $(".parant_table>tr:last").find(".employee_id").select2();
    $(".timepicker").timepicker({
      showInputs: false
    });
}
';
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
