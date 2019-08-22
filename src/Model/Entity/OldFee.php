<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OldFee Entity
 *
 * @property int $id
 * @property int $due_session_year
 * @property int $session_year_id
 * @property int $fee_category_id
 * @property int $fee_type_role_id
 * @property int $student_id
 * @property float $due_amount
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\FeeCategory $fee_category
 * @property \App\Model\Entity\FeeTypeRole $fee_type_role
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\FeeReceipt[] $fee_receipts
 */
class OldFee extends Entity
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
        'due_session_year' => true,
        'session_year_id' => true,
        'fee_category_id' => true,
        'fee_type_role_id' => true,
        'student_id' => true,
        'due_amount' => true,
        'session_year' => true,
        'fee_category' => true,
        'fee_type_role' => true,
        'student' => true,
        'fee_receipts' => true
    ];
}
