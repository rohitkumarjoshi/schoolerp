<div class="box box-primary">
                <div class="box-header with-border"> 
                    <h3 class="box-title" >Expenses Report</h3><hr>
                    <?= $this->Form->create($expense,['id'=>'ServiceForm','type'=>'get']) ?>
                    <div class="row ">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="control-label">Search By Category</label>
                                    <?= $this->Form->control('data[category_id]', ['options' =>$expenseCategories,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Category','dataplaceholder'=>'Select Category','autocomplete'=>'off'])?>
                                </div>   
                                <div class="col-md-4">
                                    <label class="control-label">Search By Sub-Category</label>
                                    <?= $this->Form->control('data[sub_category_id]', ['options' =>$expenseSubcategories,'label' => false, 'class'=>'select2 ','style'=>'width:100%','empty'=>'Select Sub-Category','dataplaceholder'=>'Select Sub-Category','autocomplete'=>'off'])?>
                                </div> 
                                <div class="col-md-4">
                                    <label class="control-label">Search By Vehicle</label>
                                   <?= $this->Form->control('data[vehicle_id]', ['options' => $vehicles,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Vehicle','dataplaceholder'=>'Select Vehicle'])?>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="col-md-4">
                                        <label class="control-label"> Date From </label>
                                       <?= $this->Form->control('data[expense_date >=]', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','style'=>'height:40px;','value'=>@$_GET['data']['expense_date >=']])?>
                                    </div> 
                                    <div class="col-md-4">
                                        <label class="control-label">Date To </label>
                                       <?= $this->Form->control('data[expense_date <=]', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy','style'=>'height:40px;','value'=>@$_GET['data']['expense_date <=']])?>
                                    </div> 
                                    <div class="col-md-1">
                                        <label class="control-label"  style=" visibility: hidden;">Search</label>
                                         <?php echo $this->Form->button('Search',['class'=>'btn btn-md btn-success filter','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'margin-right: 0px;color:white !important;height:38px;']); ?> 
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label"  style="visibility: hidden;">Search</label>
                                        <?= $this->Html->link(__('Reset '), ['action' => 'report'],['class'=>'btn btn-danger btn-md','escape'=>false, 'data-widget'=>'Home', 'data-toggle'=>'tooltip', 'data-original-title'=>'Home','style'=>'margin-right: 0px;color:white !important;height:38px;margin-top:24px;']) ?>
                                    </div> 
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                <?php if($data_exist=='data_exist') { ?>
                <div class="box-body" >
                     <?php $page_no=$this->Paginator->current('Expenses'); $page_no=($page_no-1)*20; ?>
                         <div class="row">
                            <div class="col-md-4 col-md-offset-8 text-right">
                                <table class="pull-right">
                                    <tr>
                                        <td>
                                            <?= $this->Form->create($expense,['autocomplete'=>'off','url'=>['action'=>'reportExport']]) ?>
                                                <?php if (isset($where)): ?>
                                                    <?php foreach ($where as $key => $value): ?>
                                                        <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                                <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info'])?>
                                            <?= $this->Form->end() ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <table cellpadding="0" cellspacing="0" class="table">
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
                        <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <?= $this->element('pagination') ?> 
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                         <div class="row">
                            <div class="col-md-12 text-center">
                                <h3> <?= $data_exist ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
<?= $this->element('datepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 