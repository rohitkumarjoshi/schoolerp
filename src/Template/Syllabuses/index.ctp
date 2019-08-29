<?php $cdn_path = $awsFileLoad->cdnPath(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                     <label> Add Syllabus </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($syllabus,['id'=>'ServiceForm','type'=>'file']) ?>
                    <div class="newRow">
                        <div class="row oneRow">
                           <div class="col-md-4">
                                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('faculty_class_mapping_id[]', ['empty'=>'--- Select---','options' => $option,'class'=>'select2 classMapping','style'=>'width:100%','label'=>false,'required']);?>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label"> Section</label>
                                <?php $i=0;echo $this->Form->control('section_id'.$i,[
                                'label' => false,'class'=>'select2 section','empty'=>'---Select Section---','options'=>$sections,'id'=>'section_id','multiple'=>true,'style'=>'width:100%']);$i++;?>
                            </div>
                            <div>
                            </div>
                            <?php echo $this->Form->control('medium_id[]',['label' => false,'class'=>'medium_id','type'=>'hidden']);?>
                            <?php echo $this->Form->control('student_class_id[]',['label' => false,'class'=>'student_class_id','type'=>'hidden']);?>
                            <?php echo $this->Form->control('stream_id[]',['label' => false,'class'=>'stream_id','type'=>'hidden']);?>
                           <!--  <?php echo $this->Form->control('section_id[]',['label' => false,'class'=>'section_id','type'=>'hidden']);?> -->
                            <?php echo $this->Form->control('subject_id[]',['label' => false,'class'=>'subject_id','type'=>'hidden']);?>

                            <div class="col-md-4">
                                 <label class="control-label"> Upload <span class="required" aria-required="true"> * </span></label>
                               <?php echo $this->Form->control('file_path[]',[
                                    'label' => false,'class'=>'form-control','type'=>'file','required']);?>
                            </div> 
                            <div class="col-md-2">
                                <label class="control-label" style="visibility:hidden"> Descrdasdasdsaiption <span class="required" aria-required="true"> * </span></label>
                                    <button type="button" class="btn btn-primary btn-sm add_row"><i class="fa fa-plus"></i></button>
                                    <button type="button"  class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o"></i></button>
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
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dummeyRow" style="display:none">
        <div class="row oneRow">
            <div class="col-md-4">
                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                
                    <?php echo $this->Form->control('faculty_class_mapping_id[]', ['empty'=>'--- Select---','options' => $option,'class'=>' classMapping','style'=>'width:100%','label'=>false,'required']);?>
            </div>


            <?php echo $this->Form->control('medium_id[]',['label' => false,'class'=>'medium_id','type'=>'hidden']);?>
            <?php echo $this->Form->control('student_class_id[]',['label' => false,'class'=>'student_class_id','type'=>'hidden']);?>
            <?php echo $this->Form->control('stream_id[]',['label' => false,'class'=>'stream_id','type'=>'hidden']);?>
           <!--  <?php echo $this->Form->control('section_id[]',['label' => false,'class'=>'section_id','type'=>'hidden']);?> -->
            <?php echo $this->Form->control('subject_id[]',['label' => false,'class'=>'subject_id','type'=>'hidden']);?>
            <div class="col-md-2">
                                <label class="control-label"> Section</label>
                                <?php echo $this->Form->control('section_id'.$i,[
                                'label' => false,'class'=>'section','empty'=>'---Select Section---','options'=>$sections,'id'=>'section_id','multiple'=>true,'style'=>'width:100%']);$i++;?>
                            </div>
            <div class="col-md-4">
                <label class="control-label"> Upload <span class="required" aria-required="true"> * </span></label>
               <?php echo $this->Form->control('file_path[]',[
                    'label' => false,'class'=>'form-control','type'=>'file','required']);?>
            </div> 
            <div class="col-md-2">
                <label class="control-label" style="visibility:hidden"> Descrdasdasdsaiption <span class="required" aria-required="true"> * </span></label>
                    <button type="button" class="btn btn-primary btn-sm add_row"><i class="fa fa-plus"></i></button>
                    <button type="button"  class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o"></i></button>
            </div>

        </div>
    </div>


<?php $this->element('selectpicker') ?>  
<?= $this->element('validate') ?> 
<?= $this->Html->script('/assets/js/plugins/fileinput/fileinput.min.js',['block'=>'fileinputjs']) ?>
<?php
$js="
$(document).ready(function(){
    $('.stdcheck').hide();
    $('.upload_doc').fileinput({
        showUpload: false,
        showCaption: false,
        showCancel: false,
        browseClass: 'btn btn-success btn-md',
        allowedFileExtensions: ['pdf'],
        maxFileSize: 1024,
    });
   

$(document).on('change','.classMapping',function(){
    var mid =$('option:selected',this).attr('mid');
    var cid =$('option:selected',this).attr('cid');
    var stid =$('option:selected',this).attr('stid');
    // var scid =$('option:selected',this).attr('scid');
    var subid =$('option:selected',this).attr('subid');

    $(this).closest('div.oneRow').find('.medium_id').val(mid);
    $(this).closest('div.oneRow').find('.student_class_id').val(cid);
    $(this).closest('div.oneRow').find('.stream_id').val(stid);
    // $(this).closest('div.oneRow').find('.section_id').val(scid);
    $(this).closest('div.oneRow').find('.subject_id').val(subid);

}); 

   
    
    $('#ServiceForm').validate({ 
        rules: {
            
            medium_id: {
                required: true
            },
            student_class_id: {
                required: true
            }, 
            subject_id: {
                required: true
            },
            file_path:{
                required: true
            },
        
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
    $(document).on('click', '.remove_row', function(){
       var LengthRow = $('.oneRow').length;
       if(LengthRow>2){
        $(this).closest('.oneRow').remove();
       }
    });

    $(document).on('click', '.add_row', function(){
       var new_line=$('.dummeyRow').html(); 
        $('.newRow').append(new_line);  
        rename();
    });

}); 
function rename()
{
    $('.newRow').each(function(){
        $(this).find('select.classMapping').select2();
        $(this).find('select.section').select2();
    });
}
";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>
