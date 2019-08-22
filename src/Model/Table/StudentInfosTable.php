<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * StudentInfos Model
 *
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\FeeTypeRolesTable|\Cake\ORM\Association\BelongsTo $FeeTypeRoles
 * @property \App\Model\Table\VehicleStationsTable|\Cake\ORM\Association\BelongsTo $VehicleStations
 * @property \App\Model\Table\ReservationCategoriesTable|\Cake\ORM\Association\BelongsTo $ReservationCategories
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\CastesTable|\Cake\ORM\Association\BelongsTo $Castes
 * @property \App\Model\Table\ReligionsTable|\Cake\ORM\Association\BelongsTo $Religions
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property |\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 * @property \App\Model\Table\HousesTable|\Cake\ORM\Association\BelongsTo $Houses
 * @property \App\Model\Table\StudentParentProfessionsTable|\Cake\ORM\Association\BelongsTo $StudentParentProfessions
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 * @property \App\Model\Table\HostelsTable|\Cake\ORM\Association\BelongsTo $Hostels
 * @property \App\Model\Table\RoomsTable|\Cake\ORM\Association\BelongsTo $Rooms
 * @property \App\Model\Table\FeeReceiptsTable|\Cake\ORM\Association\HasMany $FeeReceipts
 * @property \App\Model\Table\StudentHealthsTable|\Cake\ORM\Association\HasMany $StudentHealths
 * @property \App\Model\Table\StudentMarksTable|\Cake\ORM\Association\HasMany $StudentMarks
 *
 * @method \App\Model\Entity\StudentInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudentInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentInfo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentInfo findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentInfosTable extends Table
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
        $this->setTable('student_infos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Attendances', [
            'foreignKey' => 'student_info_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ReceiptStudents', [
            'className' => 'Students',
            'foreignKey' => 'student_id',
            'joinType' => 'left'
        ]);
        $this->belongsTo('FeeTypeRoles', [
            'foreignKey' => 'fee_type_role_id'
        ]);
        $this->belongsTo('VehicleStations', [
            'foreignKey' => 'vehicle_station_id'
        ])
        ->setConditions(['VehicleStations.is_deleted'=>'N']);

        $this->belongsTo('ReservationCategories', [
            'foreignKey' => 'reservation_category_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['ReservationCategories.is_deleted'=>'N']);

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['States.is_deleted'=>'N']);

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['Cities.is_deleted'=>'N']);

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Castes', [
            'foreignKey' => 'caste_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Castes.is_deleted'=>'N']);

        $this->belongsTo('Religions', [
            'foreignKey' => 'religion_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Religions.is_deleted'=>'N']);

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

        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id'
        ])
        ->setConditions(['Sections.is_deleted'=>'N']);

        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id'
        ])
        ->setConditions(['Streams.is_deleted'=>'N']);

        $this->belongsTo('Houses', [
            'foreignKey' => 'house_id'
        ])
        ->setConditions(['Houses.is_deleted'=>'N']);

        $this->belongsTo('StudentParentProfessions', [
            'foreignKey' => 'student_parent_profession_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['StudentParentProfessions.is_deleted'=>'N']);

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id'
        ])
        ->setConditions(['Vehicles.is_deleted'=>'N']);

        $this->belongsTo('Hostels', [
            'foreignKey' => 'hostel_id'
        ])
        ->setConditions(['Hostels.is_deleted'=>'N']);

        $this->belongsTo('Rooms', [
            'foreignKey' => 'room_id'
        ])
        ->setConditions(['Rooms.is_deleted'=>'N']);

        $this->hasMany('FeeReceipts', [
            'foreignKey' => 'student_info_id'
        ])
        ->setConditions(['FeeReceipts.session_year_id'=>$session_year_id,'FeeReceipts.is_deleted'=>'N']);
        
        $this->hasMany('DeleteFeeReceipts', [
            'className' => 'FeeReceipts',
            'foreignKey' => 'student_info_id'
        ])
        ->setConditions(['DeleteFeeReceipts.session_year_id'=>$session_year_id,'DeleteFeeReceipts.is_deleted'=>'Y']);

        $this->hasMany('StudentHealths', [
            'foreignKey' => 'student_info_id'
        ]);
        $this->hasMany('StudentMarks', [
            'foreignKey' => 'student_info_id'
        ]);
        $this->hasMany('StudentElectiveSubjects', [
            'foreignKey' => 'student_info_id'
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'student_info_id'
        ]);

        $this->hasMany('Exams', [
                'className' => 'ExamMasters'
            ])
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
        ->setConditions(['Exams.rght-Exams.lft'=>1]); 

        //-- API 
        $this->belongsTo('StudentClassesApi', [
            'className' => 'StudentClasses',
            'foreignKey' => 'student_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MediumsApi', [
            'className' => 'Mediums',
            'foreignKey' => 'medium_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('SectionsApi', [
            'className' => 'Sections',
            'foreignKey' => 'section_id'
        ]);

        $this->belongsTo('StreamsApi', [
            'className' => 'Streams',
            'foreignKey' => 'stream_id'
        ]); 
		
		$this->belongsTo('Users')
			->setForeignKey([
				'student_id'
			])
			->setBindingKey([
				'student_id'
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
            ->scalar('permanent_address')
            ->requirePresence('permanent_address', 'create')
            ->notEmpty('permanent_address');

       /* $validator
            ->scalar('correspondence_address')
            ->requirePresence('correspondence_address', 'create')
            ->notEmpty('correspondence_address');*/

      /*  $validator
            ->scalar('roll_no')
            ->maxLength('roll_no', 100)
            ->requirePresence('roll_no', 'create')
            ->notEmpty('roll_no');

        $validator
            ->scalar('hostel_facility')
            ->requirePresence('hostel_facility', 'create')
            ->notEmpty('hostel_facility');

        $validator
            ->integer('pincode')
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

        $validator
            ->scalar('rte')
            ->requirePresence('rte', 'create')
            ->notEmpty('rte');

        $validator
            ->scalar('aadhaar_no')
            ->maxLength('aadhaar_no', 20)
            ->requirePresence('aadhaar_no', 'create')
            ->notEmpty('aadhaar_no');

        $validator
            ->scalar('hostel_tc_nodues')
            ->requirePresence('hostel_tc_nodues', 'create')
            ->notEmpty('hostel_tc_nodues');

        $validator
            ->date('hostel_tc_date')
            ->requirePresence('hostel_tc_date', 'create')
            ->notEmpty('hostel_tc_date');

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
        */
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
       //$rules->add($rules->existsIn(['fee_type_role_id'], 'FeeTypeRoles'));
        //$rules->add($rules->existsIn(['vehicle_station_id'], 'VehicleStations'));
        //$rules->add($rules->existsIn(['reservation_category_id'], 'ReservationCategories'));
       //$rules->add($rules->existsIn(['state_id'], 'States'));
        //$rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));
        //$rules->add($rules->existsIn(['caste_id'], 'Castes'));
        //$rules->add($rules->existsIn(['religion_id'], 'Religions'));
        $rules->add($rules->existsIn(['student_class_id'], 'StudentClasses'));
        $rules->add($rules->existsIn(['medium_id'], 'Mediums'));
        //$rules->add($rules->existsIn(['section_id'], 'Sections'));
       /* $rules->add($rules->existsIn(['stream_id'], 'Streams'));
        $rules->add($rules->existsIn(['house_id'], 'Houses'));
        $rules->add($rules->existsIn(['student_parent_profession_id'], 'StudentParentProfessions'));
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));
        $rules->add($rules->existsIn(['hostel_id'], 'Hostels'));
        $rules->add($rules->existsIn(['room_id'], 'Rooms'));*/

        return $rules;
    }
}
