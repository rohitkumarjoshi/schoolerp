<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookIssueReturn[]|\Cake\Collection\CollectionInterface $bookIssueReturns
 */
?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                </div> 
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 text-center" id="school_detail">
                            <h4> Vehicle Fuel Report</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>    
                                        <button id="btnExport" onclick="fnExcelReport();" class="btn btn-sm btn-info no-print"> EXPORT </button>
                                        <button id="btnExport" onclick="window.print();" class="btn btn-sm btn-info no-print"> Print </button>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                        <thead>
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
                                <td><?= h($vehicleFuelEntry->vehicle->vehicle_no) ?></td>
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
            </div>
        </div>
    </div>

<?php $this->element('excelexport',['table'=>'example1']) ?>