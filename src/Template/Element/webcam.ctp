<?= $this->Html->script('/js/webcam.min.js',['block'=>'webcamjs']) ?>
<?php
$js="
$(document).ready(function(){
	Webcam.set({
			width: 200,
			height: 200,
			image_format: 'jpeg',
			jpeg_quality: 90,
			flip_horiz: true
		});
		Webcam.attach('#my_camera');
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>