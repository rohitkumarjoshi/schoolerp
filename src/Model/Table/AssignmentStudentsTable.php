<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssignmentStudents Model
 *
 * @property \App\Model\Table\AssignmentsTable|\Cake\ORM\Association\BelongsTo $Assignments
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\BelongsTo $StudentInfos
 *
 * @method \App\Model\Entity\AssignmentStudent get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssignmentStudent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssignmentStudent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssignmentStudent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssignmentStudent|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssignmentStudent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssignmentStudent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssignmentStudent findOrCreate($search, callable $callback = null, $options = [])
 */
class AssignmentStudentsTable extends Table
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

        $this->setTable('assignment_students');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Assignments', [
            'foreignKey' => 'assignment_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentInfos');
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
        $rules->add($rules->existsIn(['assignment_id'], 'Assignments'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));

        return $rules;
    }
}
