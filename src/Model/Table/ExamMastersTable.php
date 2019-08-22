<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExamMasters Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 * @property \App\Model\Table\ExamMastersTable|\Cake\ORM\Association\BelongsTo $ParentExamMasters
 * @property \App\Model\Table\ExamMastersTable|\Cake\ORM\Association\HasMany $ChildExamMasters
 * @property |\Cake\ORM\Association\HasMany $ExamMaxMarks
 * @property \App\Model\Table\StudentMarksTable|\Cake\ORM\Association\HasMany $StudentMarks
 * @property |\Cake\ORM\Association\HasMany $SubExams
 *
 * @method \App\Model\Entity\ExamMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExamMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExamMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExamMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExamMaster|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExamMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExamMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExamMaster findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class ExamMastersTable extends Table
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

        $this->setTable('exam_masters');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('ParentExamMasters', [
            'className' => 'ExamMasters',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildExamMasters', [
            'className' => 'ExamMasters',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ExamMaxMarks', [
            'foreignKey' => 'exam_master_id'
        ]);
        $this->hasMany('StudentMarks', [
            'foreignKey' => 'exam_master_id'
        ]);
        $this->hasMany('SubExams', [
            'foreignKey' => 'exam_master_id'
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'exam_master_id'
        ]);
        $this->hasMany('ResultRows', [
            'foreignKey' => 'exam_master_id'
        ]);
        $this->belongsTo('Mediums');
        $this->hasMany('Subjects')
        ->setForeignKey([
            'student_class_id',
            'stream_id',
            'session_year_id'
        ])
        ->setBindingKey([
            'student_class_id',
            'stream_id',
            'session_year_id'
        ])
        ->setConditions(['Subjects.rght-Subjects.lft'=>1]); 
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('order_number')
            ->requirePresence('order_number', 'create')
            ->notEmpty('order_number');

        $validator
            ->integer('max_marks')
            ->allowEmpty('max_marks');

        $validator
            ->integer('number_of_best')
            ->allowEmpty('number_of_best');

        // $validator
        //     ->dateTime('created_on')
        //     ->requirePresence('created_on', 'create')
        //     ->notEmpty('created_on');

        // $validator
        //     ->integer('created_by')
        //     ->requirePresence('created_by', 'create')
        //     ->notEmpty('created_by');

        // $validator
        //     ->dateTime('edited_on')
        //     ->requirePresence('edited_on', 'create')
        //     ->notEmpty('edited_on');

        // $validator
        //     ->integer('edited_by')
        //     ->requirePresence('edited_by', 'create')
        //     ->notEmpty('edited_by');

        // $validator
        //     ->scalar('is_deleted')
        //     ->requirePresence('is_deleted', 'create')
        //     ->notEmpty('is_deleted');

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
        $rules->add($rules->existsIn(['student_class_id'], 'StudentClasses'));
        $rules->add($rules->existsIn(['stream_id'], 'Streams'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentExamMasters'));

        return $rules;
    }
}
