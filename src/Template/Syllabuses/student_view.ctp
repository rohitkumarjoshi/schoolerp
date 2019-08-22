<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <label> Syllabus List </label>
                <div class="box-tools pull-right">
                    <!--<a style="font-size:19px;" class="btn btn-box-tool" data-target="#FilterModel" data-toggle="collapse"> <i class="fa fa-filter"></i></a>-->
                </div>
            </div> 
            <div class="box-body">
                <!--<?= $this->Form->create('FilterForm',['type'=>'get']) ?>
                <div class="collapse" id="FilterModel" aria-expanded="false"> 
                    <fieldset style="text-align:left;"><legend>Filter</legend>
                        <div class="col-md-12">
                            <div class="row"> 
                                <div class="col-md-6">
                                    <label class="control-label">Select</label>
                                    <?= $this->Form->control('medium_id', ['options'=>$media,'label' => false, 'class'=>'select2','empty'=>'Select...','style'=>'width:100%'])?>     
                                </div> 
                                <div class="col-md-6">
                                    <label class="control-label">Class</label>
                                    <?= $this->Form->control('student_class_id', ['options'=>$studentClasses,'label' => false, 'class'=>'select2','empty'=>'Select...','style'=>'width:100%'])?>     
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Stream</label>
                                    <?= $this->Form->control('stream_id', ['options'=>$streams,'label' => false, 'class'=>'select2','empty'=>'Select...','style'=>'width:100%'])?>     
                                </div> 
                                <div class="col-md-6">
                                    <label class="control-label">Section</label>
                                    <?= $this->Form->control('section_id', ['options'=>$sections,'label' => false, 'class'=>'select2','empty'=>'Select...','style'=>'width:100%'])?>     
                                </div> 
                            </div> 

                            <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                <a href="<?php echo $this->Url->build(array('controller'=>'Syllabuses','action'=>'view')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                            </div>  
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>-->
                <!--<?php $page_no=$this->Paginator->current('Directories'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Subject ') ?></th> 
                            <th scope="col" class="actions"><?= __('File ') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($syllabuses as $syllabus): ?>
                        <?php
                        $subject_name=$syllabus->subject->name;
                        if(!empty($syllabus->subject->parent_subject)){
                           $subject_name=$syllabus->subject->parent_subject->name.' -> '.$syllabus->subject->name; 
                        }
                        ?>
                        <tr>
                            <td width="15%"><?php echo ++$page_no;?></td> 
                            <td ><?php echo @$subject_name;?></td> 
                            <td width="15%">
                                <a href="<?= $cdn_path.'/'.$syllabus->file_path ?>" class="btn btn-sm btn-primary" download="download" target="_blank"> <i class="fa fa-download"></i></a>
                            </td>   
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table>
            <div class="box-footer">
                <!-- <?= $this->element('pagination') ?>  -->
            </div> 
            </div>
        </div>
    </div>
</div>

<?php $this->element('selectpicker') ?> 
<?php
$js="

$(document).ready(function(){
    $('.stdcheck').hide();
     
    function appendSubjects(arrayData)
    {
        $('#subject-id').empty();
        appendEmpty($('#subject-id')); 
        var data2 = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getSubjects.json'])."';
        
        $.post(url,data2,function(result){
            var response = JSON.parse(JSON.stringify(result));
            $.each(response.response, function (index, value) {
                var o = $('<option/>', {value: index, text: value});
                $('#subject-id').append(o);
            });
            $.each(response.co_scholastic_subjects, function (index, value) {
                var o = $('<option/>', {value: index, text: value});
                $('#subject-id').append(o);
            });
             
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
