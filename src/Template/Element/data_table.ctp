
<?= $this->Html->script('/assets/plugins/data-tables/jquery.dataTables.min.js',['block'=>'dataTablesjs']) ?>
<?= $this->Html->script('/assets/plugins/data-tables/DT-bootstrap.js',['block'=>'dataTablesjs']) ?>
<?= $this->Html->script('/assets/plugins/data-tables/table-advanced.js',['block'=>'dataTablesjs']) ?>
<?php
$js="
$(document).ready(function(){
TableAdvanced.init();
	

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>