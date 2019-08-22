<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleInOuts Model
 *
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 *
 * @method \App\Model\Entity\VehicleInOut get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehicleInOut newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehicleInOut[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehicleInOut|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleInOut|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleInOut patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleInOut[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleInOut findOrCreate($search, callable $callback = null, $options = [])
 */
class VehicleInOutsTable extends Table
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

        $this->setTable('vehicle_in_outs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'Left'
        ])->setConditions(['Vehicles.is_deleted'=>'N']);
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

        /*$validator
            ->scalar('vehicle_no')
            ->maxLength('vehicle_no', 50)
            ->requirePresence('vehicle_no', 'create')
            ->notEmpty('vehicle_no');

        $validator
            ->date('in_date')
            ->requirePresence('in_date', 'create')
            ->notEmpty('in_date');

        $validator
            ->time('in_time')
            ->requirePresence('in_time', 'create')
            ->notEmpty('in_time');

        $validator
            ->date('out_date')
            ->requirePresence('out_date', 'create')
            ->notEmpty('out_date');

        $validator
            ->time('out_time')
            ->requirePresence('out_time', 'create')
            ->notEmpty('out_time');

        $validator
            ->scalar('remarks')
            ->maxLength('remarks', 200)
            ->requirePresence('remarks', 'create')
            ->notEmpty('remarks');

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
            ->notEmpty('edited_by');

        $validator
            ->scalar('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');
*/
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
        //$rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));

        return $rules;
    }
}
