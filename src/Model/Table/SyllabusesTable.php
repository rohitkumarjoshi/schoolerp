<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Syllabuses Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 *
 * @method \App\Model\Entity\Syllabus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Syllabus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Syllabus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Syllabus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Syllabus|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Syllabus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Syllabus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Syllabus findOrCreate($search, callable $callback = null, $options = [])
 */
class SyllabusesTable extends Table
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

        $this->setTable('syllabuses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('FacultyClassMappings');
        
        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Mediums', [
            'foreignKey' => 'medium_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id'
        ]);
        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('StudentInfos');
        $this->belongsTo('ClassMappings');
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
            ->scalar('file_path')
            ->maxLength('file_path', 100)
            ->requirePresence('file_path', 'create')
            ->notEmpty('file_path');

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
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));
        $rules->add($rules->existsIn(['medium_id'], 'Mediums'));
        $rules->add($rules->existsIn(['student_class_id'], 'StudentClasses'));
 

        return $rules;
    }
}
