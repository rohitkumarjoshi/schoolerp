<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Document $document
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Document'), ['action' => 'edit', $document->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Document'), ['action' => 'delete', $document->id], ['confirm' => __('Are you sure you want to delete # {0}?', $document->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Documents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Document Class Mappings'), ['controller' => 'DocumentClassMappings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document Class Mapping'), ['controller' => 'DocumentClassMappings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="documents view large-9 medium-8 columns content">
    <h3><?= h($document->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Document Name') ?></th>
            <td><?= h($document->document_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($document->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($document->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($document->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($document->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($document->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($document->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Document Class Mappings') ?></h4>
        <?php if (!empty($document->document_class_mappings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Document Id') ?></th>
                <th scope="col"><?= __('Student Class Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($document->document_class_mappings as $documentClassMappings): ?>
            <tr>
                <td><?= h($documentClassMappings->id) ?></td>
                <td><?= h($documentClassMappings->session_year_id) ?></td>
                <td><?= h($documentClassMappings->document_id) ?></td>
                <td><?= h($documentClassMappings->student_class_id) ?></td>
                <td><?= h($documentClassMappings->created_on) ?></td>
                <td><?= h($documentClassMappings->created_by) ?></td>
                <td><?= h($documentClassMappings->edited_on) ?></td>
                <td><?= h($documentClassMappings->edited_by) ?></td>
                <td><?= h($documentClassMappings->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'DocumentClassMappings', 'action' => 'view', $documentClassMappings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'DocumentClassMappings', 'action' => 'edit', $documentClassMappings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DocumentClassMappings', 'action' => 'delete', $documentClassMappings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $documentClassMappings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
