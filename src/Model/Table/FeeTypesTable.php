<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * FeeTypes Model
 *
 * @property \App\Model\Table\FeeCategoriesTable|\Cake\ORM\Association\BelongsTo $FeeCategories
 * @property \App\Model\Table\FeeTypeMastersTable|\Cake\ORM\Association\HasMany $FeeTypeMasters
 *
 * @method \App\Model\Entity\FeeType get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeType findOrCreate($search, callable $callback = null, $options = [])
 */
class FeeTypesTable extends Table
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
        $this->setTable('fee_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('FeeCategories', [
            'foreignKey' => 'fee_category_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['FeeCategories.is_deleted'=>'N']);
        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('FeeTypeMasters', [
            'foreignKey' => 'fee_type_id'
        ])->setConditions(['FeeTypeMasters.is_deleted'=>'N']);
        $this->belongsTo('FeeTypeRoles', [
            'foreignKey' => 'fee_type_role_id'
        ]);
        $this->belongsTo('FeeReceiptDatas', [
            'className' => 'FeeReceipts',
            'bindingKey' => 'fee_type_role_id',
            'foreignKey' => 'fee_type_role_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['FeeReceiptDatas.session_year_id'=>$session_year_id,'FeeReceiptDatas.is_deleted'=>'N']);
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['fee_category_id'], 'FeeCategories'));

        return $rules;
    }
}
