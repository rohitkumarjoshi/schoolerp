<?= $this->Html->css('/assets/plugins/daterangepicker/daterangepicker-bs3.css',['block'=>'daterangepickercss']) ?>
<?= $this->Html->script('/assets/plugins/daterangepicker/daterangepicker.js',['block'=>'daterangepickerjs']) ?>
<?php 
$js="
$(document).ready(function(){
	 $('.daterangepicker').daterangepicker();
	 $('.daterangepickermin').daterangepicker({
	   	minDate:moment().startOf('day')
	});
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>