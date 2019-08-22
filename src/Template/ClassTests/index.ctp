<div class="box box-primary">
    <div class="box-header with-border"> 
        <label > Class Test List</label>
        <div class="box-tools pull-right">
            <a style="font-size:19px;" class="btn btn-box-tool" data-target="#FilterModel" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
        </div>
    </div>
    <div class="box-body" >        
        <?php $page_no=$this->Paginator->current('ClassTests'); $page_no=($page_no-1)*20; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body" style="width: 100% !important;">
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
                                        <div class="col-md-12" align="center">
                                        <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                            <a href="<?php echo $this->Url->build(array('controller'=>'ClassTests','action'=>'index')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                            <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                        </div> 
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <?= $this->Form->end() ?>
                        <div>
                            <table class="table table-bordered table-hover">
                             <thead>
                                <tr style="white-space: nowrap;">
                                    <th>#</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Topic Name </th>
                                    <th>Test Date</th>
                                    <th>Max Marks</th>
                                    <th class="actions">Action</th>
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
                                        <?=  h($classTest->subject->name) ?>
                                    </td>
                                    <td>
                                        <?=  h($classTest->topic) ?>
                                    </td>
                                    <td><?= h(date('d-M-Y',strtotime(h($classTest->test_date)))) ?> </td>
                                    <td><?=h(@$classTest->max_marks) ?> </td>
                                    <td class="actions"> 
                                        <?= $this->Html->link(__('Fill Marks'), ['action' => 'fillMarks', $EncryptingDecrypting->encryptData($classTest->id)],['class'=>'btn btn-primary btn-sm ','escape'=>false, 'data-widget'=>'Fill Marks', 'data-toggle'=>'tooltip', 'data-original-title'=>'Fill Marks']) ?>
                                        <a href="#delete<?php echo $classTest->id ;?>" class="btn btn-danger btn-sm" data-toggle="modal" /> <i class="fa fa-trash" style="color:white !important;"></i></a>
                                    </td>
                                    <div id="delete<?php echo $classTest->id ;?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                              <?= $this->Form->create('',['class'=>'ServiceForm']) ?>
                                                <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>
                                                      Are you sure you want to remove this Class Test?
                                                    </h4>
                                                    <?php echo $this->Form->hidden('classtest_id',[
                                                      'value'=>$classTest->id]);?>
                                                     
                                                </div>
                                                <div class="modal-footer">
                                                  <?php echo $this->Form->button('Yes',['class'=>'btn btn-success submit_member']); ?>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                <?= $this->Form->unlockField('reject_request_id') ;?>
                                            <?= $this->Form->end() ?>
                                            </div>
                                        </div>
                                    </div>      
                                </tr>
                            <?php $i++;endforeach; ?>
                                </tbody>
                            </table>
                            <div class="box-footer">
                                <?= $this->element('pagination') ?> 
                            </div>
                        </div>
                    </div>
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