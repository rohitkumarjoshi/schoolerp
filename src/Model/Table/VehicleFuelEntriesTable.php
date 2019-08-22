<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleFuelEntries Model
 *
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 *
 * @method \App\Model\Entity\VehicleFuelEntry get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehicleFuelEntry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehicleFuelEntry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehicleFuelEntry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleFuelEntry|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleFuelEntry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleFuelEntry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleFuelEntry findOrCreate($search, callable $callback = null, $options = [])
 */
class VehicleFuelEntriesTable extends Table
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

        $this->setTable('vehicle_fuel_entries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'left'
        ])->setConditions(['Vehicles.is_deleted'=>'N']);
        
        $this->belongsTo('Drivers', [
            'className' => 'Employees',
            'foreignKey' => 'filled_by',
            'joinType' => 'left'
        ])
        ->setConditions(['Drivers.role_id'=>2,'Drivers.is_deleted'=>'N']);
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
            ->date('fill_date')
            ->requirePresence('fill_date', 'create')
            ->notEmpty('fill_date');

        $validator
            ->integer('filled_by')
            ->requirePresence('filled_by', 'create')
            ->notEmpty('filled_by');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->integer('previous_km')
            ->requirePresence('previous_km', 'create')
            ->notEmpty('previous_km');

        $validator
            ->integer('current_km')
            ->requirePresence('current_km', 'create')
            ->notEmpty('current_km');

        $validator
            ->decimal('liter')
            ->requirePresence('liter', 'create')
            ->notEmpty('liter');

        $validator
            ->decimal('milege')
            ->requirePresence('milege', 'create')
            ->notEmpty('milege');

        $validator
            ->scalar('bill_no')
            ->maxLength('bill_no', 80)
            ->requirePresence('bill_no', 'create')
            ->notEmpty('bill_no');

        $validator
            ->scalar('remark')
            ->requirePresence('remark', 'create')
            ->notEmpty('remark');

        $validator
            ->integer('difference_km')
            ->requirePresence('difference_km', 'create')
            ->notEmpty('difference_km');

       /* $validator
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

        return $rules;
    }
}
