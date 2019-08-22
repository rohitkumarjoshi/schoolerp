<div class="row">
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <label> Entrance Exam </label>
            </div> 
            <?= $this->Form->create($entranceExamResults,['id'=>'ServiceForm']) ?>
            <div class="box-body">    
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Subject Name ') ?></th>
                            <th scope="col"><?= __('MM ') ?></th>
                            <th scope="col"><?= __('Obt. Marks ') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        $ii=0;
                        if(!empty($entranceResults->toArray()))
                        {
                             foreach ($entranceResults as $entranceResult) {
                            ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?= h($entranceResult->entrance_exam->subject_name) ?></td>
                                    <td>
                                        <?php echo $entranceResult->entrance_exam->minimum_marks;?>
                                    </td>
                                    <td>
                                        <?= $this->Form->hidden('entrance_exam['.$ii.'][entrance_exam_id]',['value'=>$entranceResult->entrance_exam->id]) ?>
                                        <?= $this->Form->hidden('entrance_exam['.$ii.'][id]',['value'=>$entranceResult->id]) ?>
                                        <?php echo $this->Form->control('entrance_exam['.$ii.'][obt_marks]',[
                                        'label' => false,'class'=>'form-control ','placeholder'=>'Enter Marks','type'=>'text','value'=>$entranceResult->obt_marks]);?>
                                    </td>
                                </tr> 
                                <?php
                               
                                $ii++;
                                $i++;
                            }
                        }
                        else
                        {
                            foreach ($entranceExams as $entranceExam) {
                            ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?= h($entranceExam->subject_name) ?></td>
                                    <td>
                                        <?php echo $entranceExam->minimum_marks;?>
                                    </td>
                                    <td>
                                        <?= $this->Form->hidden('entrance_exam['.$ii.'][entrance_exam_id]',['value'=>$entranceExam->id]) ?>
                                        <?php echo $this->Form->control('entrance_exam['.$ii.'][obt_marks]',[
                                        'label' => false,'class'=>'form-control ','placeholder'=>'Enter Marks','type'=>'text']);?>

                                    </td>
                                </tr> 
                                <?php
                               
                                $ii++;
                            }
                        }
                         echo $this->Form->unlockField('entrance_exam');
                        ?>
                            <tr>
                                <td colspan="2">Result</td>
                                <td colspan="2">
                                     <?= $this->Form->control('entrance_exam_resulte',array('options' => ['Passed'=>'Passed','Hold'=>'Hold','Pending'=>'Pending','Faild'=>'Faild'],'class'=>'select2','label'=>false,'style'=>'width:100%','value'=>$enquiryFormStudent->entrance_exam_resulte)) ?>
                                 </td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <?php
            if($enquiryFormStudent->admission_generated=='N')
            {?>
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
            <?php 
            }
            ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
    
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            service: {
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