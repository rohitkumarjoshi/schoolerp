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
                    <label> Time Table View </label>
						<div class="pull-right box-tools">
							<a href="javascript:window.print();" class="btn bg-maroon hide_print" style="color:#fff !important;">Print</a>               
						</div>
                </div>
             <div class="box-body">
                <div class="row" style="padding-top:0px">
					<div class="col-md-12" style="padding-bottom:20px">
					   <form method="get" class="hide_print">
							<div class="col-md-4">
								<label class="control-label"> Teacher </label>
							
								<?php echo $this->Form->control('student_class_id', ['empty'=>'--- Select ---','options' => $employees,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$user_id]);?>
							</div>
						   <div class="col-md-4">
						 
								 <div class="col-md-offset-3 col-md-6" style="padding-top: 18px;">  
										<?php echo $this->Form->button('Search',['class'=>'btn button btn-sm','id'=>'submit_member']); ?>
								  </div>
							</div>
					   </form>
					</div>
					<br/>
                       
                  
					
                    <div class="col-md-12">
                    <?php
                    if(!empty($TimeTablePeriodData)){
                        ?>
                        <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
                           <?php $x=0; foreach ($TimeTablePeriodData as $timeTablePeriod): 

                                //pr($timeTablePeriod['dayData']->toArray());exit;
                                ?>
                             <thead>
                                <tr>
                                    <th colspan="7" style="background-color: #eee !important;color: #000000 !important;"><?= $timeTablePeriod['dayName'] ?></th>
                                </tr>
                             </thead>
                            <thead>
                                <tr>
                                    <th scope="col"><?= h('S.No.') ?></th>
                                    <th scope="col"><?= h('Subject') ?></th>
                                    <th scope="col"><?= h('Time From') ?></th>
                                    <th scope="col"><?= h('Time To') ?></th>
                                    <th scope="col"><?= h('Class') ?></th>
                                    <th scope="col"><?= h('Section') ?></th>
                                    <th scope="col"><?= h('Teacher') ?></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($timeTablePeriod['dayData'] as $timeTable) {  ?>
                                <tr>
                                    <td><?= ++$x ?></td>
                                    <td><?= $timeTable->subject->name ?></td>
                                    <td><?= h($timeTable->time_from) ?></td>
                                    <td><?= h($timeTable->time_to) ?></td>
                                    <td><?= h($timeTable->student_class->name) ?></td>
                                    <td><?= h($timeTable->section->name) ?></td>
                                    <td><?= $timeTable->employee->name ?></td> 
                                </tr>
                                <?php } ?>
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
