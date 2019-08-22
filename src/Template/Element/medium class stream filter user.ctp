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
        var URL = '".$this->Url->build(['controller'=>'StudentHealths','action'=>'getClasses.json'])."';

        $('#student-class-id').empty();
        $('#student-class-id').select2();

        $.post(URL,{medium_id: $(this).val()},function(result){
            var response = JSON.parse(JSON.stringify(result));
            if(response.success)
            {
                $.each(response.response, function(key,value) {
                    var o = $('<option/>', {value: key, text: value});
                    $('#student-class-id').append(o);
                }); 
                $('#student-class-id').val($('#student-class-id option:first-child').val()).trigger('change');
                
            }
        });
    });

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