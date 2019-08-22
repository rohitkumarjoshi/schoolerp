<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookIssueReturn[]|\Cake\Collection\CollectionInterface $bookIssueReturns
 */
?>

<style type="text/css">
    .autofill_list{
        max-height: 100px;
        position: absolute;
        width: 100%;
        overflow: overlay;
        z-index: 1;
    }
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <b> Inwards Report </b>
                </div>
                <div class="box-body">
                    <?= $this->Form->create($inward,['autocomplete'=>'off']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Party Name</label>
                                <?php echo $this->Form->control('data[party-name]', ['options' => '', 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'party-id','valueField'=>'party_name','keyField'=>'party_name']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Person Name</label>
                                <?php echo $this->Form->control('data[person_name]', ['options' => '', 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'person-id','valueField'=>'person_name','keyField'=>'person_name']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Department Name</label>
                                <?php echo $this->Form->control('data[department_id]', ['options' => '', 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'dept-id']);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> Date From to To
                                      </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                      <?= $this->Form->control('data[form_to_date]',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range','readonly'=>true]) ?>
                                    </div>
                                </div> 
                                
                            </div>
                            <div class="col-sm-4 text-center">
                                <?= $this->Form->submit('search',['class'=>'btn btn-success btnClass'])?>
                            </div>
                        </div>
                <?= $this->Form->end(); ?>

                <?php if($data_exist=='data_exist') { ?>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($inward,['autocomplete'=>'off','url'=>['action'=>'inwardExport']]) ?>
                                            <?php if (isset($where)): ?>
                                                <?php foreach ($where as $key => $value): ?>
                                                    <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info'])?>
                                        <?= $this->Form->end() ?>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
                     <table id="example1" class="table">
                        <thead>
                           <tr style="white-space: nowrap;">
                                <th>Sr</th>
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
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <?= $this->element('pagination') ?> 
                </div>
            <?php } else { ?>
             <div class="row">
                <div class="col-md-12 text-center">
                    <h3> <?= $data_exist ?></h3>
                </div>
            </div>
            <?php } ?>
            </div>
        </div>
    </div>

<?= $this->element('autofill',['table'=>'Inwards','selector'=>'#person-id']) ?>
<?= $this->element('autofill',['table'=>'Inwards','selector'=>'#party-id']) ?>
<?= $this->element('autofill',['table'=>'Departments','selector'=>'#dept-id']) ?>
<?= $this->element('daterangepicker') ?>
<?= $this->element('validate') ?>

