<?= $this->Html->css('/assets/css/timepicker/bootstrap-timepicker.min.css',['block'=>'timepickercss']) ?>
<?= $this->Html->script('/assets/plugins/timepicker/bootstrap-timepicker.min.js',['block'=>'timepickerjs']) ?>
<?php
$js="
$(document).ready(function(){

	$('.timepicker').timepicker({
      showInputs: false
    });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>