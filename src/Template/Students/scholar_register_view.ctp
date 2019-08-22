<html>
<head>
<style>
table
{
border-collapse:collapse;
}
</style>
<style media="print">
.prnt
{
    page-break-after:always;
}
</style>
<style type="text/css">
    th {
    font-weight: 700 !important;
}
.signature{
    text-align: right;
    font-size: 15px;
    font-weight: 700;
    margin-top: 60px;
}
</style>
<style media="print">

.displaynone
{
    display:none !important;
}
.white-color-print
{
    background-color:#FFF !important;
}
</style>

<style>
.table thead tr th {
    font-size: 14px;
    font-weight: 600;
}
.table tbody tr td {
    font-size: 15px;
    
}
.table thead > tr > th {
    border-bottom: 0px none;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border: 1px solid #DDD;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 4px;
    line-height: 1;
}
table {
    border-collapse: collapse;
    border-spacing: 0px;
}

body {
    color: #000;
    font-family: "Open Sans",sans-serif;
    font-size: 13px;
    direction:ltr;
    margin-left:8%;
    
}

</style>
<style type="text/css">
    .report-logo{
        align-content: center;
        display: ruby-base-container;
        position: absolute;
    }
   .bg-maroon {
    background-color: #d81b60 !important;
}
.btn {
    border-radius: 0px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
a {
    color: #337ab7;
    text-decoration: none;
}
.pull-right {
    float: right !important;
}
</style>
<style type="text/css" media="print">
    .box-header{
        display: none;
    }
    .report-header{
        display: block;
    }
    .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td 
    {
        border: 1px solid #0c0c0c !important;
    }
</style>
<title>Scholar Register </title>

</head>

<body>
    <div class="pull-right box-tools">
        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon displaynone','style'=>'color:#fff !important;']) ?>
    </div>
    <?php
    if(!empty($studentInfos))
    { 
        foreach ($studentInfos as $studentInfo)
        {
            $gender=($studentInfo->student->gender_id==1)?'D/O':'S/O';
            ?>
            <div class="prnt" style="margin-right:1%;">
                <div class="report-header">
                    <!-- <div class="report-logo">
                        <?= $this->Html->image('school_logo/reportlogo.png',['style'=>  'height: 120px;']) ?> 
                    </div> -->
                    <table width="100%"  align="center"  cellpadding="0" cellspacing="0"  >
                        <tbody>
                            <tr>
                                <td  align="center" style="font-size:25px">
                                    <b style="text-transform: uppercase;"><?= $school->name ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" >
                                    <B><I>(<?= $school->affiliation_no ?>)</I></B>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <b><?= $school->address ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"   style="font-size:20px">
                                    <b>(<?= $school->agis ?>)</b>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"   style="font-size:20px">
                                    <b><?= $auth->User('session_name') ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
                <table width="100%" align="center" style="margin-top: 12px;">
                    <tr>
                        <th width="27%" align="center">Record(A)</th>
                        <th width="36%" align="center">Scholar's Register</th>
                        <th width="37%" align="center">Scholar No. : <?= h($studentInfo->student->scholar_no) ?></th>
                    </tr>
                </table>
                <table   width="100%" align="center" border="1" >
                    <tr>
                        <td align="center">Date of Admission</td>
                        <td align="center">Date of Removal/leaving</td>
                        <td align="center">Cause of removal/leaving</td>
                        
                    </tr>
                    <tr>
                        <th><?= date("d-M-Y", strtotime($studentInfo->student->registration_date)) ?></th>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <table width="100%" align="center">
                    <tr>
                        <th style="text-align:left" width="21%">Record(B)</th>
                        <td width="22%"></td>
                        <td width="8%"></td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td >Name of scholar</td>
                        <th style="text-align:left"><?= h($studentInfo->student->name) ?></th>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td>Date of birth(in figure)</td>
                        <th  style="text-align:left">
                            <?= ($studentInfo->student->dob != '')?date("d-m-Y", strtotime($studentInfo->student->dob)):'' ?></th>
                        <td>In words</td>
                        <th  width="30%" style="text-align:left">
                            <?php
                            if($studentInfo->student->dob != '')
                            {
                                ?>
                                <?= $this->Numbers->convertNumberToWord($studentInfo->student->dob->format('j')).' '.$studentInfo->student->dob->format('F').', '.$this->Numbers->convertNumberToWord($studentInfo->student->dob->format('Y')) ?>
                                <?php
                            }
                            ?>
                            </th>
                    </tr>
                </table>
                <table border="1" width="100%" align="center">
                    <tr>
                        <td rowspan="2" width="30%">
                            <table border="0" width="100%" height="100%">
                                <tr>
                                    <td>Name of Father</td>
                                </tr>
                                <tr>
                                    <th style="text-align:left"><?= h($studentInfo->student->father_name) ?></th>
                                </tr>
                                <tr>
                                    <td >Name of Mother</td>
                                </tr>
                                <tr>
                                    <th style="text-align:left"><?= h($studentInfo->student->mother_name) ?></th>
                                </tr>
                                <tr>
                                    <td >Name of Guardian</td>
                                </tr>
                                <tr>
                                    <th style="text-align:left"><?= h($studentInfo->local_guardian) ?></th>
                                </tr>
                            </table>
                        </td>
                        <td width="30%" height="35%" align="center"> Occupation & Address </td>
                        <td align="center">The last school, attended <br/>before this school</td>
                        <td align="center">The highest class passed <br/> at the previous school at the joining</td>
                    </tr>
                    <tr>
                        <th  style="text-align:left"><?= h($studentInfo->permanent_address) ?></th>
                        <th style="text-align:left"><?= h($studentInfo->student->last_school) ?></th>
                        <th style="text-align:left"><?= h(@$studentInfo->student->last_class->roman_name) ?></th>
                    </tr>       
                </table>
                <table width="100%" align="center">
                    <tr>
                        <th style="text-align:left;">Record(C)</th><th style="text-align:right;">Record(D)</th>
                    </tr>
                </table>
                <table width="100%" border="1" align="center">
                    <tr>
                        <td colspan="2" align="center">Addmission of  promotion</td>
                        <td rowspan="2" align="center">Date of passing  standard or class  from this school</td>
                        <td colspan="2" align="center">Attendance</td>
                        <td colspan="2" align="center">Rank in class</td>
                        <td rowspan="2" align="center">Remarks</td>
                        <td rowspan="2" align="center">(Sign.)Entries Made by</td>
                        <td rowspan="2" align="center">Conduct & work  during school Year</td>
                     </tr>
                    <tr>
                        <td align="center">Class</td>
                        <td align="center">Date</td>
                        <td align="center">Total number  of School meeting</td>
                        <td align="center">Number of meeting  on which present</td>
                        <td align="center">Number of scholar  in class</td>
                        <td align="center">Place as shown by  final examination in class</td>
                    </tr>
                    <?php
                    foreach ($studentClasses as $studentClass) 
                    {
                        ?>
                        <tr>
                            <td align="center"><?= h($studentClass->roman_name) ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="center"></td>
                            <td align="center"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <table width="100%" align="center">
                    <tr>
                        <td colspan="2">1. Certified that the above Scholar's Register has been posted up to date on Scholar's leaving as required by the Rule. </td>
                    </tr>
                    <tr>
                        <td colspan="2"> 2. Certified that noSchool feeis due Copy given to/Copy sent by post.</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">Date: </td><td style="text-align:right;">PRINCIPAL</td>
                    </tr>
                </table>
            </div>
            <?php
        }
    }
    ?>
</body>
</html>