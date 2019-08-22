<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
    <div class="row">
        <?php foreach ($fines as $key => $fine): ?>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border" >
                            <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Fine For <?= $fine->fine_for?></label>
                    </div>
                    <div class="box-body">
                        <div class="form-group">    
                            <?= $this->Form->create($fine,['id'=>'ServiceForm']) ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label"> Fine Per Day <span class="required" aria-required="true"> * </span></label>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $this->Form->control('fine_amount_per_day',[
                                    'label' => false,'class'=>'form-control ','type'=>'text','required','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label"> Fine After Days <span class="required" aria-required="true"> * </span></label>
                                </div>
                                <div class="col-md-8">
                                    <?php echo $this->Form->control('fine_after_days',[
                                    'label' => false,'class'=>'form-control ','type'=>'text','required','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]);?>
                                    <?= $this->Form->hidden('fine_for')?>
                                    <?= $this->Form->hidden('id')?>
                                </div>
                            </div>
                            <span class="help-block"></span>
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
        <?php endforeach; ?>
    </div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?= $this->element('validate') ?> 
