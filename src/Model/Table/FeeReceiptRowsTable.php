<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeeReceiptRows Model
 *
 * @property \App\Model\Table\FeeReceiptsTable|\Cake\ORM\Association\BelongsTo $FeeReceipts
 * @property \App\Model\Table\FeeTypeMasterRowsTable|\Cake\ORM\Association\BelongsTo $FeeTypeMasterRows
 * @property \App\Model\Table\FeeTypeStudentMastersTable|\Cake\ORM\Association\BelongsTo $FeeTypeStudentMasters
 * @property \App\Model\Table\FeeMonthsTable|\Cake\ORM\Association\BelongsTo $FeeMonths
 *
 * @method \App\Model\Entity\FeeReceiptRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeReceiptRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeReceiptRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeReceiptRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeReceiptRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeReceiptRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeReceiptRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeReceiptRow findOrCreate($search, callable $callback = null, $options = [])
 */
class FeeReceiptRowsTable extends Table
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

        $this->setTable('fee_receipt_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FeeReceipts', [
            'foreignKey' => 'fee_receipt_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FeeTypeMasterRows', [
            'foreignKey' => 'fee_type_master_row_id'
        ]);
        $this->belongsTo('FeeTypeStudentMasters', [
            'foreignKey' => 'fee_type_student_master_id'
        ]);
        $this->belongsTo('FeeMonths', [
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
        $rules->add($rules->existsIn(['fee_receipt_id'], 'FeeReceipts'));
        $rules->add($rules->existsIn(['fee_type_master_row_id'], 'FeeTypeMasterRows'));
        $rules->add($rules->existsIn(['fee_type_student_master_id'], 'FeeTypeStudentMasters'));
        $rules->add($rules->existsIn(['fee_month_id'], 'FeeMonths'));

        return $rules;
    }
}
