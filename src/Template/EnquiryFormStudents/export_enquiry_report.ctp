<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Enquiry Report".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );
//pr($OrderAcceptances->toArray()); exit;
?>


<table border="1">
         <thead>
                                        <tr style="white-space: nowrap;">
                                            <th>#</th>
                                            <th scope="col"><?=__('Enquiry No.')?></th>
                                            <th scope="col"><?=__('Form No.')?></th>
                                            <th scope="col"><?=__('Name') ?></th>
                                            <th scope="col"><?=__('Gender') ?></th>
                                            <th scope="col"><?= __('Father Name ') ?></th>
                                            <th scope="col" style="text-align:center;"><?= __('Medium ') ?></th>
                                            <th scope="col" style="text-align:center;"><?= __('Class ') ?></th>
                                            <th scope="col" style="text-align:center;"><?= __('Stream ') ?></th>
                                           <!--  <th scope="col" style="text-align:center;"><?= __('Status ') ?></th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="replace_data">
                                        <?php
                                        $i=0;
                                        foreach($enquiryFormStudents as $enquiryFormStudent){ ?>
                                        <tr>
                                            <td><?= ++$i; ?></td>
                                            <td><?=h ($enquiryFormStudent->enquiry_no)?></td>
                                            <td><?=h ($enquiryFormStudent->admission_form_no > 0 ? $enquiryFormStudent->admission_form_no : '-')?></td>
                                            <td><?=h ($enquiryFormStudent->name)?></td>
                                            <td><?=h ($enquiryFormStudent->gender->name)?></td>
                                            <td><?=h ($enquiryFormStudent->father_name)?></td>
                                            <td style="text-align:center;"><?=h ($enquiryFormStudent->medium->name)?></td>
                                            <td style="text-align:center;"><?=h ($enquiryFormStudent->student_class->name)?></td>
                                            <td style="text-align:center;"><?=h (@$enquiryFormStudent->stream->name)?></td>
                                            <!-- <td style="text-align:center;"><?=h (@$enquiryFormStudent->enquiry_status)?></td> -->
                                        </tr>
                                        <?php }?>
                                    </tbody>

      </table>
			