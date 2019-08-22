<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vehicle Entity
 *
 * @property int $id
 * @property string $vehicle_no
 * @property string $vehicle_type
 * @property string $vechicle_company
 * @property string $city_reg
 * @property string $model_no
 * @property string $engine_no
 * @property string $condition
 * @property string $year_manufacturing
 * @property string $color
 * @property string $chasis_no
 * @property \Cake\I18n\FrozenDate $insurance_date
 * @property \Cake\I18n\FrozenDate $insurance_expiry_date
 * @property string $insurance_doc
 * @property string $poc_doc
 * @property \Cake\I18n\FrozenDate $poc_date
 * @property \Cake\I18n\FrozenDate $poc_expiry_date
 * @property string $permit_doc
 * @property \Cake\I18n\FrozenDate $permit_date
 * @property \Cake\I18n\FrozenDate $permit_expiry_date
 * @property string $fuel_type
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Expense[] $expenses
 * @property \App\Model\Entity\StudentInfo[] $student_infos
 * @property \App\Model\Entity\VehicleDriverMapping[] $vehicle_driver_mappings
 * @property \App\Model\Entity\VehicleFeedback[] $vehicle_feedbacks
 * @property \App\Model\Entity\VehicleFuelEntry[] $vehicle_fuel_entries
 * @property \App\Model\Entity\VehicleRoute[] $vehicle_routes
 * @property \App\Model\Entity\VehicleService[] $vehicle_services
 * @property \App\Model\Entity\VehicleStudentAttendance[] $vehicle_student_attendances
 */
class Vehicle extends Entity
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
        'vehicle_no' => true,
        'vehicle_type' => true,
        'vehicle_name' => true,
        'vechicle_company' => true,
        'city_reg' => true,
        'model_no' => true,
        'engine_no' => true,
        'vehicle_condition' => true,
        'year_manufacturing' => true,
        'color' => true,
        'chasis_no' => true,
        'insurance_date' => true,
        'insurance_expiry_date' => true,
        'insurance_doc' => true,
        'poc_doc' => true,
        'poc_date' => true,
        'poc_expiry_date' => true,
        'permit_doc' => true,
        'permit_date' => true,
        'permit_expiry_date' => true,
        'fuel_type' => true,
        'status' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'expenses' => true,
        'student_infos' => true,
        'vehicle_driver_mappings' => true,
        'vehicle_feedbacks' => true,
        'vehicle_fuel_entries' => true,
        'vehicle_routes' => true,
        'vehicle_services' => true,
        'vehicle_student_attendances' => true,
        'is_deleted'=>true
    ];
}
