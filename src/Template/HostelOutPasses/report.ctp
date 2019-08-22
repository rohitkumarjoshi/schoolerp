  <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label>  Gate Pass Report </label>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box-body " >
                    <?= $this->Form->create(' ',['class'=>'ServiceForm']) ?>
                            <div class="col-md-12 " >
                                <div class="row"> 
                                    <div class="col-md-4">
                                        <label class="control-label">Search By Student</label>
                                        <?= $this->Form->control('student_id', ['options' => $students,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Student','dataplaceholder'=>'Select Student'])?>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Search By Date</label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range','style'=>'height:40px']) ?>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-1">
                                        <label class="control-label"  style=" visibility: hidden;">Search</label>
                                         <?php echo $this->Form->button('Search',['class'=>'btn btn-md btn-success filter','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'margin-right: 0px;color:white !important;height:38px;']); ?> 
                                    </div>
                                </div>
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
            
            <?php if($data_exist=='data_exist') { ?>
            <div class="box-body " >
                <div class="form-group">   
                    <table cellpadding="0" cellspacing="0" class="table">
                        <thead>
                            <tr style="background-color: #f3f2f1;">
                                <th scope="col"><?= $this->Paginator->sort('Sr.No') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('date_from') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('date_to') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('out_time') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('in_time') ?></th>
                                <th style="text-align: center;" scope="col"><?= $this->Paginator->sort('status') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;foreach ($hostelOutPasses as $hostelOutPass): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= h($hostelOutPass->student->name) ?></td>
                                <td><?= h($hostelOutPass->date_from) ?></td>
                                <td><?= h($hostelOutPass->date_to) ?></td>
                                <td><?= h($hostelOutPass->out_time) ?></td>
                                <td><?= h($hostelOutPass->in_time) ?></td>
                                <td style="text-align: center;"><?= h($hostelOutPass->status) ?></td>
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
          <?php } else { ?>
             <div class="row">
                <div class="col-md-12 text-center">
                    <h3> <?= $data_exist ?></h3>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>

<?= $this->element('daterangepicker') ?>
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){
    $('.ServiceForm').validate({ 
        submitHandler: function () {
            $('#loading').show();
            $('.submit_member').attr('disabled','disabled');
            form.submit();
        }
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 