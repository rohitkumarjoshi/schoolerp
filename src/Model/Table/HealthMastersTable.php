<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HealthMasters Model
 *
 * @property \App\Model\Table\StudentHealthsTable|\Cake\ORM\Association\HasMany $StudentHealths
 *
 * @method \App\Model\Entity\HealthMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\HealthMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HealthMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HealthMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HealthMaster|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HealthMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HealthMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HealthMaster findOrCreate($search, callable $callback = null, $options = [])
 */
class HealthMastersTable extends Table
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

        $this->setTable('health_masters');
        $this->setDisplayField('health_type');
        $this->setPrimaryKey('id');

        $this->hasMany('StudentHealths', [
            'foreignKey' => 'health_master_id'
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
            ->scalar('health_type')
            ->maxLength('health_type', 50)
            ->requirePresence('health_type', 'create')
            ->notEmpty('health_type')
            ->add('health_type', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('unit')
            ->maxLength('unit', 100)
            ->requirePresence('unit', 'create')
            ->notEmpty('unit');

        // $validator
        //     ->dateTime('created_on')
        //     ->requirePresence('created_on', 'create')
        //     ->notEmpty('created_on');

        // $validator
        //     ->integer('created_by')
        //     ->requirePresence('created_by', 'create')
        //     ->notEmpty('created_by');

        // $validator
        //     ->dateTime('edited_on')
        //     ->requirePresence('edited_on', 'create')
        //     ->notEmpty('edited_on');

        // $validator
        //     ->integer('edited_by')
        //     ->requirePresence('edited_by', 'create')
        //     ->notEmpty('edited_by');

        // $validator
        //     ->scalar('is_deleted')
        //     ->requirePresence('is_deleted', 'create')
        //     ->notEmpty('is_deleted');

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
        $rules->add($rules->isUnique(['health_type']));

        return $rules;
    }
}
