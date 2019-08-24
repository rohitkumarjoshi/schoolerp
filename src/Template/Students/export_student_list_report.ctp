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


<table border="1">
        <thead>
                                        <tr>
                                            <th>Sr. No.</th><th>Scholar No.</th><th>Name</th><th>Father's Name</th><th>Mother's Name</th><th>Medium</th><th>Class</th><th>Stream</th><th>Section</th>
                                            <th>Date of Admission</th><th>Date of Birth</th><th>Permanent Address</th><th>Current Address</th><th>Mobile No.</th><th>Gender</th>
                                            <th>Father's Profession</th>
                                            <th>Mother's Profession</th>
                                            <th>Category</th>
                                            <th>Caste</th><th>Religon</th><th>Disability</th><th>Aadhaar No.</th><th>Hosteller</th><th>Bus</th>
                                            <th>Email Id</th>
                                            <th>Pend. Doc</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sr_no=0;
                                            foreach ($studentLists as $studentList) {
                                                ?>
                                                <tr>
                                                    <td><?= ++$sr_no ?></td>
                                                    <td><?= $studentList->student->scholar_no ?></td>
                                                    <td><?= $studentList->student->name ?></td>
                                                    <td><?= $studentList->student->father_name ?></td>
                                                    <td><?= $studentList->student->mother_name ?></td>
                                                    <td><?= $studentList->medium->name ?></td>
                                                    <td><?= $studentList->student_class->name ?></td>
                                                    <td><?= @$studentList->stream->name ?></td>
                                                    <td><?= @$studentList->section->name ?></td>
                                                    <td><?= @$studentList->student->registration_date ?></td>
                                                    <td><?= @$studentList->student->dob ?></td>
                                                    <td><?= @$studentList->permanent_address ?></td>
                                                    <td><?= @$studentList->correspondence_address ?></td>
                                                    <td><?= @$studentList->student->parent_mobile_no ?></td>
                                                    <td><?= @$studentList->student->gender->name ?></td>
                                                    <td>
                                                        <?php
                                                        $student_father=[];
                                                        foreach ($studentList->student->student_father_professions as $student_father_profession) {
                                                           $student_father[]=h($student_father_profession->student_parent_profession->name);
                                                        }
                                                        echo implode(', ',$student_father);
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $student_mother=[];
                                                        foreach ($studentList->student->student_mother_professions as $student_mother_profession) {
                                                           $student_mother[]=h($student_mother_profession->student_parent_profession->name);
                                                        }
                                                        echo implode(', ',$student_mother);
                                                        ?> 
                                                    </td>
                                                    <td><?= @$studentList->reservation_category->short_name ?></td>
                                                    <td><?= @$studentList->caste->name ?></td>
                                                    <td><?= @$studentList->religion->name ?></td>
                                                    <td><?= @$studentList->student->disability->name ?></td>
                                                    <td><?= @$studentList->aadhaar_no ?></td>
                                                    <td><?= @$studentList->hostel_facility ?></td>
                                                    <td><?= h($studentList->bus_facility) ?></td>
                                                    <td><?= @$studentList->email ?></td>
                                                    <td>
                                                        <?php
                                                        $doc=[];
                                                        $doc_i=0;
                                                       foreach ($studentList->student->document_class_mappings as $document_class_mapping) 
                                                       {
                                                        $doc_i++;
                                                            $doc[]=$doc_i.'. '.$document_class_mapping->document->document_name;
                                                       }
                                                       echo implode(', ', $doc);
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
      </table>
			