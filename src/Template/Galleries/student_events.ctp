<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Event List </label>
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
                                     <?= $this->Form->control('daterange',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range']) ?> 
                                    </div>    
                                </div>
                                <div class="col-md-12" align="center">
                                <hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
                                    <a href="<?php echo $this->Url->build(array('controller'=>'Galleries','action'=>'studentEvents')) ?>"class="btn btn-danger btn-sm">Reset</a>
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
                            <th scope="col"><?= h('S.No.') ?></th> 
                            <th scope="col"><?= h('Title') ?></th> 
                            <th scope="col"><?= h('Date From') ?></th>
                            <th scope="col"><?= h('Date To') ?></th>
                            <th scope="col"><?= h('Location') ?></th>
                            <th scope="col"><?= h('Time') ?></th> 
                            <th scope="col"><?= h('Schedules') ?></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=0; foreach ($galleries as $gallery): ?>
                        <tr>
                            <td><?= ++$x ?></td> 
                            <td><?= h($gallery->title) ?></td>
                            <td><?= h($gallery->date_from) ?></td>
                            <td><?= h($gallery->date_to) ?></td>
                            <td><?= h($gallery->event_location) ?></td>
                            <td><?= h($gallery->time_start) ?></td> 
                            <td>
                                <a class=" btn btn-primary btn-sm" data-target="#Details<?php echo $gallery->id; ?>" data-toggle="modal">Schedules</a>
                                    <div id="Details<?php echo $gallery->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                            <div class="modal-content">
                                              <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" >
                                                        Event Schedules
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                <table id="example1" class="table  table-striped" style="border-collapse:collapse;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><?= h('S.No.') ?></th> 
                                                            <th scope="col"><?= h('Name') ?></th>   
                                                            <th scope="col"><?= h('Date') ?></th>   
                                                            <th scope="col"><?= h('Time') ?></th>   
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  $a=0;
                                                        foreach ($gallery->event_schedules as $event_schedul) {?>
                                                         <tr>
                                                            <td><?= ++$a;?></td>
                                                            <td><?= $event_schedul->name ?></td>
                                                            <td><?= $event_schedul->schedule_date ?></td>
                                                            <td><?= $event_schedul->schedule_time ?></td>
                                                         </tr>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="box-footer">
                    <?= $this->element('pagination') ?> 
                </div>
            </div>
        </div>
    </div>
</div> 
<?= $this->element('daterangepicker') ?> 