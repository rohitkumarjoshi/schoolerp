<?= $this->element('student_search') ?> 
<?= $this->element('selectpicker') ?> 
<?php
$js="
$(document).ready(function(){
    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms, 1 second for example
    $(document).on('keyup','input.student_search',function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchData, doneTypingInterval);
    });
    $(document).on('change','select.student_search',function(){
        
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchData, doneTypingInterval);
    });
    function fetchData()
    {
        url = '".$this->Url->build(['action'=>'getStudentData1.json'])."';
        $.ajax({
            url: url,
            type: 'post',
            data: $('form').serialize(),
            contentType: 'application/x-www-form-urlencoded',
            success: function(result)
            {
                var obj = JSON.parse(JSON.stringify(result));
                $('#replace_data').html(obj.response);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
               $('#replace_data').html(textStatus);
            }
        }); 
    }
        

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>