 <?php// pr($hostelStudentAsset);exit;?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label >  Return Assets of <?= $hostelStudentAsset[0]->student->name ?> </label>
                </div>
                <br>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($hostelStudentAsset,['id'=>'ServiceForm']) ?>
                        
                        <table class="table" width="100%" id="mainTable">
                           <thead style="background-color: #21898e;color: #f1f2f3;">
                                <tr >
                                    <th style="text-align: center;">Check For Return</th>
                                    <th >Asset Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=0;
                                foreach($hostelStudentAsset as $StudentAsset) { 
                                    $quantity=0;
                                    if(!empty($StudentAsset->hostel_student_asset_returns))
                                    {
                                        foreach ($StudentAsset->hostel_student_asset_returns as $hostel_student_asset_return) {
                                            $quantity+=$hostel_student_asset_return->quantity;
                                        }
                                        
                                    }
                                    $quantity=$StudentAsset->quantity-$quantity;
                                    if($quantity>0)
                                    { $i++;
                                        ?>
                                    <tr>
                                        <td width="10%">
                                             <center>
                                                <?php echo $this->Form->checkbox('return_check[]', ['hiddenField' => false,'class'=>'check_box']); ?>
                                            </center>
                                        </td>
                                        <td width="30%"> 
                                            <?php echo $this->Form->control('hostel_room_asset_id1[]',[
                                            'label' => false,'class'=>'form-control assets','type'=>'text','value'=>$StudentAsset->hostel_room_asset->name,'disabled'=>true]);?>
                                            <?php echo $this->Form->hidden('hostel_room_asset_id[]',['value'=>$StudentAsset->hostel_room_asset_id,'disabled'=>true]);?>
                                            <?php echo $this->Form->hidden('student_id[]',['value'=>$StudentAsset->student_id,'disabled'=>true]);?>
                                        </td>
                                        <td width="10%">
                                            
                                            <?php echo $this->Form->control('quantity[]',[
                                            'label' => false,'class'=>'form-control quantity','placeholder'=>'Enter quantity','type'=>'text','value'=>$quantity,'disabled'=>true,'max'=>$quantity,'min'=>1,'id'=>'quantity'.$i]);?>
                                        </td>
                                        
                                    </tr>
                                <?php 
                                }
                            } ?>
                            </tbody>
                        </table>
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
                         <?= $this->Form->unlockField('hostel_room_asset_id'); ?>
                    <?= $this->Form->unlockField('quantity') ;?>
                    <?= $this->Form->unlockField('hostel_room_asset_id1') ;?>
                    <?= $this->Form->unlockField('student_id') ;?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->element('validate') ?> 
<?= $this->element('selectpicker') ?> 
<?php
$js="
$(document).ready(function(){
    $(document).on('change','.check_box',function(e){
        if($(this).is(':checked'))
        {
            $(this).closest('tr').find('input[type=text]').prop('disabled',false);
             $(this).closest('tr').find('input[type=hidden]').prop('disabled',false);
        }
        else
        {
             $(this).closest('tr').find('input[type=text]').prop('disabled',true);
             $(this).closest('tr').find('input[type=hidden]').prop('disabled',true);
        }
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
