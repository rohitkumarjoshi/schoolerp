<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookFine $bookFine
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Book Fines'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="bookFines form large-9 medium-8 columns content">
    <?= $this->Form->create($bookFine) ?>
    <fieldset>
        <legend><?= __('Add Book Fine') ?></legend>
        <?php
            echo $this->Form->control('fine_after_days');
            echo $this->Form->control('fine_amount_per_day');
            echo $this->Form->control('fine_for');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
