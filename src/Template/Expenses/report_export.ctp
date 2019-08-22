<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookIssueReturn[]|\Cake\Collection\CollectionInterface $bookIssueReturns
 */
?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                </div> 
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12 text-center" id="school_detail">
                            <h4> Expense Report</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>    
                                        <button id="btnExport" onclick="fnExcelReport();" class="btn btn-sm btn-info no-print"> EXPORT </button>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th scope="col"><?= ('Sr.No') ?></th>
                                <th scope="col"><?= ('expense_category_id') ?></th>
                                <th scope="col"><?= ('expense_subcategory_id') ?></th>
                                <th scope="col"><?= ('amount') ?></th>
                                <th scope="col"><?= ('vehicle_id') ?></th>
                                <th scope="col"><?= ('expense_by') ?></th>
                                <th scope="col"><?= ('expense_date') ?></th>
                                <th scope="col"><?= ('payment_mode') ?></th>
                                <th scope="col"><?= ('cheque_no') ?></th>
                                <th scope="col"><?= ('cheque_date') ?></th>
                                <th scope="col"><?= ('bank_name') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;foreach ($expenses as $expense): ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?= h($expense->expense_category->name) ?></td>
                                    <td><?= h($expense->expense_subcategory->name) ?></td>
                                    <td><?= $this->Number->format($expense->amount) ?></td>
                                    <td><?= h($expense->vehicle->vehicle_no)  ?></td>
                                    <td><?= h($expense->employee->name) ?></td>
                                    <td><?= h($expense->expense_date) ?></td>
                                    <td><?= h($expense->payment_mode) ?></td>
                                    <td><?= h($expense->cheque_no) ?></td>
                                    <td><?= h($expense->cheque_date) ?></td>
                                    <td><?= h($expense->bank_name) ?></td>
                                </tr>
                                <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $this->element('excelexport',['table'=>'example1']) ?>