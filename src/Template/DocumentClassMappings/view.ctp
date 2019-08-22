<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocumentClassMapping $documentClassMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Document Class Mapping'), ['action' => 'edit', $documentClassMapping->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Document Class Mapping'), ['action' => 'delete', $documentClassMapping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $documentClassMapping->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Document Class Mappings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document Class Mapping'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Classes'), ['controller' => 'StudentClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Class'), ['controller' => 'StudentClasses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Documents'), ['controller' => 'StudentDocuments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Document'), ['controller' => 'StudentDocuments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="documentClassMappings view large-9 medium-8 columns content">
    <h3><?= h($documentClassMapping->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $documentClassMapping->has('session_year') ? $this->Html->link($documentClassMapping->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $documentClassMapping->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Document') ?></th>
            <td><?= $documentClassMapping->has('document') ? $this->Html->link($documentClassMapping->document->id, ['controller' => 'Documents', 'action' => 'view', $documentClassMapping->document->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student Class') ?></th>
            <td><?= $documentClassMapping->has('student_class') ? $this->Html->link($documentClassMapping->student_class->name, ['controller' => 'StudentClasses', 'action' => 'view', $documentClassMapping->student_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($documentClassMapping->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($documentClassMapping->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($documentClassMapping->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($documentClassMapping->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($documentClassMapping->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($documentClassMapping->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Student Documents') ?></h4>
        <?php if (!empty($documentClassMapping->student_documents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Enquiry Form Student Id') ?></th>
                <th scope="col"><?= __('Document Class Mapping Id') ?></th>
                <th scope="col"><?= __('Image Path') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($documentClassMapping->student_documents as $studentDocuments): ?>
            <tr>
                <td><?= h($studentDocuments->id) ?></td>
                <td><?= h($studentDocuments->session_year_id) ?></td>
                <td><?= h($studentDocuments->student_id) ?></td>
                <td><?= h($studentDocuments->enquiry_form_student_id) ?></td>
                <td><?= h($studentDocuments->document_class_mapping_id) ?></td>
                <td><?= h($studentDocuments->image_path) ?></td>
                <td><?= h($studentDocuments->created_on) ?></td>
                <td><?= h($studentDocuments->created_by) ?></td>
                <td><?= h($studentDocuments->edited_on) ?></td>
                <td><?= h($studentDocuments->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentDocuments', 'action' => 'view', $studentDocuments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentDocuments', 'action' => 'edit', $studentDocuments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentDocuments', 'action' => 'delete', $studentDocuments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentDocuments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
