<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SportRows Model
 *
 * @property \App\Model\Table\SportsTable|\Cake\ORM\Association\BelongsTo $Sports
 *
 * @method \App\Model\Entity\SportRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\SportRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SportRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SportRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SportRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SportRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SportRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SportRow findOrCreate($search, callable $callback = null, $options = [])
 */
class SportRowsTable extends Table
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

        $this->setTable('sport_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sports', [
            'foreignKey' => 'sport_id',
            'joinType' => 'INNER'
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
            ->scalar('file_path')
            ->maxLength('file_path', 200)
            ->requirePresence('file_path', 'create')
            ->notEmpty('file_path');

        $validator
            ->scalar('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

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
        $rules->add($rules->existsIn(['sport_id'], 'Sports'));

        return $rules;
    }
}
