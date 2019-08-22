<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookIssueReturn Entity
 *
 * @property int $id
 * @property int $book_id
 * @property int $student_id
 * @property int $session_year_id
 * @property int $employee_id
 * @property \Cake\I18n\FrozenDate $date_from
 * @property \Cake\I18n\FrozenDate $date_to
 * @property \Cake\I18n\FrozenDate $return_date
 * @property int $late_day
 * @property float $fine_amount_per_day
 * @property float $fine_amount
 * @property string $status
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 *
 * @property \App\Model\Entity\Book $book
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\SessionYear $session_year
 * @property \App\Model\Entity\Employee $employee
 */
class BookIssueReturn extends Entity
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
        'book_id' => true,
        'student_id' => true,
        'session_year_id' => true,
        'employee_id' => true,
        'date_from' => true,
        'date_to' => true,
        'return_date' => true,
        'late_day' => true,
        'fine_amount_per_day' => true,
        'fine_amount' => true,
        'Payment_date' => true,
        'status' => true,
        'remark' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'book' => true,
        'student' => true,
        'session_year' => true,
        'employee' => true
    ];
}
