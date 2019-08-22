<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HostelStudentAsset Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $session_year_id
 * @property int $hostel_room_asset_id
 * @property int $quantity
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\HostelRoomAsset $hostel_room_asset
 */
class HostelStudentAsset extends Entity
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
        'hostel_room_asset_id' => true,
        'quantity' => true,
        'status' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'student' => true,
        'session_year' => true,
        'hostel_room_asset' => true
    ];
}
