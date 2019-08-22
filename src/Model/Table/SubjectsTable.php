<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * Subjects Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $ParentSubjects
 * @property \App\Model\Table\SubjectTypesTable|\Cake\ORM\Association\BelongsTo $SubjectTypes
 * @property \App\Model\Table\BestMarkSubjectsTable|\Cake\ORM\Association\HasMany $BestMarkSubjects
 * @property \App\Model\Table\BooksTable|\Cake\ORM\Association\HasMany $Books
 * @property \App\Model\Table\ScalingsTable|\Cake\ORM\Association\HasMany $Scalings
 * @property \App\Model\Table\StudentMarksTable|\Cake\ORM\Association\HasMany $StudentMarks
 * @property \App\Model\Table\SubjectMaxMarksTable|\Cake\ORM\Association\HasMany $SubjectMaxMarks
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\HasMany $ChildSubjects
 *
 * @method \App\Model\Entity\Subject get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Subject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subject|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subject findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class SubjectsTable extends Table
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

        $this->setTable('subjects');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('FacultyClassMappings', [
            'foreignKey' => 'subject_id',
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
        $this->belongsTo('ParentSubjects', [
            'className' => 'Subjects',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('SubjectTypes', [
            'foreignKey' => 'subject_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('BestMarkSubjects', [
            'foreignKey' => 'subject_id'
        ]);
        $this->hasMany('Books', [
            'foreignKey' => 'subject_id'
        ]);
        $this->hasMany('Scalings', [
            'foreignKey' => 'subject_id'
        ]);
        $this->hasMany('StudentMarks', [
            'foreignKey' => ['subject_id']
        ]);
        $this->hasMany('ExamMaxMarks', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ResultRows', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
        $this->hasOne('ChildSubjects', [
            'className' => 'Subjects',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Exams', [
                'className' => 'ExamMasters'
            ])
        ->setForeignKey([
            'student_class_id',
            'stream_id'
        ])
        ->setBindingKey([
            'student_class_id',
            'stream_id'
        ]);

        $this->belongsTo('Mediums'); 
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
            ->maxLength('name', 80)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('elective')
            ->requirePresence('elective', 'create')
            ->notEmpty('elective');

        $validator
            ->integer('order_number')
            ->requirePresence('order_number', 'create')
            ->notEmpty('order_number');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentSubjects'));
        $rules->add($rules->existsIn(['subject_type_id'], 'SubjectTypes'));

        return $rules;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['name'])) {
            $data['name'] = ucwords($data['name']);
        }
    }
}
