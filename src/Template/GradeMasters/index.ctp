<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GradeMaster[]|\Cake\Collection\CollectionInterface $gradeMasters
 */
?>

    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <label> Add Grade Master </label>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($gradeMaster,['id'=>'ServiceForm','url'=>['action'=>'add']]) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Choose Class <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('student_class_id', ['options' => $studentClasses,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required']);?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Choose Stream <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('stream_id', ['options' => $streams,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <th>Minimum Marks</th>
                                        <th>Maximum Marks</th>
                                        <th>Grade</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="main_tbody">
                                        
                                    </tbody>
                                </table>
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
                    <?= $this->Form->create('gradeMaster',['class'=>'filter_form']) ?>
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
                     <table id="example1" class="table" >
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('student_class_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('stream_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('min_marks') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('max_marks') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('grade') ?></th>
                                <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($gradeMasters as $gradeMaster): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= $gradeMaster->has('student_class') ? $gradeMaster->student_class->name : '' ?></td>
                                <td><?= $gradeMaster->has('stream') ? $gradeMaster->stream->name : '' ?></td>
                                <td><?= $gradeMaster->min_marks ?></td>
                                <td><?= $gradeMaster->max_marks ?></td>
                                <td><?= $gradeMaster->grade ?></td>
                                <td class="actions">
                                    <a class=" btn btn-danger btn-xs deletebtn" data-target="#deletemodal<?php echo $gradeMaster->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $gradeMaster->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'GradeMasters','action'=>'delete',$gradeMaster->id]]) ?>
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


        <div class="row">
            <div class="col-md-12">
                <table class="hidden" id="sample_table">
                    <tbody>
                        <tr class="main_tr">
                            <td>
                                <?php echo $this->Form->control('min_marks', ['label'=>false,'class'=>'form-control min_marks','required']);?>
                            </td>
                            <td>
                                <?php echo $this->Form->control('max_marks', ['label'=>false,'class'=>'form-control max_marks','required']);?>
                            </td>
                            <td>
                                <?php echo $this->Form->control('grade', ['label'=>false,'class'=>'form-control grade','required']);?>
                            </td>

                            <td style="width: 20%;">
                                <button type="button" class="add_row btn btn-lg btn-success editbtn"><i class="fa fa-plus"></i></button><button type="button" class="remove btn btn-lg btn-danger deletebtn"><i class="fa fa-minus"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

    $(document).on('change','#student-class-id',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentClasses','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#stream-id').empty();
        appendEmpty($('#stream-id'));

        $.post(URL,{class_id: id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#stream-id').append(o);
                });
            }
        });
    });

    $(document).on('change','#filter-class',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentClasses','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#filter-stream').empty();
        appendEmpty($('#filter-stream'));

        $.post(URL,{class_id: id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#filter-stream').append(o);
                });
            }
        });
    });

    add_row();
    rename_rows();

    $(document).on('click', '.add_row', function(){
        add_row();
    });
    
    function add_row()
    {
        var tr=$('#sample_table tbody tr.main_tr').clone();
        $('#main_tbody').append(tr);
        rename_rows();
    }
    
    $(document).on('click', '.remove', function(){
        var count = $('#main_tbody').children().length;
        if(count>=2)
        {
            $(this).parent().parent().remove();
            rename_rows();
        }
    });
    
    function rename_rows()
    {
        var i=0;
        $('#main_tbody').find('.main_tr').each(function(){
            
            $(this).find('.index').html(i+1);
            $(this).find('.min_marks').attr({name:'grades['+i+'][min_marks]',id: ''});
            $(this).find('.max_marks').attr({name:'grades['+i+'][max_marks]',id: ''});
            $(this).find('.grade').attr({name:'grades['+i+'][grade]',id: ''});
            i++;
        });
    }

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
