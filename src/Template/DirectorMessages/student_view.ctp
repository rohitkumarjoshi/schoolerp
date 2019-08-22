<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <label> Director/Principal Message </label>
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
                                    <label class="control-label">Message by</label> 
                                    <?php $types['Principal']='Principal';?>
                                    <?php $types['Director']='Director';?>
                                    <?php echo $this->Form->control('msgby',[
                                    'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $types]);?>     
                                </div> 
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <a href="<?php echo $this->Url->build(array('controller'=>'DirectorMessages','action'=>'studentView')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
                <!--<?php $page_no=$this->Paginator->current('DirectorMessages'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th> 
                            <th scope="col"><?= __('Message By ') ?></th>
                            <th scope="col"><?= __('Message ') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($directorMessages as $directorMessage): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td> 
                            <td width="25%"><?= h(@$directorMessage->message_by) ?></td> 
                            <td width="65%"><?= h(@$directorMessage->message) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table> 
            </div>
        </div>
    </div> 
</div> 