<div class="box box-primary">
        <div class="box-header with-border"> 
            <label> <?= __('Vehicle Fuel Entries') ?></label>
            <div class="box-tools pull-right">
            </div>
        </div>
       <div class="box-body" >
              <div class="row">
                    <div class="col-md-12">
                      <?= $this->Form->create(' ',['id'=>'ServiceForm']) ?>
                            <fieldset><legend class="control-label">Filter</legend>
                                <div class="col-md-12 " >
                                    <div class="row"> 
                                         <div class="col-md-3">
                                            <label class="control-label">Search By Vehicle</label>
                                            <?= $this->Form->control('vehicle_id', ['options' => $vehicles,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Vehicle','dataplaceholder'=>'Select Vehicle'])?>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label" style="    visibility: hidden;">Search</label>
                                            <?php echo $this->Form->button('Go',['class'=>'btn btn-sm button','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'height: 38px;']); ?> 
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                      <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
                <div class="box-body" >
                    <?php if($data_exist=='data_exist') { ?>
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
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
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
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($vehicleFuelEntry->id)],['class'=>'btn btn-info editbtn btn-xs','escape'=>false, 'data-widget'=>'Edit Fuel', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Fuel']) ?>
                                 
                                </td>
                            </tr>
                            <?php $i++;endforeach; ?>
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