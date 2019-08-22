<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MonthMapping[]|\Cake\Collection\CollectionInterface $monthMappings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Month Mapping'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="monthMappings index large-9 medium-8 columns content">
    <h3><?= __('Month Mappings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('session_year_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_class_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('medium_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stream_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('april') ?></th>
                <th scope="col"><?= $this->Paginator->sort('may') ?></th>
                <th scope="col"><?= $this->Paginator->sort('june') ?></th>
                <th scope="col"><?= $this->Paginator->sort('july') ?></th>
                <th scope="col"><?= $this->Paginator->sort('august') ?></th>
                <th scope="col"><?= $this->Paginator->sort('september') ?></th>
                <th scope="col"><?= $this->Paginator->sort('october') ?></th>
                <th scope="col"><?= $this->Paginator->sort('november') ?></th>
                <th scope="col"><?= $this->Paginator->sort('december') ?></th>
                <th scope="col"><?= $this->Paginator->sort('january') ?></th>
                <th scope="col"><?= $this->Paginator->sort('february') ?></th>
                <th scope="col"><?= $this->Paginator->sort('march') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($monthMappings as $monthMapping): ?>
            <tr>
                <td><?= $this->Number->format($monthMapping->id) ?></td>
                <td><?= $monthMapping->has('session_year') ? $this->Html->link($monthMapping->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $monthMapping->session_year->id]) : '' ?></td>
                <td><?= $monthMapping->has('student_class') ? $this->Html->link($monthMapping->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $monthMapping->student_class->id]) : '' ?></td>
                <td><?= $this->Number->format($monthMapping->medium_id) ?></td>
                <td><?= $monthMapping->has('stream') ? $this->Html->link($monthMapping->stream->name, ['controller' => 'Streams', 'action' => 'view', $monthMapping->stream->id]) : '' ?></td>
                <td><?= h($monthMapping->april) ?></td>
                <td><?= h($monthMapping->may) ?></td>
                <td><?= h($monthMapping->june) ?></td>
                <td><?= h($monthMapping->july) ?></td>
                <td><?= h($monthMapping->august) ?></td>
                <td><?= h($monthMapping->september) ?></td>
                <td><?= h($monthMapping->october) ?></td>
                <td><?= h($monthMapping->november) ?></td>
                <td><?= h($monthMapping->december) ?></td>
                <td><?= h($monthMapping->january) ?></td>
                <td><?= h($monthMapping->february) ?></td>
                <td><?= h($monthMapping->march) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $monthMapping->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $monthMapping->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $monthMapping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $monthMapping->id)]) ?>
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
