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
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <b> Vehicle In-Out Report </b>
                </div>
                <div class="box-body">
                    <?= $this->Form->create($vehicleInOut,['autocomplete'=>'off']) ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label"> Campus Vehicle  </label>
                                <?php echo $this->Form->control('data[vehicle_id]', ['options' => '', 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'vehicle-id']);?>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label"> Other Vehicle</label>
                                <?php echo $this->Form->control('data[vehicle_no]', ['options' => '', 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'vehicleoutside-id','valueField'=>'vehicle_no','keyField'=>'vehicle_no']);?>
                            </div>
                           <div class="col-md-3">
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
                            <div class="col-sm-2">
                                 <?= $this->Form->submit('search',['class'=>'btn btn-success btnClass'])?>
                            </div>
                        </div>
                <?= $this->Form->end(); ?>
                <br>

                 <?php if($data_exist=='data_exist') { ?>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($vehicleInOut,['autocomplete'=>'off','url'=>['action'=>'vehicleinoutExport']]) ?>
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

                    <?php $page_no=$this->Paginator->current('VehicleInOuts'); $page_no=($page_no-1)*20; ?>
                     <table id="example1" class="table ">
                        <thead>
                          <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('vehicle_no') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('in_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('in_time') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('out_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('out_time') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('remarks') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($vehicleInOuts as $vehicleInOut): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>
                                    <?php 

                                    if(!empty($vehicleInOut->vehicle_no))
                                     {
                                        echo $vehicleInOut->vehicle_no; 
                                     } else 
                                     {
                                        echo $vehicleInOut->vehicle->vehicle_no;
                                       /*echo $this->Html->link($vehicleInOut->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $vehicleInOut->vehicle->id]);*/

                                     }
                                    ?>
                                </td>
                                <td><?= h($vehicleInOut->in_date) ?></td>
                                <td><?= h($vehicleInOut->in_time) ?></td>
                                <td><?= h($vehicleInOut->out_date) ?></td>
                                <td><?= h($vehicleInOut->out_time) ?></td>
                                <td><?= h($vehicleInOut->remarks) ?></td>
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
        </div>
    </div>

<?= $this->element('autofill',['table'=>'VehicleInOuts','selector'=>'#vehicleoutside-id']) ?>
<?= $this->element('autofill',['table'=>'Vehicles','selector'=>'#vehicle-id']) ?>
<?= $this->element('daterangepicker') ?>
<?= $this->element('validate') ?>
