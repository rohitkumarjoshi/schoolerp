<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentInfo Entity
 *
 * @property int $id
 * @property int $student_id
 * @property string $permanent_address
 * @property string $correspondence_address
 * @property string $roll_no
 * @property string $hostel_facility
 * @property int $fee_type_role_id
 * @property int $vehicle_station_id
 * @property int $reservation_category_id
 * @property int $state_id
 * @property int $city_id
 * @property int $pincode
 * @property int $session_year_id
 * @property string $rte
 * @property string $aadhaar_no
 * @property int $caste_id
 * @property int $religion_id
 * @property int $student_class_id
 * @property int $medium_id
 * @property int $section_id
 * @property int $stream_id
 * @property int $house_id
 * @property int $student_parent_profession_id
 * @property int $vehicle_id
 * @property int $hostel_id
 * @property int $room_id
 * @property string $hostel_tc_nodues
 * @property \Cake\I18n\FrozenDate $hostel_tc_date
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\FeeTypeRole $fee_type_role
 * @property \App\Model\Entity\VehicleStation $vehicle_station
 * @property \App\Model\Entity\ReservationCategory $reservation_category
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Caste $caste
 * @property \App\Model\Entity\Religion $religion
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Medium $medium
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\Stream $stream
 * @property \App\Model\Entity\House $house
 * @property \App\Model\Entity\StudentParentProfession $student_parent_profession
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\Hostel $hostel
 * @property \App\Model\Entity\Room $room
 * @property \App\Model\Entity\FeeReceipt[] $fee_receipts
 * @property \App\Model\Entity\StudentHealth[] $student_healths
 * @property \App\Model\Entity\StudentMark[] $student_marks
 */
class StudentInfo extends Entity
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
        'permanent_address' => true,
        'correspondence_address' => true,
        'email' => true,
        'living' => true,
        'roll_no' => true,
        'hostel_facility' => true,
        'bus_facility' => true,
        'hostel_this_year' => true,
        'fee_type_role_id' => true,
        'vehicle_station_id' => true,
        'reservation_category_id' => true,
        'state_id' => true,
        'city_id' => true,
        'minority' => true,
        'session_year_id' => true,
        'rte' => true,
        'aadhaar_no' => true,
        'caste_id' => true,
        'religion_id' => true,
        'student_class_id' => true,
        'medium_id' => true,
        'section_id' => true,
        'stream_id' => true,
        'house_id' => true,
        'student_parent_profession_id' => true,
        'vehicle_id' => true,
        'drop_vechile_id' => true,
        'hostel_id' => true,
        'room_id' => true,
        'hostel_tc_nodues' => true,
        'hostel_tc_date' => true,
        'student_status' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'student' => true,
        'fee_type_role' => true,
        'vehicle_station' => true,
        'reservation_category' => true,
        'state' => true,
        'city' => true,
        'session_year' => true,
        'caste' => true,
        'religion' => true,
        'student_class' => true,
        'medium' => true,
        'section' => true,
        'stream' => true,
        'house' => true,
        'student_parent_profession' => true,
        'vehicle' => true,
        'hostel' => true,
        'room' => true,
        'fee_receipts' => true,
        'student_healths' => true,
        'student_marks' => true
    ];
}
