<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentRedDiary Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $session_year_id
 * @property string $reason
 * @property string $description
 * @property int $punished_by
 * @property \Cake\I18n\FrozenDate $punished_from
 * @property \Cake\I18n\FrozenDate $punished_to
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\SessionYear $session_year
 */
class StudentRedDiary extends Entity
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
        'student_id' => true,
        'session_year_id' => true,
        'reason' => true,
        'description' => true,
        'punished_by' => true,
        'punished_from' => true,
        'punished_to' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'student' => true,
        'session_year' => true
    ];
}
