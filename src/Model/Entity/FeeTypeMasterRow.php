<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeeTypeMasterRow Entity
 *
 * @property int $id
 * @property int $fee_type_master_id
 * @property int $fee_month_id
 * @property float $amount
 *
 * @property \App\Model\Entity\FeeTypeMaster $fee_type_master
 * @property \App\Model\Entity\FeeMonth $fee_month
 * @property \App\Model\Entity\FeeReceiptRow[] $fee_receipt_rows
 * @property \App\Model\Entity\FeeTypeStudentMaster[] $fee_type_student_masters
 */
class FeeTypeMasterRow extends Entity
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
        'fee_type_master_id' => true,
        'fee_month_id' => true,
        'amount' => true,
        'fee_type_master' => true,
        'fee_month' => true,
        'fee_receipt_rows' => true,
        'fee_type_student_masters' => true
    ];
}
