<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Syllabus Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $medium_id
 * @property int $student_class_id
 * @property int $stream_id
 * @property string $file_path
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
 */
class Syllabus extends Entity
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
        '*' => true,
        'medium_id' => true,
        'student_class_id' => true,
        'stream_id' => true,
        'file_path' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'media' => true,
        'student_class' => true,
        'stream' => true,
        'subject_id' => true
    ];
}
