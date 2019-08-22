<style type="text/css">
    .autofill_list{
        max-height: 100px;
        position: absolute;
        width: 100%;
        overflow: overlay;
        z-index: 1;
    }
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <b> Visitors Report </b>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create($visitor,['autocomplete'=>'off']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Visitor Name</label>
                                <?php echo $this->Form->control('data[name]', ['options' => '', 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'visitor-id','valueField'=>'name','keyField'=>'name']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Student</label>
                                <?php echo $this->Form->control('data[student_id]', ['options' => '', 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'student-id']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Employee</label>
                                <?php echo $this->Form->control('data[employee_id]', ['options' => '', 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'employee-id']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Date From to To
                                      </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                      <?= $this->Form->control('data[form_to_date]',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range','readonly'=>true]) ?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-4 text-center">
                                <?= $this->Form->submit('search',['class'=>'btn btn-success btnClass'])?>
                            </div>
                        </div>
                <?= $this->Form->end(); ?>

                <?php if($data_exist=='data_exist') { ?>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
									<?= $this->Form->create($visitor,['autocomplete'=>'off','url'=>['action'=>'visitorExport']]) ?>
										<?php if (isset($where)): ?>
											<?php foreach ($where as $key => $value): ?>
												<?= $this->Form->hidden($key,['value'=>$value]) ?>
											<?php endforeach ?>
										<?php endif ?>
										<?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info'])?>
									<?= $this->Form->end() ?>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <?php $page_no=$this->Paginator->current('Visitors'); $page_no=($page_no-1)*20; ?>
                     <table id="example1" class="table" >
                        <thead>
                            <tr style="white-space: nowrap;">
                                <th>Sr</th>
                                <th>Visitor</th>
                                <th>Meeeting With</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Visiting Area</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $i=0; foreach ($visitors as $key => $visitor): $i++;?>
                                <tr>
                                    <td> <?php echo $i; ?></td>
                                    <td><?= h($visitor->name) ?> </td>
                                    <?php if($visitor->employee_id!='') 
                                         { ?>
                                        <td><?= h($visitor->employee->name) ?> </td>
                                    <?php } ?>
                                     <?php if($visitor->student_id!='') 
                                         { ?>
                                        <td><?= h($visitor->student->name) ?> </td>
                                    <?php } ?>
                                    <td><?php  
                                  
                                        echo $result = (!empty($visitor->in_time)) ? date('d-M-Y',strtotime($visitor->in_date)).', '.date('h:i:s A',strtotime($visitor->in_time)): '';
                                    ?></td>
                                    <td> <?php  
                                        echo $result = (!empty($visitor->out_time)) ? date('d-M-Y',strtotime($visitor->out_date)).', '.date('h:i:s A',strtotime($visitor->out_time)): 'Visitor till inside the campus';
                                    ?>
                                    </td>
                                    <td><?= h($visitor->visitor_type) ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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

<?= $this->element('student_autofill',['table'=>'Students','selector'=>'#student-id']) ?>
<?= $this->element('autofill',['table'=>'Visitors','selector'=>'#visitor-id']) ?>
<?= $this->element('employee_autofill',['table'=>'Employees','selector'=>'#employee-id']) ?>
<?= $this->element('daterangepicker') ?>
