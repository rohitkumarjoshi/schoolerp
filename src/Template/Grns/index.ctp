<div class="row">	
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border" >
					<label> Goods Receive Note</label>
			</div>
			<div class="box-body table-responsive content-scroll" style="width: 100% !important;">
				 <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
				<div>
					<table class="table table-striped" >
						<thead>
							<tr style="white-space: nowrap;">
								<th scope="col"><?=__('Sr')?></th>
								<th scope="col"><?=__('Grn No')?></th>
								<th scope="col"><?=__('Transaction Date') ?></th>
								<th scope="col"><?=__('Vandor Name') ?></th>
								<th scope="col"><?=__('Grand Total') ?></th>
								<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
						<?php $x=0; foreach($grns  as $grn){?>
							<tr>
								<td><?php echo ++$page_no;?></td>
								<td><?=h ($grn->grn_no)?></td>
								<td><?=h ($grn->transaction_date->format('d-m-Y'))?></td>
								<td><?=h ($grn->vendor->name)?></td>
								<td><?=h ($grn->grand_total)?></td>
								<td class="actions">
									<?php echo $this->Html->image('editicon.png',['url'=>['controller'=>'Grns','action'=>'edit',$EncryptingDecrypting->encryptData($grn->id)],'class'=>'tooltips showLoader','data-original-title'=>'Edit grn','data-container'=>'body','data-widget'=>'Edit grn']);?>
									
									<?php echo $this->Html->image('ViewIcon.png',['url'=>['controller'=>'Grns','action'=>'View',$EncryptingDecrypting->encryptData($grn->id)],'class'=>'tooltips showLoader','data-original-title'=>'View grn','data-container'=>'body','data-widget'=>'View grn',]);?>
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

