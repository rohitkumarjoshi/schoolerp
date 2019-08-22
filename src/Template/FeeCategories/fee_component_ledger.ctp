<style type="text/css">
    th {
    font-weight: 700 !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label >Fee Component Ledger </label>
            </div>
            <div class="box-body">
                <?= $this->Form->create('',['id'=>'ServiceForm']) ?>
                <div class="form-group hide_print">
                    <div class="row">
                        <div class="col-md-3">
                                <label class="control-label"> Medium </label>
                                <?php echo $this->Form->control('medium_id',[
                                'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Class</label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('stream_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label"> Date Range <span class="required" aria-required="true"> * </span></label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'required'=>true,'placeholder'=>'Date range']) ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label"> Check All </label>
                            <?php echo $this->Form->control('', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>'Check All','class'=>'check_all']);?>
                        </div>
                        <?php $individual='';
                        foreach ($feeCategories as $feeCategory) {
                            if($feeCategory->fee_collection=='Individual')
                            {
                                foreach ($feeTypeRoles as $feeTypeRole) {
                                    ?>
                                    <div class="col-md-2">
                                        <label class="control-label"> <?= $feeTypeRole->name ?> </label>
                                        <?php echo $this->Form->control('fee_type_role_id[]', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>$feeTypeRole->id,'class'=>'checkone']);?>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                 ?>
                                <div class="col-md-2">
                                    <label class="control-label"> <?= $feeCategory->name;?> </label>
                                    <?php echo $this->Form->control('fee_category_id[]', ['type' => 'checkbox','label'=>false,'hiddenField'=>false,'value'=>$feeCategory->id,'class'=>'checkone']);?>
                                </div>
                                <?php
                            }
                        }
                        ?> 
                    </div>
                    <div  class="row">
                        <center>
                            <?php echo $this->Form->button('View',['class'=>'btn button','id'=>'submit_member']); ?>
                        </center>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <?php
                $fee_order=[];
                if(!empty($monthlyCollection))
                { ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link('Print','javascript:window.print();',['escape'=>false,'class'=>'btn bg-maroon hide_print','style'=>'color:#fff !important;']) ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12  table-responsive">
                                <center>
                                    <h3>Component Wise Collection</h3>
                                    <h4><?= date('d-M-Y',strtotime($date_from)) ?> to <?= date('d-M-Y',strtotime($date_to)) ?></h4>
                                </center>
                                <div class="table-responsive">
                                <table class="table table-bordered " style="text-align: center !important;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center !important;" rowspan="2">Month</th>
                                            <?php
                                            foreach ($getFeeCategories as $feeCategory) {
                                                if($feeCategory->fee_collection=='Individual')
                                                {
                                                    ?>
                                                    <th style="text-align: center !important;" colspan="<?= sizeof($feeCategory->fee_types)+sizeof($feeCategory->fee_types)+6 ?>"><?= $feeCategory->name ?></th>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <th style="text-align: center !important;" colspan="<?= sizeof($feeCategory->fee_types)+5 ?>"><?= $feeCategory->name ?></th>
                                                    <?php
                                                }
                                            }?>
                                            <th style="text-align: center !important;" rowspan="2">Total Amount</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            foreach ($getFeeCategories as $feeCategory) {
                                                if($feeCategory->fee_collection=='Individual')
                                                {
                                                    $individual=$feeCategory->fee_collection;
                                                    foreach ($feeCategory->fee_types as $fee_type) {
                                                    
                                                        ?>
                                                        <th style="text-align: center !important;">Receipt No.</th>
                                                        <th style="text-align: center !important;"><?= $fee_type->fee_type_role->name ?></th>
                                                        <?php
                                                        $fee_order[$feeCategory->id][]=$fee_type->fee_type_role->id;
                                                        ?>
                                                        <th style="text-align: left !important;">Concession</th>
                                                    <th style="text-align: left !important;">Fine</th>
                                                    <th style="text-align: left !important;">Total</th>
                                                    <?php
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                    <th style="text-align: center !important;">Receipt No.</th>
                                                    <?php
                                                    foreach ($feeCategory->fee_types as $fee_type) {
                                                        ?>
                                                        <th style="text-align: center !important;"><?= $fee_type->name ?></th>
                                                        <?php
                                                        $fee_order[$feeCategory->id][]=$fee_type->id;
                                                    }
                                                    $fee_order[$feeCategory->id][]=$feeCategory->id.'_oldfee';
                                                    ?>
                                                    <th style="text-align: left !important;">Old Fee</th>
                                                    <th style="text-align: left !important;">Concession</th>
                                                    <th style="text-align: left !important;">Fine</th>
                                                    <th style="text-align: left !important;">Total</th>
                                                    <?php
                                                }
                                            }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                        $overall_gross_amount=0;

                                        foreach ($monthlyCollection as $receipt_date => $category) 
                                        {
                                            $gross_amount=0;
                                            ?>
                                            <tr>
                                            <td>
                                                <?php
                                                foreach ($feeMonthAlls as $monthKey => $monthValue) {
                                                    if($monthKey==$receipt_date)
                                                    {
                                                        echo $monthValue;
                                                    }
                                                }
                                                ?>
                                                </td>
                                            <?php
                                            foreach ($fee_order as $fee_order_key => $fee_order_value) 
                                            {
                                                if(array_key_exists($fee_order_key, $category))
                                                {
                                                    foreach ($category as $category_id => $category_data) 
                                                    { 
                                                        if($category_id==$fee_order_key)
                                                        {
                                                            
                                                            if($category_id==1)
                                                            {
                                                                if($individual=='Individual')
                                                                {
                                                                    $receipt_no=[];
                                                                    $total_amount=[];
                                                                    $concession_amount=[];
                                                                    $fine_amount=[];
                                                                    $comp_amount=[];
                                                                    foreach ($category_data as $key => $value) 
                                                                    {
                                                                        foreach ($fee_order_value as $data) 
                                                                        {
                                                                            if(!empty($value[$data]))
                                                                            {
                                                                                $comp_amount[$data][]=$value[$data]; 
                                                                                $total_amount[$data][]=$value['total_amount'];
                                                                                $receipt_no[$data][]=$value['receipt_no'];
                                                                                $concession_amount[$data][]=$value['concession_amount'];
                                                                                $fine_amount[$data][]=$value['fine_amount'];
                                                                                //$gross_amount[]=$value['total_amount'];
                                                                            }
                                                                            else
                                                                            {
                                                                                $comp_amount[$data][]=0;
                                                                                $total_amount[$data][]=0;
                                                                                $concession_amount[$data][]=0;
                                                                                $fine_amount[$data][]=0;
                                                                                //$gross_amount[]=0;
                                                                                $receipt_no[$data][]='';
                                                                            }
                                                                            
                                                                        }
                                                                    }
                                                                    foreach ($fee_order_value as $data) 
                                                                    { 
                                                                        //$receipt_no=array_filter($receipt_no);
                                                                        $arr=array_values(array_filter($receipt_no[$data]));
                                                                       if(!empty($arr))
                                                                       {
                                                                        ?>
                                                                        <td><?= min($arr) ?> - <?= max($arr) ?>
                                                                        </td>
                                                                        <?php
                                                                       }
                                                                       else
                                                                       {
                                                                        ?><td></td><?php
                                                                       }
                                                                        ?>
                                                                        
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($comp_amount[$data]);
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($concession_amount[$data]);
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($fine_amount[$data]);
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($total_amount[$data]);
                                                                            $gross_amount+=$sum;
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $receipt_no=[];
                                                                    $total_amount=0;
                                                                    $concession_amount=0;
                                                                    $fine_amount=0;
                                                                    $comp_amount=[];
                                                                    foreach ($category_data as $key => $value) 
                                                                    {

                                                                        $receipt_no[]=$value['receipt_no'];
                                                                        $total_amount+=$value['total_amount'];
                                                                        $gross_amount+=$value['total_amount'];
                                                                        $concession_amount+=$value['concession_amount'];
                                                                        $fine_amount+=$value['fine_amount'];
                                                                        foreach ($fee_order_value as $data) 
                                                                        { 
                                                                            if(!empty($value[$data]))
                                                                            {
                                                                                $comp_amount[$data][]=array_sum($value[$data]);
                                                                                
                                                                            }
                                                                            else
                                                                            {
                                                                                $comp_amount[$data][]=0;
                                                                            }
                                                                            
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <td><?= min($receipt_no) ?> - <?= max($receipt_no) ?></td>
                                                                    <?php
                                                                    
                                                                    foreach ($fee_order_value as $data) 
                                                                    { 
                                                                        ?>
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($comp_amount[$data]);
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <td><?= $concession_amount ?></td>
                                                                    <td><?= $fine_amount ?></td>
                                                                    <td><?= $total_amount ?></td>
                                                                    <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $receipt_no=[];
                                                                $total_amount=0;
                                                                $concession_amount=0;
                                                                $fine_amount=0;
                                                                $comp_amount=[];
                                                                foreach ($category_data as $key => $value) 
                                                                {

                                                                    $receipt_no[]=$value['receipt_no'];
                                                                    $total_amount+=$value['total_amount'];
                                                                    $gross_amount+=$value['total_amount'];
                                                                    $concession_amount+=$value['concession_amount'];
                                                                    $fine_amount+=$value['fine_amount'];
                                                                    foreach ($fee_order_value as $data) 
                                                                    {
                                                                        if(!empty($value[$data]))
                                                                        {
                                                                            $comp_amount[$data][]=array_sum($value[$data]);
                                                                        }
                                                                        else
                                                                        {
                                                                            $comp_amount[$data][]=0;
                                                                        }
                                                                        
                                                                    }
                                                                }
                                                                ?>
                                                                <td><?= min($receipt_no) ?> - <?= max($receipt_no) ?></td>
                                                                <?php

                                                                foreach ($fee_order_value as $data) 
                                                                { 
                                                                    ?>
                                                                    <td>
                                                                        <?php
                                                                        echo $sum = array_sum($comp_amount[$data]);
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td><?= $concession_amount ?></td>
                                                                <td><?= $fine_amount ?></td>
                                                                <td><?= $total_amount ?></td>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    if($fee_order_key==1)
                                                    {
                                                        if($individual=='Individual')
                                                        {
                                                            ?>
                                                           
                                                            <?php
                                                            foreach ($fee_order_value as $data) 
                                                            {
                                                                ?>
                                                                 <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <td></td>
                                                            <?php
                                                            foreach ($fee_order_value as $data) 
                                                            {
                                                                ?>
                                                                <td>
                                                                </td>
                                                                <?php
                                                            }
                                                             ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <td></td>
                                                        <?php
                                                        foreach ($fee_order_value as $data) 
                                                        {
                                                            ?>
                                                            <td>
                                                            </td>
                                                            <?php
                                                        }
                                                         ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <?php
                                                    }
                                                    
                                                }
                                            }

                                            ?>
                                            <th style="text-align: right;"><?= $gross_amount ?></th>
                                        </tr>
                                        <?php
                                        $overall_gross_amount+=$gross_amount;
                                        }
                                        ?>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="100" style="text-align: right;"><?= $overall_gross_amount ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                <?php
                } ?>
                <?php
                $fee_order=[];
                if(!empty($dailyCollection))
                { ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12  table-responsive">
                                <center>
                                    <h3>Component Wise Collection</h3>
                                    <h4><?= date('d-M-Y',strtotime($date_from)) ?> to <?= date('d-M-Y',strtotime($date_to)) ?></h4>
                                </center>
                                <div class="table-responsive">
                                <table class="table table-bordered " style="text-align: center !important;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center !important;" rowspan="2">Date</th>
                                            <?php
                                            foreach ($getFeeCategories as $feeCategory) {
                                                if($feeCategory->fee_collection=='Individual')
                                                {
                                                    ?>
                                                    <th style="text-align: center !important;" colspan="<?= sizeof($feeCategory->fee_types)+sizeof($feeCategory->fee_types)+6 ?>"><?= $feeCategory->name ?></th>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <th style="text-align: center !important;" colspan="<?= sizeof($feeCategory->fee_types)+5 ?>"><?= $feeCategory->name ?></th>
                                                    <?php
                                                }
                                            }?>
                                            <th style="text-align: center !important;" rowspan="2">Total Amount</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            foreach ($getFeeCategories as $feeCategory) {
                                                if($feeCategory->fee_collection=='Individual')
                                                {
                                                    $individual=$feeCategory->fee_collection;
                                                    foreach ($feeCategory->fee_types as $fee_type) {
                                                    
                                                        ?>
                                                        <th style="text-align: center !important;">Receipt No.</th>
                                                        <th style="text-align: center !important;"><?= $fee_type->fee_type_role->name ?></th>
                                                        <?php
                                                        $fee_order[$feeCategory->id][]=$fee_type->fee_type_role->id;
                                                        $fee_order[$feeCategory->id][]=$feeCategory->id.'_oldfee';
                                                        ?>
                                                        <th style="text-align: left !important;">Old Fee</th>
                                                        <th style="text-align: left !important;">Concession</th>
                                                    <th style="text-align: left !important;">Fine</th>
                                                    <th style="text-align: left !important;">Total</th>
                                                    <?php
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                    <th style="text-align: center !important;">Receipt No.</th>
                                                    <?php
                                                    foreach ($feeCategory->fee_types as $fee_type) {
                                                        ?>
                                                        <th style="text-align: center !important;"><?= $fee_type->name ?></th>
                                                        <?php
                                                        $fee_order[$feeCategory->id][]=$fee_type->id;
                                                        
                                                    }
                                                    $fee_order[$feeCategory->id][]=$feeCategory->id.'_oldfee';
                                                    ?>
                                                    <th style="text-align: left !important;">Old Fee</th>
                                                    <th style="text-align: left !important;">Concession</th>
                                                    <th style="text-align: left !important;">Fine</th>
                                                    <th style="text-align: left !important;">Total</th>
                                                    <?php
                                                }
                                            }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                        $overall_gross_amount=0;
                                        foreach ($dailyCollection as $receipt_date => $category) 
                                        {
                                            $gross_amount=0;
                                            ?>
                                            <tr>
                                            <td><?= date('d-M-Y',$receipt_date) ?></td>
                                            <?php

                                            foreach ($fee_order as $fee_order_key => $fee_order_value) 
                                            {
                                                if(array_key_exists($fee_order_key, $category))
                                                {
                                                    foreach ($category as $category_id => $category_data) 
                                                    { 
                                                        if($category_id==$fee_order_key)
                                                        {
                                                            
                                                            if($category_id==1)
                                                            {
                                                                if($individual=='Individual')
                                                                {
                                                                    $receipt_no=[];
                                                                    $total_amount=[];
                                                                    $concession_amount=[];
                                                                    $fine_amount=[];
                                                                    $comp_amount=[];
                                                                    
                                                                    foreach ($category_data as $key => $value) 
                                                                    {
                                                                        foreach ($fee_order_value as $data) 
                                                                        {
                                                                            if(!empty($value[$data]))
                                                                            {
                                                                                $comp_amount[$data][]=$value[$data];

                                                                                $total_amount[$data][]=$value['total_amount'];
                                                                                $receipt_no[$data][]=$value['receipt_no'];
                                                                                $concession_amount[$data][]=$value['concession_amount'];
                                                                                $fine_amount[$data][]=$value['fine_amount'];
                                                                                //$gross_amount[]=$value['total_amount'];
                                                                            }
                                                                            else
                                                                            {
                                                                                $comp_amount[$data][]=0;
                                                                                $total_amount[$data][]=0;
                                                                                $concession_amount[$data][]=0;
                                                                                $fine_amount[$data][]=0;
                                                                                //$gross_amount[]=0;
                                                                                $receipt_no[$data][]='';
                                                                            }
                                                                            
                                                                        }
                                                                    }
                                                                    foreach ($fee_order_value as $data) 
                                                                    { 
                                                                        //$receipt_no=array_filter($receipt_no);
                                                                        $arr=array_values(array_filter($receipt_no[$data]));
                                                                       if(!empty($arr))
                                                                       {
                                                                        ?>
                                                                        <td><?= min($arr) ?> - <?= max($arr) ?>
                                                                        </td>
                                                                        <?php
                                                                       }
                                                                       else
                                                                       {
                                                                        ?><td></td><?php
                                                                       }
                                                                        ?>
                                                                        
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($comp_amount[$data]);
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($concession_amount[$data]);
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($fine_amount[$data]);
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($total_amount[$data]);
                                                                            $gross_amount+=$sum;
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $receipt_no=[];
                                                                    $total_amount=0;
                                                                    $concession_amount=0;
                                                                    $fine_amount=0;
                                                                    $comp_amount=[];
                                                                    foreach ($category_data as $key => $value) 
                                                                    {

                                                                        $receipt_no[]=$value['receipt_no'];
                                                                        $total_amount+=$value['total_amount'];
                                                                        $gross_amount+=$value['total_amount'];
                                                                        $concession_amount+=$value['concession_amount'];
                                                                        $fine_amount+=$value['fine_amount'];
                                                                        foreach ($fee_order_value as $data) 
                                                                        { 
                                                                            if(!empty($value[$data]))
                                                                            {
                                                                                $comp_amount[$data][]=array_sum($value[$data]);
                                                                            }
                                                                            else
                                                                            {
                                                                                $comp_amount[$data][]=0;
                                                                            }
                                                                            
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <td><?= min($receipt_no) ?> - <?= max($receipt_no) ?></td>
                                                                    <?php
                                                                    
                                                                    foreach ($fee_order_value as $data) 
                                                                    { 
                                                                        ?>
                                                                        <td>
                                                                            <?php
                                                                            echo $sum = array_sum($comp_amount[$data]);
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <td><?= $concession_amount ?></td>
                                                                    <td><?= $fine_amount ?></td>
                                                                    <td><?= $total_amount ?></td>
                                                                    <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $receipt_no=[];
                                                                $total_amount=0;
                                                                $concession_amount=0;
                                                                $fine_amount=0;
                                                                $comp_amount=[];
                                                                foreach ($category_data as $key => $value) 
                                                                {

                                                                    $receipt_no[]=$value['receipt_no'];
                                                                    $total_amount+=$value['total_amount'];
                                                                    $gross_amount+=$value['total_amount'];
                                                                    $concession_amount+=$value['concession_amount'];
                                                                    $fine_amount+=$value['fine_amount'];
                                                                    foreach ($fee_order_value as $data) 
                                                                    {
                                                                        if(!empty($value[$data]))
                                                                        {
                                                                            $comp_amount[$data][]=array_sum($value[$data]);
                                                                        }
                                                                        else
                                                                        {
                                                                            $comp_amount[$data][]=0;
                                                                        }
                                                                        
                                                                    }
                                                                }
                                                                ?>
                                                                <td><?= min($receipt_no) ?> - <?= max($receipt_no) ?></td>
                                                                <?php

                                                                foreach ($fee_order_value as $data) 
                                                                { 
                                                                    ?>
                                                                    <td>
                                                                        <?php
                                                                        echo $sum = array_sum($comp_amount[$data]);
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <td><?= $concession_amount ?></td>
                                                                <td><?= $fine_amount ?></td>
                                                                <td><?= $total_amount ?></td>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    if($fee_order_key==1)
                                                    {
                                                        if($individual=='Individual')
                                                        {
                                                            ?>
                                                           
                                                            <?php
                                                            foreach ($fee_order_value as $data) 
                                                            {
                                                                ?>
                                                                 <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <td></td>
                                                            <?php
                                                            foreach ($fee_order_value as $data) 
                                                            {
                                                                ?>
                                                                <td>
                                                                </td>
                                                                <?php
                                                            }
                                                             ?>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <td></td>
                                                        <?php
                                                        foreach ($fee_order_value as $data) 
                                                        {
                                                            ?>
                                                            <td>
                                                            </td>
                                                            <?php
                                                        }
                                                         ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <?php
                                                    }
                                                    
                                                }
                                            }

                                            ?>
                                            <th style="text-align: right;"><?= $gross_amount ?></th>
                                        </tr>
                                        <?php
                                        $overall_gross_amount+=$gross_amount;
                                        }
                                        ?>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="100" style="text-align: right;"><?= $overall_gross_amount ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('validate') ?> 
<?= $this->element('daterangepicker') ?>
<?= $this->element('icheck') ?>
<?php
$js="
$(document).ready(function(){
    $('#ServiceForm').validate({ 
        rules: {
            'fee_category_id[]': {
              required: true,
              minlength: 1
          }
        }
    });
    $(document).on('ifChanged', '.check_all', function(){
        if($(this).is(':checked')){
            $('.checkone').each(function(){
                $(this).attr('checked',true).iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });
                $(this).closest('div').addClass('checked');
            });
        }
        else
        {
            $('.checkone').each(function(){
                $(this).attr('checked',false).iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });
            });
        }
    });
    $(document).on('change', '#medium_id', function(e){
        var medium_id = $(this).val();
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getClass.json'])."';
        $.post(
            url, 
            {medium_id: medium_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#student_class_id').html(obj.response);
        });
    });
    $(document).on('change', '#student_class_id', function(e){
        var student_class_id = $(this).val();
        url = '".$this->Url->build(['controller'=>'FeeTypeMasters','action'=>'getStream.json'])."';
        $.post(
            url, 
            {student_class_id: student_class_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#stream_id').html(obj.response);
        });
    });
});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>