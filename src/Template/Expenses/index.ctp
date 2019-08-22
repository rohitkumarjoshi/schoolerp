<div class="box box-primary">
                <div class="box-header with-border"> 
                    <h3 class="box-title" >Expenses</h3><hr>
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
                                        <?= $this->Html->link(__('Reset '), ['action' => 'index'],['class'=>'btn btn-danger btn-md','escape'=>false, 'data-widget'=>'Home', 'data-toggle'=>'tooltip', 'data-original-title'=>'Home','style'=>'margin-right: 0px;color:white !important;height:38px;margin-top:24px;']) ?>
                                    </div> 
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                <?php if($data_exist=='data_exist') { ?>
                <div class="box-body" >
                     <?php $page_no=$this->Paginator->current('Expenses'); $page_no=($page_no-1)*20; ?>
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <table cellpadding="0" cellspacing="0" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?= ('Sr.No') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('expense_category_id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('expense_subcategory_id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('vehicle_id') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('expense_by') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('expense_date') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('payment_mode') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('cheque_no') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('cheque_date') ?></th>
                                            <th scope="col"><?= $this->Paginator->sort('bank_name') ?></th>
                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;foreach ($expenses as $expense): ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?= $expense->has('expense_category') ? $this->Html->link($expense->expense_category->name, ['controller' => 'ExpenseCategories', 'action' => 'view', $expense->expense_category->id]) : '' ?></td>
                                                <td><?= $expense->has('expense_subcategory') ? $this->Html->link($expense->expense_subcategory->name, ['controller' => 'ExpenseSubcategories', 'action' => 'view', $expense->expense_subcategory->id]) : '' ?></td>
                                                <td><?= $this->Number->format($expense->amount) ?></td>
                                                <td><?= $expense->has('vehicle') ? $this->Html->link($expense->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $expense->vehicle->id]) : '' ?></td>
                                                <td><?= h($expense->employee->name) ?></td>
                                                <td><?= h($expense->expense_date) ?></td>
                                                <td><?= h($expense->payment_mode) ?></td>
                                                <td><?= h($expense->cheque_no) ?></td>
                                                <td><?= h($expense->cheque_date) ?></td>
                                                <td><?= h($expense->bank_name) ?></td>
                                                <td class="actions">
                                                   <?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($expense->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit expense', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit expense']) ?>
                                                   <!--  <?= $this->Html->link(__('<i class="fa fa-eye"></i>'), ['action' => 'view', $EncryptingDecrypting->encryptData($expense->id)],['class'=>'btn viewbtn btn-xs','escape'=>false, 'data-widget'=>'View', 'data-toggle'=>'tooltip', 'data-original-title'=>'View']) ?> -->
                                                </td>
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