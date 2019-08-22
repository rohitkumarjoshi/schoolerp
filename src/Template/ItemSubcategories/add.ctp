<div class="row">
	<div class="col-md-5"">
		<div class="box box-primary">
			<div class="box-header with-border">
				<?php if(!empty($id)){ ?>
					 <label > Edit Sub Category</label>
				<?php }else{ ?>
					 Add Sub Category </label>
				<?php } ?>
			</div>
			<div class="box-body">
				<div class="form-group">	
					<?= $this->Form->create($itemSubCategory,['id'=>'ServiceForm']) ?>
					
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Select Category <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('item_category_id',['options' =>$itemCategories,'label' => false,'class'=>'select2 selectState','empty'=> 'Select...','style'=>'width:100%','required']);?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<label class="control-label"> Sub Category <span class="required" aria-required="true"> * </span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<?php echo $this->Form->control('name',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Name','type'=>'text','id'=>'txtFirstName']);?>
						</div>
					</div>
					<?php if(!empty($id)){ ?>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Status</label>
                        </div>
					</div>
					<div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'class'=>' select2 selectState','style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
					<br>
					<div class="box-footer">
						<div class="row">
							<center>
								<div class="col-md-12">
									<div class="col-md-offset-3 col-md-6">	
										<?php echo $this->Form->button('SUBMIT',['class'=>'btn button','id'=>'submit_member']); ?>
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
				<table id="example1" class="table table-striped" style="border-collapse:collapse;">
					<thead>
						<tr>
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Name ') ?></th>
							<th scope="col"><?= __('Item Category ') ?></th>
							<th scope="col"><?= __('Status ') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $x=0; foreach ($ItemSubCategoriesLists as $ItemSubCategoriesList){?>
						<tr>
							<td><?= ++$x; ?></td>
							<td><?= h($ItemSubCategoriesList->name)?></td>
							<td><?= h($ItemSubCategoriesList->item_category->name) ?></td>
							<td>
                            <?php
                            if($ItemSubCategoriesList->is_deleted=='Y')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
							<td class="actions">
                               <?php echo $this->Html->image('editicon.png',['url'=>['controller'=>'ItemSubcategories','action'=>'add',$EncryptingDecrypting->encryptData($ItemSubCategoriesList->id)],'class'=>'tooltips showLoader','data-original-title'=>'Edit Item Sub Categories','data-container'=>'body','data-widget'=>'Edit ItemSubCategoriesList']);?>
							</td>
						</tr>
						<?php } ?>
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
            name: {
                required: true
            },
            item_category_id: {
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
