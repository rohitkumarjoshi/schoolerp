 <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <label> View Feedbacks </label>
                    <hr>
                     <?= $this->Form->create($vehicleFeedback,['id'=>'ServiceForm','type'=>'get']) ?>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label class="control-label">Search By Vehicle</label>
                               <?= $this->Form->control('data[vehicle_id]', ['options' => $vehicles,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Vehicle','dataplaceholder'=>'Select Vehicle'])?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Date From </label>
                               <?= $this->Form->control('data[assign_date >=]', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','style'=>'height:40px;','value'=>@$_GET['data']['assign_date >=']])?>
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label">Date To </label>
                               <?= $this->Form->control('data[assign_date <=]', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','style'=>'height:40px;','value'=>@$_GET['data']['assign_date <=']])?>
                            </div> 
                            
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12" align="center">
                             <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                            <a href="<?php echo $this->Url->build(array('controller'=>'VehicleFeedbacks','action'=>'report')) ?>"class="btn btn-danger btn-sm" style="color: white !important ;" >Reset</a>
                            <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                        </div> 
                    </div> 
                <?= $this->Form->end() ?>
                </div> 
                <?php if($data_exist=='data_exist') { ?>
                <div class="box-body">
                   <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($vehicleFeedback,['autocomplete'=>'off','url'=>['action'=>'reportExport']]) ?>
                                            <?php if (isset($where)): ?>
                                                <?php foreach ($where as $key => $value): ?>
                                                    <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info'])?>
                                        <?= $this->Form->end() ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php $page_no=$this->Paginator->current('VehicleFeedbacks'); $page_no=($page_no-1)*10; ?>
                     <table id="example1" class="table" >
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= __('Vehicle No ') ?></th>
                                <th scope="col"><?= __('Driver') ?></th>
                                <th scope="col"><?= __('Student') ?></th>
                                <th scope="col"><?= __(' Date') ?></th>
                                <th scope="col"><?= __('Comment') ?></th>
                                <th scope="col"><?= __('Status') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($vehicleFeedbacks as $vehicleFeedback): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td >
                                <?php echo $vehicleFeedback->vehicle->vehicle_no;?>
                                </td> 
                                <td >
                                <?php echo @$vehicleFeedback->driver->name?>
                                </td>
                                 <td >
                                <?php echo @$vehicleFeedback->student->name;?>
                                </td>
                                 <td >
                                <?php echo $vehicleFeedback->date;?>
                                </td> 
                                <td >
                                <?php echo $vehicleFeedback->comment;?>
                                </td>
                                <td>
                                <?php
                                if($vehicleFeedback->is_deleted=='Y')
                                {
                                    echo 'Deactive';
                                }
                                else{
                                    echo 'Active';
                                }
                                ?>
                                </td>
                            </tr>
                        <?php $i++; endforeach; ?>
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
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            name: {
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
<?= $this->element('datepicker') ?> 