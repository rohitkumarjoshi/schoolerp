<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LibraryStudentInOuts Model
 *
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 *
 * @method \App\Model\Entity\LibraryStudentInOut get($primaryKey, $options = [])
 * @method \App\Model\Entity\LibraryStudentInOut newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LibraryStudentInOut[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LibraryStudentInOut|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LibraryStudentInOut|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LibraryStudentInOut patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LibraryStudentInOut[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LibraryStudentInOut findOrCreate($search, callable $callback = null, $options = [])
 */
class LibraryStudentInOutsTable extends Table
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

        $this->setTable('library_student_in_outs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
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

        // $validator
        //     ->date('in_date')
        //     ->requirePresence('in_date', 'create')
        //     ->notEmpty('in_date');

        // $validator
        //     ->time('in_time')
        //     ->requirePresence('in_time', 'create')
        //     ->notEmpty('in_time');

        // $validator
        //     ->date('out_date')
        //     ->requirePresence('out_date', 'create')
        //     ->notEmpty('out_date');

        // $validator
        //     ->time('out_time')
        //     ->requirePresence('out_time', 'create')
        //     ->notEmpty('out_time');

        // $validator
        //     ->scalar('status')
        //     ->requirePresence('status', 'create')
        //     ->notEmpty('status');

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
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));

        return $rules;
    }
}
