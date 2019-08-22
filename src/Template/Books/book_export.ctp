<style type="text/css">
    .control-label{
        display: block;
    }
</style>
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
                            <th>Name</th>
                            <th>Author Name</th>
                            <th>Edition</th>
                            <th>Volume</th>
                            <th>Total Page</th>
                            <th>Book Condition</th>
                            <th>Book Category</th>
                            <th>Price</th>
                            <th>Accession_no</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($books as $book): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $book->name ?></td>
                            <td><?= h($book->author_name) ?></td>
                            <td><?= h($book->edition) ?></td>
                            <td><?= h($book->volume) ?></td>
                            <td><?= $this->Number->format($book->total_page) ?></td>
                            <td><?= h($book->book_condition) ?></td>
                            <td><?= $book->has('book_category') ? $book->book_category->name: '' ?></td>
                            <td><?= $this->Number->format($book->price) ?></td>
                            <td><?= h($book->id) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->element('excelexport',['table'=>'example1']) ?>