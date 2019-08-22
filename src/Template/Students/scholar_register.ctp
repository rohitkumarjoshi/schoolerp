<style type="text/css">
.nav-tabs-custom {
box-shadow: none !important;
}
.nav-tabs-custom > .nav-tabs > li {
    margin-bottom: -1px !important;
 }
 .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border: 1px solid #a8a1a133;
}

</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Scholar Register</label>
            </div>
            <div class="box-body">
        		<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active" >
							<a href="#tab_1_1" data-toggle="tab" aria-expanded="true">Student Wise</a>
						</li>
						<li class="">
							<a href="#tab_1_2" data-toggle="tab">Admission Date Wise</a>
						</li>
					</ul>
        		</div>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="tab_1_1">
						<?= $this->element('student_search') ?> 
					</div>
					<div class="tab-pane fade" id="tab_1_2">
                        <?= $this->Form->create('',['url'=>['controller'=>'Students','action'=>'scholarRegisterView'],'target'=>'_blank']) ?>
						<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'required'=>true,'placeholder'=>'Date range']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                        <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('daterangepicker') ?>
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
       url = '".$this->Url->build(['action'=>'getStudentScholarRegister.json'])."';
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