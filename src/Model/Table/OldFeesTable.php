<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * OldFees Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\FeeCategoriesTable|\Cake\ORM\Association\BelongsTo $FeeCategories
 * @property \App\Model\Table\FeeTypeRolesTable|\Cake\ORM\Association\BelongsTo $FeeTypeRoles
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\FeeReceiptsTable|\Cake\ORM\Association\HasMany $FeeReceipts
 *
 * @method \App\Model\Entity\OldFee get($primaryKey, $options = [])
 * @method \App\Model\Entity\OldFee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OldFee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OldFee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OldFee|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OldFee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OldFee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OldFee findOrCreate($search, callable $callback = null, $options = [])
 */
class OldFeesTable extends Table
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
        $this->setTable('old_fees');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FeeCategories', [
            'foreignKey' => 'fee_category_id',
            'joinType' => 'INNER'
        ])->setConditions(['FeeCategories.is_deleted'=>'N']);
        
        $this->belongsTo('FeeTypeRoles', [
            'foreignKey' => 'fee_type_role_id'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('FeeReceipts', [
            'foreignKey' => 'old_fee_id'
        ])->setConditions(['FeeReceipts.is_deleted'=>'N']);
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
            ->integer('due_session_year')
            ->requirePresence('due_session_year', 'create')
            ->notEmpty('due_session_year');

        $validator
            ->decimal('due_amount')
            ->requirePresence('due_amount', 'create')
            ->notEmpty('due_amount');

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
        //$rules->add($rules->existsIn(['fee_category_id'], 'FeeCategories'));
        //$rules->add($rules->existsIn(['fee_type_role_id'], 'FeeTypeRoles'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));

        return $rules;
    }
}
