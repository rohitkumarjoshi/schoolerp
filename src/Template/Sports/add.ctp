<?php
 $cdn_path = $awsFileLoad->cdnPath();
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
                     <label > Edit Sports Category </label>
                    <div class="box-tools pull-right">
                        <h3 class="box-title" style="padding:10px;color:gray;"><?= $this->Html->link(__('<i class="fa fa-plus"></i> '), ['action' => 'add'],['class'=>'','escape'=>false,'data-widget'=>'Add', 'data-toggle'=>'tooltip', 'data-original-title'=>'Add']) ?>
                        </h3>
                    </div>
                <?php }else{ ?>
                     <label> Add Sports Category </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($sports,['id'=>'ServiceForm','type'=>'file']) ?>
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
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Icon Image <?php $req = ""; if(empty($id)){  $req="required";?> <span class="required" aria-required="true"> * </span> <?php } ?></label> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <?php echo $this->Form->control('sport_image',[
                            'label' => false,'class'=>'','placeholder'=>'Enter Name','type'=>'file',$req]);?>
                        </div>
                    </div>
                    <?php if(!empty($id)){ ?>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Status </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <?php 
                                    $status[]=['value'=>'N','text'=>'Active'];
                                    $status[]=['value'=>'Y','text'=>'Deactive'];
                                ?>
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
                <!--<?php $page_no=$this->Paginator->current('citys'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Name ') ?></th> 
                            <th scope="col"><?= __('Icon ') ?></th> 
                            <th scope="col"><?= __('Status ') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($CategoriesList as $city): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td width="25%"><?php echo $city->name;?></td> 
                            <td width="25%"> <?= $this->Html->image($cdn_path.'/'.$city->sport_image,['style'=>  'margin-top: 0px;height: 50px; background-color: #f9eded00 !important;width: 50px;']); ?> </td> 
                            <td>
                            <?php
                            if($city->is_deleted=='Y')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
                            <td class="actions" align="center">
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'add', $EncryptingDecrypting->encryptData($city->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table> 
            </div>
        </div>
    </div>
</div>

<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            service: {
                required: true
            },
            state_id:{
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
<?= $this->element('selectpicker') ?> 