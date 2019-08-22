<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject
 */
?>

<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
    .control-label{
        display: block;
    }
    .iradio_minimal-blue{
        margin-right: 5px;
        margin-left: 5px;
    }
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                        <label > Edit Subjects </label>
                    <?php }else{ ?>
                        <label> Add Subject </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($subject,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Choose Class</label>
                                <?php echo $this->Form->control('student_class_id', ['options' => $studentClasses,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','required']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Choose Stream</label>
                                <?php echo $this->Form->control('stream_id', ['options' => $streams,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','s-val'=>$subject->stream_id]);?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <th>Subject Name</th>
                                        <th>Elective ?</th>
                                        <th>Order</th>
                                        <th>Type</th>
                                        <th>Parent</th>
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="hidden" id="sample_table">
                <tbody>
                    <tr class="main_tr">
                        <td>
                            <?php echo $this->Form->control('name',['label' => false,'id'=>false,'class'=>'form-control name','placeholder'=>'Subject Name','type'=>'text']);?>
                        </td>
                        <td>
                            <?php $options = array('Yes' => 'Yes','No'=>'No' ); ?>
                            <?php echo $this->Form->radio('elective',[
                                ['value'=>'No','text'=>'No','checked','class'=>'radio-inline elective','id'=>false],
                                ['value'=>'Yes','text'=>'Yes','class'=>'radio-inline elective','id'=>false]
                            ]);?>
                        </td>
                        <td>
                            <?php echo $this->Form->control('order_number',['label' => false,'class'=>'form-control order_number','placeholder'=>'Order No.']);?>
                        </td>
                        <td>
                            <?php echo $this->Form->control('subject_type_id', ['options' => $subjectTypes,'label'=>false,'id'=>false,'class'=>'subject_type_id','style'=>'width:100%;']);?>
                        </td>
                        <td>
                            <?php echo $this->Form->control('parent_id', ['options' => [],'empty'=>'--Select--','label'=>false,'class'=>'parent_id','style'=>'width:100%;']);?>
                        </td>

                        <td>
                            <button type="button" class="add_row btn btn-lg btn-success editbtn"><i class="fa fa-plus"></i></button><button type="button" class="remove btn btn-lg btn-danger deletebtn"><i class="fa fa-minus"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->element('selectpicker') ?>
<?= $this->element('validate') ?>
<?= $this->element('loading') ?>
<?= $this->element('icheck_class') ?>

<?php
$js="
$(document).ready(function(){
    function appendSubjects(arrayData)
    {
        var order = '';
        var data2 = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'Subjects','action'=>'getParent.json'])."';
        
        $.post(url,data2,function(result){
            var response = JSON.parse(JSON.stringify(result));
            
            $.each(response.response, function (index, value) {
                var val = '';
                order = value.order_number || 0;
                if(value.parent != null)
                    val+= value.parent+' > ';
                val+= value.name;
                var o = $('<option/>', {value: value.id, text: val});
                $('#parent-id').append(o);
            });
            $('#order-number').attr('placeholder','Last Order = '+order);
            if($('#parent-id').attr('s-val'))
                $('#parent-id').val($('#parent-id').attr('s-val')).trigger('change');
            else
                $('#parent-id').val($('#parent-id option:first-child').val()).trigger('change');

            add_row();
        });
    }

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }

    $(document).on('change','#student-class-id',function(){
        $('#main_tbody').empty();
        var URL = '".$this->Url->build(['controller'=>'StudentClasses','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#stream-id').empty();
        $('#stream-id').select2();
        $('#parent-id').empty();
        appendEmpty($('#parent-id'));

        if(id)
        {
            $.post(URL,{class_id: id},function(result){
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
                    var data = {};
                    data['student_class_id'] = id;
                    appendSubjects(data);               
                }
            });
        }
    });

    $(document).on('change','#stream-id',function(){
        $('#main_tbody').empty();
        $('#parent-id').empty();
        appendEmpty($('#parent-id'));
        var data = {};
        data['stream_id'] = $('#stream-id').val();
        data['student_class_id'] = $('#student-class-id').val();
        appendSubjects(data); 
    });

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
            $(this).find('.name').attr({name:'subjects['+i+'][name]'});
            $(this).find('.elective').attr({name:'subjects['+i+'][elective]'}).iCheck({checkboxClass: 'icheckbox_minimal-blue', radioClass: 'iradio_minimal-blue'});
            $(this).find('.order_number').attr({name:'subjects['+i+'][order_number]',id: ''});
            $(this).find('select.subject_type_id ').attr({name:'subjects['+i+'][subject_type_id]'}).select2();
            $(this).find('select.parent_id ').attr({name:'subjects['+i+'][parent_id]',id: ''}).select2();
            i++;
        });
    }

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>