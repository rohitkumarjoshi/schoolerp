<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EntranceExam $entranceExam
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Entrance Exam'), ['action' => 'edit', $entranceExam->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Entrance Exam'), ['action' => 'delete', $entranceExam->id], ['confirm' => __('Are you sure you want to delete # {0}?', $entranceExam->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Entrance Exams'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Entrance Exam'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Session Years'), ['controller' => 'SessionYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session Year'), ['controller' => 'SessionYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Entrance Exam Results'), ['controller' => 'EntranceExamResults', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Entrance Exam Result'), ['controller' => 'EntranceExamResults', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="entranceExams view large-9 medium-8 columns content">
    <h3><?= h($entranceExam->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session Year') ?></th>
            <td><?= $entranceExam->has('session_year') ? $this->Html->link($entranceExam->session_year->id, ['controller' => 'SessionYears', 'action' => 'view', $entranceExam->session_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject Name') ?></th>
            <td><?= h($entranceExam->subject_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minimum Marks') ?></th>
            <td><?= h($entranceExam->minimum_marks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= h($entranceExam->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($entranceExam->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($entranceExam->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($entranceExam->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($entranceExam->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($entranceExam->edited_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Entrance Exam Results') ?></h4>
        <?php if (!empty($entranceExam->entrance_exam_results)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Entrance Exam Id') ?></th>
                <th scope="col"><?= __('Enquiry Form Student Id') ?></th>
                <th scope="col"><?= __('Obt Marks') ?></th>
                <th scope="col"><?= __('Session Year Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($entranceExam->entrance_exam_results as $entranceExamResults): ?>
            <tr>
                <td><?= h($entranceExamResults->id) ?></td>
                <td><?= h($entranceExamResults->entrance_exam_id) ?></td>
                <td><?= h($entranceExamResults->enquiry_form_student_id) ?></td>
                <td><?= h($entranceExamResults->obt_marks) ?></td>
                <td><?= h($entranceExamResults->session_year_id) ?></td>
                <td><?= h($entranceExamResults->created_on) ?></td>
                <td><?= h($entranceExamResults->created_by) ?></td>
                <td><?= h($entranceExamResults->edited_on) ?></td>
                <td><?= h($entranceExamResults->edited_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EntranceExamResults', 'action' => 'view', $entranceExamResults->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EntranceExamResults', 'action' => 'edit', $entranceExamResults->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EntranceExamResults', 'action' => 'delete', $entranceExamResults->id], ['confirm' => __('Are you sure you want to delete # {0}?', $entranceExamResults->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
