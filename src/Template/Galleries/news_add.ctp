
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > News Add</label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($gallery,['id'=>'ServiceForm','type'=>'file']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Select Role <span class="required" aria-required="true"> * </span></label>
                                <?php $type['All']='All';?>
                                <?php $type['Teacher']='Teacher';?>
                                <?php $type['Student']='Student';?>
                                <?php echo $this->Form->control('role_type',[
                                'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $type,'required'=>true]);?>
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label"> Title <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('title',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Title','type'=>'text','required']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('date_from',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required']);?>
                            </div>  
                        </div>
                        
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Featured Image <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('cover_image',[
                                'label' => false,'class'=>'','placeholder'=>'Date','type'=>'file','required']);?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Description </label>
                                <?php echo $this->Form->control('description',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>1,'required']);?>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label"> Shareable</label>
                                 <?= $this->Form->control('shareable', ['type' => 'checkbox','label'=>false,'class'=>'checkDisable','value'=>1])?>
                            </div>
                        </div>
                        

                        <div class="row">
                            <fieldset><legend>News Images</legend>
                                <center>                        
                                <table style="width:50%;align:center" class="table table-bordered table-hover" id="parant_table2" >
                                    <thead>
                                        <tr style="background-color:#8a8a8a2e;">    
                                            <th style="text-align:center"> Image</th> 
                                            <th colspan="2" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="parant_table2">
                                    <tr>
                                        <td>
                                            <?php echo $this->Form->control('eventImage[]',[
                                    'label' => false,'class'=>' eventImage','placeholder'=>'Name','type'=>'file']);?>
                                        </td>
                                        <td>
                                            <button type="button" onClick="add_row2()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </center>
                            </fieldset>
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

<table id="sample2" style="display:none;">
    <tbody>
        <tr>
        <td><?php echo $this->Form->control('eventImage[]',[
                                'label' => false,'class'=>' eventImage','placeholder'=>'Name','type'=>'file']);?>
        </td>
        <td>
            <button type="button" onClick="add_row2()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
        </td>
        <td>
            <button type="button"  class="btn btn-danger btn-sm remove_row2"><i class="fa fa-trash-o"></i></button>
        </td>
        </tr>
    </tbody> 
</table>

<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?>  
<?= $this->element('icheck') ?> 
<?php
$js='
$(document).ready(function() { 
     
     
    $(document).on("click", ".remove_row2", function(){
        $(this).closest("#parant_table2 tr").remove();
    });

    // validate signup form on keyup and submit
     $("#ServiceForm").validate({ 
        rules: { 
            academic_category_id: {
                required: true
            },
            date: {
                required: true
            }
        },
        submitHandler: function () {
            $("#submit_member").attr("disabled","disabled");
            form.submit();
        }
    }); 
});

function add_row2(){  
    var new_line=$("#sample2 tbody").html();
    $("#parant_table2 tbody.parant_table2").append(new_line); 
    remaneRows2();
} 
    
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
 