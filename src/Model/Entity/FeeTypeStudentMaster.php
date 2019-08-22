<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeeTypeStudentMaster Entity
 *
 * @property int $id
 * @property int $fee_type_master_row_id
 * @property int $student_info_id
 * @property int $session_year_id
 * @property float $amount
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $remarks
 *
 * @property \App\Model\Entity\FeeTypeMasterRow $fee_type_master_row
 * @property \App\Model\Entity\StudentInfo $student_info
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\FeeReceiptRow[] $fee_receipt_rows
 */
class FeeTypeStudentMaster extends Entity
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
        'fee_type_master_row_id' => true,
        'student_info_id' => true,
        'session_year_id' => true,
        'amount' => true,
        'concession_amount' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'remarks' => true,
        'fee_type_master_row' => true,
        'student_info' => true,
        'session_year' => true,
        'fee_receipt_rows' => true
    ];
}
