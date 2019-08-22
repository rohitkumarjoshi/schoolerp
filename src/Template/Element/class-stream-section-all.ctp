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
        var URL = '".$this->Url->build(['controller'=>'ClassMappings','action'=>'getStreams.json'])."';
        var URL2 = '".$this->Url->build(['controller'=>'ClassMappings','action'=>'getSections.json'])."';
        var id = $(this).val();

        $('#stream-id').empty();
        $('#stream-id').select2();
        appendEmpty($('#stream-id'));

        $('#section-id').empty();
        $('#section-id').select2();
        appendEmpty($('#section-id'));
        
        if(id)
        {
            $.post(URL,{student_class_id: id},function(result){
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
                    $.post(URL2,{student_class_id: id},function(result){
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
        }
    });
});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>