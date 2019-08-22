<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <?= $this->Form->create($inward,['id'=>'ServiceForm']) ?>
            <div class="box-header with-border" >
               <label> Edit Inward  </label>
                 <div class="box-header pull-right"> 
                     <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> Inward Status :</label>
                            <label class="radio-inline" >
                                <input type="radio" id="inward_in" value="In" name="inward_status" checked > Inward In
                            </label>
                            <label class="radio-inline" >
                                 <input type="radio" id="inward_out" value="Out" name="inward_status"> Inward Out 
                            </label>
                            <?= $this->Form->unlockField('inward_status') ?>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="box-body">
                <div class="form-group inward_in">    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label">Bill No / Chalan No <span class="required" aria-required="true"> * </span></label>
                                       <?= $this->Form->control('bill_no', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Bill Number','required'=>true])?>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"> Person Name <span class="required" aria-required="true"> * </span></label>
                                       <?= $this->Form->control('person_name',array('class'=>'form-control','label'=>false,'placeholder'=>'Enter Person Name','oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');",'required'=>true)) ?>
                                    </div>
                                </div> 
                            </div> 
                              <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"> Mobile Number <span class="required" aria-required="true"> * </span></label>
                                      <?= $this->Form->control('mobile_no', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Mobile Number','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'maxlength'=>'10','minlength'=>'10','required'=>true])?>
                                    </div>
                                </div> 
                            </div> 
                        </div> 
                         <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"> Party Name <span class="required" aria-required="true"> * </span></label>
                                        <?= $this->Form->control('party_name', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Party Name','required'=>true])?>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"> Party Address <span class="required" aria-required="true"> * </span></label>
                                        <?= $this->Form->control('party_address', ['label' => false, 'class'=>'form-control ','type'=>'text','placeholder'=>'Enter Party Address
                                        ','required'=>true])?>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"> Department <span class="required" aria-required="true"> * </span></label>
                                        <?= $this->Form->control('department_id',array('options' => $departments,'class'=>'select2','label'=>false,'style'=>'width:100%','empty'=>'Select Department','required'=>true)) ?>
                                    </div>
                                </div> 
                            </div> 
                         </div> 
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"> Remarks</label>
                                        <?= $this->Form->control('remarks', ['label' => false, 'class'=>'form-control ','type'=>'textarea','placeholder'=>'Enter Remarks','rows'=>'5','style'=>'resize:none;'])?>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label"> Item Description</label>
                                        <?= $this->Form->control('item_description', ['label' => false, 'class'=>'form-control ','type'=>'textarea','placeholder'=>'Enter Item Description','rows'=>'5','style'=>'resize:none;'])?>
                                    </div>
                                </div> 
                            </div> 
                        </div> 
                        
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
               </div>
               <?= $this->Form->end() ?> 
            </div>
        </div>
    </div>
</div>
<?= $this->element('validate') ?> 
<?= $this->element('selectpicker') ?>     
<?= $this->element('icheck') ?>     


<?php
$js="
$(document).ready(function(){
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



