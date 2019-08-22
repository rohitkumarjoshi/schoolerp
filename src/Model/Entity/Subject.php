<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subject Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property string $name
 * @property int $student_class_id
 * @property int $stream_id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $elective
 * @property int $subject_type_id
 * @property int $order_number
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Stream $stream
 * @property \App\Model\Entity\ParentSubject $parent_subject
 * @property \App\Model\Entity\SubjectType $subject_type
 * @property \App\Model\Entity\BestMarkSubject[] $best_mark_subjects
 * @property \App\Model\Entity\Book[] $books
 * @property \App\Model\Entity\Scaling[] $scalings
 * @property \App\Model\Entity\StudentMark[] $student_marks
 * @property \App\Model\Entity\SubjectMaxMark[] $subject_max_marks
 * @property \App\Model\Entity\ChildSubject[] $child_subjects
 */
class Subject extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'session_year_id' => true,
        'name' => true,
        'student_class_id' => true,
        'stream_id' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'elective' => true,
        'subject_type_id' => true,
        'order_number' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'student_class' => true,
        'stream' => true,
        'parent_subject' => true,
        'subject_type' => true,
        'best_mark_subjects' => true,
        'books' => true,
        'scalings' => true,
        'student_marks' => true,
        'subject_max_marks' => true,
        'child_subjects' => true
    ];
}
