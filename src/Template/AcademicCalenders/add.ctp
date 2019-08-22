
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > Academic Calendar </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($academicCalender,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-5">
                                <label class="control-label"> Select Category <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('academic_category_id',[
                                'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $academicCategories,'required'=>true]);?>
                            </div>


                        </div>
                        <span class="help-block"></span>

                        <div class="newRow">
                            <div class="row oneRow">
                                <div class="col-md-5">
                                    <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('date[]',[
                                    'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required','value'=>date('d-m-Y')]);?>
                                </div>
                                <div class="col-md-5">
                                    <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('description[]',[
                                    'label' => false,'class'=>'form-control des','placeholder'=>'Description','type'=>'text','required']);?>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label" style="visibility:hidden"> Descrdasdasdsaiption <span class="required" aria-required="true"> * </span></label>
                                    <button type="button" onClick="add_row()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                    <button type="button"  class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                                        </div>
                                    </div>
                                </center>       
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dummeyRow" style="display:none">
    <div class="row oneRow">
        <div class="col-md-5">
            <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
            <?php echo $this->Form->control('date[]',[
            'label' => false,'class'=>'form-control datepicker date','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy']);?>
        </div>
        <div class="col-md-5">
            <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
            <?php echo $this->Form->control('description[]',[
            'label' => false,'class'=>'form-control des','placeholder'=>'Description','type'=>'text']);?>
        </div>
        <div class="col-md-2">
            <label class="control-label" style="visibility:hidden"> Descrdasdasdsaiption <span class="required" aria-required="true"> * </span></label>
            <button type="button" onClick="add_row()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
            <button type="button"  class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o"></i></button>
        </div>
    </div>
</div>
<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?> 
<?php
$js='
$(document).ready(function() {

    // validate signup form on keyup and submit
     $("#ServiceForm").validate({ 
        rules: { 
            academic_category_id: {
                required: true
            } 
        },
        submitHandler: function () {
            $("#submit_member").attr("disabled","disabled");
            form.submit();
        }
    }); 
    $(document).on("click", ".remove_row", function(){
        var LengthRow = $(".oneRow").length;
        if(LengthRow>2){
            $(this).closest(".oneRow").remove();
        }
    });

});
function add_row(){  
    var new_line=$(".dummeyRow").html(); 
    $(".newRow").append(new_line); 
    $(".datepicker").datepicker();  
}  
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
 