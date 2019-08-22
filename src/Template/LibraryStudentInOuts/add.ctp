<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                    <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label> Student In Out </label>
            </div>
            <div class="box-body">
                <div class="form-group">  
                    <div class="row">
                        <?= $this->Form->create($libraryStudentInOut,['id'=>'inout','autocomplete'=>'off'])?>
                            <div class="col-sm-4 col-sm-offset-4">
                                <?=$this->Form->control('student_id',['class'=>'form-control','placeholder'=>'Student ID','label'=>false,'type'=>'text','required'])?>
                                <label class="control-label"></label>
                            </div>
                        <?=$this->Form->end()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

$js ="
    $(document).ready(function() {
        $('#student-id').focus();

        $(document).on('submit','#ServiceForm', function( event ) {
            if(!($(\"input[name='book_id[]']\").length > 0))
            {
                alert('Please scan or enter atleast one barode.');
                event.preventDefault();
            }
        });

        $(document).on('submit','#inout', function( event ) { 
            event.preventDefault();

            if($('#student-id').hasClass('processing'))
                    return;
                    
            $('#student-id').addClass('processing');

            var check = true;

            if(check)
            {
                url = $(this).attr('action')+'.json';
                $.post(url, $(this).serialize(), function(result) {
                    $('#student-id').removeClass('processing');
                    $('#student-id').val('');
                    var obj = JSON.parse(JSON.stringify(result));
                    
                    if(obj.success == 1)
                        toastr.success(obj.response);
                    else
                        toastr.error(obj.response);
                });
            }
        });
    });
";
$this->Html->scriptBlock($js, ['block' => 'scriptPageBottom']);
?>
