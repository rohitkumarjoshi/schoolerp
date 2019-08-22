<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * EnquiryFormStudents Model
 *
 * @property \App\Model\Table\GendersTable|\Cake\ORM\Association\BelongsTo $Genders
 * @property |\Cake\ORM\Association\BelongsTo $StudentParentProfessions
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property |\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 * @property |\Cake\ORM\Association\BelongsTo $LastMedia
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $LastClasses
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $LastStreams
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property |\Cake\ORM\Association\BelongsTo $ReservationCategories
 * @property |\Cake\ORM\Association\HasMany $FeeReceiptRows
 * @property \App\Model\Table\FeeReceiptsTable|\Cake\ORM\Association\HasMany $FeeReceipts
 * @property |\Cake\ORM\Association\HasMany $Students
 *
 * @method \App\Model\Entity\EnquiryFormStudent get($primaryKey, $options = [])
 * @method \App\Model\Entity\EnquiryFormStudent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EnquiryFormStudent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EnquiryFormStudent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnquiryFormStudent|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnquiryFormStudent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EnquiryFormStudent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EnquiryFormStudent findOrCreate($search, callable $callback = null, $options = [])
 */
class EnquiryFormStudentsTable extends Table
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
        $this->setTable('enquiry_form_students');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['Genders.is_deleted'=>'N']);

        $this->belongsTo('StudentParentProfessions', [
            'foreignKey' => 'student_parent_profession_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['StudentParentProfessions.is_deleted'=>'N']);

        $this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['StudentClasses.is_deleted'=>'N']);

        $this->belongsTo('Mediums', [
            'foreignKey' => 'medium_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['Mediums.is_deleted'=>'N']);

        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Streams.is_deleted'=>'N']);

        $this->belongsTo('LastMediums', [
            'className'=>'Mediums',
            'foreignKey' => 'last_medium_id'
        ])
        ->setConditions(['LastMediums.is_deleted'=>'N']);

        $this->belongsTo('LastClasses', [
            'className'=>'StudentClasses',
            'foreignKey' => 'last_class_id'
        ])
        ->setConditions(['LastClasses.is_deleted'=>'N']);

        $this->belongsTo('LastStreams', [
            'className'=>'Streams',
            'foreignKey' => 'last_stream_id'
        ])
        ->setConditions(['LastStreams.is_deleted'=>'N']);

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ReservationCategories', [
            'foreignKey' => 'reservation_category_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['ReservationCategories.is_deleted'=>'N']);

        $this->hasMany('FeeReceiptRows', [
            'foreignKey' => 'enquiry_form_student_id'
        ])
        ->setConditions(['FeeReceiptRows.is_deleted'=>'N']);

        $this->hasMany('FeeReceipts', [
            'foreignKey' => 'enquiry_form_student_id'
        ])
        ->setConditions(['FeeReceipts.session_year_id'=>$session_year_id,'FeeReceipts.is_deleted'=>'N']);
        
        $this->hasMany('Students', [
            'foreignKey' => 'enquiry_form_student_id'
        ]);
        $this->hasMany('StudentDocuments', [
            'foreignKey' => 'enquiry_form_student_id'
        ]);
        $this->hasMany('StudentFatherProfessions', [
            'foreignKey' => 'enquiry_form_student_id'
        ]);
        $this->hasMany('StudentMotherProfessions', [
            'foreignKey' => 'enquiry_form_student_id'
        ]);
        $this->belongsTo('VehicleStations', [
            'foreignKey' => 'vehicle_station_id'
        ])
        ->setConditions(['VehicleStations.is_deleted'=>'N']);
        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id'
        ])
        ->setConditions(['Vehicles.is_deleted'=>'N']);
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
            ->scalar('father_name')
            ->maxLength('father_name', 100)
            ->requirePresence('father_name', 'create')
            ->notEmpty('father_name');

        $validator
            ->scalar('mother_name')
            ->maxLength('mother_name', 100)
            ->requirePresence('mother_name', 'create')
            ->notEmpty('mother_name');

        $validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 100)
            ->requirePresence('mobile_no', 'create')
            ->notEmpty('mobile_no');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('rte')
            ->requirePresence('rte', 'create')
            ->notEmpty('rte');

        $validator
            ->scalar('last_school')
            ->maxLength('last_school', 100)
            ->allowEmpty('last_school');

        $validator
            ->scalar('percentage_in_last_class')
            ->maxLength('percentage_in_last_class', 10)
            ->allowEmpty('percentage_in_last_class');

        $validator
            ->scalar('board')
            ->maxLength('board', 100)
            ->allowEmpty('board');

        $validator
            ->scalar('permanent_address')
            ->requirePresence('permanent_address', 'create')
            ->notEmpty('permanent_address');

        $validator
            ->scalar('correspondence_address')
            ->allowEmpty('correspondence_address');

       

        $validator
            ->scalar('enquiry_mode')
            ->requirePresence('enquiry_mode', 'create')
            ->notEmpty('enquiry_mode');

        $validator
            ->date('dob')
            ->allowEmpty('dob');

        $validator
            ->scalar('hostel_facility')
            ->allowEmpty('hostel_facility');

        $validator
            ->scalar('minority')
            ->allowEmpty('minority');

        $validator
            ->scalar('local_guardian')
            ->maxLength('local_guardian', 100)
            ->allowEmpty('local_guardian');

        $validator
            ->scalar('guardian_address')
            ->allowEmpty('guardian_address');

        $validator
            ->integer('guardian_pincode')
            ->allowEmpty('guardian_pincode');

        $validator
            ->scalar('guardian_mobile_no')
            ->maxLength('guardian_mobile_no', 100)
            ->allowEmpty('guardian_mobile_no');

        $validator
            ->scalar('transportation')
            ->allowEmpty('transportation');

        $validator
            ->scalar('licence_no')
            ->maxLength('licence_no', 100)
            ->allowEmpty('licence_no');

        $validator
            ->date('exam_date')
            ->allowEmpty('exam_date');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->time('exam_time')
            ->allowEmpty('exam_time');

        $validator
            ->scalar('enquiry_status')
            ->allowEmpty('enquiry_status');

        $validator
            ->date('enquiry_date')
            ->allowEmpty('enquiry_date');

        $validator
            ->date('admission_form_date')
            ->allowEmpty('admission_form_date');

        $validator
            ->integer('admission_form_no')
            ->allowEmpty('admission_form_no');

        $validator
            ->scalar('admission_generated')
            ->allowEmpty('admission_generated');

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
        $rules->add($rules->existsIn(['gender_id'], 'Genders'));
        $rules->add($rules->existsIn(['student_class_id'], 'StudentClasses'));
        $rules->add($rules->existsIn(['medium_id'], 'Mediums'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));

        return $rules;
    }
}
