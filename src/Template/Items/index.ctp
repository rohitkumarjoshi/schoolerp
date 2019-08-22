<div class="box box-primary">
	<div class="box-header with-border">
			<label>Item Details</label>
	</div>
	<div class="row">	
		<?= $this->Form->create($items,['id'=>'ServiceForm']) ?>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body table-responsive content-scroll" style="width: 100% !important;">
					 <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
					<div>
						<table class="table table-striped" >
							<thead>
								<tr style="white-space: nowrap;">
									<th>Sr</th>
									<th scope="col"><?=__('Item Categories')?></th>
									<th scope="col"><?=__('Item Sub Categories') ?></th>
									<th scope="col"><?=__('New Item') ?></th>
									<th scope="col"><?= __('Status ') ?></th>
									<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $x=0; foreach($ItemLists as $ItemList){ ?>
								<tr>
									<td><?php echo ++$page_no;?></td>
									<td><?=h ($ItemList->item_category->name)?></td>
									<td><?=h ($ItemList->item_subcategory->name)?></td>
									<td><?=h ($ItemList->name)?></td>
									
									<td>
										<?php
										if($ItemList->is_deleted=='Y')
										{
											echo 'Deactive';
										}
										else{
											echo 'Active';
										}
										?>
									</td>
									<td class="actions">
										<?php echo $this->Html->image('editicon.png',['url'=>['controller'=>'Items','action'=>'edit',$EncryptingDecrypting->encryptData($ItemList->id)],'class'=>'tooltips showLoader','data-original-title'=>'Edit Item','data-container'=>'body']);?>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="box-footer">
					<?= $this->element('pagination') ?> 
				</div>
			</div>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>
