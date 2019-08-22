<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                    <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Issue Allocation </label>
                <?php }else{ ?>
                    <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label>   Assets Allocation </label>
                <?php } ?>
            </div><hr>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($hostelStudentAsset,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <!-- <div class="col-md-2">
                            <label class="control-label"> Student <span class="required" aria-required="true"> * </span></label>
                        </div> -->
                        <div class="col-md-4">
                           <?= $this->Form->control('student_id', ['options'=>$students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%'])?>
                        </div>
                    </div><br>
                    <table class="table" width="100%" id="mainTable">
                       <thead style="background-color: #21898e;color: #f1f2f3;">
                            <tr>
                                <th>Asset Name</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="50%"> <?= $this->Form->control('hostel_room_asset_id[]', ['options'=>$hostelRoomAssets,'label' => false, 'class'=>'select2','empty'=>'Select Asset','style'=>'width:100%'])?>
                                </td>
                                <td width="30%">
                                    <?php echo $this->Form->control('quantity[]',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter quantity','type'=>'text']);?>
                                </td>
                                <td width="20%">
                                     <center>
                                        <?= $this->Form->button(__('+'),['class'=>'btn btn-md btn-primary','id'=>'addRow','type'=>'button']) ?>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if(!empty($id)){ ?>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Status </label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <span class="help-block"></span>
                    <div class="box-footer">
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-6">  
                                        <?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','id'=>'submit_member']); ?>
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
<table id="addRowContain" style="display: none;">
    <tbody>
        <tr>
           <td width="50%"> 
            <?= $this->Form->control('hostel_room_asset_id[]', ['options'=>$hostelRoomAssets,'label' => false, 'class'=>'selectadd','empty'=>'Select Asset','style'=>'width:100%'])?>
                </td>
                <td width="30%">
                    <?php echo $this->Form->control('quantity[]',[
                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter quantity','type'=>'text']);?>
                </td>
                <td width="20%">
                     <center>
                        <?= $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger DeleteRow','type'=>'button']) ?>
                    </center>
                </td>
        </tr>
    </tbody>
</table>
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    function rename()
    {
        $('#mainTable >tbody').find('tr').each(function(){
                $(this).find('select.selectadd').select2();
            });
      }
     $(document).on('click','.DeleteRow',function(){
        $(this).closest('tr').remove();
    });
    $(document).on('click','#addRow',function(){
        var addRowContain = $('#addRowContain >tbody').html();
        $('#mainTable >tbody').append(addRowContain);
        rename();
        });

    $('#ServiceForm').validate({ 
        rules: {
            name: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 