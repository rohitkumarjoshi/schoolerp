<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HostelOutPass Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $student_id
 * @property \Cake\I18n\FrozenDate $date_from
 * @property \Cake\I18n\FrozenDate $date_to
 * @property \Cake\I18n\FrozenTime $in_time
 * @property \Cake\I18n\FrozenTime $out_time
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Student $student
 */
class HostelOutPass extends Entity
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
        'date_from' => true,
        'date_to' => true,
        'in_time' => true,
        'out_time' => true,
        'status' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'student' => true
    ];
}
