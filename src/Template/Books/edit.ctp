<style type="text/css">
    .control-label{
        display: block;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                        <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Book </label>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($book,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Book Name <span class="required" aria-required="true"> * </span></label>

                                <?php echo $this->Form->control('name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Author Name </label>

                                <?php echo $this->Form->control('author_name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Author Name','type'=>'text','oninput'=>"this.value = this.value.replace(/[^a-z A-Z.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Volume </label>

                                <?php echo $this->Form->control('volume',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Volume','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Edition </label>

                                <?php echo $this->Form->control('edition',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Edition','type'=>'text']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Publisher </label>

                                <?php echo $this->Form->control('publisher',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Publisher','type'=>'text']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Total Page <span class="required" aria-required="true"> * </span></label>

                                <?php echo $this->Form->control('total_page',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Total Page','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Book Condition</label>
                                <?php $options = array('Good' => 'Good','Bad'=>'Bad' ); ?>
                                <?php echo $this->Form->control('book_condition', ['options' => $options, 'empty' => '--Select--','label'=>false,'class'=>'form-control selectto']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Price <span class="required" aria-required="true"> * </span></label>

                                <?php echo $this->Form->control('price',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Price','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Reserved</label>
                                <?php echo $this->Form->radio('is_reserved',[
                                    ['value'=>'No','text'=>'No','checked','class'=>'radio-inline'],
                                    ['value'=>'Yes','text'=>'Yes','class'=>'radio-inline'],
                                ]);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Medium</label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Class</label>

                                <?php echo $this->Form->control('student_class_id', ['options' => $studentClasses, 'empty' => '--Select--','label'=>false,'class'=>'select2','style'=>'width:100%','id'=>'student_class_id']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Subject</label>
                                <?php echo $this->Form->control('subject_id', ['options' => $subjects, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%','id'=>'subject_id']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Book Category</label>
                                <?php echo $this->Form->control('book_category_id', ['options' => $bookCategories, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%']);?>
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
<?= $this->element('validate') ?>
<?= $this->element('icheck') ?>
<?= $this->element('selectpicker') ?>
<?php
$js="
$(document).ready(function(){
    $(document).on('change', '#medium_id', function(e){
        var medium_id = $(this).val();
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getClass.json'])."';
        $.post(
            url, 
            {medium_id: medium_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#student_class_id').html(obj.response);
        });
    });
    $(document).on('change', '#student_class_id', function(e){
        var student_class_id = $(this).val();
        url = '".$this->Url->build(['controller'=>'Books','action'=>'getSubject.json'])."';
        $.post(
            url, 
            {student_class_id: student_class_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#subject_id').html(obj.response);
        });
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>