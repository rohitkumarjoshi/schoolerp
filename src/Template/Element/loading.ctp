<?php
$js="

$(document).ready(function(){
    var progressTimer;  
    $(document).ajaxStart(function () {
         $('#loading').show();
        clearTimeout(progressTimer);
    }).ajaxStop(function () {
        progressTimer = setTimeout(function () {
             $('#loading').hide();
        }, 10)
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>