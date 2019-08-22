<?php
$js="
$(document).ready(function(){

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }

    $(document).on('change','#stream-id',function(){
        var URL2 = '".$this->Url->build(['controller'=>'ClassMappings','action'=>'getSections.json'])."';
        var class_id = $('#student-class-id').val();
        var id = $(this).val();
        
        $('#section-id').empty();
        $('#section-id').select2();
        appendEmpty($('#section-id'));
        if(id)
        {
            $.post(URL2,{student_class_id: class_id, stream_id: id},function(result){
                var response = JSON.parse(JSON.stringify(result));
                if(response.success)
                {
                    $.each(response.response, function(key,value) {
                        var o = $('<option/>', {value: key, text: value});
                        $('#section-id').append(o);
                    });
                }
            });
        }
    });
});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>