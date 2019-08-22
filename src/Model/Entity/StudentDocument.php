<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentDocument Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $student_id
 * @property int $enquiry_form_student_id
 * @property int $document_class_mapping_id
 * @property string $image_path
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\EnquiryFormStudent $enquiry_form_student
 * @property \App\Model\Entity\DocumentClassMapping $document_class_mapping
 */
class StudentDocument extends Entity
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
        'student_id' => true,
        'enquiry_form_student_id' => true,
        'document_class_mapping_id' => true,
        'image_path' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'session_year' => true,
        'student' => true,
        'enquiry_form_student' => true,
        'document_class_mapping' => true
    ];
}
