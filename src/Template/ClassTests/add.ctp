<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StudentMark $studentMark
 */
?>
<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <label> Class Test</label>
                </div>
                <?= $this->Form->create($classTest,['id'=>'ServiceForm','type'=>'file']) ?>
                <div class="box-body">
                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                            
                                <?php echo $this->Form->control('class', ['empty'=>'--- Select ---','options' => $option,'class'=>'select2 classMapping','style'=>'width:100%','label'=>false,'required']);?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Topic <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('topic',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Topic','type'=>'text','required']);?>
                            </div>
                           
                        </div> 
                        <div class="row">
                             
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Test Date <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('test_date',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Test Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required']);?>
                            </div> 
                            
                           <div class="col-md-6">
                                <label class="control-label"> Max Marks <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('max_marks',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Max Marks','type'=>'text','required','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>  
                        </div>
                        
                    </div>
                </div>
                <?php echo $this->Form->hidden('medium_id',['label' => false,'class'=>'medium_id','type'=>'text','required']);?>
                            <?php echo $this->Form->hidden('student_class_id',['label' => false,'class'=>'student_class_id','type'=>'text','required']);?>
                            <?php echo $this->Form->hidden('stream_id',['label' => false,'class'=>'stream_id','type'=>'text','required']);?>
                            <?php echo $this->Form->hidden('section_id',['label' => false,'class'=>'section_id','type'=>'text','required']);?>
                            <?php echo $this->Form->hidden('subject_id',['label' => false,'class'=>'subject_id','type'=>'text','required']);?>

                <div class="box-footer">
                    <div class="row">
                        <center>
                            <div class="col-md-12">
                                <div class="col-md-offset-3 col-md-6">  
                                    <?php echo $this->Form->button('Submit',['class'=>'btn btn-danger btn-md','id'=>'submit_member','name'=>'submit']); ?>
                                    <?php echo $this->Form->button('Submit and Fill Marks',['class'=>'btn btn-primary btn-md','id'=>'submit_member','name'=>'fill_marks']); ?>
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

 
<?php $this->element('selectpicker') ?> 
<?php $this->element('datepicker') ?> 
<?= $this->element('validate') ?>  
<?php
$js="

$(document).ready(function(){     
    
    $(document).on('change','.classMapping',function(){
        
        var mid =$('option:selected',this).attr('mid');
        var cid =$('option:selected',this).attr('cid');
        var stid =$('option:selected',this).attr('stid');
        var scid =$('option:selected',this).attr('scid');
        var subid =$('option:selected',this).attr('subid'); 

        $('.medium_id').val(mid);
        $('.student_class_id').val(cid);
        $('.stream_id').val(stid);
        $('.section_id').val(scid);
        $('.subject_id').val(subid);
        $('#students').empty();
        url=url+'?student_class_id='+cid+'&medium_id='+mid+'&stream_id='+stid+'&section_id='+scid;
        
    }); 
    
    
    $('#ServiceForm').validate({ 
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
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    }); 

});";
 
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
