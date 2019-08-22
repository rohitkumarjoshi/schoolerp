<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
            </div> 
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 text-center" id="school_detail">
                        <h4>Vehicles In-Out Report</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-8 text-right">
                        <table class="pull-right">
                            <tr>
                                <td>    
                                    <button id="btnExport" onclick="fnExcelReport();" class="btn btn-sm btn-info no-print"> EXPORT </button>
                            </tr>
                        </table>
                    </div>
                </div>
                
                 <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
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
                                   echo $this->Html->link($vehicleInOut->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $vehicleInOut->vehicle->id]);

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
        </div>
    </div>
</div>
<?php $this->element('excelexport',['table'=>'example1']) ?>