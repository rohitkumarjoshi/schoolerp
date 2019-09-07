<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vehicles Model
 *
 * @property \App\Model\Table\ExpensesTable|\Cake\ORM\Association\HasMany $Expenses
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\HasMany $StudentInfos
 * @property \App\Model\Table\VehicleDriverMappingsTable|\Cake\ORM\Association\HasMany $VehicleDriverMappings
 * @property \App\Model\Table\VehicleFeedbacksTable|\Cake\ORM\Association\HasMany $VehicleFeedbacks
 * @property \App\Model\Table\VehicleFuelEntriesTable|\Cake\ORM\Association\HasMany $VehicleFuelEntries
 * @property \App\Model\Table\VehicleRoutesTable|\Cake\ORM\Association\HasMany $VehicleRoutes
 * @property \App\Model\Table\VehicleServicesTable|\Cake\ORM\Association\HasMany $VehicleServices
 * @property \App\Model\Table\VehicleStudentAttendancesTable|\Cake\ORM\Association\HasMany $VehicleStudentAttendances
 *
 * @method \App\Model\Entity\Vehicle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vehicle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vehicle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vehicle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vehicle|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vehicle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vehicle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vehicle findOrCreate($search, callable $callback = null, $options = [])
 */
class VehiclesTable extends Table
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

        $this->setTable('vehicles');
        $this->setDisplayField('vehicle_no');
        $this->setPrimaryKey('id');

         $this->hasMany('Expenses', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('StudentInfos', [
            'foreignKey' => 'vehicle_id'
        ]);
		$this->hasMany('StudentInfos', [
            'foreignKey' => 'drop_vechile_id'
        ]);
        $this->hasMany('VehicleDriverMappings', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('VehicleFeedbacks', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('VehicleFuelEntries', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('VehicleRoutes', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('VehicleServices', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('VehicleStudentAttendances', [
            'foreignKey' => 'vehicle_id'
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
            ->scalar('vehicle_no')
            ->maxLength('vehicle_no', 50)
            ->requirePresence('vehicle_no', 'create')
            ->notEmpty('vehicle_no');

        $validator
            ->scalar('vehicle_type')
            ->maxLength('vehicle_type', 30)
            ->requirePresence('vehicle_type', 'create')
            ->notEmpty('vehicle_type');

       /*  $validator
            ->scalar('vechicle_company')
            ->maxLength('vechicle_company', 50)
            ->requirePresence('vechicle_company', 'create')
            ->notEmpty('vechicle_company');

        $validator
            ->scalar('city_reg')
            ->maxLength('city_reg', 50)
            ->requirePresence('city_reg', 'create')
            ->notEmpty('city_reg');

        $validator
            ->scalar('model_no')
            ->maxLength('model_no', 50)
            ->requirePresence('model_no', 'create')
            ->notEmpty('model_no');

        $validator
            ->scalar('engine_no')
            ->maxLength('engine_no', 50)
            ->requirePresence('engine_no', 'create')
            ->notEmpty('engine_no');

        $validator
            ->scalar('vehicle_condition')
            ->maxLength('vehicle_condition', 20)
            ->requirePresence('vehicle_condition', 'create')
            ->notEmpty('vehicle_condition');

        $validator
            ->scalar('year_manufacturing')
            ->maxLength('year_manufacturing', 20)
            ->requirePresence('year_manufacturing', 'create')
            ->notEmpty('year_manufacturing');

        $validator
            ->scalar('color')
            ->maxLength('color', 20)
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        $validator
            ->scalar('chasis_no')
            ->maxLength('chasis_no', 50)
            ->requirePresence('chasis_no', 'create')
            ->notEmpty('chasis_no');

        $validator
            ->date('insurance_date')
            ->requirePresence('insurance_date', 'create')
            ->notEmpty('insurance_date');

        $validator
            ->date('insurance_expiry_date')
            ->requirePresence('insurance_expiry_date', 'create')
            ->notEmpty('insurance_expiry_date');

        $validator
            ->scalar('insurance_doc')
            ->maxLength('insurance_doc', 100)
            ->requirePresence('insurance_doc', 'create')
            ->notEmpty('insurance_doc');

        $validator
            ->scalar('poc_doc')
            ->maxLength('poc_doc', 100)
            ->requirePresence('poc_doc', 'create')
            ->notEmpty('poc_doc');

        $validator
            ->date('poc_date')
            ->requirePresence('poc_date', 'create')
            ->notEmpty('poc_date');

        $validator
            ->date('poc_expiry_date')
            ->requirePresence('poc_expiry_date', 'create')
            ->notEmpty('poc_expiry_date');

        $validator
            ->scalar('permit_doc')
            ->maxLength('permit_doc', 100)
            ->requirePresence('permit_doc', 'create')
            ->notEmpty('permit_doc');

        $validator
            ->date('permit_date')
            ->requirePresence('permit_date', 'create')
            ->notEmpty('permit_date');

        $validator
            ->date('permit_expiry_date')
            ->requirePresence('permit_expiry_date', 'create')
            ->notEmpty('permit_expiry_date');

        $validator
            ->scalar('fuel_type')
            ->maxLength('fuel_type', 10)
            ->requirePresence('fuel_type', 'create')
            ->notEmpty('fuel_type');

        $validator
            ->scalar('status')
            ->maxLength('status', 10)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->dateTime('edited_on')
            ->requirePresence('edited_on', 'create')
            ->notEmpty('edited_on');

        $validator
            ->integer('edited_by')
            ->requirePresence('edited_by', 'create')
            ->notEmpty('edited_by'); */

        return $validator;
    }
}
