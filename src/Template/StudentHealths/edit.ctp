<style type="text/css">
    .row{
        margin-bottom: 20px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Class Mapping </label>
            </div>
            <?= $this->Form->create($studentHealth,['id'=>'ServiceForm']) ?>
            <div class="box-body">
                <div class="form-group">
                    <div class="row" id="main">
                        <div class="col-sm-4">
                            <label><?= $studentHealth->student_info->student->name?></label>
                            <?= $this->Form->control('health_value',['class'=>'form-control','label'=>false]) ?>
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
