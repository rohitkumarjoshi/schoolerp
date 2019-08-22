<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label >  Edit Assets  </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($hostelStudentAsset,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label" style="padding: 10px;"> Student </label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <?= $this->Form->control('student_id', ['options'=>$students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%','value'=>$id])?>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label" style="padding: 10px;"> Status </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                                    </div>
                                </div>
                            </div>  
                        </div>
                         
                    </div><br>
                    <table class="table" width="100%" id="mainTable">
                       <thead style="background-color: #21898e;color: #f1f2f3;">
                            <tr >
                                <th style="text-align: center;">Check For Return</th>
                                <th >Asset Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($hostelStudentAsset as $StudentAsset) { ?>
                            <tr>
                                <td width="30%"> 
                                      <?php echo $this->Form->control('hostel_room_asset_id1[]',[
                                    'label' => false,'class'=>'form-control ','type'=>'text','value'=>$StudentAsset->hostel_room_asset->name,'readonly'=>'readonly','required'=>true]);?>
                                    <?php echo $this->Form->hidden('id[]',['value'=>$StudentAsset->id]);?>
                                    <?php echo $this->Form->hidden('hostel_room_asset_id[]',['value'=>$StudentAsset->hostel_room_asset_id]);?>

                                </td>
                                <td width="10%">
                                    <?php echo $this->Form->control('quantity[]',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter quantity','type'=>'text','value'=>$StudentAsset->quantity,'required'=>true]);?>
                                </td>
                                 <td width="10%">
                                     <center>
                                            <?= $this->Form->button(__('+'),['class'=>'btn btn-md btn-primary','id'=>'addRow','type'=>'button']) ?> 
                                           
                                    </center>
                                </td>
                                
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?= $this->Form->unlockField('hostel_room_asset_id'); ?>
                    <?= $this->Form->unlockField('id') ;?>
                    <br>
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
                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter quantity','type'=>'text','required'=>true]);?>
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