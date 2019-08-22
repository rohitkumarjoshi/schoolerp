<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
            </div> 
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 text-center" id="school_detail">
                        <h4>School Detail</h4>
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
                            <th><?= __('Sr.No') ?></th>
                            <th scope="col">Book </th>
                            <th scope="col">Issue By</th>
                            <th scope="col">Date From </th>
                            <th scope="col">Date To </th>
                            <th scope="col">Return Date </th>
                            <th scope="col">Fine Amount </th>
                            <th scope="col">Status </th>         
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($bookIssueReturns as $bookIssueReturn): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $bookIssueReturn->book->name ?></td>
                            <td><?= $bookIssueReturn->has('student') ? $bookIssueReturn->student->name : $bookIssueReturn->employee->name ?></td>
                            <td><?= h($bookIssueReturn->date_from) ?></td>
                            <td><?= h($bookIssueReturn->date_to) ?></td>
                            <td><?= h($bookIssueReturn->return_date) ?></td>
                            <td><?= $this->Number->format($bookIssueReturn->fine_amount) ?></td>
                            <td><?= h($bookIssueReturn->status) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->element('excelexport',['table'=>'example1']) ?>