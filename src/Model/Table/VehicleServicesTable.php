<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleServices Model
 *
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $Drivers
 * @property \App\Model\Table\VendorsTable|\Cake\ORM\Association\BelongsTo $Vendors
 *
 * @method \App\Model\Entity\VehicleService get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehicleService newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehicleService[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehicleService|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleService|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleService patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleService[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleService findOrCreate($search, callable $callback = null, $options = [])
 */
class VehicleServicesTable extends Table
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

        $this->setTable('vehicle_services');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'left'
        ])->setConditions(['Vehicles.is_deleted'=>'N']);
        /*$this->belongsTo('Drivers', [
            'foreignKey' => 'driver_id',
            'joinType' => 'INNER'
        ]);*/
         $this->belongsTo('Drivers', [
            'className' => 'Employees',
            'foreignKey' => 'driver_id',
            'joinType' => 'left'
        ])
        ->setConditions(['Drivers.role_id'=>2,'Drivers.is_deleted'=>'N']);
        
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'left'
        ])->setConditions(['Vendors.is_deleted'=>'N']);
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
            ->date('service_date')
            ->requirePresence('service_date', 'create')
            ->notEmpty('service_date');

        $validator
            ->integer('km')
            ->requirePresence('km', 'create')
            ->notEmpty('km');

        $validator
            ->scalar('bill_no')
            ->maxLength('bill_no', 30)
            ->requirePresence('bill_no', 'create')
            ->notEmpty('bill_no');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->date('next_service')
            ->requirePresence('next_service', 'create')
            ->notEmpty('next_service');

        /*$validator
            ->scalar('remark')
            ->requirePresence('remark', 'create')
            ->notEmpty('remark');*/
/*
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
            ->notEmpty('edited_by');*/

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
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));
        $rules->add($rules->existsIn(['driver_id'], 'Drivers'));
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'));

        return $rules;
    }
}
