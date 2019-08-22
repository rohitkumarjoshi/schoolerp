<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentClass Entity
 *
 * @property int $id
 * @property string $name
 * @property string $roman_name
 * @property int $session_year_id
 * @property int $order_of_class
 * @property string $grade_type
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\BestMarkSubject[] $best_mark_subjects
 * @property \App\Model\Entity\Book[] $books
 * @property \App\Model\Entity\ClassMapping[] $class_mappings
 * @property \App\Model\Entity\EnquiryFormStudent[] $enquiry_form_students
 * @property \App\Model\Entity\ExamMaster[] $exam_masters
 * @property \App\Model\Entity\FeeMonthMapping[] $fee_month_mappings
 * @property \App\Model\Entity\FeeTypeMaster[] $fee_type_masters
 * @property \App\Model\Entity\GradeMaster[] $grade_masters
 * @property \App\Model\Entity\StudentInfo[] $student_infos
 * @property \App\Model\Entity\Subject[] $subjects
 */
class StudentClass extends Entity
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
        'name' => true,
        'roman_name' => true,
        'session_year_id' => true,
        'order_of_class' => true,
        'grade_type' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'best_mark_subjects' => true,
        'books' => true,
        'class_mappings' => true,
        'enquiry_form_students' => true,
        'exam_masters' => true,
        'fee_month_mappings' => true,
        'fee_type_masters' => true,
        'grade_masters' => true,
        'student_infos' => true,
        'subjects' => true
    ];
}
