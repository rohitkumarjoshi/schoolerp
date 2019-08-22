 <?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label> Notice List </label>
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
                                    <label class="control-label">Select Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                     <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range','data-date-format'=>'dd-mm-yyyy']) ?> 
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Title</label>
                                    
                                    <?php echo $this->Form->control('title',[
                                    'label' => false,'class'=>'form-control','empty'=>'Select...','type' => 'text','placeholder'=>'Title']);?>     
                                </div>
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <a href="<?php echo $this->Url->build(array('controller'=>'SchoolNotices','action'=>'studentView')) ?>"class="btn btn-danger btn-sm">Reset</a>
                                    <?php echo $this->Form->button('Apply',['class'=>'btn btn-sm btn-success']); ?>
                                </div> 
                            </div>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
                <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= h('S. No.') ?></th>
                            <th scope="col"><?= h('Title') ?></th>
                            <th scope="col"><?= h('Valid Till') ?></th> 
                            <th scope="col"><?= h('Description') ?></th>   
                            <th scope="col"><?= h('Download') ?></th>   
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=0;foreach ($schoolNotices as $schoolNotice): ?>
                        <tr>
                            <td><?= ++$x; ?></td>
                            <td><?= h($schoolNotice->title) ?></td>
                            <td><?= h($schoolNotice->valid_date) ?></td> 
                            <td><?= h($schoolNotice->description) ?></td>
                            <td class="actions">
                                <?php if($schoolNotice->doc_file){ ?>
                                <a class="btn btn-success btn-sm" download="download" href="<?= $cdn_path.'/'.$schoolNotice->doc_file ?>" target="_blank"><i class="fa fa-download"></i></a>
                                <?php } ?>
                            </td> 
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->element('daterangepicker') ?>  
