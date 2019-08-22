<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inward $inward
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inward'), ['action' => 'edit', $inward->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inward'), ['action' => 'delete', $inward->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inward->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inwards'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inward'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Inward Details'), ['controller' => 'InwardDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inward Detail'), ['controller' => 'InwardDetails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inwards view large-9 medium-8 columns content">
    <h3><?= h($inward->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($inward->item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><?= h($inward->material) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vehicle No') ?></th>
            <td><?= h($inward->vehicle_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bill No') ?></th>
            <td><?= h($inward->bill_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bring By') ?></th>
            <td><?= h($inward->bring_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Remarks') ?></th>
            <td><?= h($inward->remarks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($inward->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inward->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($inward->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($inward->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($inward->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('In Time') ?></th>
            <td><?= h($inward->in_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($inward->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($inward->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($inward->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Inward Details') ?></h4>
        <?php if (!empty($inward->inward_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Inward Id') ?></th>
                <th scope="col"><?= __('Material') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($inward->inward_details as $inwardDetails): ?>
            <tr>
                <td><?= h($inwardDetails->id) ?></td>
                <td><?= h($inwardDetails->inward_id) ?></td>
                <td><?= h($inwardDetails->material) ?></td>
                <td><?= h($inwardDetails->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'InwardDetails', 'action' => 'view', $inwardDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'InwardDetails', 'action' => 'edit', $inwardDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'InwardDetails', 'action' => 'delete', $inwardDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inwardDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
