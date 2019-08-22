<div class="box box-primary">
        <div class="box-header with-border"> 
            <label> <?= __('Vehicle Fuel Entries') ?></label>
            <div class="box-tools pull-right">
            </div>
        </div>
       <div class="box-body" >
              <div class="row">
                    <div class="col-md-12">
                      <?= $this->Form->create($vehicleFuelEntry,['id'=>'ServiceForm','type'=>'get']) ?>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="control-label">Search By Vehicle</label>
                                   <?= $this->Form->control('data[vehicle_id]', ['options' => $vehicles,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Vehicle','dataplaceholder'=>'Select Vehicle'])?>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Date From </label>
                                   <?= $this->Form->control('data[fill_date >=]', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','style'=>'height:40px;','value'=>@$_GET['data']['fill_date >=']])?>
                                </div> 
                                <div class="col-md-4">
                                    <label class="control-label">Date To </label>
                                   <?= $this->Form->control('data[fill_date <=]', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','style'=>'height:40px;','value'=>@$_GET['data']['fill_date <=']])?>
                                </div> 
                            </div>
                        </div>   
                        <div class="row ">
                            <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                <?php echo $this->Form->button('GO',['class'=>'btn btn-sm button']); ?>
                            </div> 
                        </div> 
                      <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
             <?php if($data_exist=='data_exist') { ?>
                <div class="box-body" >
                    <?php $page_no=$this->Paginator->current('vehicleFuelEntries'); $page_no=($page_no-1)*10; ?>
                <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($vehicleFuelEntry,['autocomplete'=>'off','url'=>['action'=>'reportExport'],'target'=>'_blank']) ?>
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
                    <table cellpadding="0" cellspacing="0" class="table">
                         <thead style="background-color: #21898e;color: #f1f2f3;">
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">Filling Date</th>
                                <th scope="col">Filled By</th>
                                <th scope="col">Vehicle No</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Previous Km</th>
                                <th scope="col">Current Km</th>
                                <th scope="col">Liter</th>
                                <th scope="col">Milege</th>
                                <th scope="col">Bill No</th>
                                <th scope="col">Diffeence Km</th>                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;foreach ($vehicleFuelEntries as $vehicleFuelEntry): ?>
                            <tr>
                                <td><?= $i;?></td>
                                <td><?= h($vehicleFuelEntry->fill_date) ?></td>
                                <td><?= h(@$vehicleFuelEntry->driver->name) ?></td>
                                <td><?= $vehicleFuelEntry->has('vehicle') ? $vehicleFuelEntry->vehicle->vehicle_no : '' ?></td>
                                <td><?= $this->Number->format($vehicleFuelEntry->amount) ?></td>
                                <td><?= $this->Number->format($vehicleFuelEntry->previous_km) ?></td>
                                <td><?= $this->Number->format($vehicleFuelEntry->current_km) ?></td>
                                <td><?= $this->Number->format($vehicleFuelEntry->liter) ?></td>
                                <td><?= $this->Number->format($vehicleFuelEntry->milege) ?></td>
                                <td><?= h($vehicleFuelEntry->bill_no) ?></td>
                                <td><?= $this->Number->format($vehicleFuelEntry->difference_km) ?></td>
                               
                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
             <div class="row">
                <div class="col-md-12 text-center">
                    <h3> <?= $data_exist ?></h3>
                </div>
            </div>
        <?php } ?>
    </div>
<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            vehicle_id: {
                required: false
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