<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MonthMapping $monthMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Month Mapping'), ['action' => 'edit', $monthMapping->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Month Mapping'), ['action' => 'delete', $monthMapping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $monthMapping->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Month Mappings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Month Mapping'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Streams'), ['controller' => 'Streams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stream'), ['controller' => 'Streams', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="monthMappings view large-9 medium-8 columns content">
    <h3><?= h($monthMapping->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $monthMapping->has('session_year') ? $this->Html->link($monthMapping->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $monthMapping->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $monthMapping->has('student_class') ? $this->Html->link($monthMapping->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $monthMapping->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stream') ?></th>
            <td><?= $monthMapping->has('stream') ? $this->Html->link($monthMapping->stream->name, ['controller' => 'Streams', 'action' => 'view', $monthMapping->stream->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('April') ?></th>
            <td><?= h($monthMapping->april) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('May') ?></th>
            <td><?= h($monthMapping->may) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('June') ?></th>
            <td><?= h($monthMapping->june) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('July') ?></th>
            <td><?= h($monthMapping->july) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('August') ?></th>
            <td><?= h($monthMapping->august) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('September') ?></th>
            <td><?= h($monthMapping->september) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('October') ?></th>
            <td><?= h($monthMapping->october) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('November') ?></th>
            <td><?= h($monthMapping->november) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('December') ?></th>
            <td><?= h($monthMapping->december) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('January') ?></th>
            <td><?= h($monthMapping->january) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('February') ?></th>
            <td><?= h($monthMapping->february) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('March') ?></th>
            <td><?= h($monthMapping->march) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($monthMapping->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Medium Id') ?></th>
            <td><?= $this->Number->format($monthMapping->medium_id) ?></td>
        </tr>
    </table>
</div>
