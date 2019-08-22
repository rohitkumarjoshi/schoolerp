<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title" >Search Student</h3>
        <div class="box-tools pull-right">
          <?= $this->Html->link('Direct Admission Form',['controller'=>'FeeReceipts','action'=>'formFee']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
           <div class="box-body table-responsive" >
                <?= $this->element('form_fee_search') ?> 
            </div>
        </div>
    </div>
</div>
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
       url = '".$this->Url->build(['action'=>'getEnquiryData.json'])."';
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