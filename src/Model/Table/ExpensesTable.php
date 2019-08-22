<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Expenses Model
 *
 * @property \App\Model\Table\ExpenseCategoriesTable|\Cake\ORM\Association\BelongsTo $ExpenseCategories
 * @property \App\Model\Table\ExpenseSubcategoriesTable|\Cake\ORM\Association\BelongsTo $ExpenseSubcategories
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 *
 * @method \App\Model\Entity\Expense get($primaryKey, $options = [])
 * @method \App\Model\Entity\Expense newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Expense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Expense|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Expense|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Expense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Expense[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Expense findOrCreate($search, callable $callback = null, $options = [])
 */
class ExpensesTable extends Table
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

        $this->setTable('expenses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ExpenseCategories', [
            'foreignKey' => 'expense_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExpenseSubcategories', [
            'foreignKey' => 'expense_subcategory_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Employees', [
            'foreignKey' => 'expense_by',
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->integer('expense_by')
            ->requirePresence('expense_by', 'create')
            ->notEmpty('expense_by');

        $validator
            ->date('expense_date')
            ->requirePresence('expense_date', 'create')
            ->notEmpty('expense_date');

   /*     $validator
            ->scalar('remark')
            ->requirePresence('remark', 'create')
            ->notEmpty('remark');
*/
        $validator
            ->scalar('payment_mode')
            ->maxLength('payment_mode', 50)
            ->requirePresence('payment_mode', 'create')
            ->notEmpty('payment_mode');
/*
        $validator
            ->scalar('cheque_no')
            ->maxLength('cheque_no', 50)
            ->requirePresence('cheque_no', 'create')
            ->notEmpty('cheque_no');

        $validator
            ->date('cheque_date')
            ->requirePresence('cheque_date', 'create')
            ->notEmpty('cheque_date');

        $validator
            ->scalar('bank_name')
            ->maxLength('bank_name', 100)
            ->requirePresence('bank_name', 'create')
            ->notEmpty('bank_name');

        $validator
            ->scalar('bank_remarks')
            ->requirePresence('bank_remarks', 'create')
            ->notEmpty('bank_remarks');

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
        $rules->add($rules->existsIn(['expense_category_id'], 'ExpenseCategories'));
        $rules->add($rules->existsIn(['expense_subcategory_id'], 'ExpenseSubcategories'));
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));

        return $rules;
    }
}
