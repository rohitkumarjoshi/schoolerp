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
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Tuition Fee Certificate </label>
                <div class="pull-right box-tools">
                    <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon printnone','style'=>'color:#fff !important;']) ?>
                </div>
                
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= $this->element('school_detail') ?> 
                    </div>
                </div>
                <?php
                if(!empty($studentLedgers))
                { 
                    foreach ($studentLedgers as $studentLedger)
                    {
                        $gender=($studentLedger->student->gender_id==1)?'D/O':'S/O';
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <u style="font-weight: 700;font-size: 14px;">TO WHOM SO EVER IT MAY CONCERN</u>
                                </center>
                                <p style="text-align: right !important;font-size: 14px;"><strong>Date: </strong><?= date('d-M-Y') ?></p>
                                <p style="font-size: 14px;">This is to certify that <?= $studentLedger->student->name ?> (Scholar No. <?= $studentLedger->student->scholar_no ?> ) <?= $gender.' '.$studentLedger->student->father_name ?> and <?= $studentLedger->student->mother_name ?> of Class <?= $studentLedger->student_class->name ?> has deposited fees as per following details.</p>
                            </div>
                        </div>
                        <?php
                        $grand_total=0;
                        $category=[];
                        
                        if(!empty($studentLedger->student->enquiry_receipt))
                        {
                            $grand_total+=$studentLedger->student->enquiry_receipt->total_amount;
                            $category[$studentLedger->student->enquiry_receipt->receipt_fee_category->name][]=$studentLedger->student->enquiry_receipt->total_amount;
                        }
                        foreach ($studentLedger->fee_receipts as $fee_receipt) 
                        {
                            if($fee_receipt->fee_category_id==1)
                            {
                                $sub_category=[];
                                foreach ($fee_receipt->fee_receipt_rows as $fee_receipt_row) 
                                {
                                    if(!empty($fee_receipt_row->fee_type_student_master))
                                    {
                                        $fee_type_role_name=$fee_receipt_row->fee_type_student_master->fee_type_master_row->fee_type_master->fee_type->fee_type_role->name;
                                    }
                                    else
                                    {
                                        $fee_type_role_name=$fee_receipt_row->fee_type_master_row->fee_type_master->fee_type->fee_type_role->name;
                                    }

                                   $sub_category[$fee_type_role_name][]=$fee_receipt_row->amount;
                                }
                                if(@$sub_category['Bus Fee'])
                                {
                                    $amount= array_sum($sub_category['Bus Fee']);
                                    $category['Bus Fee'][]=$amount-$fee_receipt->concession_amount_2;
                                    $grand_total+=$amount-$fee_receipt->concession_amount_2;
                                }
                                if(@$sub_category['Tuition Fee'])
                                {
                                    $amount= array_sum($sub_category['Tuition Fee']);
                                    $category['Tuition Fee'][]=$amount-$fee_receipt->concession_amount_1;
                                    $grand_total+=$amount-$fee_receipt->concession_amount_1;
                                }
                            }
                            else
                            {
                                $category[$fee_receipt->receipt_fee_category->name][]=$fee_receipt->total_amount;
                                $grand_total+=$fee_receipt->total_amount;
                            }
                            
                        }
                    }
                    $sr_no=0;
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">S.No</th>
                                        <th style="text-align: center;">Fee Description</th>
                                        <th style="text-align: right;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($category as $key => $value) {
                                       ?>
                                        <tr>
                                            <td style="text-align: center;"><?= ++$sr_no ?></td>
                                            <td style="text-align: center;"><?= $key ?></td>
                                            <td style="text-align: right;">
                                                <?php
                                                echo array_sum($category[$key]);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: right;" colspan="2">Total Amount</th>
                                        <th style="text-align: right;"><?= $grand_total ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="signature">
                                 Authorized Signature 
                            </p>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>