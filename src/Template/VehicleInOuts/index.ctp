<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VehicleInOut[]|\Cake\Collection\CollectionInterface $vehicleInOuts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Vehicle In Out'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vehicles'), ['controller' => 'Vehicles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vehicle'), ['controller' => 'Vehicles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vehicleInOuts index large-9 medium-8 columns content">
    <h3><?= __('Vehicle In Outs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vehicle_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vehicle_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('in_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('in_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('out_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('out_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remarks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicleInOuts as $vehicleInOut): ?>
            <tr>
                <td><?= $this->Number->format($vehicleInOut->id) ?></td>
                <td><?= h($vehicleInOut->vehicle_no) ?></td>
                <td><?= $vehicleInOut->has('vehicle') ? $this->Html->link($vehicleInOut->vehicle->vehicle_no, ['controller' => 'Vehicles', 'action' => 'view', $vehicleInOut->vehicle->id]) : '' ?></td>
                <td><?= h($vehicleInOut->in_date) ?></td>
                <td><?= h($vehicleInOut->in_time) ?></td>
                <td><?= h($vehicleInOut->out_date) ?></td>
                <td><?= h($vehicleInOut->out_time) ?></td>
                <td><?= h($vehicleInOut->remarks) ?></td>
                <td><?= h($vehicleInOut->created_on) ?></td>
                <td><?= $this->Number->format($vehicleInOut->created_by) ?></td>
                <td><?= h($vehicleInOut->edited_on) ?></td>
                <td><?= $this->Number->format($vehicleInOut->edited_by) ?></td>
                <td><?= h($vehicleInOut->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $vehicleInOut->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vehicleInOut->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vehicleInOut->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicleInOut->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
