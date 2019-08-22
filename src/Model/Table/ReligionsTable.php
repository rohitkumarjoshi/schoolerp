<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Religions Model
 *
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\HasMany $StudentInfos
 *
 * @method \App\Model\Entity\Religion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Religion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Religion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Religion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Religion|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Religion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Religion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Religion findOrCreate($search, callable $callback = null, $options = [])
 */
class ReligionsTable extends Table
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

        $this->setTable('religions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('StudentInfos', [
            'foreignKey' => 'religion_id'
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
           // ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        

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
        //$rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
