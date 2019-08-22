<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * EntranceExamResults Model
 *
 * @property \App\Model\Table\EntranceExamsTable|\Cake\ORM\Association\BelongsTo $EntranceExams
 * @property \App\Model\Table\EnquiryFormStudentsTable|\Cake\ORM\Association\BelongsTo $EnquiryFormStudents
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 *
 * @method \App\Model\Entity\EntranceExamResult get($primaryKey, $options = [])
 * @method \App\Model\Entity\EntranceExamResult newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EntranceExamResult[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EntranceExamResult|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EntranceExamResult|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EntranceExamResult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EntranceExamResult[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EntranceExamResult findOrCreate($search, callable $callback = null, $options = [])
 */
class EntranceExamResultsTable extends Table
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
        $session_year_id = (new Session())->read('Auth.User.session_year_id');
        $this->setTable('entrance_exam_results');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('EntranceExams', [
            'foreignKey' => 'entrance_exam_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['EntranceExams.session_year_id'=>$session_year_id]);

        $this->belongsTo('EnquiryFormStudents', [
            'foreignKey' => 'enquiry_form_student_id',
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

        $validator
            ->scalar('obt_marks')
            ->maxLength('obt_marks', 15)
            ->requirePresence('obt_marks', 'create')
            ->notEmpty('obt_marks');

       /* $validator
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
            ->notEmpty('edited_by');*/

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
        $rules->add($rules->existsIn(['entrance_exam_id'], 'EntranceExams'));
        $rules->add($rules->existsIn(['enquiry_form_student_id'], 'EnquiryFormStudents'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));

        return $rules;
    }
}
