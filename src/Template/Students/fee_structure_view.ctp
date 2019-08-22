<style type="text/css">
    b {
    font-weight: 700 !important;
    
}
td{
    border-top: none !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Fee Structure </label>
                <div class="pull-right box-tools">
                    <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon printnone','style'=>'color:#fff !important;']) ?>
                </div>
                
            </div>
            <div class="box-body">
                
                    <div class="row">
                        <center>
                            <center><b><u>Fee Structure</u></b></center>
                            <table class="table " style="width: 40%">
                                <tbody>
                                    <tr>
                                        <td style="text-align: left;">Scholar No.:</td>
                                        <td style="text-align: left;"><?= $students->scholar_no ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Name :</td>
                                        <td style="text-align: left;"><?= $students->name ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Father's Name :</td>
                                        <td style="text-align: left;"><?= $students->father_name ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">Class :</td>
                                        <td style="text-align: left;"><?= $studentInfos->student_class->name ?></td>
                                    </tr>
                                    <?php
                                    if(!empty($studentInfos->stream))
                                    {
                                        ?>
                                        <tr>
                                            <td style="text-align: left;">Stream :</td>
                                            <td style="text-align: left;"><?= $studentInfos->stream->name ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td style="text-align: left;">Section :</td>
                                         <td style="text-align: left;"><?= (!empty($studentInfos->section))?$studentInfos->section->name:'' ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <center><b><u>Year <?= $session_name ?></u></b></center>
                            <table class="table table-bordered" style="width: 50%">
                                <tbody>
                                    <?php
                                    foreach ($fee_structure_data as $fee_name => $value) {
                                       ?>
                                        <tr>
                                            <td style="text-align: right;"><?= $fee_name ?></td>
                                            <td style="text-align: left;"><?= $value ?></td>
                                        </tr>
                                        <?php
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </center>
                    </div>
            </div>
        </div>
    </div>
</div>