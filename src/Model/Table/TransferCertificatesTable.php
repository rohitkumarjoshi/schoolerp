<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransferCertificates Model
 *
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 *
 * @method \App\Model\Entity\TransferCertificate get($primaryKey, $options = [])
 * @method \App\Model\Entity\TransferCertificate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TransferCertificate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TransferCertificate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransferCertificate|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransferCertificate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TransferCertificate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TransferCertificate findOrCreate($search, callable $callback = null, $options = [])
 */
class TransferCertificatesTable extends Table
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
        $this->addBehavior('Datepicker');
        
        $this->setTable('transfer_certificates');
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
        $this->belongsTo('PromotedStudentClasses', [
            'className' => 'StudentClasses',
            'foreignKey' => 'higher_promotion_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('LastStudiedStudentClasses', [
            'className' => 'StudentClasses',
            'foreignKey' => 'last_studied_class_id',
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
            ->scalar('tc_type')
            ->requirePresence('tc_type', 'create')
            ->notEmpty('tc_type');

        $validator
            ->date('tc_apply_date')
            ->requirePresence('tc_apply_date', 'create')
            ->notEmpty('tc_apply_date');

        $validator
            ->date('tc_issue_date')
            ->requirePresence('tc_issue_date', 'create')
            ->notEmpty('tc_issue_date');

        $validator
            ->scalar('book_no')
            ->maxLength('book_no', 50)
            ->requirePresence('book_no', 'create')
            ->notEmpty('book_no');

        $validator
            ->requirePresence('tc_serial_no', 'create')
            ->notEmpty('tc_serial_no');

        $validator
            ->scalar('tc_status')
            ->requirePresence('tc_status', 'create')
            ->notEmpty('tc_status');

        $validator
            ->scalar('tc_reason')
            ->requirePresence('tc_reason', 'create')
            ->notEmpty('tc_reason');

        $validator
            ->scalar('school_board')
            ->maxLength('school_board', 20)
            ->requirePresence('school_board', 'create')
            ->notEmpty('school_board');

        $validator
            ->scalar('fail')
            ->maxLength('fail', 10)
            ->requirePresence('fail', 'create')
            ->notEmpty('fail');

        $validator
            ->scalar('subject')
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->scalar('higher_promotion')
            ->requirePresence('higher_promotion', 'create')
            ->notEmpty('higher_promotion');

        $validator
            ->scalar('dues_paid')
            ->requirePresence('dues_paid', 'create')
            ->notEmpty('dues_paid');

        $validator
            ->scalar('concession')
            ->requirePresence('concession', 'create')
            ->notEmpty('concession');

        $validator
            ->decimal('working_day_last_class')
            ->requirePresence('working_day_last_class', 'create')
            ->notEmpty('working_day_last_class');

        $validator
            ->decimal('present_day_last_class')
            ->requirePresence('present_day_last_class', 'create')
            ->notEmpty('present_day_last_class');

        $validator
            ->scalar('ncc_cadet')
            ->requirePresence('ncc_cadet', 'create')
            ->notEmpty('ncc_cadet');

        $validator
            ->scalar('general_conduct')
            ->maxLength('general_conduct', 15)
            ->requirePresence('general_conduct', 'create')
            ->notEmpty('general_conduct');

        $validator
            ->scalar('other_remark')
            ->requirePresence('other_remark', 'create')
            ->notEmpty('other_remark');

        $validator
            ->scalar('result_status')
            ->maxLength('result_status', 15)
            ->requirePresence('result_status', 'create')
            ->notEmpty('result_status');

        $validator
            ->scalar('extra_curricular_activity')
            ->requirePresence('extra_curricular_activity', 'create')
            ->notEmpty('extra_curricular_activity');

        $validator
            ->scalar('extra_curricular_activity_name')
            ->allowEmpty('extra_curricular_activity_name');

        $validator
            ->scalar('achievement')
            ->allowEmpty('achievement');

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
