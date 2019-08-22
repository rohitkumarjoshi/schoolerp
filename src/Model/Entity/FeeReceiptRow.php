<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeeReceiptRow Entity
 *
 * @property int $id
 * @property int $fee_receipt_id
 * @property int $fee_type_master_row_id
 * @property int $fee_type_student_master_id
 * @property int $fee_month_id
 * @property float $amount
 *
 * @property \App\Model\Entity\FeeReceipt $fee_receipt
 * @property \App\Model\Entity\FeeTypeMaster $fee_type_master
 * @property \App\Model\Entity\FeeTypeMasterRow $fee_type_master_row
 * @property \App\Model\Entity\FeeTypeStudentMaster $fee_type_student_master
 * @property \App\Model\Entity\FeeMonth $fee_month
 */
class FeeReceiptRow extends Entity
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
        'fee_receipt_id' => true,
        'fee_type_master_row_id' => true,
        'fee_type_student_master_id' => true,
        'fee_month_id' => true,
        'amount' => true,
        'fee_receipt' => true,
        'fee_type_master' => true,
        'fee_type_master_row' => true,
        'fee_type_student_master' => true,
        'fee_month' => true
    ];
}
