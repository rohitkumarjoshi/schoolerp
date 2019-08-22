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
                            <h4> Vehicle Route Report</h4>
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
								<th scope="col">Vehicle No</th>
								<th scope="col">Statation Name</th>
								<th scope="col">Pick-up Time</th>
								<th scope="col">Drop Time</th>
								<th scope="col">Station Order</th>
							</tr>
                        </thead>
                       <tbody>
						<?php 
								$i=1;foreach ($vehicleRoutes as $vehicleRoute): ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= h($vehicleRoute->vehicle->vehicle_no) ?></td>
								<td><?= h($vehicleRoute->vehicle_station->name) ?></td>
								<td><?= h($vehicleRoute->pickup_time) ?></td>
								<td><?= h($vehicleRoute->drop_time) ?></td>
								<td><?= $this->Number->format($vehicleRoute->station_order_by) ?></td>
								</tr>
							<?php $i++;endforeach; ?>
						</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $this->element('excelexport',['table'=>'example1']) ?>