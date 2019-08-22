<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeeMonths Model
 *
 * @property \App\Model\Table\FeeReceiptRowsTable|\Cake\ORM\Association\HasMany $FeeReceiptRows
 * @property \App\Model\Table\FeeTypeMasterRowsTable|\Cake\ORM\Association\HasMany $FeeTypeMasterRows
 *
 * @method \App\Model\Entity\FeeMonth get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeMonth newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeMonth[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeMonth|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeMonth|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeMonth patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeMonth[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeMonth findOrCreate($search, callable $callback = null, $options = [])
 */
class FeeMonthsTable extends Table
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

        $this->setTable('fee_months');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('FeeReceiptRows', [
            'foreignKey' => 'fee_month_id'
        ]);
        $this->hasMany('FeeTypeMasterRows', [
            'foreignKey' => 'fee_month_id'
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
            ->maxLength('name', 10)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        /*$validator
            ->scalar('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

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
        //$rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
