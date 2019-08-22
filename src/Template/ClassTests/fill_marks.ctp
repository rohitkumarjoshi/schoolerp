<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Fill Marks </label>
            </div>
            <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <table class="table table-bordered" style="text-align: center !important;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center !important;">Medium: <?=$classTest->medium->name ?></th>
                                            <th style="text-align: center !important;">Class: <?=$classTest->student_class->name ?></th>
                                            <th style="text-align: center !important;">Stream: <?= @$classTest->stream->name ?></th>
                                            <th style="text-align: center !important;">Section: <?= @$classTest->section->name ?></th>
                                        </tr>
                                    </thead>
                                </table> 
                            </center>
                            <?php echo $this->Form->hidden('max_marks',['value'=>$classTest->max_marks,'class'=>'max_marks']);?>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>Name</th>
                                        <th>Scholar No.</th>
                                        <th style="text-align: center !important;">Marks (<?= @$classTest->max_marks ?>) <?php echo $this->Form->control('max_marks',[
                                'label' => false,'type'=>'hidden','value'=>$classTest->max_marks,'id'=>'maxMarks']);?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x=0;
                                    foreach ($studnetData as $studentlist) {
                                        ?>
                                        <tr>
                                            <td  width="10%"><?= ++$x;?></td>
                                            <td class="sname"><?= $studentlist->student->name?>
                                                 <?php echo $this->Form->hidden('student_id[]',[
                                                  'value'=>$studentlist->id]);?> 
                                            </td>
                                            <td width="15%"><?= $studentlist->student->scholar_no?></td>
                                            <td style="text-align: center !important;width:25%">
                                                <?php echo $this->Form->control('marks[]',[
                                                'label' => false,'class'=>'form-control inputtedMarks','placeholder'=>'Marks','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",'value'=>@$std_marks[$studentlist->id]]);?>
                                            </td> 
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
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
<?= $this->element('validate') ?> 

<?php
$js="
$(document).ready(function(){
    $(document).on('keyup', '.inputtedMarks', function(e){
        var max_marks= parseFloat($('.max_marks').val());
        var inputtedMark=parseFloat($(this).closest('tr').find('td input.inputtedMarks').val());
        if(inputtedMark>max_marks){
            alert('Student Marks can not be greater than max marks');
            $(this).val('');
        }
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>