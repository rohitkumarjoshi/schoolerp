<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeeReceipt Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $fee_type_master_id
 * @property int $enquiry_form_student_id
 * @property int $student_info_id
 * @property int $receipt_no
 * @property float $amount
 * @property float $fine_amount
 * @property float $concession_amount
 * @property float $total_amount
 * @property string $payment_type
 * @property string $payment_method
 * @property string $cheque_no
 * @property \Cake\I18n\FrozenDate $cheque_date
 * @property string $transaction_no
 * @property \Cake\I18n\FrozenDate $receipt_date
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\FeeTypeReceipt $fee_type_receipt
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\StudentInfo $student_info
 * @property \App\Model\Entity\FeeReceiptRow[] $fee_receipt_rows
 */
class FeeReceipt extends Entity
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
        '*' => true,
        'session_year_id' => true,
        'fee_category_id' => true,
        'enquiry_form_student_id' => true,
        'detail' => true,
        'student_info_id' => true,
        'fee_type_role_id' => true,
        'receipt_no' => true,
        'amount' => true,
        'fine_amount' => true,
        'concession_amount' => true,
        'concession_amount_1' => true,
        'concession_amount_2' => true,
        'total_amount' => true,
        'payment_type' => true,
        'payment_method' => true,
        'cheque_no' => true,
        'cheque_date' => true,
        'transaction_no' => true,
        'receipt_date' => true,
        'remark' => true,
        'delete_date' => true,
        'deleted_remark' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'session_year' => true,
        'fee_type_receipt' => true,
        'student' => true,
        'student_info' => true,
        'fee_receipt_rows' => true
    ];
}
