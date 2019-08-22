
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > Gallery </label>
            </div>
            <div class="box-body">
                <div class="form-group">                       

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab">
                            Event/News Gallery </a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab">
                            New Gallery </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_1_1">
                            <?= $this->Form->create($gallery,['id'=>'ServiceForms','type'=>'file']) ?>
                            <div class="row" style="padding-top:10px">
                                <div class="col-md-6">
                                    <label class="control-label"> Select Role <span class="required" aria-required="true"> * </span></label>
                                    <?php $type['Event']='Event';?>
                                    <?php $type['News']='News';?>
                                    <?php echo $this->Form->control('type',[
                                    'label' => false,'class'=>'form-control type','empty'=>'Select...','options' => $type,'required'=>true]);?>
                                </div> 
                                <div class="col-md-6 event">
                                    <label class="control-label"> Events <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('event_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $events,'required'=>true]);?>
                                </div>
                                <div class="col-md-6 news">
                                    <label class="control-label"> News <span class="required" aria-required="true"> * </span></label>
                                    <?php echo $this->Form->control('news_id',[
                                    'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $news,'required'=>true]);?>
                                </div>
                            </div>
                            <div class="row">
                                <fieldset><legend>Images</legend>
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
                                        'label' => false,'class'=>' eventImage','placeholder'=>'Name','type'=>'file','required']);?>
                                            </td>
                                            <td>
                                                <button type="button" onClick="add_row2()" class="btn btn-primary btn-sm addrow"><i class="fa fa-plus"></i></button>
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
                                                <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member','name'=>'oldGallery']); ?>
                                            </div>
                                        </div>
                                    </center>       
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="tab-pane fade" id="tab_1_2">
                            <?= $this->Form->create($gallery,['id'=>'ServiceForm','type'=>'file']) ?>
                                <div class="row" style="padding-top:10px">
                                    <div class="col-md-3">
                                        <label class="control-label"> Title <span class="required" aria-required="true"> * </span></label>
                                        <?php echo $this->Form->control('title',[
                                        'label' => false,'class'=>'form-control','placeholder'=>'Title','type'=>'text','required']);?>
                                    </div> 
                                    <div class="col-md-4">
                                        <label class="control-label"> Description </label>
                                        <?php echo $this->Form->control('description',[
                                        'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>1]);?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label"> Featured Image <span class="required" aria-required="true"> * </span></label>
                                        <?php echo $this->Form->control('cover_image',[
                                        'label' => false,'class'=>'','placeholder'=>'Date','type'=>'file','required']);?>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <label class="control-label"> Shareable</label>
                                         <?= $this->Form->control('shareable', ['type' => 'checkbox','label'=>false,'class'=>'checkDisable','value'=>1])?>
                                    </div>
                                </div>

                                <div class="row">
                                    <fieldset><legend>Images</legend>
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
                                            'label' => false,'class'=>' eventImage','placeholder'=>'Name','type'=>'file','required']);?>
                                                </td>
                                                <td>
                                                    <button type="button" onClick="add_row2()" class="btn btn-primary btn-sm addrow"><i class="fa fa-plus"></i></button>
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
                                                    <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member','name'=>'newGallery']); ?>
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
    </div>
</div>

<table id="sample2" style="display:none;">
    <tbody>
        <tr>
        <td><?php echo $this->Form->control('eventImage[]',[
                                'label' => false,'class'=>' eventImage','placeholder'=>'Name','type'=>'file']);?>
        </td>
        <td>
            <button type="button" onClick="add_row2()" class="btn btn-primary btn-sm addrow"><i class="fa fa-plus"></i></button>
        </td>
        <td>
            <button type="button"  class="btn btn-danger btn-sm remove_row2"><i class="fa fa-trash-o"></i></button>
        </td>
        </tr>
    </tbody> 
</table>

<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('timepicker') ?> 
<?= $this->element('icheck') ?> 
<?php
$js='
$(document).ready(function() { 
    $(".event").hide();
    $(".news").hide(); 
    $(document).on("change", ".type", function(){
        var isSelected = $(this).val();
        if(isSelected=="Event"){
            $(".event").show();
            $(".news").hide();
        }
        else if(isSelected == "News"){
            $(".event").hide();
            $(".news").show();
        }
        else{
            $(".event").hide();
            $(".news").hide(); 
        }
    });
     
    $(document).on("click", ".remove_row2", function(){
        $(this).closest("#parant_table2 tr").remove();
    });

    $(document).on("click", ".addrow", function(){
        var new_line=$("#sample2 tbody").html();
        $(this).closest("form").find("#parant_table2 tbody.parant_table2").append(new_line); 
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
    $("#ServiceForms").validate({ 
        rules: {
            description: {
                required: true
            },
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
    
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
 