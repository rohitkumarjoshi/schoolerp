<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleRoutes Model
 *
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 * @property \App\Model\Table\VehicleStationsTable|\Cake\ORM\Association\BelongsTo $VehicleStations
 *
 * @method \App\Model\Entity\VehicleRoute get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehicleRoute newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehicleRoute[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehicleRoute|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleRoute|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleRoute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleRoute[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleRoute findOrCreate($search, callable $callback = null, $options = [])
 */
class VehicleRoutesTable extends Table
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

        $this->setTable('vehicle_routes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER'
        ])->setConditions(['Vehicles.is_deleted'=>'N']);
        
        $this->belongsTo('VehicleStations', [
            'foreignKey' => 'vehicle_station_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['VehicleStations.is_deleted'=>'N']);
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
            ->time('pickup_time')
            ->requirePresence('pickup_time', 'create')
            ->notEmpty('pickup_time');

        $validator
            ->time('drop_time')
            ->requirePresence('drop_time', 'create')
            ->notEmpty('drop_time');

        $validator
            ->integer('station_order_by')
            ->requirePresence('station_order_by', 'create')
            ->notEmpty('station_order_by');

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
            ->notEmpty('edited_by'); */

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
        $rules->add($rules->existsIn(['vehicle_station_id'], 'VehicleStations'));

        return $rules;
    }
}
