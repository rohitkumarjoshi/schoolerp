<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClassTestStudents Model
 *
 * @property \App\Model\Table\ClassTestsTable|\Cake\ORM\Association\BelongsTo $ClassTests
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\BelongsTo $StudentInfos
 *
 * @method \App\Model\Entity\ClassTestStudent get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClassTestStudent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClassTestStudent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClassTestStudent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassTestStudent|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassTestStudent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClassTestStudent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClassTestStudent findOrCreate($search, callable $callback = null, $options = [])
 */
class ClassTestStudentsTable extends Table
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

        $this->setTable('class_test_students');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ClassTests', [
            'foreignKey' => 'class_test_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentInfos', [
            'foreignKey' => 'student_info_id',
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
/*
        $validator
            ->decimal('marks')
            ->requirePresence('marks', 'create')
            ->notEmpty('marks');

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
        $rules->add($rules->existsIn(['class_test_id'], 'ClassTests'));
        $rules->add($rules->existsIn(['student_info_id'], 'StudentInfos'));

        return $rules;
    }
}
