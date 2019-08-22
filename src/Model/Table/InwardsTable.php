<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inwards Model
 *
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\InwardDetailsTable|\Cake\ORM\Association\HasMany $InwardDetails
 *
 * @method \App\Model\Entity\Inward get($primaryKey, $options = [])
 * @method \App\Model\Entity\Inward newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Inward[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Inward|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inward|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inward patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Inward[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Inward findOrCreate($search, callable $callback = null, $options = [])
 */
class InwardsTable extends Table
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

        $this->setTable('inwards');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'left'
        ]);
        $this->hasMany('InwardDetails', [
            'foreignKey' => 'inward_id'
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

        /*$validator
            ->scalar('item_description')
            ->requirePresence('item_description', 'create')
            ->notEmpty('item_description');

        $validator
            ->scalar('party_name')
            ->maxLength('party_name', 50)
            ->requirePresence('party_name', 'create')
            ->notEmpty('party_name');

        $validator
            ->scalar('party_address')
            ->requirePresence('party_address', 'create')
            ->notEmpty('party_address');

        $validator
            ->scalar('in_time')
            ->maxLength('in_time', 20)
            ->requirePresence('in_time', 'create')
            ->notEmpty('in_time');

        $validator
            ->scalar('in_date')
            ->maxLength('in_date', 20)
            ->requirePresence('in_date', 'create')
            ->notEmpty('in_date');

        $validator
            ->scalar('out_time')
            ->maxLength('out_time', 20)
            ->requirePresence('out_time', 'create')
            ->notEmpty('out_time');

        $validator
            ->scalar('out_date')
            ->maxLength('out_date', 20)
            ->requirePresence('out_date', 'create')
            ->notEmpty('out_date');

        $validator
            ->scalar('bill_no')
            ->maxLength('bill_no', 100)
            ->requirePresence('bill_no', 'create')
            ->notEmpty('bill_no');

        $validator
            ->scalar('person_name')
            ->maxLength('person_name', 50)
            ->requirePresence('person_name', 'create')
            ->notEmpty('person_name');

        $validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 20)
            ->requirePresence('mobile_no', 'create')
            ->notEmpty('mobile_no');

        $validator
            ->scalar('remarks')
            ->maxLength('remarks', 200)
            ->requirePresence('remarks', 'create')
            ->notEmpty('remarks');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->scalar('inward_status')
            ->requirePresence('inward_status', 'create')
            ->notEmpty('inward_status');

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
        //$rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
}
