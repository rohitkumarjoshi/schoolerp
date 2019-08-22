<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Leave Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $student_id
 * @property \Cake\I18n\FrozenDate $date_from
 * @property \Cake\I18n\FrozenDate $date_to
 * @property string $half_day
 * @property string $halfday_type
 * @property string $reason
 * @property string $status
 * @property int $action_by
 * @property \Cake\I18n\FrozenDate $action_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Student $student
 */
class Leave extends Entity
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
        'student_id' => true,
        'date_from' => true,
        'date_to' => true,
        'half_day' => true,
        'halfday_type' => true,
        'reason' => true,
        'status' => true,
        'action_by' => true,
        'action_date' => true,
        'halfday_date' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'student' => true
    ];
}
