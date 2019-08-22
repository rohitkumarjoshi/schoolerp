<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentMotherProfession Entity
 *
 * @property int $id
 * @property int $enquiry_form_student_id
 * @property int $student_id
 * @property int $student_parent_profession_id
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\EnquiryFormStudent[] $enquiry_form_students
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\StudentParentProfession $student_parent_profession
 */
class StudentMotherProfession extends Entity
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
        'enquiry_form_student_id' => true,
        'student_id' => true,
        'student_parent_profession_id' => true,
        'session_year' => true,
        'enquiry_form_students' => true,
        'student' => true,
        'student_parent_profession' => true
    ];
}
