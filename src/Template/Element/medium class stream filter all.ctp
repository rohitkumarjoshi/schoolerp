<?php
$js="
$(document).ready(function(){

    function appendEmpty(id)
    {
        var o = $('<option/>', {value: '', text: '--Select--'});
        id.append(o);
        id.trigger('change');
    }

    $(document).on('change','#medium-id',function(){
        var URL = '".$this->Url->build(['controller'=>'ClassMappings','action'=>'getClasses.json'])."';

        $('#student-class-id').empty();
        $('#student-class-id').select2();
        appendEmpty($('#student-class-id'));

        $.post(URL,{medium_id: $(this).val()},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#student-class-id').append(o);
                });
            }
        });
    });

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