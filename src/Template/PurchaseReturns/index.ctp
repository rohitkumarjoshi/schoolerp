<div class="row">	
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label> Purchase Return</label>
			</div>
			<div class="box-body table-responsive content-scroll" style="width: 100% !important;">
				<?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
				<div>
					<table class="table" id="main_table">	
						<thead>
							<tr style="white-space: nowrap;">
								<th scope="col"><?=__('Sr')?></th>
								<th scope="col"><?=__('Voucher No')?></th>
								<th scope="col"><?=__('Item Name')?></th>
								<th scope="col"><?=__('Transaction Date') ?></th>
								<th scope="col"><?=__('Vandor Name') ?></th>
								<th scope="col"><?=__('Grand Total') ?></th>
								<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
						<?php $x=0; foreach($purchaseReturns  as $purchaseReturn){?>
							<tr>
								<td><?php echo ++$page_no;?></td>
								<td><?= ($purchaseReturn->voucher_no) ?></td>
								<td><?=h ($purchaseReturn->purchase_return_rows[0]->item->name)?></td>
								<td><?=h ($purchaseReturn->transaction_date->format('d-m-Y'))?></td>
								<td><?=h ($purchaseReturn->vendor->name)?></td>
								<td><?=h ($purchaseReturn->grand_total)?></td>
								<td class="actions">
									
									<?php echo $this->Html->image('editicon.png',['url'=>['controller'=>'PurchaseReturns','action'=>'edit', $EncryptingDecrypting->encryptData($purchaseReturn->id)],'class'=>'tooltips showLoader','data-original-title'=>'Purchase Return','data-container'=>'body','data-widget'=>'Edit Purchase Return']);?>
									<?php echo $this->Html->image('ViewIcon.png',['url'=>['controller'=>'PurchaseReturns','action'=>'View',$EncryptingDecrypting->encryptData($purchaseReturn->id)],'class'=>'tooltips showLoader','data-original-title'=>'View Purchase Return','data-container'=>'body','data-widget'=>'View Purchase Return',]);?>
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
	
</div>

