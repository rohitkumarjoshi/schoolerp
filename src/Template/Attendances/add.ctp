<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Attendence </label>
            </div>
            <?= $this->Form->create('',['id'=>'ServiceForm','type'=>'get']) ?>
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Medium </label>
                        
                            <?php echo $this->Form->control('medium_id', ['empty'=>'--- Select---','options' => $mediums,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Class </label>
                        
                            <?php echo $this->Form->control('student_class_id', ['empty'=>'--- Select ---','options' => '','class'=>'select2','style'=>'width:100%','label'=>false]);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Stream</label>
                        
                            <?php echo $this->Form->control('stream_id', ['empty'=>'--- Select ---','options' => '','class'=>'select2','style'=>'width:100%','label'=>false]);?>
                        </div> 
                    </div>
                    <span class="help-block"></span>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Section</label>
                            <?php echo $this->Form->control('section_id', ['empty'=>'--- Select ---','options' => '','class'=>'select2','style'=>'width:100%','label'=>false]);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Date</label>
                            <?= $this->Form->control('attendance_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','value'=>date('d-M-Y'),'data-date-format'=>'dd-M-yyyy','required'])?>
                        </div>
                        <div class="col-md-4">
                                <label class="control-label"> Attendence Time </label>
                                <div class="">
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" value="first" <?php if(!empty($optradio)){ if($optradio=='first'){echo"checked";}} else{echo"checked";} ?> > First Half
                                </label>  
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" <?php if(!empty($optradio)){ if($optradio=='second'){echo"checked";}} ?> value="second"> Second Half
                                </label>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="box-footer">
                <div class="row">
                    <center>
                        <div class="col-md-12">
                            <div class="col-md-offset-3 col-md-6">  
                                <?php echo $this->Form->button('Search',['class'=>'btn button','id'=>'submit_member']); ?>
                            </div>
                        </div>
                    </center>       
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?php if($optradio){ ?>
 <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <?= $this->Form->create($attendance,['id'=>'ServiceFormfdsdfffffffffdfs']) ?>
            <div class="box-header with-border" >
                <label> View Attendence  (<?php echo @$medium_name; ?>-><?php echo @$class_name; ?>-> <?php echo @$stream_name; ?>-><?php echo @$section_name; ?>) </label>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <table class="table" id="main_table1" style="width:100%;">
                        <thead>
                            <tr>
                                <th > Sr.No</th>
                                <th > Student</th>
                                <th > Select All
                                    <label class="radio-inline">
                                        <input type="radio" name="selectAll" class="all" value="p" 
                                           /> Present 
                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="selectAll" value="a" class="all" /> Absent 
                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="selectAll" value="l" class="all" /> Leave 
                                    </label>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $this->Form->hidden('optradio', ['value'=>$optradio,'type'=>'hidden']); ?>
                            <?php $i=1; foreach (@$attendancesDatas as $attendanceData): ?>
                            <?php
                            $attendances = $attendanceData->attendances;
                            $currentAttend='';
                            if(sizeof($attendances) >0 ){
                                if($optradio=='first'){
                                    $currentAttend = $attendances[0]->first_half;
                                }
                                if($optradio == 'second'){
                                    $currentAttend=$attendances[0]->second_half;;
                                }
                                echo $this->Form->hidden('attendance_id['.$attendanceData->id.']', ['value'=>$attendances[0]->id,'type'=>'hidden']);
                            }
                            ?>
                            <tr class="main_tr1">
                                <td><?= $i ;?></td>
                                <td><?= h($attendanceData->student->name) ;?>
                                <?= $this->Form->hidden('student_info_id', ['value'=>$attendanceData->id,'type'=>'hidden']); ?>
                                </td>
                                 <td width="40%">
                                    <label class="radio-inline">
                                        <input type="radio" name="attendance" class="<?php if($currentAttend==0.5) { echo 'hello'; } ?> pclass" value="0.5" 
                                           /> Present 
                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="attendance" value="0" class="<?php if($currentAttend==0) { echo 'hello'; } ?> aclass" /> Absent 
                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="attendance" value="1" class="<?php if($currentAttend==1) { echo 'hello'; } ?> lclass" /> Leave 
                                    </label>
                                </td> 
                               <?= $this->Form->unlockField('student_info_id');?>
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
             <div class="box-footer">
                <div class="row">
                    <center>
                        <div class="col-md-12">
                            <div class="col-md-offset-3 col-md-6">  
                                <?php echo $this->Form->button('submit',['class'=>'btn btn-primary','id'=>'submit_attendence']); ?>
                            </div>
                        </div>
                    </center>       
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?php } ?>
<?= $this->element('validate') ?>
<?= $this->element('datepicker') ?> 
<?php $this->element('icheck') ?>  
<?php $this->element('selectpicker') ?>  
<?php
$js="

$(document).ready(function(){
    rename_rows();
    function rename_rows(){
        var j=0;
        var p=0;    
        var i=0;
        $('#main_table1 tbody tr.main_tr1').each(function()
        { 
            $(this).find('td:nth-child(1)').html(++p);
            $(this).find('td:nth-child(2) input').attr({name:'student_info_id['+i+']'});
            $(this).find('td:nth-child(3) input').attr({name:'attendance['+i+']'});
            $(this).find('td:nth-child(3) input.hello').attr('checked',true);
            $(this).find('td:nth-child(3) input.hello').closest('div.iradio_minimal-blue').addClass('checked');
            i++;
         });
     }
 
    $(document).on('ifChecked', '.all', function(){
        var isNow= $(this).val();
        if(isNow =='p'){
            $('input.pclass').closest('div.iradio_minimal-blue').addClass('checked');
            $('input.pclass').attr('checked',true);

            $('input.aclass').closest('div.iradio_minimal-blue').removeClass('checked');
            $('input.aclass').removeAttr('checked',true);
            $('input.lclass').closest('div.iradio_minimal-blue').removeClass('checked');
            $('input.lclass').removeAttr('checked',true);
        }   
        if(isNow =='a'){
            $('input.aclass').closest('div.iradio_minimal-blue').addClass('checked');
            $('input.aclass').attr('checked',true);

            $('input.pclass').closest('div.iradio_minimal-blue').removeClass('checked');
            $('input.pclass').removeAttr('checked',true);
            $('input.lclass').closest('div.iradio_minimal-blue').removeClass('checked');
            $('input.lclass').removeAttr('checked',true);
        }
        if(isNow =='l'){
            $('input.lclass').closest('div.iradio_minimal-blue').addClass('checked');
            $('input.lclass').attr('checked',true);

            $('input.aclass').closest('div.iradio_minimal-blue').removeClass('checked');
            $('input.aclass').removeAttr('checked',true);
            $('input.pclass').closest('div.iradio_minimal-blue').removeClass('checked');
            $('input.pclass').removeAttr('checked',true);
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
    
    $('#ServiceForm').validate({ 
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});";

$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
