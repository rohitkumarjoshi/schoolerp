<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
            </div> 
            <div class="box-body">
                <?= $this->Form->create('examMaster') ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="control-label"> Class </label>
                            <?= $this->Form->control('student_class_id',['options'=>$studentClasses,'empty'=>'--All--','class'=>'select2','style'=>'width:100%;','label'=>false]) ?>
                        </div>

                        <div class="col-sm-4">
                            <label class="control-label"> Stream </label>
                            <?= $this->Form->control('stream_id',['options'=>$streams,'empty'=>'--All--','class'=>'select2','style'=>'width:100%;','label'=>false]) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $this->Form->submit('search',['class'=>'btn btn-default btn-success btnClass']) ?>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
                <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
                 <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th><?= __('Sr.No') ?></th>
                            <th scope="col"> Class</th>
                            <th scope="col"><?= ('Stream') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('scale_no') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>           
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($scalings as $scaling): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td><?= @$scaling->subject->student_class->name ?></td>
                            <td><?= @$scaling->subject->stream->name ?></td>
                            <td><?= $scaling->has('subject') ? $scaling->subject->name : '' ?></td>
                            <td><?= h($scaling->scale_no) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('<i class="fa fa-pencil-square-o"></i> '), ['action' => 'add', $EncryptingDecrypting->encryptData($scaling->id)],['class'=>'btn btn-info btn-xs','escape'=>false]) ?>

                                <a class=" btn btn-danger btn-xs" data-target="#deletemodal<?php echo $scaling->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                <div id="deletemodal<?php echo $scaling->id; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-md" >
                                    <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'Scalings','action'=>'delete',$scaling->id]]) ?>
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
            </div>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker');?>

<?php
$js="
$(document).ready(function(){

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--All--'});
        id.append(o);
        id.trigger('change');
    }

    $(document).on('change','#student-class-id',function(){
        var URL = '".$this->Url->build(['controller'=>'Subjects','action'=>'getStreams.json'])."';
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
});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>