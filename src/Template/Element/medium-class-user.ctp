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
});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>