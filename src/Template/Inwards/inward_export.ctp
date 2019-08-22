<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
            </div> 
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 text-center" id="school_detail">
                        <h4>Inwards Detail</h4>
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
                       <tr style="white-space: nowrap;">
                            <th>#</th>
                            <th>Person Name</th>
                            <th>Mobile No</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Item Description</th>
                            <th>Quantity</th>
                            <th>Bill No</th>
                            <th>Department</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i=0; foreach ($inwards as $key => $inward): $i++;?>
                            <tr>
                                <td> <?php echo $i; ?></td>
                                <td><?= h($inward->person_name) ?> </td>
                                <td><?= h($inward->mobile_no) ?> </td>
                                <td>
                                    <?php if(!empty($inward->in_date)) { ?>
                                        <?= date('d-M-Y',strtotime(h($inward->in_date))).' '.date('H:i:s',strtotime(h($inward->in_time))); ?>
                                    <?php } else { ?>
                                        <label> NA</label>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if(!empty($inward->out_date)) { ?>
                                        <?= date('d-M-Y',strtotime(h($inward->out_date))).' '.date('H:i:s',strtotime(h($inward->out_time))); ?>
                                    <?php }  else { ?>
                                        <label> NA</label>
                                    <?php } ?>
                                </td>
                                <td><?= h($inward->item_description) ?> </td>
                                <td><?= h($inward->total_quantity) ?> </td>
                                <td><?= h($inward->bill_no) ?> </td>
                                <td><?= h(@$inward->department->name) ?> </td>
                                <td><?= h($inward->remarks) ?> </td>
                            </tr>
                        <?php endforeach; ?>>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->element('excelexport',['table'=>'example1']) ?>