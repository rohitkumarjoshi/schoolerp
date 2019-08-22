<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                 <label> Directories List </label>
                 <div class="box-tools pull-right">
                    <a style="font-size:19px;" class="btn btn-box-tool" data-target="#FilterModel" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
                </div>
            </div> 
            <div class="box-body">
                <?= $this->Form->create('FilterForm',['type'=>'get']) ?>
                <div class="collapse"  id="FilterModel" aria-expanded="false"> 
                    <fieldset style="text-align:left;"><legend>Filter</legend>
                        <div class="col-md-12">
                            <div class="row"> 
                                <div class="col-md-6">
                                    <label class="control-label">Select</label>
                                    <?= $this->Form->control('emp_id', ['options'=>$employees,'label' => false, 'class'=>'select2','empty'=>'Select Employee','style'=>'width:100%'])?>     
                                </div> 
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <a href="<?php echo $this->Url->build(array('controller'=>'Directories','action'=>'studentView')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
                <!--<?php $page_no=$this->Paginator->current('Directories'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Employee Name ') ?></th> 
                            <th scope="col"><?= __('Mobile No ') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($directories as $directory): ?>
                        <tr>
                            <td width="20%"><?php echo ++$page_no;?></td>
                            <td width="35%"><?php echo $directory->employee->name;?></td> 
                            <td width="35%"><?php echo $directory->mobile_no;?></td>  
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
                </table>
                <?= $this->element('pagination') ?> 
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 