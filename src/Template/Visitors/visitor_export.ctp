<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
            </div> 
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 text-center" id="school_detail">
                        <h4>Visitor Detail</h4>
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
                            <th>#</th>
                            <th>Visitor</th>
                            <th>Meeeting With</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Visiting Area</th>  
                        </tr>
                    </thead>
                    <tbody>
                       <?php $i=0; foreach ($visitors as $key => $visitor): $i++;?>
                            <tr>
                                <td> <?php echo $i; ?></td>
                                <td><?= h($visitor->name) ?> </td>
                                <?php if($visitor->employee_id!='') 
                                     { ?>
                                    <td><?= h($visitor->employee->name) ?> </td>
                                <?php } ?>
                                 <?php if($visitor->student_id!='') 
                                     { ?>
                                    <td><?= h($visitor->student->name) ?> </td>
                                <?php } ?>
                               <td><?php  
                                  
                                        echo $result = (!empty($visitor->in_time)) ? date('d-M-Y',strtotime($visitor->in_date)).', '.date('h:i:s A',strtotime($visitor->in_time)): '';
                                    ?></td>
                                    <td> <?php  
                                        echo $result = (!empty($visitor->out_time)) ? date('d-M-Y',strtotime($visitor->out_date)).', '.date('h:i:s A',strtotime($visitor->out_time)): 'Visitor till inside the campus';
                                    ?>
                                    </td>
                                <td><?= h($visitor->visitor_type) ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->element('excelexport',['table'=>'example1']) ?>