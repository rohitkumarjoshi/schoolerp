<table class="table table-bordered" id="tab">
                        <tbody>
                        <tr>
                            <th>Scholar No.: <?=$students->scholar_no?></th>
                            <th>Recipt No.: <?=$ReceiptNo?></th>
                            <th>Date: <?= date('d-m-Y')?></th>
                            <th>Medium: <?= @$studentInfos->medium->name?></th> 
                            
                        </tr>
                         <tr>
                            <th>Class: <?= @$studentInfos->student_class->name?></th>
                            <th>Stream: <?= @$studentInfos->stream->name?></th>
                            <th>Section: <?= @$studentInfos->section->name?></th>
                            <th>Name: <?=$students->name?></th>
                        </tr>
                        <tr>
                            
                            <th>Father Name: <?= @$students->father_name?></th>
                            <th>Mother Name: <?= @$students->mother_name?></th>
                            <th>Bus Facility: <?= $studentInfos->bus_facility?></th>
                            <th></th>
                        </tr>
                       
                        </tbody>
                    </table>