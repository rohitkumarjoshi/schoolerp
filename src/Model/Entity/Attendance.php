<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attendance Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $medium_id
 * @property int $student_class_id
 * @property int $stream_id
 * @property int $section_id
 * @property int $student_info_id
 * @property string $first_half
 * @property string $second_half
 * @property \Cake\I18n\FrozenDate $attendance_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Stream $stream
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\StudentInfo $student_info
 */
class Attendance extends Entity
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
        'medium_id' => true,
        'student_class_id' => true,
        'stream_id' => true,
        'section_id' => true,
        'student_info_id' => true,
        'first_half' => true,
        'second_half' => true,
        'attendance_date' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'media' => true,
        'student_class' => true,
        'stream' => true,
        'section' => true,
        'student_info' => true,
		'class_mapping_id'=>true
    ];
}
