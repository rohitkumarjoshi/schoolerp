<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubExams Model
 *
 * @property \App\Model\Table\ExamMastersTable|\Cake\ORM\Association\BelongsTo $ExamMasters
 * @property \App\Model\Table\StudentMarksTable|\Cake\ORM\Association\HasMany $StudentMarks
 *
 * @method \App\Model\Entity\SubExam get($primaryKey, $options = [])
 * @method \App\Model\Entity\SubExam newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SubExam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SubExam|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubExam|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubExam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SubExam[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SubExam findOrCreate($search, callable $callback = null, $options = [])
 */
class SubExamsTable extends Table
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

        $this->setTable('sub_exams');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ExamMasters', [
            'foreignKey' => 'exam_master_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('StudentMarks', [
            'foreignKey' => 'sub_exam_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
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

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('max_marks')
            ->requirePresence('max_marks', 'create')
            ->notEmpty('max_marks');

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
        $rules->add($rules->existsIn(['exam_master_id'], 'ExamMasters'));

        return $rules;
    }
}
