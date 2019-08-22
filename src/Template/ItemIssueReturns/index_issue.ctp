
<div class="box box-primary">
	<div class="box-header with-border" >
			<label> Item Issue </label>
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body table-responsive content-scroll" style="width: 100% !important;">
					<?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
					<div>
						<table class="table" id="main_table">
							<thead>
								<tr style="white-space: nowrap;">
									<th scope="col"><?=__('Sr')?></th>
									<th scope="col"><?=__('Location Id')?></th>
									<th scope="col"><?=__('Student Name ') ?></th>
									<th scope="col"><?=__('Employee Name') ?></th>
									<th scope="col"><?=__('Transaction Date') ?></th>
									<th scope="col"><?=__('Item Name') ?></th>
									<th scope="col"><?=__('Grand Total') ?></th>
									<th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $x=0; foreach($itemIssues as  $itemIssue) {?>
								<tr>
									<td><?php echo ++$page_no;?></td>
									<td><?=h ($itemIssue->item_issue_return_rows[0]->location_id)?></td>
									<td><?=($itemIssue->has('student')?$itemIssue->student->name:'-')?></td>
									<td><?=($itemIssue->has('employee')?$itemIssue->employee->name:'-')?></td>
									<td><?=h ($itemIssue->transaction_date)?></td>
									<td><?=h ($itemIssue->item_issue_return_rows[0]->item->name)?></td>
									<td><?=h ($itemIssue->grand_total)?></td>
									<td class="actions">
										<?php echo $this->Html->image('editicon.png',['url'=>['controller'=>'ItemIssueReturns','action'=>'editIssue',$EncryptingDecrypting->encryptData($itemIssue->id)],'class'=>'tooltips showLoader','data-original-title'=>'Edit itemIssue','data-container'=>'body','data-widget'=>'Edit itemIssue']);?>
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
</div>

