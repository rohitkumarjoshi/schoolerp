<div class="row">	
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
				<label> Purchase Order</label>
			</div>
			<div class="box-body table-responsive content-scroll" style="width: 100% !important;">
				 <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
				<div>
					<table id="example1" class="table table-str table-striped" style="border-collapse:collapse;">
					
						<thead>
							<tr style="white-space: nowrap;">
								<th scope="col"><?=__('Sr')?></th>
								<th scope="col"><?=__('Purchase No')?></th>
								<th scope="col"><?=__('Transaction Date') ?></th>
								<th scope="col"><?=__('Vandor Name') ?></th>
								<th scope="col"><?=__('Grand Total') ?></th>
								<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
						<?php $x=0; foreach($purchaseOrders as $purchaseOrder){?>
							<tr>
								<td><?php echo ++$page_no;?></td>
								<td><?=h ($purchaseOrder->po_no)?></td>
								<td><?=h ($purchaseOrder->transaction_date->format('d-m-Y'))?></td>
								<td><?=h ($purchaseOrder->vendor->name)?></td>
								<td><?=h ($purchaseOrder->grand_total)?></td>
								<td class="actions">
									<?php echo $this->Html->image('editicon.png',['url'=>['controller'=>'purchaseOrders','action'=>'edit',$EncryptingDecrypting->encryptData($purchaseOrder->id)],'class'=>'tooltips showLoader','data-original-title'=>'Edit purchaseOrder','data-container'=>'body']);?>
									
									<?php echo $this->Html->image('ViewIcon.png',['url'=>['controller'=>'purchaseOrders','action'=>'View',$EncryptingDecrypting->encryptData($purchaseOrder->id)],'class'=>'tooltips showLoader','data-original-title'=>'View purchaseOrder','data-container'=>'body','data-widget'=>'View purchaseOrder',]);?>
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

