

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                </div> 
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 text-center" id="school_detail">
                            <h4>Driver Conductor Report</h4>
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
								<th scope="col"><?= __('Sr.No') ?></th>
								<th scope="col"><?= __('Vehicle No ') ?></th>
								<th scope="col"><?= __('Driver') ?></th>
								<th scope="col"><?= __('Conductor') ?></th>
								<th scope="col"><?= __('Assign Date') ?></th>
								<th scope="col"><?= __('Status') ?></th>
							</tr>
                        </thead>
                       <tbody>
							<?php $i=1; foreach ($vehicleDriverMappings as $vehicleDriverMapping): ?>
							<tr>
								<td><?php echo $i;?></td>
								<td >
								<?php echo $vehicleDriverMapping->vehicle->vehicle_no;?>
								</td> 
								<td >
								<?php echo $vehicleDriverMapping->driver->name?>
								</td>
								 <td >
								<?php echo $vehicleDriverMapping->conductor->name;?>
								</td>
								 <td >
								<?php echo $vehicleDriverMapping->assign_date;?>
								</td>
								<td>
								<?php
								if($vehicleDriverMapping->is_deleted=='Y')
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
            </div>
        </div>
    </div>

<?php $this->element('excelexport',['table'=>'example1']) ?>