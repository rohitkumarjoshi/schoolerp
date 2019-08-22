<?= $this->Html->css('/assets/plugins/iCheck/all.css',['block'=>'icheckcss']) ?>
<?= $this->Html->script('/assets/plugins/iCheck/icheck.min.js',['block'=>'icheckjs']) ?>
<?php
$js="
$(document).ready(function(){

	 $('input[type=checkbox], input[type=radio]').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>