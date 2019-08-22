<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocumentClassMapping $documentClassMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $documentClassMapping->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $documentClassMapping->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Document Class Mappings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Student Documents'), ['controller' => 'StudentDocuments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student Document'), ['controller' => 'StudentDocuments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="documentClassMappings form large-9 medium-8 columns content">
    <?= $this->Form->create($documentClassMapping) ?>
    <fieldset>
        <legend><?= __('Edit Document Class Mapping') ?></legend>
        <?php
            echo $this->Form->control('session_year_id', ['options' => $sessionYears]);
            echo $this->Form->control('document_id', ['options' => $documents]);
            echo $this->Form->control('student_class_id', ['options' => $studentClasses]);
            echo $this->Form->control('created_on');
            echo $this->Form->control('created_by');
            echo $this->Form->control('edited_on');
            echo $this->Form->control('edited_by');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
