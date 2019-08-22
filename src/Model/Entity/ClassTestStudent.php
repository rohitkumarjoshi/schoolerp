<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClassTestStudent Entity
 *
 * @property int $id
 * @property int $class_test_id
 * @property int $student_info_id
 * @property float $marks
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property int $edited_by
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\ClassTest $class_test
 * @property \App\Model\Entity\StudentInfo $student_info
 */
class ClassTestStudent extends Entity
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
        'class_test_id' => true,
        'student_info_id' => true,
        'marks' => true,
        'created_on' => true,
        'created_by' => true,
        'edited_on' => true,
        'edited_by' => true,
        'is_deleted' => true,
        'class_test' => true,
        'student_info' => true
    ];
}
