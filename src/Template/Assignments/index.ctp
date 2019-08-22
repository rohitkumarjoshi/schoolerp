<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > View Assignment</label>
                <div class="box-tools pull-right">
                    <a style="font-size:19px;" class="btn btn-box-tool" data-target="#FilterModel" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
                </div>
            </div>
            <div class="box-body">
                <?= $this->Form->create('FilterForm',['type'=>'get']) ?>
                <div class="collapse"  id="FilterModel" aria-expanded="false"> 
                    <fieldset style="text-align:left;"><legend>Filter</legend>
                        <div class="col-md-12">
                            <div class="row"> 
                                <div class="col-md-4">
                                    <label class="control-label"> Medium </label>
                                    <?php echo $this->Form->control('medium_id', ['empty'=>'--- Select---','options' => $mediums,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Class </label>
                                    <?php echo $this->Form->control('student_class_id', ['empty'=>'--- Select ---','options' => $studentClasses,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Stream</label>
                                    <?php echo $this->Form->control('stream_id', ['empty'=>'--- Select ---','options' => $streams,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label">Select Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                     <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range']) ?> 
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Section</label>
                                    <?php echo $this->Form->control('section_id', ['empty'=>'--- Select ---','options' => $sections,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                                </div>  
                                <div class="col-md-4">
                                    <label class="control-label"> Subjects </label>
                                    <?php echo $this->Form->control('subject_id', ['empty'=>'--- Select ---','options' => $subjects,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label"> Employee </label>
                                    <?php echo $this->Form->control('employee_id', ['empty'=>'--- Select ---','options' => $employees,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <!-- <a href="<?php echo $this->Url->build(array('controller'=>'Assignments','action'=>'index')) ?>"class="btn btn-danger btn-sm">Reset</a> -->
                                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end(); ?>
                <table id="example1" class="table  table-striped" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th scope="col"><?= h('S.No.') ?></th> 
                            <th scope="col"><?= h('Assignment Type') ?></th>
                            <th scope="col"><?= h('Medium') ?></th>
                            <th scope="col"><?= h('Class') ?></th>
                            <th scope="col"><?= h('Stream') ?></th>
                            <th scope="col"><?= h('Section') ?></th>
                            <th scope="col"><?= h('Subject') ?></th>
                            <th scope="col"><?= h('Topic') ?></th>
                            <th scope="col"><?= h('Date') ?></th>  
                            <th scope="col" class="actions"><?= h('Download') ?></th> 
                            <th scope="col" class="actions"><?= h('Students') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=0; foreach ($assignments as $assignment): ?>
                        <?php
                        $subject_name=$assignment->subject->name;
                        if(!empty($assignment->subject->parent_subject)){
                           $subject_name=$assignment->subject->parent_subject->name.' -> '.$assignment->subject->name; 
                        }
                        ?>
                        <tr>
                            <td><?= ++$x; ?></td>
                            <td><?= h($assignment->assignment_type) ?></td>
                            <td><?= $assignment->medium->name ?></td>
                            <td><?= $assignment->student_class->name ?></td>
                            <td><?= @$assignment->stream->name ?></td>
                            <td><?= @$assignment->section->name ?></td>
                            <td><?= $subject_name ?></td>
                            <td><?= h($assignment->topic) ?></td>
                            <td><?= h($assignment->date) ?></td>
                            <td class="actions"><a class="btn btn-success btn-sm" download="download" href="<?= $cdn_path.'/'.$assignment->document ?>" ><i class="fa fa-download"></i></a></td>  
                            <td class="actions">
                                <a class=" btn btn-primary btn-sm" data-target="#Details<?php echo $assignment->id; ?>" data-toggle="modal"><i class="fa fa-book"></i> Students</a>
                                    <div id="Details<?php echo $assignment->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                            <div class="modal-content">
                                              <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" >
                                                        Student List
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                <table id="example1" class="table  table-striped" style="border-collapse:collapse;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><?= h('S.No.') ?></th> 
                                                            <th scope="col"><?= h('Student Name') ?></th>   
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  $a=0;
                                                        foreach ($assignment->assignment_students as $studnetlist) {?>
                                                         <tr>
                                                            <td><?= ++$a;?></td>
                                                            <td><?= $studnetlist->student->name ; ?></td>
                                                         </tr>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                            <td class="actions">
                                <a class=" btn btn-danger btn-sm" data-target="#deletemodal<?php echo $assignment->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $assignment->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['url'=>['controller'=>'Assignments','action'=>'delete',$assignment->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to remove this Assignment ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-sm btn-info">Yes</button>
                                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="box-footer">
                    <?= $this->element('pagination') ?> 
                </div>
            </div>
        </div>
    </div>
</div>
     
 
<?= $this->element('selectpicker') ?>
<?= $this->element('daterangepicker') ?>
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
