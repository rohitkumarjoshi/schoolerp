<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Visitors Model
 *
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property |\Cake\ORM\Association\BelongsTo $Employees
 * @property |\Cake\ORM\Association\BelongsTo $Students
 * @property |\Cake\ORM\Association\BelongsTo $Departments
 *
 * @method \App\Model\Entity\Visitor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Visitor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Visitor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Visitor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visitor|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visitor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Visitor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Visitor findOrCreate($search, callable $callback = null, $options = [])
 */
class VisitorsTable extends Table
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

        $this->setTable('visitors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'left'
        ]);
       /* $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER'
        ]);*/
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

    /*    $validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 15)
            ->requirePresence('mobile_no', 'create')
            ->notEmpty('mobile_no');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->date('in_date')
            ->requirePresence('in_date', 'create')
            ->notEmpty('in_date');

        $validator
            ->time('in_time')
            ->requirePresence('in_time', 'create')
            ->notEmpty('in_time');

        $validator
            ->date('out_date')
            ->requirePresence('out_date', 'create')
            ->notEmpty('out_date');

        $validator
            ->time('out_time')
            ->requirePresence('out_time', 'create')
            ->notEmpty('out_time');

        $validator
            ->scalar('vehicle_no')
            ->maxLength('vehicle_no', 50)
            ->requirePresence('vehicle_no', 'create')
            ->notEmpty('vehicle_no');

        $validator
            ->scalar('reason')
            ->requirePresence('reason', 'create')
            ->notEmpty('reason');

        $validator
            ->scalar('remarks')
            ->maxLength('remarks', 100)
            ->requirePresence('remarks', 'create')
            ->notEmpty('remarks');

        $validator
            ->scalar('id_card')
            ->maxLength('id_card', 30)
            ->requirePresence('id_card', 'create')
            ->notEmpty('id_card');

        $validator
            ->scalar('id_card_no')
            ->maxLength('id_card_no', 50)
            ->requirePresence('id_card_no', 'create')
            ->notEmpty('id_card_no');

        $validator
            ->scalar('photo')
            ->maxLength('photo', 100)
            ->requirePresence('photo', 'create')
            ->notEmpty('photo');

        $validator
            ->scalar('visitor_type')
            ->requirePresence('visitor_type', 'create')
            ->notEmpty('visitor_type');

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
            ->notEmpty('edited_by');

        $validator
            ->scalar('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');
*/
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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));
       // $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
}
