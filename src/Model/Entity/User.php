<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property int $employee_id
 * @property int $student_id
 * @property string $username
 * @property string $password
 * @property string $user_type
 * @property string $is_deleted
 */
class User extends Entity
{
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher())->hash($password);
    }

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
        'otp' => true,
        'employee_id' => true,
        'student_id' => true,
        'username' => true,
        'password' => true,
        'user_type' => true,
        'is_deleted' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
