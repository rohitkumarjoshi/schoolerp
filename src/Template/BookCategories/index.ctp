<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                         <label > Edit Category </label>
                    <?php }else{ ?>
                         <label> Add Category </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($category,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Name <span class="required" aria-required="true"> * </span></label>
                            </div>
						</div>
						<div class="row">
                            <div class="col-md-11">
                                <?php echo $this->Form->control('name',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
                                        </div>
                                    </div>
                                </center>       
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="box box-primary">
                <div class="box-header with-border">
                   <label> View List </label>
                </div> 
                <div class="box-body">
                     <table id="example1" class="table  table-striped" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= __('Name ') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($categories as $Category): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td>
                                <?php echo $Category->name;?>
                                </td>
                            <td class="actions">
                                  
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($Category->id)],['class'=>'btn btn-info btn-lg editbtn','escape'=>false]) ?>

                                    <!-- <a class=" btn btn-danger btn-lg deletebtn" data-target="#deletemodal<?php echo $Category->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $Category->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm1','url'=>['controller'=>'BookCategories','action'=>'delete',$Category->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to remove this Category ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn  btn-sm btn-info">Yes</button>
                                                        <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div> -->
                             </td>
							
                                </tr>
                        <?php $i++; endforeach; ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            name: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>