<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property int $session_year_id
 * @property string $name
 * @property \Cake\I18n\FrozenDate $dob
 * @property string $parmanent_address
 * @property string $correspondence_address
 * @property string $marital_status
 * @property int $gender_id
 * @property int $city_id
 * @property int $state_id
 * @property int $role_id
 * @property string $is_deleted
 *
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Hostel[] $hostels
 * @property \App\Model\Entity\ItemIndent[] $item_indents
 * @property \App\Model\Entity\ItemIssueReturn[] $item_issue_returns
 * @property \App\Model\Entity\SessionYear $session_year
 */
class Employee extends Entity
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
        'session_year_id' => true,
        'name' => true,
        'dob' => true,
        'parmanent_address' => true,
        'correspondence_address' => true,
        'marital_status' => true,
        'gender_id' => true,
        'city_id' => true,
        'state_id' => true,
        'role_id' => true,
        'is_deleted' => true,
        'gender' => true,
        'city' => true,
        'state' => true,
        'hostels' => true,
        'item_indents' => true,
        'item_issue_returns' => true,
        'session_year' => true
    ];
}
