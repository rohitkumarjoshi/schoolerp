<div class="box box-primary">
    <div class="box-header with-border">
        <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
    </div> 
    <div class="box-body">
        <?= $this->Form->create('',['type'=>'get']) ?>
            <div class="form-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Fee Category</label>
                            <?php echo $this->Form->control('fee_category_id', ['empty'=>'---Select---','options' => $feeCategories,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$fee_category_id]);?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Fee Type</label>
                            <?php echo $this->Form->control('fee_type_id', ['empty'=>'---Select---','options' => $feeTypes,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$fee_type_id]);?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Vehicle Station</label>
                            <?php echo $this->Form->control('vehicle_station_id', ['empty'=>'---Select---','options' => $vehicleStations,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$vehicle_station_id]);?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Student Class</label>
                            <?php echo $this->Form->control('student_class_id', ['empty'=>'---Select---','options' => $studentClasses,'class'=>'select2','style'=>'width:100%','label'=>false,'value'=>@$student_class_id]);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <center>
                        <div class="form-group">
                            <?= $this->Form->label('Search', null, ['class'=>'control-label','style'=>'visibility: hidden;']) ?>
                            <div class="input-icon right">
                               <?= $this->Form->button(__('Search'),['class'=>'btn text-uppercase btn-success','name'=>'search','value'=>'search']) ?>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="box-body">
        <?php $page_no = $this->Paginator->counter(['format' => __('{{page}}')]); ?>
        <?php $page_no=($page_no-1)*10; ?>
         <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th scope="col"><?= ('S. No.') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('fee_category_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('fee_type_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('vehicle_station_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('gender_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('hostel') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('student_class_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('medium_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('stream_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('fee_wise') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('student_wise') ?></th> 
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach ($feeTypeMasters as $feeTypeMaster): ?>
                <tr>
                    <td><?= ++$page_no;?></td>
                    <td><?= $feeTypeMaster->fee_category->name ?></td>
                    <td><?= $feeTypeMaster->fee_type->name ?></td>
                    <td><?= @$feeTypeMaster->vehicle_station->name ?></td>
                    <td><?= @$feeTypeMaster->gender->name?></td>
                    <td><?= h(@$feeTypeMaster->hostel->hostel_name) ?></td>
                    <td><?= @$feeTypeMaster->student_class->name ?></td>
                    <td><?= @$feeTypeMaster->medium->name ?></td>
                    <td><?= @$feeTypeMaster->stream->name ?></td>
                    <td><?= h($feeTypeMaster->fee_wise) ?></td>
                    <td><?= h($feeTypeMaster->student_wise) ?></td> 
                    <td class="actions">
                        
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>',['action' => 'edit', $feeTypeMaster->id],array('escape'=>false,'class'=>'btn btn-info btn-xs'));?> 
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
    <div class="box-footer">
        <?= $this->element('pagination') ?> 
    </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 