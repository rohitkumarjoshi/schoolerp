<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Student List Report".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );
//pr($OrderAcceptances->toArray()); exit;
?>

		<table id="example1" class="table" border="1">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Medium ') ?></th>
							<th scope="col"><?= __('Class ') ?></th>
							<th scope="col"><?= __('Stream ') ?></th>
							<th scope="col"><?= __('Section ') ?></th>
							<th scope="col"><?= __('Class Teacher Name ') ?></th>
							
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($classMappings as $classMapping): ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $classMapping->medium->name;?></td>
							<td><?php echo $classMapping->student_class->name;?></td>
							<td><?php echo @$classMapping->stream->name;?></td>
							<td><?php echo @$classMapping->section->name;?></td>
							<td><?php echo @$classMapping->employee->name;?></td>
							
						</tr>
					<?php $i++; endforeach; ?>
					</tbody>
	</table>
