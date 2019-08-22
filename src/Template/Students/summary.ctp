<style type="text/css">
.nav-tabs-custom {
box-shadow: none !important;
}
.nav-tabs-custom > .nav-tabs > li {
    margin-bottom: -1px !important;
 }
 .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border: 1px solid #a8a1a133;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Summary</label>
            </div>
            <div class="box-body">
        		<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active" >
							<a href="#tab_1_1" data-toggle="tab" aria-expanded="true">School</a>
						</li>
						<li class="">
							<a href="#tab_1_2" data-toggle="tab">Hostel</a>
						</li>
                        <li class="">
							<a href="#tab_1_3" data-toggle="tab">Account</a>
						</li>
						
					</ul>
        		</div>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="tab_1_1">
						<div class="row">
							<div class="col-md-6">	
								<div class="box box-info">
									<div class="box-header">
										<div class="caption">Total Student</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<th style="text-align:center">Record</th><th style="text-align:center">Boys</th style="text-align:center"><th style="text-align:center">Girls</th><th style="text-align:center">Total</th>
												</tr>
												<tr>
													<td class="active" style="text-align:center">Old Student</td>
													<td class="success" style="text-align:center"><?= $totalStudents->totalOldBoyCount ?></td>
													<td class="success" style="text-align:center"><?= $totalStudents->totalOldGirlCount ?></td>
													<td class="danger" style="text-align:center"><?= $totalStudents->totalOldBoyCount+$totalStudents->totalOldGirlCount ?></td>
												</tr>
												<tr>
													<td class="active" style="text-align:center">New Student</td>
													<td class="success" style="text-align:center"><?= $totalStudents->totalNewBoyCount ?></td>
													<td class="success" style="text-align:center"><?= $totalStudents->totalNewGirlCount ?></td>
													<td class="danger" style="text-align:center"><?= $totalStudents->totalNewBoyCount+$totalStudents->totalNewGirlCount ?></td>
												</tr>
												<tr>
													<td class="active">Total</td>
													<td class="danger" style="text-align:center"><?= $totalStudents->totalOldBoyCount+$totalStudents->totalNewBoyCount ?></td>
													<td class="danger" style="text-align:center"><?= $totalStudents->totalOldGirlCount+$totalStudents->totalNewGirlCount ?></td>
													
													<td class="active" style="text-align:center"><?= $totalStudents->totalOldBoyCount+$totalStudents->totalOldGirlCount+$totalStudents->totalNewBoyCount+$totalStudents->totalNewGirlCount ?></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">	
								<div class="box box-warning">
									<div class="box-header">
										<div class="caption">Transfer Certificate</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<th style="text-align:center">Record</th><th style="text-align:center">TC Issued</th>
												</tr>
												<tr>
													<td class="active" style="text-align:center">TC Fee Applicable</td>
													<td class="success" style="text-align:center"><?= $totalTcStudents ?></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<?php
							foreach ($totalClassStudentCounts as $medium => $totalClassStudentCount)
							{
								?>
								<div class="col-md-6">	
									<div class="box box-info">
										<div class="box-header">
											<div class="caption">Class Wise Summary <?= $medium ?> Medium</div>
										</div>
										<div class="box-body">
											<div class="table-responsive">
												<table class="table table-bordered">
													<tr><th rowspan="2" style="text-align:center">Class</th><th colspan="3" style="text-align:center">Old</th><th colspan="3" style="text-align:center">New</th><th rowspan="2">Total</th></tr>
													<tr>
													<td><label>Boys</label></td><td><label>Girls</label></td><td><label>Total</label></td><td><label>Boys</label></td><td><label>Girls</label></td><td><label>Total</label></td>
													</tr>
								<?php
								$totalOldBoyCount=$totalOldGirlCount=$totalNewBoyCount=$totalNewGirlCount=0;
								foreach ($totalClassStudentCount as $class => $classWiseCounts) {
									
									foreach ($classWiseCounts as $classWiseCount) {
										$totalOldBoyCount+=$classWiseCount->totalOldBoyCount;
										$totalOldGirlCount+=$classWiseCount->totalOldGirlCount;
										$totalNewBoyCount+=$classWiseCount->totalNewBoyCount;
										$totalNewGirlCount+=$classWiseCount->totalNewGirlCount;
										?>
										<tr>
											<td class="active"><?= $class ?></td>
											<td class="success" style="text-align:center"><?= $classWiseCount->totalOldBoyCount ?></td>
											<td class="success" style="text-align:center"><?= $classWiseCount->totalOldGirlCount ?></td>
											<td class="success style="text-align:center""><?= $classWiseCount->totalOldBoyCount+$classWiseCount->totalOldGirlCount ?></td>
											<td class="success" style="text-align:center"><?= $classWiseCount->totalNewBoyCount ?></td>
											<td class="success" style="text-align:center"><?= $classWiseCount->totalNewGirlCount ?></td>
											<td class="success" style="text-align:center"><?= $classWiseCount->totalNewBoyCount+$classWiseCount->totalNewGirlCount ?></td>
											<td class="danger" style="text-align:center"><?= $classWiseCount->totalOldBoyCount+$classWiseCount->totalOldGirlCount+$classWiseCount->totalNewBoyCount+$classWiseCount->totalNewGirlCount ?></td>
										</tr>
										<?php
									}
								}
								?>
													<tr>
														<td class="danger">Total</td>
														<td class="danger"  style="text-align:center"><?= $totalOldBoyCount ?></td>
														<td class="danger"  style="text-align:center"><?= $totalOldGirlCount ?></td>
														<td class="danger"  style="text-align:center"><?= $totalOldBoyCount+$totalOldGirlCount ?></td>
														<td class="danger"  style="text-align:center"><?= $totalNewBoyCount ?></td>
														<td class="danger"  style="text-align:center"><?= $totalNewGirlCount ?></td>
														<td class="danger"  style="text-align:center"><?= $totalNewBoyCount+$totalNewGirlCount ?></td>
														<td class="active"  style="text-align:center"><?= $totalOldBoyCount+$totalOldGirlCount+$totalNewBoyCount+$totalNewGirlCount ?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="box box-danger">
									<div class="box-header">
										<div class="caption">Discontinued Students</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr><th style="text-align:center">Class</th><th style="text-align:center">Temp.</th><th style="text-align:center">Perm.</th></tr>
													<?php
													$totaltempCount=$totalpermCount=0;
													foreach ($totalConDisStudents as $totalConDisStudent) 
													{
														$totaltempCount+=$totalConDisStudent->total_temporary_dicontinue;
														$totalpermCount+=$totalConDisStudent->total_discontinue;
														?>
														<tr>
															<td class="active"><?= $totalConDisStudent->student_class->name ?></td>
															<td class="success"  style="text-align:center"><?= $totalConDisStudent->total_temporary_dicontinue ?></td>
															<td class="success"  style="text-align:center"><?= $totalConDisStudent->total_discontinue ?></td>
															
															<td class="danger"  style="text-align:center"><?= $totalConDisStudent->total_temporary_dicontinue+$totalConDisStudent->total_discontinue ?></td>
														</tr>
														<?php
													}
													?>
												<tr>
													<td class="danger">Total</td>
													<td class="danger"  style="text-align:center"><?= $totaltempCount ?></td>
													<td class="danger"  style="text-align:center"><?= $totalpermCount ?></td>
													<td class="active"  style="text-align:center"><?= $totaltempCount+$totalpermCount ?></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">	
								<div class="box box-danger">
									<div class="box-header">
										<div class="caption">Bus Students</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr><th style="text-align:center">Class</th><th style="text-align:center">Student</th></tr>
													<?php
													$total_bus_student=0;
													foreach ($totalBusStudents as $totalBusStudent) 
													{
														$total_bus_student+=$totalBusStudent->total_bus_student;
														?>
														<tr>
															<td class="active"><?= $totalBusStudent->student_class->name ?></td>
															<td class="success"  style="text-align:center"><?= $totalBusStudent->total_bus_student ?></td>
														</tr>
														<?php
													}
													?>
												<tr>
													<td class="danger">Total</td>
													<td class="active"  style="text-align:center"><?= $total_bus_student ?></td></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade in" id="tab_1_2">
						<div class="row">
							<div class="col-md-6">	
								<div class="box box-danger">
									<div class="box-header">
										<div class="caption">Hostel Students</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr><th style="text-align:center">Class</th><th style="text-align:center">Student</th></tr>
													<?php
													$total_hostel_student=0;
													foreach ($totalHostelStudents as $totalHostelStudent) 
													{
														$total_hostel_student+=$totalHostelStudent->total_hostel_student;
														?>
														<tr>
															<td class="active"><?= $totalHostelStudent->student_class->name ?></td>
															<td class="success"  style="text-align:center"><?= $totalHostelStudent->total_hostel_student ?></td>
														</tr>
														<?php
													}
													?>
												<tr>
													<td class="danger">Total</td>
													<td class="active"  style="text-align:center"><?= $total_hostel_student ?></td></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade in" id="tab_1_3">
						<div class="row">
							<div class="col-md-6">	
								<div class="box box-danger">
									<div class="box-header">
										<div class="caption">Receipt Books</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr><th style="text-align:center">Fee Category</th>
													<th style="text-align:center">Receipt No. From</th>
													<th style="text-align:center">Receipt No. To</th>
												</tr>
													<?php
													foreach ($feeReceipts as $feeReceipt) 
													{
														?>
														<tr>
															<td class="active"><?= $feeReceipt->fee_category->name ?></td>
															<td class="success"  style="text-align:center"><?= $feeReceipt->min_receipt_no ?></td>
															<td class="success"  style="text-align:center"><?= $feeReceipt->max_receipt_no ?></td>
														</tr>
														<?php
													}
													?>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">	
								<div class="box box-danger">
									<div class="box-header">
										<div class="caption">Fee Collection</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr><th style="text-align:center">Fee Category</th>
													<th style="text-align:center">Amount</th>
												</tr>
													<?php
													$total_amount=0;
													foreach ($feeReceipts as $feeReceipt) 
													{
														$total_amount+=$feeReceipt->total_amount;
														?>
														<tr>
															<td class="active"><?= $feeReceipt->fee_category->name ?></td>
															<td class="success"  style="text-align:center"><?= $this->Number->format($feeReceipt->total_amount) ?></td>
														</tr>
														<?php
													}
													?>
													<tr>
														<td class="danger">Total</td>
														<td class="active"  style="text-align:center"><?= $this->Number->format($total_amount) ?></td></td>
													</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>