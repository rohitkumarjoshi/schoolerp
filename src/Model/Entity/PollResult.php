<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PollResult Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $employee_id
 * @property int $poll_id
 * @property int $poll_row_id
 * @property string $suggestion
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Poll $poll
 * @property \App\Model\Entity\PollRow $poll_row
 */
class PollResult extends Entity
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
        'student_id' => true,
        'employee_id' => true,
        'poll_id' => true,
        'poll_row_id' => true,
        'suggestion' => true,
        'student' => true,
        'employee' => true,
        'poll' => true,
        'poll_row' => true
    ];
}
