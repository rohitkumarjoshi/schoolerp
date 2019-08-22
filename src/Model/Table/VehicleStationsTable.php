<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleStations Model
 *
 * @property \App\Model\Table\FeeTypeMastersTable|\Cake\ORM\Association\HasMany $FeeTypeMasters
 * @property \App\Model\Table\VehicleRoutesTable|\Cake\ORM\Association\HasMany $VehicleRoutes
 *
 * @method \App\Model\Entity\VehicleStation get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehicleStation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehicleStation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehicleStation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleStation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleStation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleStation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleStation findOrCreate($search, callable $callback = null, $options = [])
 */
class VehicleStationsTable extends Table
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

        $this->setTable('vehicle_stations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('FeeTypeMasters', [
            'foreignKey' => 'vehicle_station_id'
        ]);
        $this->hasMany('VehicleRoutes', [
            'foreignKey' => 'vehicle_station_id'
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
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 255)
            ->requirePresence('latitude', 'create')
            ->notEmpty('latitude');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 255)
            ->requirePresence('longitude', 'create')
            ->notEmpty('longitude');

      /*   $validator
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
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
