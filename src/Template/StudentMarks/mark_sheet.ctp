<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentElectiveSubject[]|\Cake\Collection\CollectionInterface $studentElectiveSubjects
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                  <label > Mark Sheet </label>
                <?php }else{ ?>
                  <label> Mark Sheet </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($studentMark,['id'=>'ServiceForm','autocomplete'=>false]) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Class <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('class_mapping_id', ['options' => $classMappings,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required','val'=>'']);?>
                        </div>
                    
                        <div class="col-md-4">
                            <label class="control-label"> Exams </label>
                            <?php echo $this->Form->control('exam_master_id', ['options' =>[],'label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                            <?= $this->Form->hidden('last',['value'=>0,'id'=>'last']) ?>
                        </div>
                    
                        <div class="col-md-4">
                            <?php echo $this->Form->button('Submit',['class'=>'btn button btnClass','id'=>'submit_member']); ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th>Sr. No.</th>
                                <th>Student</th>
                                <th>Scoller No.</th>
                                <th>Roll No.</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="main">
                                <?php if (isset($students)): ?>
                                    <?php foreach ($students as $key => $student): ?>
                                        <tr>
                                            <td><?= $key+1 ?></td>
                                            <td><?= $student->name?></td>
                                            <td><?= $student->scoller_no?></td>
                                            <td><?= $student->roll_no?></td>
                                            <td>
                                                <a target="_blank" class="btn btn-warning" href="<?=$this->Url->build(['action'=>'viewMarkSheet1',$student->id,$student->student_class_id,$_POST['exam_master_id'],$_POST['last'],$student->stream_id])?>">View</a>
                                            </td>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('loading') ?>
<?= $this->element('selectpicker') ?>
<?= $this->element('validate') ?>

<?php 
$js = "
$(document).ready(function(){

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

    $(document).on('change','#class-mapping-id',function()
    {
        $('#exam-master-id').empty();
        $('#exam-master-id').select2();

        var url = '".$this->Url->build(['action'=>'getParentExams.json'])."';
        
        $.post(url,{class_mapping_id: $(this).val()},function(result){
            var response = JSON.parse(JSON.stringify(result));
            $.each(response.response, function (index, value) {
                var o = $('<option/>', {value: value.id, text: value.name});
                o.attr('save_to','exam_master_id');
                $('#exam-master-id').append(o);
            });

            $('#exam-master-id').val($('#exam-master-id option:first-child').val()).trigger('change');

            arr = {};
        });
    });

    $(document).on('change','#exam-master-id',function(){
        if($(this).val())
            if($(this).val() == $('#exam-master-id option:last').val())
                $('#last').val('1');
            else
                $('#last').val('0');
    });
});
";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>