<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ExamMaster $examMaster
 */
?>
<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
    .control-label{
        display: block;
    }
    .iradio_minimal{
        margin-right: 5px;
        margin-left: 5px;
    }
    td button{
        margin-right: 5px;
    }
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                        <label > Edit Exam </label>
                    <?php }else{ ?>
                        <label> Add Exam </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($examMaster,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="control-label"> Choose Class</label>
                                <?= $this->Form->control('student_class_id',['s-val'=>$examMaster->student_class_id,'options' => $studentClasses,'empty'=>'--Select--','class'=>'select2','style'=>'width:100%;','label'=>false,'required']);?>
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label"> Choose Stream</label>
                                <?php echo $this->Form->control('stream_id', ['s-val'=>$examMaster->stream_id,'options' => $streams,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','s-val'=>$examMaster->stream_id]);?>
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label"> Parent Exam</label>
                                <?php echo $this->Form->control('parent_id', ['s-val'=>$examMaster->parent_id,'options' => $parentExamMasters,'empty'=>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;']);?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Exam Name </label>

                                <?php echo $this->Form->control('name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Exam Name','type'=>'text']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Order Number</label>
                                <?php echo $this->Form->control('order_number',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Order No.']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Max-Marks</label>
                                <?php echo $this->Form->control('max_marks',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Maximum Marks']);?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button data-toggle="collapse" data-target="#sub_exams" type="button" class="btn btn-success" id="add_sub_exams"><i class="fa fa-plus"></i> Add Sub-Exams</button>
                                <span class="error text-danger">*Note: Sub-Exams will not be visible in marksheet. The Addition of Sub-Exam's marks will be scaled in main exam.</span>
                            </div>
                        </div>

                        <div class="row collapse" id="sub_exams">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Sr_no</th>
                                        <th>Name</th>
                                        <th>Max Marks</th>
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

        <div class="col-md-12">
            <table class="hidden" id="sample_table">
                <tbody>
                    <tr class="main_tr">
                        <td class="index">1</td>
                        <td><?= $this->Form->control('name',['type'=>'text','class'=>'form-control sub_exam_control sub_exam_name','label'=>false,'placeholder'=>'Sub-Exam Name','id'=>false])?></td>
                        <td><?= $this->Form->control('max_marks',['type'=>'text','class'=>'form-control sub_exam_control sub_exam_max_marks','label'=>false,'placeholder'=>'Max Marks','id'=>false])?></td>
                        <td><button type="button" class="add_row btn btn-sm btn-success"><i class="fa fa-plus"></i></button><button type="button" class="remove btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->element('selectpicker');?>
<?= $this->element('validate');?>
<?= $this->element('loading');?>

<?php
$js="
$(document).ready(function(){

    var id = $('#student-class-id').val();
    if(id)
    {
        var URL = '".$this->Url->build(['controller'=>'StudentClasses','action'=>'getStreams.json'])."';
        var id = $(this).val();
        $('#stream-id').empty();
        $('#stream-id').select2();
        $('#parent-id').empty();
        $('#parent-id').select2();
        
        $.post(URL,{class_id: id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#stream-id').append(o);
                }); 
                if($('#stream-id').attr('s-val'))
                    $('#stream-id').val($('#stream-id').attr('s-val')).trigger('change');
                else
                    $('#stream-id').val($('#stream-id option:first-child').val()).trigger('change');
            }
            else
            {
                var data = {};
                data['student_class_id'] = id;
                appendExams(data);               
            }
        });
    }

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }

    function appendExams(arrayData)
    {
        var order = '';
        appendEmpty($('#parent-id'));
        var data = JSON.parse(JSON.stringify(arrayData));
        var url = '".$this->Url->build(['controller'=>'ExamMasters','action'=>'getExams.json'])."';
        
        $.post(url,data,function(result){
            var response = JSON.parse(JSON.stringify(result));
            
            $.each(response.response, function (index, value) {
                order = value.order_number;
                var o = $('<option/>', {value: value.id, text: value.name});
                $('#parent-id').append(o);
            });
            $('#order-number').attr('placeholder','Last Order = '+order);
            if($('#parent-id').attr('s-val'))
                $('#parent-id').val($('#parent-id').attr('s-val')).trigger('change');
            else
                $('#parent-id').val($('#parent-id option:first-child').val()).trigger('change');
        });
    }

    $(document).on('change','#student-class-id',function(){
        var URL = '".$this->Url->build(['controller'=>'StudentClasses','action'=>'getStreams.json'])."';
        //var URL2 = '".$this->Url->build(['controller'=>'StudentClasses','action'=>'getGradeType.json'])."';
        var id = $(this).val();
        $('#stream-id').empty();
        $('#stream-id').select2();
        $('#parent-id').empty();
        $('#parent-id').select2();

        if(id)
        {
            // $.post(URL2,{class_id: id},function(result){
            //     var response = JSON.parse(JSON.stringify(result));
            //     if(response.success)
            //     {
            //         if(response.response != 'Grade')
            //             $('#max-marks').prop('disabled', false);
            //         else
            //             $('#max-marks').prop('disabled', true);
            //     }
            // });

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
                    appendExams(data);               
                }
            });
        }
    });

    $(document).on('change','#stream-id',function(){
        $('#parent-id').empty();
        $('#parent-id').select2();
        var data = {};
        data['stream_id'] = $(this).val();
        data['student_class_id'] = $('#student-class-id').val();
        appendExams(data); 
    });

    $('#sub_exams').on('shown.bs.collapse', function (e) {
        $('.sub_exam_control').attr('required','required');
    })

    $('#sub_exams').on('hide.bs.collapse', function (e) {
        $('.sub_exam_control').removeAttr('required');
    })

    $('#sub_exams').on('show.bs.collapse', function (e) {
        add_row();
    })

    $('#sub_exams').on('hide.bs.collapse', function (e) {
        $('#main_tbody').empty();
    })
   
    
    $(document).on('click', '.add_row', function(){
        add_row();
        $('.sub_exam_control').attr('required','required');
    });
    
    $(document).on('click', '.remove', function(){
        var count = $('#main_tbody').children().length;
        if(count>=2)
        {
            $(this).parent().parent().remove();
            rename_rows();
        }
        else
        {
            alert('Atleast One Row Is Required');
        }
    });
    
    $(document).on('click', '.delete', function(){
        var url = '".$this->Url->build(['controller'=>'SubExams','action'=>'deleteJ'])."';
        var id = $(this).attr('record');
        var dd = confirm('Do You realy want to delete ?');

        if(dd)
        {
            var count = $('#main_tbody').children().length;
            if(count>=2)
            {
                $.post(url,{id: id},function(result){
                    var sum = 0;
                    $('.total_amount').each(function(){
                        sum += parseInt($(this).val()) || 0;
                    });
                    $('#amount').val(sum);
                    alert(result);
                });

                $(this).parent().parent().remove();
                rename_rows();
            }
            else
            {
                alert('Atleast One Row Is Required');
            }
        }
    });
    
    function add_row()
    {
        var tr=$('#sample_table tbody tr.main_tr').clone();
        $('#main_tbody').append(tr);
        rename_rows();
    }
    
    function rename_rows()
    {
        var i=0;
        $('#main_tbody').find('.main_tr').each(function(){
            $(this).find('.index').html(i+1);
            $(this).find('.sub_exam_name').attr({name:'sub_exams['+i+'][name]'});
            $(this).find('.sub_exam_max_marks').attr({name:'sub_exams['+i+'][max_marks]'});
            $(this).find('.sub_exam_id').attr({name:'sub_exams['+i+'][id]'});
            i++;
        });
    }

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>