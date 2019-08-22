<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * FeeReceipts Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property |\Cake\ORM\Association\BelongsTo $FeeTypeMasters
 * @property |\Cake\ORM\Association\BelongsTo $EnquiryFormStudents
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\BelongsTo $StudentInfos
 * @property \App\Model\Table\FeeReceiptRowsTable|\Cake\ORM\Association\HasMany $FeeReceiptRows
 *
 * @method \App\Model\Entity\FeeReceipt get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeReceipt newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeReceipt[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeReceipt|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeReceipt|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeReceipt patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeReceipt[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeReceipt findOrCreate($search, callable $callback = null, $options = [])
 */
class FeeReceiptsTable extends Table
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
        $session_year_id = (new Session())->read('Auth.User.session_year_id');
        $this->setTable('fee_receipts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FeeCategories', [
            'foreignKey' => 'fee_category_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['FeeCategories.is_deleted'=>'N']);

        $this->belongsTo('ReceiptFeeCategories', [
            'className' => 'FeeCategories',
            'foreignKey' => 'fee_category_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['ReceiptFeeCategories.is_deleted'=>'N']);

        $this->belongsTo('EnquiryFormStudents', [
            'foreignKey' => 'enquiry_form_student_id'
        ])
        ->setConditions(['EnquiryFormStudents.session_year_id'=>$session_year_id]);

        $this->belongsTo('StudentInfos', [
            'foreignKey' => 'student_info_id'
        ])
        ->setConditions(['StudentInfos.session_year_id'=>$session_year_id]);
        
        $this->hasMany('FeeReceiptRows', [
            'foreignKey' => 'fee_receipt_id'
        ])
        ->setConditions(['FeeReceiptRows.is_deleted'=>'N']);

        $this->belongsTo('OldFees', [
            'foreignKey' => 'old_fee_id',
            'joinType' => 'LEFT'
        ])->setConditions(['OldFees.session_year_id'=>$session_year_id]);

        $this->belongsTo('FeeTypeRoles', [
            'foreignKey' => 'fee_type_role_id '
        ]);

        $this->belongsTo('FeeTypeMasters');
        $this->belongsTo('FeeTypeStudentMasters');
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
            ->integer('receipt_no')
            ->requirePresence('receipt_no', 'create')
            ->notEmpty('receipt_no');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        

        $validator
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount');

        $validator
            ->scalar('payment_type')
            ->maxLength('payment_type', 20)
            ->requirePresence('payment_type', 'create')
            ->notEmpty('payment_type');
        
        $validator
            ->date('receipt_date')
            ->requirePresence('receipt_date', 'create')
            ->notEmpty('receipt_date');

       $validator
            ->scalar('detail')
            ->allowEmpty('detail');

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
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));
        $rules->add($rules->existsIn(['fee_category_id'], 'FeeCategories'));
        $rules->add($rules->existsIn(['enquiry_form_student_id'], 'EnquiryFormStudents'));
        $rules->add($rules->existsIn(['student_info_id'], 'StudentInfos'));

        return $rules;
    }
}
