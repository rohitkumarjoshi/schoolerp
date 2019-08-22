<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				 <label> Vehicle Student Attendances </label>
			</div> 
			<div class="box-body">
				<?php $page_no=$this->Paginator->current('sections'); $page_no=($page_no-1)*10; ?>
				 <table id="example1" class="table">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Vehicle No ') ?></th>
							<th scope="col"><?= __('Student') ?></th>
							<th scope="col"><?= __('In Time') ?></th>
							<th scope="col"><?= __('Out Time') ?></th>
							<th scope="col"><?= __('Taken By') ?></th>
							<th scope="col"><?= __('Date') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($vehicleStudentAttendances as $StudentAttendance): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td >
							<?php echo $StudentAttendance->vehicle->vehicle_no;?>
							</td> 
							 <td >
							<?php echo $StudentAttendance->student->name;?>
							</td>
							 <td >
							<?php echo $StudentAttendance->in_time;?>
							</td> 
							 <td >
							<?php echo $StudentAttendance->out_time;?>
							</td> 
							<td >
							<?php echo $StudentAttendance->conductor->name;?>
							</td> 
						 <td >
							<?php echo $StudentAttendance->date;?>
							</td>
						</tr>
					<?php $i++; endforeach; ?>
					</tbody>
			</table>
			<div class="box-footer">
				<?= $this->element('pagination') ?> 
			</div>
			</div>
		</div>
	</div>
 </div>

<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            name: {
                required: true
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
<?= $this->element('datepicker') ?> 