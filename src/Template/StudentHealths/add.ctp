<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                    <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Class Mapping </label>
                <?php }else{ ?>
                    <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Add Class Mapping </label>
                <?php } ?>
            </div>
            <?= $this->Form->create($studentHealth,['id'=>'ServiceForm']) ?>
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                        
                            <?php echo $this->Form->control('class_mapping_id', ['empty'=>'--- Select---','options' => $classMappings,'class'=>'select2','style'=>'width:100%','label'=>false]);?>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"> Heath Master <span class="required" aria-required="true"> * </span></label>
                        
                            <?php echo $this->Form->control('health_master_id', ['empty'=>'--- Select ---','options' => $healthMasters,'class'=>'select2','style'=>'width:100%','label'=>false,'required']);?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <th>Student</th>
                                    <th>Heath Value</th>
                                </thead>
                                <tbody id="main">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
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
<?= $this->element('validate') ?> 
<?= $this->element('selectpicker') ?> 
<?= $this->element('loading') ?> 
<?php
$js="

$(document).ready(function(){

    function appendStudents(class_mapping_id)
    {
        var url = '".$this->Url->build(['action'=>'getStudents.json'])."';
        
        $.post(url,{class_mapping_id: class_mapping_id},function(result){
            var response = JSON.parse(JSON.stringify(result));
            var i = 0;
            $.each(response.response, function(key,value) {
                i++;
                var o = \"<tr><td>\"+value+\"</td><td><input type='hidden' class='health_master' name='data[\"+i+\"][health_master_id]' value = \"+$('#health-master-id').val()+\" ><input type='hidden' name='data[\"+i+\"][student_info_id]' value = \"+key+\" ><input type='text' name='data[\"+i+\"][health_value]' placeholder='Enter Value' class='form-control' required></td></tr>\";
                $('#main').append(o);
            });
        });
    }

    $(document).on('change','#class-mapping-id',function(){
        $('#main').html('');
        appendStudents($(this).val());
    });

    $(document).on('change','#health-master-id',function(){
        $('.health_master').val($(this).val());
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
