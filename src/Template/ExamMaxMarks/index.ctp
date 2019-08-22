<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExamMaxMark[]|\Cake\Collection\CollectionInterface $examMaxMarks
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\examMaxMark[]|\Cake\Collection\CollectionInterface $examMaxMarks
 */
?>

    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                      <label > Edit Subject Max Marks </label>
                    <?php }else{ ?>
                      <label> Add Subject Max Marks </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($examMaxMark,['id'=>'ServiceForm','url'=>['action'=>'add','autocomplete'=>false]]) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Choose Medium <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('medium_id', ['options' => $mediums,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required','val'=>'']);?>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Choose Class <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('student_class_id', ['options' => [],'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required','val'=>'']);?>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Choose Stream </label>
                                <?php echo $this->Form->control('stream_id', ['options' =>[],'label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Choose Exams <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('exam_master_id', ['options' =>[],'label'=>false,'class'=>'select2','style'=>'width:100%;','required','hiddenField'=>false]);?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Subjects</label>
                            
                                <?php echo $this->Form->control('subject_id', ['empty'=>'--- Select ---','options' => '','class'=>'select2','style'=>'width:100%','label'=>false]);?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Maximum Marks <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('max_marks', ['label'=>false,'class'=>'form-control','placeholder'=>'Ex. 2']);?>
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
        <div class="col-md-7">
            <div class="box box-primary">
                <div class="box-header with-border">
                     <label> View List </label>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create('examMaxMark',['class'=>'filter_form']) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="control-label"> Class </label>
                                <?= $this->Form->control('student_class_id',['id'=>'filter-class','options'=>$studentClasses,'empty'=>'--select--','class'=>'select2','style'=>'width:100%;','label'=>false,'val'=>'']) ?>
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label"> Stream </label>
                                <?= $this->Form->control('stream_id',['id'=>'filter-stream','options'=>[],'class'=>'select2','style'=>'width:100%;','label'=>false]) ?>
                            </div>

                            <div class="col-sm-4">
                                <?= $this->Form->submit('search',['class'=>'btn btn-default btn-success btnClass']) ?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                    <!--<?php $page_no=$this->Paginator->current('achivementCategories'); $page_no=($page_no-1)*10; ?>-->
                     <table id="example1" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= __('Class') ?></th>
                                <th scope="col"><?= __('Stream') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                                <th scope="col"><?= __('Exam') ?></th>
                                <th scope="col"><?= __('Max Marks') ?></th>
                                <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($examMaxMarks as $examMaxMark): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= $examMaxMark->has('exam_master') ? $examMaxMark->exam_master->student_class->name : '' ?></td>
                                <td><?= $examMaxMark->has('exam_master') ? $examMaxMark->exam_master->stream->name : '' ?></td>
                                <td><?= $examMaxMark->has('subject') ? $examMaxMark->subject->name : '' ?></td>
                                <td><?= $examMaxMark->has('exam_master') ? $examMaxMark->exam_master->name : '' ?></td>
                                <td><?= $this->Number->format($examMaxMark->max_marks) ?></td>
                                <td class="actions">
                                    <a class=" btn btn-danger btn-lg deletebtn" data-target="#deletemodal<?php echo $examMaxMark->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $examMaxMark->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['class'=>'filter_form','url'=>['controller'=>'ExamMaxMarks','action'=>'delete',$examMaxMark->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to remove this ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn  btn-sm btn-info">Yes</button>
                                                        <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++; endforeach; ?>
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
<?= $this->element('validate') ?>
<?= $this->element('loading') ?>
<?php
$js="
$(document).ready(function(){

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }
    var arr = {};

    function rr(obj)
    {
        $.each(obj, function(key,value) {
            if(value.children == '')
            {
                arr[value.id] = value.name;
            }
            else
            {
                var response = JSON.parse(JSON.stringify(value.children));
                rr(response);
            }
        });
    }

    function appendSubjects(arrayData)
    {
        $('#subject-id').empty();
        $('#subject-id').select2();
        var data2 = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'Subjects','action'=>'getSubjects.json'])."';
        
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

    function appendExams(arrayData)
    {
        $('#exam-master-id').empty();
        $('#exam-master-id').select2();
        var data = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'ExamMasters','action'=>'getExamsThreaded.json'])."';
        
        $.post(url,data,function(result){
            var response = JSON.parse(JSON.stringify(result));
            rr(response.response);
            
            $.each(arr, function (index, value) {
                var o = $('<option/>', {value: index, text: value});
                o.attr('save_to','exam_master_id');
                $('#exam-master-id').append(o);
            });

            $.each(response.sub_exams, function (key, value) {
                var optgroup = $('<optgroup/>');
                optgroup.attr('label',value.name);
                
                $.each(value.sub_exams, function (key, value2) {
                    var o = $('<option/>', {value: value2.id, text: value2.name});
                    o.attr('save_to','sub_exam_id');
                    optgroup.append(o);
                });
                if(optgroup.children().length > 0)
                    $('#exam-master-id').append(optgroup);
            });
            $('#exam-master-id').val($('#exam-master-id option:first-child').val()).trigger('change');

            arr = {};
        });
    }

    $(document).on('change','#medium-id',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getClasses.json'])."';

        $('#student-class-id').empty();
        $('#student-class-id').select2();
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
        var data = {};
        var id = $(this).val();

        $('#stream-id').empty();
        $('#stream-id').select2();
        appendEmpty($('#stream-id'));

        $('#section-id').empty();
        $('#section-id').select2();

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
                    appendExams(arrData);

                    $.post(URL2,data,function(result){
                        var response = JSON.parse(JSON.stringify(result));
                        if(response.success)
                        {
                            $.each(response.response, function(key,value) {
                                var o = $('<option/>', {value: key, text: value});
                                $('#section-id').append(o);
                            });
                            $('#section-id').val($('#section-id option:first-child').val()).trigger('change');
                        }
                    });
                }
            });
        }
    });

    $(document).on('change','#stream-id',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getSections.json'])."';
        var class_id = $('#student-class-id').val();
        var id = $(this).val();
        
        $('#section-id').empty();
        $('#section-id').select2();
        appendEmpty($('#section-id'));
        
        $('#exam-master-id').empty();
        $('#exam-master-id').select2();
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

            var arrData = {};
            arrData['student_class_id'] = $('#student-class-id').val();
            arrData['stream_id'] = $('#stream-id').val();
            appendSubjects(arrData);
            appendExams(arrData);
        }
    });

    $(document).on('change','#filter-class',function(){
        var URL = '".$this->Url->build(['controller'=>'Subjects','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#filter-stream').empty();
        appendEmpty($('#filter-stream'));
        $('#filter-stream').select2();

        $.post(URL,{class_id: id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#filter-stream').append(o);
                }); 
                $('#filter-stream').val($('#filter-stream option:first-child').val()).trigger('change');;
                
            }
        });
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
