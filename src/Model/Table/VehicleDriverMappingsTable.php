<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleDriverMappings Model
 *
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 * @property \App\Model\Table\DriversTable|\Cake\ORM\Association\BelongsTo $Drivers
 * @property \App\Model\Table\ConductorsTable|\Cake\ORM\Association\BelongsTo $Conductors
 *
 * @method \App\Model\Entity\VehicleDriverMapping get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehicleDriverMapping newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehicleDriverMapping[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehicleDriverMapping|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleDriverMapping|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleDriverMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleDriverMapping[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleDriverMapping findOrCreate($search, callable $callback = null, $options = [])
 */
class VehicleDriverMappingsTable extends Table
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

        $this->setTable('vehicle_driver_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'left'
        ])->setConditions(['Vehicles.is_deleted'=>'N']);
        
        $this->belongsTo('Drivers', [
            'className' => 'Employees',
            'foreignKey' => 'driver_id',
            'joinType' => 'left'
        ])
        ->setConditions(['Drivers.role_id'=>2,'Drivers.is_deleted'=>'N']);

        $this->belongsTo('Conductors', [
            'className' => 'Employees',
            'foreignKey' => 'conductor_id',
            'joinType' => 'left'
        ])
        ->setConditions(['Conductors.role_id'=>3,'Conductors.is_deleted'=>'N']);
        

        /*$this->belongsTo('Conductors', [
            'foreignKey' => 'conductor_id',
            'joinType' => 'INNER'
        ]);*/
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
            ->date('assign_date')
            ->requirePresence('assign_date', 'create')
            ->notEmpty('assign_date');

 /*       $validator
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
            ->notEmpty('edited_by');

        $validator
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
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));
        $rules->add($rules->existsIn(['driver_id'], 'Drivers'));
        $rules->add($rules->existsIn(['conductor_id'], 'Conductors'));

        return $rules;
    }
}
