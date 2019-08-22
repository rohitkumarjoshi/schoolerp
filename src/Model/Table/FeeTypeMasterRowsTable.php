<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeeTypeMasterRows Model
 *
 * @property \App\Model\Table\FeeTypeMastersTable|\Cake\ORM\Association\BelongsTo $FeeTypeMasters
 * @property \App\Model\Table\FeeMonthsTable|\Cake\ORM\Association\BelongsTo $FeeMonths
 * @property \App\Model\Table\FeeReceiptRowsTable|\Cake\ORM\Association\HasMany $FeeReceiptRows
 * @property \App\Model\Table\FeeTypeStudentMastersTable|\Cake\ORM\Association\HasMany $FeeTypeStudentMasters
 *
 * @method \App\Model\Entity\FeeTypeMasterRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeTypeMasterRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeTypeMasterRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeMasterRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeTypeMasterRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeTypeMasterRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeMasterRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeMasterRow findOrCreate($search, callable $callback = null, $options = [])
 */
class FeeTypeMasterRowsTable extends Table
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

        $this->setTable('fee_type_master_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FeeTypeMasters', [
            'foreignKey' => 'fee_type_master_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FeeMonths', [
            'foreignKey' => 'fee_month_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('FeeReceiptRows', [
            'foreignKey' => 'fee_type_master_row_id'
        ]);
        $this->hasMany('FeeTypeStudentMasters', [
            'foreignKey' => 'fee_type_master_row_id'
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

        // $validator
        //     ->decimal('amount')
        //     ->requirePresence('amount', 'create')
        //     ->notEmpty('amount');

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
        $rules->add($rules->existsIn(['fee_type_master_id'], 'FeeTypeMasters'));
       // $rules->add($rules->existsIn(['fee_month_id'], 'FeeMonths'));

        return $rules;
    }
}
