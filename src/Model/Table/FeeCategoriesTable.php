<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeeCategories Model
 *
 * @property \App\Model\Table\FeeTypeMastersTable|\Cake\ORM\Association\HasMany $FeeTypeMasters
 * @property \App\Model\Table\FeeTypesTable|\Cake\ORM\Association\HasMany $FeeTypes
 *
 * @method \App\Model\Entity\FeeCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class FeeCategoriesTable extends Table
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

        $this->setTable('fee_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('FeeTypeMasters', [
            'foreignKey' => 'fee_category_id'
        ]);
        $this->hasMany('FeeTypes', [
            'foreignKey' => 'fee_category_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('FeeReceipts', [
            'foreignKey' => 'fee_category_id',
             'joinType' => 'INNER'
        ]);
        $this->belongsTo('Expenses');
        $this->belongsTo('Mediums');
        $this->belongsTo('StudentClasses');
        $this->belongsTo('Streams');
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');
        $validator
            ->scalar('fee_collection')
            ->requirePresence('fee_collection', 'create')
            ->notEmpty('fee_collection');
            //->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        /*$validator
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
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
}
