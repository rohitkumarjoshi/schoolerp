<?= $this->Html->css('/assets/plugins/select2/select2.css',['block'=>'select2css']) ?>
<?= $this->Html->script('/assets/plugins/select2/select2.js',['block'=>'select2js']) ?>

<?php
$js="
$(document).ready(function(){
	$('.select2').select2();
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>