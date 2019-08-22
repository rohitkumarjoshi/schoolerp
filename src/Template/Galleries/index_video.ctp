<?php $cdn_path = $awsFileLoad->cdnPath(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Video List </label>
            </div>
            <div class="box-body">
                <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= h('S.No.') ?></th>
                            <th scope="col"><?= h('Role') ?></th>
                            <th scope="col"><?= h('Title') ?></th>  
                            <th scope="col"><?= h('Description ') ?></th> 
                            <th scope="col"><?= h('Play') ?></th> 
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=0; foreach ($galleries as $gallery): ?>
                        <tr>
                            <td><?= ++$x ?></td>
                            <td><?= h($gallery->role_type) ?></td> 
                            <td><?= h($gallery->title) ?></td>    
                            <td><?= h($gallery->description)?></td>   
                            <td class="actions"><a class=" btn btn-primary btn-sm" target="_blank" href="<?=$gallery->cover_image ?>" ><i class="fa fa-youtube-play"></i></a></td>   
                            <td class="actions">
                               <a class=" btn btn-danger btn-sm" data-target="#deletemodal<?php echo $gallery->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                <div id="deletemodal<?php echo $gallery->id; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-md" >
                                    <?= $this->Form->create('',['url'=>['controller'=>'Galleries','action'=>'audioDelete',$gallery->id]]) ?>
                                            <div class="modal-content">
                                              <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" >
                                                        Stay Attention
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                <h4 class="modal-title">
                                                    Are you sure you want to remove this Audio ?
                                                    </h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-sm btn-info">Yes</button>
                                                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        <?= $this->Form->end() ?>
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