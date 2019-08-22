<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemIssueReturn Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property int $student_id
 * @property int $employee_id
 * @property string $status
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property float $grand_total
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\ItemIssueReturnRow[] $item_issue_return_rows
 */
class ItemIssueReturn extends Entity
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
        
    ];
}
