<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sport $sport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sport->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sport->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sports'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sport Rows'), ['controller' => 'SportRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sport Row'), ['controller' => 'SportRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sports form large-9 medium-8 columns content">
    <?= $this->Form->create($sport) ?>
    <fieldset>
        <legend><?= __('Edit Sport') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('sport_image');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
