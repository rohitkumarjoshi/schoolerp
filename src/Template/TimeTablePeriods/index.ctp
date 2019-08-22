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
                    <label> Time Table View</label>
                </div>
                <?= $this->Form->create('dasd',['id'=>'ServiceForm','type'=>'file']) ?>
                <div class="box-body">
                    <div class="form-group">
                         
                        <span class="help-block"></span>
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
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Section</label>
                                <?php echo $this->Form->control('section_id', ['empty'=>'--- Select ---','options' => $sections,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                            </div>
                            <!-- <div class="col-md-4">
                                <label class="control-label"> Subject</label>
                                <?php //echo $this->Form->control('subject_id', ['empty'=>'--- Select ---','options' => $subjects,'class'=>'select2 subject-id','style'=>'width:100%','label'=>false]);?>
                            </div>  -->
                            <div class="col-md-6">
                                <label class="control-label"> Day</label>
                                <?php $type['Monday']='Monday';?>
                                <?php $type['Tuesday']='Tuesday';?>
                                <?php $type['Wednesday']='Wednesday';?>
                                <?php $type['Thursday']='Thursday';?>
                                <?php $type['Friday']='Friday';?>
                                <?php $type['Saturday']='Saturday';?>
                                <?php echo $this->Form->control('day',[
                                'label' => false,'class'=>'select2 day','empty'=>'Select...','style'=>'width:100%','options' => $type]);?>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <center>
                            <div class="col-md-12">
                                <div class="col-md-offset-3 col-md-6">  
                                    <?php echo $this->Form->button('Search',['class'=>'btn button btn-sm','id'=>'submit_member']); ?>
                                </div>
                            </div>
                        </center>       
                    </div>
                </div>
                <?= $this->Form->end() ?> 
                <div class="row" style="padding-top:0px">
                    <div class="col-md-12">
                    <?php
                    if(!empty($timeTablePeriods)){
                        ?>
                        <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?= h('S.No.') ?></th>
                                    <th scope="col"><?= h('Medium') ?></th>
                                    <th scope="col"><?= h('Class') ?></th>
                                    <th scope="col"><?= h('Stream') ?></th>
                                    <th scope="col"><?= h('Section') ?></th>
                                    <th scope="col"><?= h('Subject') ?></th>
                                    <th scope="col"><?= h('Time From') ?></th>
                                    <th scope="col"><?= h('Time To') ?></th>
                                    <th scope="col"><?= h('Day') ?></th>
                                    <th scope="col"><?= h('Teacher') ?></th> 
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x=0; foreach ($timeTablePeriods as $timeTablePeriod): ?>
                                <tr>
                                    <td><?= ++$x ?></td>
                                    <td><?= $timeTablePeriod->medium->name ?></td>
                                    <td><?= $timeTablePeriod->student_class->name?></td>
                                    <td><?= @$timeTablePeriod->stream->name ?></td>
                                    <td><?= @$timeTablePeriod->section->name ?></td>
                                    <td><?= $timeTablePeriod->subject->name ?></td>
                                    <td><?= h($timeTablePeriod->time_from) ?></td>
                                    <td><?= h($timeTablePeriod->time_to) ?></td>
                                    <td><?= h($timeTablePeriod->day) ?></td>
                                    <td><?= $timeTablePeriod->employee->name ?></td> 
                                    <td class="actions">
                                        <a class=" btn btn-danger btn-sm" data-target="#deletemodal<?php echo $timeTablePeriod->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                        <div id="deletemodal<?php echo $timeTablePeriod->id; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md" >
                                            <?= $this->Form->create('',['url'=>['controller'=>'TimeTablePeriods','action'=>'delete',$timeTablePeriod->id]]) ?>
                                                    <div class="modal-content">
                                                      <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title" >
                                                                Stay Attention
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                        <h4 class="modal-title">
                                                            Are you sure you want to remove this record ?
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
                        <?php
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>

 
<?php $this->element('selectpicker') ?>  
<?php
$js="

$(document).ready(function(){     
    var arr = {};

    function appendSubjects(arrayData)
    {
        $('#subject-id').empty(); 
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
        $('#subject-id').select2(); 
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
