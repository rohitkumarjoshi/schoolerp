<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeeMonth $feeMonth
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $feeMonth->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $feeMonth->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fee Months'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Fee Receipt Rows'), ['controller' => 'FeeReceiptRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Receipt Row'), ['controller' => 'FeeReceiptRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Type Master Rows'), ['controller' => 'FeeTypeMasterRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Type Master Row'), ['controller' => 'FeeTypeMasterRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feeMonths form large-9 medium-8 columns content">
    <?= $this->Form->create($feeMonth) ?>
    <fieldset>
        <legend><?= __('Edit Fee Month') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('is_deleted');
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
