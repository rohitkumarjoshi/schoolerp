<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BestMarkSubject[]|\Cake\Collection\CollectionInterface $bestMarkSubjects
 */
?>
    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                        <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Best Marsk Subject </label>
                    <?php }else{ ?>
                        <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Add Best Marsk Subject </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($bestMarkSubject,['id'=>'ServiceForm','url'=>['action'=>'add','autocomplete'=>false]]) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Choose Class <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('student_class_id', ['options' => $studentClasses,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required','val'=>'']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Choose Stream </label>
                            </div>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('stream_id', ['options' => $streams,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Choose Subject <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('subject_id', ['options' => $subjects,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Choose Exams <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('exam_masters[]', ['options' =>[],'label'=>false,'class'=>'select2','style'=>'width:100%;','multiple'=>true,'required','hiddenField'=>false]);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Choose Best Of <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-8">
                                <?php echo $this->Form->control('no_of_best_subject', ['label'=>false,'class'=>'form-control','placeholder'=>'Ex. 2']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','id'=>'submit_member']); ?>
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
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create('bestMarkSubject',['class'=>'filter_form']) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="control-label"> Class </label>
                                <?= $this->Form->control('student_class_id',['id'=>'filter-class','options'=>$studentClasses,'empty'=>'--select--','class'=>'select2','style'=>'width:100%;','label'=>false]) ?>
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label"> Stream </label>
                                <?= $this->Form->control('stream_id',['id'=>'filter-stream','options'=>$streams,'empty'=>'--select--','class'=>'select2','style'=>'width:100%;','label'=>false]) ?>
                            </div>

                            <div class="col-sm-4">
                                <?= $this->Form->submit('search',['class'=>'btn btn-default btn-success btnClass']) ?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                    <!--<?php $page_no=$this->Paginator->current('achivementCategories'); $page_no=($page_no-1)*10; ?>-->
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('student_class_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('stream_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                                <th scope="col"><?= __('Best Of') ?></th>
                                <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($bestMarkSubjects as $bestMarkSubject): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= $bestMarkSubject->has('student_class') ? $bestMarkSubject->student_class->name : '' ?></td>
                                <td><?= $bestMarkSubject->has('stream') ? $bestMarkSubject->stream->name : '' ?></td>
                                <td><?= $bestMarkSubject->has('subject') ? $bestMarkSubject->subject->name : '' ?></td>
                                <td><?= $this->Number->format($bestMarkSubject->no_of_best_subject) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($bestMarkSubject->id)],['class'=>'btn btn-info btn-lg editbtn','escape'=>false]) ?>

                                    <a class=" btn btn-danger btn-lg deletebtn" data-target="#deletemodal<?php echo $bestMarkSubject->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $bestMarkSubject->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'BestMarkSubjects','action'=>'delete',$bestMarkSubject->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to remove this book ?
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
<?= $this->element('loading') ?> 
<?= $this->element('validate') ?>
<?php
$js="
$(document).ready(function(){

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }

    function appendSubjects(arrayData)
    {
        var data = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'Subjects','action'=>'getSubjects.json'])."';
        
        $.post(url,data,function(result){
            var response = JSON.parse(JSON.stringify(result));
            
            $.each(response.response, function (index, value) {
                var o = $('<option/>', {value: value.id, text: value.name});
                $('#subject-id').append(o);
            });
        });
    }

    function appendExams(arrayData)
    {
        var data = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'ExamMasters','action'=>'getExams.json'])."';
        
        $.post(url,data,function(result){
            var response = JSON.parse(JSON.stringify(result));
            
            $.each(response.response, function (index, value) {
                var o = $('<option/>', {value: value.id, text: value.name});
                $('#exam-masters').append(o);
            });

            subjectArr = {};
        });
    }

    $(document).on('change','#student-class-id',function(){
        var URL = '".$this->Url->build(['controller'=>'Subjects','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#stream-id').empty();
        $('#subject-id').empty();

        $.post(URL,{class_id: id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#stream-id').append(o);
                }); 
                $('#stream-id').val($('#stream-id option:first-child').val()).trigger('change');;
                
            }
            else
            {
                appendEmpty($('#stream-id'));
                var data = {};
                data['student_class_id'] = id;
                appendSubjects(data);               
            }
        });
    });

    $(document).on('change','#stream-id',function(){
        $('#subject-id').empty();
        $('#exam-masters').empty();
        if($(this).val())
        {
            appendEmpty($('#subject-id'));
            var data = {};
            data['stream_id'] = $(this).val();
            data['student_class_id'] = $('#student-class-id').val();
            appendSubjects(data); 
            appendExams(data);
        } 
    });

    $(document).on('change','#filter-class',function(){
        var URL = '".$this->Url->build(['controller'=>'Subjects','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#filter-stream').empty();
        $('#filter-stream').select2();

        $.post(URL,{class_id: id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#filter-stream').append(o);
                }); 
                $('#stream-id').val($('#stream-id option:first-child').val()).trigger('change');;
                
            }
        });
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
