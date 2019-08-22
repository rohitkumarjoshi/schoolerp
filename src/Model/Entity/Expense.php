<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Expense Entity
 *
 * @property int $id
 * @property int $expense_category_id
 * @property int $expense_subcategory_id
 * @property float $amount
 * @property int $vehicle_id
 * @property int $expense_by
 * @property \Cake\I18n\FrozenDate $expense_date
 * @property string $remark
 * @property int $payment_mode
 * @property string $cheque_no
 * @property \Cake\I18n\FrozenDate $cheque_date
 * @property string $bank_name
 * @property string $bank_remarks
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\ExpenseCategory $expense_category
 * @property \App\Model\Entity\ExpenseSubcategory $expense_subcategory
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\Employee $employee
 */
class Expense extends Entity
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
        'expense_category_id' => true,
        'expense_subcategory_id' => true,
        'amount' => true,
        'vehicle_id' => true,
        'expense_by' => true,
        'expense_date' => true,
        'remark' => true,
        'payment_mode' => true,
        'cheque_no' => true,
        'cheque_date' => true,
        'transaction_no' => true,
        'bank_name' => true,
        'bank_remarks' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'expense_category' => true,
        'expense_subcategory' => true,
        'vehicle' => true,
        'employee' => true,
        'is_deleted    ' => true
    ];
}
