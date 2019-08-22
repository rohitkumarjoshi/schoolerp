<style type="text/css">
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    
    border-top: none;
    line-height: 2;
}
.border-field{
    /*border: 1px solid;
    padding: 5px;*/
    font-weight: bold;
}

</style>
<?php $cdn_path = $awsFileLoad->cdnPath(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="pull-right box-tools">
                    <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                </div>
                <?= $this->element('school_detail') ?>
                <h4><center>APPLICATION AND REGISTRATION FORM</center></h4>
                <table class="table">
                    <tr>
                        <td style="vertical-align: middle;"><b>S.No. : </b><?= h(str_pad($enquiryFormStudent->admission_form_no, 4, '0', STR_PAD_LEFT)).'/'.h($enquiryFormStudent->session_year->session_name) ?> </td>
                        <td style="vertical-align: middle;"><b>Class: </b><?= h($enquiryFormStudent->student_class->roman_name) ?>
                        </td>
                        <td style="vertical-align: middle;"><b>Date: </b><?= h($enquiryFormStudent->admission_form_date) ?>
                        </td>
                        <td style="float: right;margin-top:;">
                            <?php
                                if(!empty($studentDocumentPhotos))
                                {
                                    echo $this->Html->image($cdn_path.'/'.$studentDocumentPhotos->image_path,['style'=>  'margin-top: 0px;height: 100px;align-content: center; background-color: #f9eded00 !important;width: 100px;']);
                                }
                                else
                                {
                                    echo '<img src="../../img/avatar3.png" width="100">';
                                }
                                ?>
                                </td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td style="width: 25%;"><b>Name of the Applicant : </b></td>
                        <td style="width: 25%;"><strong class="border-field"><?= h($enquiryFormStudent->name) ?></strong></td>
                        <td style="width: 25%;"><b>Gender :</b></td>
                        <td style="width: 25%;"><?= h($enquiryFormStudent->gender->name) ?></td>
                    </tr>
                    <tr>
                        <td><b>Date of Birth :</b></td>
                        <td><strong class="border-field"><?= h($enquiryFormStudent->dob) ?></strong></td>
                    </tr>
                    <tr>
                        <td><b>Father's Name : </b></td>
                        <td><strong class="border-field"><?= h($enquiryFormStudent->father_name) ?></strong></td>
                        <td><b>Father Profession :</b></td>
                        <td>
                            <?php
                            $student_father=[];
                            foreach ($enquiryFormStudent->student_father_professions as $student_father_profession) {
                               $student_father[]=h($student_father_profession->student_parent_profession->name);
                            }
                            echo implode(', ',$student_father);
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td><b>Mother's Name : </b></td>
                        <td><strong class="border-field"><?= h($enquiryFormStudent->mother_name) ?></strong></td>
                        <td><b>Mother Profession :</b></td>
                        <td>
                            <?php
                            $student_mother=[];
                            foreach ($enquiryFormStudent->student_mother_professions as $student_mother_profession) {
                               $student_mother[]=h($student_mother_profession->student_parent_profession->name);
                            }
                            echo implode(', ',$student_mother);
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td><b>Hosteller :  </b></td>
                        <td><?= h($enquiryFormStudent->hostel_facility) ?></td>
                        <td><b>Category : </b></td>
                        <td><?= h($enquiryFormStudent->reservation_category->short_name) ?></td>
                    </tr>
                    <tr>
                        <td><b>Current Address : </b></td>
                        <td><?= h($enquiryFormStudent->correspondence_address) ?></td>
                        <td><b>Permanent Address : </b></td>
                        <td><?= h($enquiryFormStudent->permanent_address) ?></td>
                    </tr>
                    <tr>
                        <td><b>Minority : </b></td>
                        <td><?= h($enquiryFormStudent->minority) ?></td>
                        <td><b>Mobile No. : </b></td>
                        <td><?= h($enquiryFormStudent->mobile_no) ?></td>
                    </tr>
                    <tr>
                        <td><b>Document Attached : </b></td>
                        <td>
                            <?php
                            $document=[];
                        foreach ($enquiryFormStudent->student_documents as $student_document) {
                            $document[]= $student_document->document_class_mapping->document->document_name;
                        }
                        echo implode(', ', $document);
                            ?>
                        
                        </td>
                        <td><b>E-mail ID : </b></td>
                        <td><?= h($enquiryFormStudent->email) ?></td>
                    </tr>   
                    <tr>
                        <td><b>Class : </b></td>
                        <td><?= h($enquiryFormStudent->student_class->roman_name) ?></td>
                        <td><b>Medium : </b></td>
                        <td><?= h($enquiryFormStudent->medium->name) ?></td>
                    </tr>
                      <tr>
                        <td><b>RTE : </b></td>
                        <td><?= h($enquiryFormStudent->rte) ?></td>
                        <td><b>Living : </b></td>
                        <td><?= h($enquiryFormStudent->living) ?></td>
                    </tr>
                    <tr>
                        <td><b>Previous School detail : </b></td>
                        <td><?= h($enquiryFormStudent->last_school) ?></td>
                    </tr>
                    <tr>
                        <td><b>Last Class attended : </b></td>
                        <td><?= h(@$enquiryFormStudent->last_class->roman_name) ?></td>
                        <td><b>Medium : </b></td>
                        <td><?= h(@$enquiryFormStudent->last_medium->name) ?></td>
                    </tr>
                    <tr>
                        <td><b>Name of Local Guardian : </b></td>
                        <td><?= h($enquiryFormStudent->local_guardian) ?></td>
                        <td><b>Address & phone no. : </b></td>
                        <td><?= h($enquiryFormStudent->guardian_address) ?></td>
                    </tr>
                    <tr>
                        <td><b>Mobile No. : </b></td>
                        <td><?= h($enquiryFormStudent->guardian_mobile_no) ?></td>
                    </tr>
                    <tr>
                        <td><b>Transportation : </b></td>
                        <td><?= h($enquiryFormStudent->transportation) ?></td>
                        <td><b>(if student is coming by own vehicle, please mention the Licence No.) : </b></td>
                        <td><?= h($enquiryFormStudent->licence_no) ?></td>
                    </tr>
                </table>
                <!-- <table class="table" style="margin-top: 50PX;">
                    <tr>
                        <td style="width: 33%;text-align: center;"><b>Signature of Student</b></td>
                        <td style="width: 33%;text-align: center;"><b></b></td>
                        <td style="width: 33%;text-align: center;"><b>Signature of Parent/Guardian</b></td>
                    </tr>
                </table>
                <table class="table"  style="margin-top: 50PX;">
                    <tr>
                        <td style="width: 33%;text-align: center;"><b>SIGNATURE OF THE PRINCIPAL</b></td>
                        <td style="width: 33%;text-align: center;"><b>SIGNATURE OF THE DIRECTOR</b></td>
                        <td style="width: 33%;text-align: center;"><b>SIGNATURE OFFICE</b></td>
                    </tr>
                </table> -->
            </div>
        </div>