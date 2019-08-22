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
        var URL = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getSections.json'])."';
        var class_id = $('#student-class-id').val();
        var id = $(this).val();
        
        $('#section-id').empty();
        $('#section-id').select2();

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
                    $('#section-id').val($('#section-id option:first-child').val()).trigger('change');
                }
            });
        }
    });
});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>