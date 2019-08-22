<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\GendersTable|\Cake\ORM\Association\BelongsTo $Genders
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property |\Cake\ORM\Association\BelongsTo $Roles
 * @property |\Cake\ORM\Association\HasMany $AppointmentMasters
 * @property |\Cake\ORM\Association\HasMany $Appointments
 * @property |\Cake\ORM\Association\HasMany $BookIssueReturns
 * @property |\Cake\ORM\Association\HasMany $ClassMappings
 * @property |\Cake\ORM\Association\HasMany $Complaints
 * @property |\Cake\ORM\Association\HasMany $Directories
 * @property |\Cake\ORM\Association\HasMany $FacultyClassMappings
 * @property |\Cake\ORM\Association\HasMany $Feedbacks
 * @property \App\Model\Table\ItemIssueReturnsTable|\Cake\ORM\Association\HasMany $ItemIssueReturns
 * @property |\Cake\ORM\Association\HasMany $Leaves
 * @property |\Cake\ORM\Association\HasMany $PollResults
 * @property |\Cake\ORM\Association\HasMany $Tasks
 * @property |\Cake\ORM\Association\HasMany $TimeTablePeriods
 * @property |\Cake\ORM\Association\HasMany $UserRights
 * @property |\Cake\ORM\Association\HasMany $Users
 * @property |\Cake\ORM\Association\HasMany $Visitors
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('employees');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('AppointmentMasters', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Appointments', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('BookIssueReturns', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('ClassMappings', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Complaints', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Directories', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('FacultyClassMappings', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Feedbacks', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('ItemIssueReturns', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Leaves', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('PollResults', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Tasks', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('TimeTablePeriods', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('UserRights', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Visitors', [
            'foreignKey' => 'employee_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->date('dob')
            ->requirePresence('dob', 'create')
            ->notEmpty('dob');

        $validator
            ->scalar('parmanent_address')
            ->requirePresence('parmanent_address', 'create')
            ->notEmpty('parmanent_address');

        $validator
            ->scalar('correspondence_address')
            ->requirePresence('correspondence_address', 'create')
            ->notEmpty('correspondence_address');

        $validator
            ->scalar('marital_status')
            ->requirePresence('marital_status', 'create')
            ->notEmpty('marital_status');

        /*$validator
            ->scalar('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');*/

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));
        $rules->add($rules->existsIn(['gender_id'], 'Genders'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
