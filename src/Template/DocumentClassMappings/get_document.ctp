<?php
foreach ($documentClassMappings as $documentClassMapping) {
	?>
	<div class="col-md-3">                     
		<div class="form-group">
			<label style="margin-top:5px;"><?= $documentClassMapping->document->document_name ?></label>
			<?= $this->Form->hidden('document_class_mapping[]',['value'=>$documentClassMapping->id,'label'=>false]); ?>
			<?= $this->Form->control('document[]', ['label' => false, 'type'=>'file','autocomplete'=>'false','id'=>'document_0', 'accept'=>'image/jpeg,image/jpeg'])?>
		</div>
	</div>
	<?php
}
?>