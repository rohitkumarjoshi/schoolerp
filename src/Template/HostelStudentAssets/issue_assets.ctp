
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                         <label > Edit Issue Allocation </label>
                    <?php }else{ ?>
                        <label>   Assets Allocation </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($hostelStudentAsset,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <!-- <div class="col-md-2">
                                <label class="control-label"> Student <span class="required" aria-required="true"> * </span></label>
                            </div> -->
                            <div class="col-md-4">
                               <?= $this->Form->control('student_id', ['options'=>$students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%','required'])?>
                            </div>
                        </div><br>
                        <center>
                        <table class="table" id="mainTable" style="width: 50%;">
                           <thead style="background-color: #21898e;color: #f1f2f3;">
                                <tr>
                                    <th>Asset Name</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($hostelRoomAssets as $hostelRoomAsset) { ?>
                                <tr>
                                    <td width="50%"> 
                                        <label><?= $hostelRoomAsset->name.'('.$hostelRoomAsset->item_code.')';?></label>
                                    <?php echo $this->Form->hidden('hostel_room_asset_id[]',[
                                        'value'=>$hostelRoomAsset->id,'required'=>true]);?>
                                    </td>
                                    <td width="30%">
                                        <?php echo $this->Form->control('quantity[]',[
                                        'label' => false,'class'=>'form-control ','placeholder'=>'Enter quantity','type'=>'text','value'=>1,'required'=>true]);?>
                                    </td>
                                    <td width="20%">
                                         <center>
                                            <?= $this->Form->button(__('+'),['class'=>'btn btn-md btn-primary','id'=>'addRow','type'=>'button']) ?>
                                            <?= $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger DeleteRow','type'=>'button']) ?>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </center>
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
                                            <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                                        </div>
                                    </div>
                                </center>       
                            </div>
                        </div>
                        <?= $this->Form->unlockField('hostel_room_asset_id') ;?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <table id="addRowContain" style="display: none;">
            <tbody>
                 <tr>
                   <td width="50%"> 
                    <?= $this->Form->control('hostel_room_asset_id[]', ['options'=>$default_data_no,'label' => false, 'class'=>'selectadd','empty'=>'Select Asset','style'=>'width:100%','required'=>true])?>
                        </td>
                        <td width="30%">
                            <?php echo $this->Form->control('quantity[]',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Enter quantity','type'=>'text','value'=>1,'required'=>true]);?>
                        </td>
                        <td width="20%">
                             <center>
                                <?= $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger DeleteRow','type'=>'button']) ?>
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>

<?php
$js="
$(document).ready(function(){
     $(document).on('click','.DeleteRow',function(){
        $(this).closest('tr').remove();
    });
    $(document).on('click','#addRow',function(){
        var addRowContain = $('#addRowContain >tbody').html();
        $('#mainTable >tbody').append(addRowContain);
        rename_rows();
    });
    /*$('#ServiceForm').validate({ 
        rules: {
            student_id: {
                required: true
            },
            'hostel_room_asset_id[]': {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            $('#ServiceForm').submit();
        }
    });*/
    rename_rows();
    function rename_rows(){  
        var i=0;
        $('#mainTable tbody tr').each(function()
        { 
            $(this).find('td:nth-child(1) input').attr({id:'hostel_room_asset_id['+i+']'});
            $(this).find('td:nth-child(1) select').attr({id:'hostel_room_asset_id['+i+']'});
            $(this).find('td:nth-child(2) input').attr({id:'quantity['+i+']'});
            $(this).find('td:nth-child(1) select.selectadd').select2();
            i++;
         });
     }

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 