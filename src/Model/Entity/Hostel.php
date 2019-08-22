<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Hostel Entity
 *
 * @property int $id
 * @property string $hostel_name
 * @property int $warden_id
 * @property int $assistant_warden_id
 * @property string $address
 * @property int $no_of_rooms
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Warden $warden
 * @property \App\Model\Entity\AssistantWarden $assistant_warden
 * @property \App\Model\Entity\HostelAttendance[] $hostel_attendances
 * @property \App\Model\Entity\HostelRegistration[] $hostel_registrations
 * @property \App\Model\Entity\Room[] $rooms
 * @property \App\Model\Entity\StudentInfo[] $student_infos
 */
class Hostel extends Entity
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
        'hostel_name' => true,
        'warden_id' => true,
        'assistant_warden_id' => true,
        'address' => true,
        'no_of_rooms' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'warden' => true,
        'assistant_warden' => true,
        'hostel_attendances' => true,
        'hostel_registrations' => true,
        'rooms' => true,
        'student_infos' => true,
        'is_deleted' => true
    ];
}
