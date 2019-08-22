<div class="box box-primary">
    <div class="box-header with-border"> 
        <label > Class Test Report </label>
    </div>
    <div class="box-body"> 
         <?= $this->Form->create($classTest,['autocomplete'=>'off']) ?>
            <div class="row"> 
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label class="control-label"> Medium </label>
                        <?php echo $this->Form->control('data[medium_id]', ['empty'=>'--- Select---','options' => $mediums,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Class </label>
                        <?php echo $this->Form->control('data[student_class_id]', ['empty'=>'--- Select ---','options' => $studentClasses,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Stream</label>
                        <?php echo $this->Form->control('data[stream_id]', ['empty'=>'--- Select ---','options' => $streams,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"> Section</label>
                        <?php echo $this->Form->control('data[section_id]', ['empty'=>'--- Select ---','options' => $sections,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                    </div>  
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                         <label class="control-lable"> Date From </label>
                            <?= $this->Form->control('data[test_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['test_date >=']])?>
                    </div>
                     <div class="col-sm-4">
                        <label class="control-label"> Date To </label>
                        <?= $this->Form->control('data[test_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'Select Date','value'=>@$_POST['data']['test_date <=']])?>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="control-label"> Subjects </label>
                        <?php echo $this->Form->control('data[subject_id]', ['empty'=>'--- Select ---','options' => $subjects,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" align="center">
                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                    <a href="<?php echo $this->Url->build(array('controller'=>'ClassTests','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                </div> 
            </div>
        <?= $this->Form->end() ?>
    </div>
   <?php if($data_exist=='data_exist') { ?>
    <div class="box-body" >        
        <?php $page_no=$this->Paginator->current('ClassTests'); $page_no=($page_no-1)*20; ?>
                    <table class="table table-bordered table-hover">
                             <thead>
                                <tr >
                                    <th>#</th>
                                    <th>Class</th>
                                    <th>Medium</th>
                                    <th>Stream</th>
                                    <th>Section</th>
                                    <th>Subject</th>
                                    <th>Topic Name </th>
                                    <th>Test Date</th>
                                    <th>Max Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach ($classTests as $classTest) :?>
                                <tr>
                                    <td> <?php echo $i; ?></td>
                                    <td>
                                        <?=  h($classTest->student_class->name) ?>
                                    </td>
                                    <td>
                                        <?=  h(@$classTest->medium->name) ?>
                                    </td>
                                    <td>
                                        <?=  h(@$classTest->stream->name) ?>
                                    </td>
                                    <td>
                                        <?=  h(@$classTest->section->name) ?>
                                    </td>
                                    <td>
                                        <?=  h($classTest->subject->name) ?>
                                    </td>
                                    <td>
                                        <?=  h($classTest->topic) ?>
                                    </td>
                                    <td><?= h(date('d-M-Y',strtotime(h($classTest->test_date)))) ?> </td>
                                    <td><?=h(@$classTest->max_marks) ?> </td>
                                    
                                </tr>
                            <?php $i++;endforeach; ?>
                                </tbody>
                            </table> 
                        </div>
                        <?php } else { ?>
                         <div class="row">
                            <div class="col-md-12 text-center">
                                <h3> <?= $data_exist ?></h3>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
<?= $this->element('selectpicker') ?>
<?= $this->element('datepicker') ?>
<?php
$js="

$(document).ready(function(){
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
        
        $('#subject-id').empty(); 
        appendEmpty($('#subject-id'));
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
     

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>