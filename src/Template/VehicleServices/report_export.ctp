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
                            <h4>Vehicle Services Report</h4>
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
								<th scope="col">Driver</th>
								<th scope="col">Service Date</th>
								<th scope="col">Km</th>
								<th scope="col">Bill No</th>
								<th scope="col">Amount</th>
								<th scope="col">Vendor</th>
								<th scope="col">Next Service Date</th>                               
								<th scope="col">Status</th>                               
							</tr>
                        </thead>
                      <tbody>
						<?php $i=1;foreach ($vehicleServices as $vehicleService): ?>
						<tr>
							<td><?= $i;?></td>
							<td><?= h($vehicleService->vehicle->vehicle_no) ?></td>
							<td><?= h(@$vehicleService->driver->name) ?></td>
							<td><?= h($vehicleService->service_date) ?></td>
							<td><?= $this->Number->format(@$vehicleService->km) ?></td>
							<td><?= h(@$vehicleService->bill_no) ?></td>
							<td><?= $this->Number->format($vehicleService->amount) ?></td>
							<td><?= h(@$vehicleService->vendor->name)?></td>
							<td><?= h(@$vehicleService->next_service) ?></td>
							<td>
								<?php
								if($vehicleService->is_deleted=='Y')
								{
									echo 'Deactive';
								}
								else{
									echo 'Active';
								}
								?>
							</td>
						</tr>
						<?php $i++;endforeach; ?>
					</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $this->element('excelexport',['table'=>'example1']) ?>