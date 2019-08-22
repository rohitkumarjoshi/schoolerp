<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label>  Students Hostel Report </label><br>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<?= $this->Form->create(' ',['class'=>'ServiceForm']) ?>
								<div class="col-md-12 " >
									<div class="row"> 
										<div class="col-md-3">
											<label class="control-label">Search By Student</label>
											<?= $this->Form->control('student_id', ['options' => $students,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select All Student','dataplaceholder'=>'Select Student'])?>
										</div>
										  <div class="col-md-1">
			                                    <label class="control-label"  style=" visibility: hidden;">Search</label>
			                                     <?php echo $this->Form->button('Search',['class'=>'btn btn-md btn-success filter','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'margin-right: 0px;color:white !important;height:38px;']); ?> 
			                             </div>
									</div>
								</div>
						<?= $this->Form->end() ?>
					</div>
				</div>
			
			<?php if($data_exist=='data_exist') { ?>
				
					<?php $page_no=$this->Paginator->current('HostelRegistrations'); $page_no=($page_no-1)*10; ?>
					<table id="example1" class="table">
						<thead>
							<tr>
								<th scope="col"><?= __('Sr.No') ?></th>
								<th scope="col"><?= __('Student ') ?></th>
								<th scope="col"><?= __('Hostel') ?></th>
								<th scope="col"><?= __('Room') ?></th>
								<th scope="col"><?= __('Reg. No') ?></th>
								<th scope="col"><?= __('Reg. Date') ?></th>
								<th scope="col"><?= __('Status ') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($HostelRegistrations as $hostelRegistration): ?>
							<tr>
								<td><?php echo $i;?></td>
								<td >
								<?php echo $hostelRegistration->student->name;?>
								</td> 
								<td >
								<?php echo $hostelRegistration->hostel->hostel_name;?>
								</td>
								<td >
								<?php echo $hostelRegistration->room->room_no;?>
								</td>
								<td >
								<?php 
							   $count= strlen($hostelRegistration->registration_no);
								if($count<3){
								echo "000".$hostelRegistration->registration_no;
								}else
								 {
									echo $hostelRegistration->registration_no;
								}
							?>
								</td>
								 <td >
								<?php echo $hostelRegistration->registration_date;?>
								</td>
								<td>
								<?php
								if($hostelRegistration->is_deleted=='Y')
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

<?= $this->element('selectpicker') ?> 

