<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeeTypeMaster Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $fee_category_id
 * @property int $fee_type_id
 * @property int $vehicle_station_id
 * @property int $gender_id
 * @property string $optional
 * @property int $student_class_id
 * @property int $medium_id
 * @property int $stream_id
 * @property string $fee_wise
 * @property string $student_wise
 * @property string $is_deleted
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\FeeCategory $fee_category
 * @property \App\Model\Entity\FeeType $fee_type
 * @property \App\Model\Entity\VehicleStation $vehicle_station
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\StudentClass $student_class
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\Stream $stream
 * @property \App\Model\Entity\FeeReceiptRow[] $fee_receipt_rows
 * @property \App\Model\Entity\FeeTypeMasterRow[] $fee_type_master_rows
 */
class FeeTypeMaster extends Entity
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
        'fee_category_id' => true,
        'fee_type_id' => true,
        'vehicle_station_id' => true,
        'gender_id' => true,
        'hostel_id' => true,
        'student_class_id' => true,
        'medium_id' => true,
        'stream_id' => true,
        'fee_wise' => true,
        'student_wise' => true,
        'is_deleted' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'session_year' => true,
        'fee_category' => true,
        'fee_type' => true,
        'vehicle_station' => true,
        'gender' => true,
        'student_class' => true,
        'medium' => true,
        'stream' => true,
        'hostel' => true,
        'fee_receipt_rows' => true,
        'fee_type_master_rows' => true
    ];
}
