<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentMarks Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\BelongsTo $StudentInfos
 * @property \App\Model\Table\ExamMastersTable|\Cake\ORM\Association\BelongsTo $ExamMasters
 * @property |\Cake\ORM\Association\BelongsTo $SubExams
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $Subjects
 *
 * @method \App\Model\Entity\StudentMark get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentMark newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudentMark[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentMark|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentMark|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentMark patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentMark[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentMark findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentMarksTable extends Table
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

        $this->setTable('student_marks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentInfos', [
            'foreignKey' => 'student_info_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExamMasters', [
            'foreignKey' => 'exam_master_id'
        ]);
        $this->belongsTo('SubExams', [
            'foreignKey' => 'sub_exam_id'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Mediums');
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

        $validator
            ->scalar('student_number')
            ->maxLength('student_number', 30)
            ->requirePresence('student_number', 'create')
            ->notEmpty('student_number');

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
        $rules->add($rules->existsIn(['student_info_id'], 'StudentInfos'));
        $rules->add($rules->existsIn(['exam_master_id'], 'ExamMasters'));
        $rules->add($rules->existsIn(['sub_exam_id'], 'SubExams'));
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));

        return $rules;
    }
}
