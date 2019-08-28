<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * Students Model
 *
 * @property \App\Model\Table\GendersTable|\Cake\ORM\Association\BelongsTo $Genders
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\AdmissionClassesTable|\Cake\ORM\Association\BelongsTo $AdmissionClasses
 * @property \App\Model\Table\AdmissionMediaTable|\Cake\ORM\Association\BelongsTo $AdmissionMedia
 * @property \App\Model\Table\AdmissionStreamsTable|\Cake\ORM\Association\BelongsTo $AdmissionStreams
 * @property \App\Model\Table\DisabilitiesTable|\Cake\ORM\Association\BelongsTo $Disabilities
 * @property \App\Model\Table\LastClassesTable|\Cake\ORM\Association\BelongsTo $LastClasses
 * @property \App\Model\Table\LastStreamsTable|\Cake\ORM\Association\BelongsTo $LastStreams
 * @property \App\Model\Table\LastMediaTable|\Cake\ORM\Association\BelongsTo $LastMedia
 * @property \App\Model\Table\BookIssueReturnsTable|\Cake\ORM\Association\HasMany $BookIssueReturns
 * @property \App\Model\Table\FeeTypeStudentMastersTable|\Cake\ORM\Association\HasMany $FeeTypeStudentMasters
 * @property \App\Model\Table\HostelAttendancesTable|\Cake\ORM\Association\HasMany $HostelAttendances
 * @property \App\Model\Table\HostelOutPassesTable|\Cake\ORM\Association\HasMany $HostelOutPasses
 * @property \App\Model\Table\HostelRegistrationsTable|\Cake\ORM\Association\HasMany $HostelRegistrations
 * @property \App\Model\Table\HostelStudentAssetsTable|\Cake\ORM\Association\HasMany $HostelStudentAssets
 * @property \App\Model\Table\ItemIssueReturnsTable|\Cake\ORM\Association\HasMany $ItemIssueReturns
 * @property \App\Model\Table\LibraryStudentInOutsTable|\Cake\ORM\Association\HasMany $LibraryStudentInOuts
 * @property \App\Model\Table\MessAttendancesTable|\Cake\ORM\Association\HasMany $MessAttendances
 * @property \App\Model\Table\StudentAchivementsTable|\Cake\ORM\Association\HasMany $StudentAchivements
 * @property \App\Model\Table\StudentDocumentsTable|\Cake\ORM\Association\HasMany $StudentDocuments
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\HasMany $StudentInfos
 * @property |\Cake\ORM\Association\HasMany $StudentMarks
 * @property \App\Model\Table\StudentRedDiariesTable|\Cake\ORM\Association\HasMany $StudentRedDiaries
 * @property \App\Model\Table\StudentSiblingsTable|\Cake\ORM\Association\HasMany $StudentSiblings
 * @property \App\Model\Table\VehicleFeedbacksTable|\Cake\ORM\Association\HasMany $VehicleFeedbacks
 * @property \App\Model\Table\VehicleStudentAttendancesTable|\Cake\ORM\Association\HasMany $VehicleStudentAttendances
 * @property |\Cake\ORM\Association\HasMany $Visitors
 *
 * @method \App\Model\Entity\Student get($primaryKey, $options = [])
 * @method \App\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentsTable extends Table
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
        $this->setTable('students');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['Genders.is_deleted'=>'N']);

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AdmissionClasses', [
            'className' => 'StudentClasses',
            'foreignKey' => 'admission_class_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['AdmissionClasses.is_deleted'=>'N']);

        $this->belongsTo('AdmissionMediums', [
            'className' => 'Mediums',
            'foreignKey' => 'admission_medium_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['AdmissionMediums.is_deleted'=>'N']);

        $this->belongsTo('EnquiryReceipts', [
            'className' => 'FeeReceipts',
            'foreignKey' => 'enquiry_form_student_id',
            'bindingKey' => 'enquiry_form_student_id'
        ])
        ->setConditions(['EnquiryReceipts.session_year_id'=>$session_year_id,'EnquiryReceipts.is_deleted'=>'N']);

        $this->belongsTo('AdmissionStreams', [
            'className' => 'Streams',
            'foreignKey' => 'admission_stream_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['AdmissionStreams.is_deleted'=>'N']);

        $this->belongsTo('Disabilities', [
            'foreignKey' => 'disability_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Disabilities.is_deleted'=>'N']);

        $this->belongsTo('LastClasses', [
            'className' => 'StudentClasses',
            'foreignKey' => 'last_class_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['LastClasses.is_deleted'=>'N']);

        $this->belongsTo('LastStreams', [
            'className' => 'Streams',
            'foreignKey' => 'last_stream_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['LastStreams.is_deleted'=>'N']);

        $this->belongsTo('LastMediums', [
            'className' => 'Mediums',
            'foreignKey' => 'last_medium_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['LastMediums.is_deleted'=>'N']);

        $this->belongsTo('EnquiryForms', [
            'className' => 'EnquiryFormStudents'
        ])
        ->setConditions(['EnquiryForms.session_year_id'=>$session_year_id]);

        $this->belongsTo('EnquiryFormStudents', [
            'foreignKey' => 'enquiry_form_student_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['EnquiryFormStudents.session_year_id'=>$session_year_id]);

        $this->hasMany('BookIssueReturns', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('FeeTypeStudentMasters', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('HostelAttendances', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('HostelOutPasses', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('HostelRegistrations', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('HostelStudentAssets', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('ItemIssueReturns', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('LibraryStudentInOuts', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('MessAttendances', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('StudentAchivements', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('StudentDocuments', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('SubmitDocuments', [
            'className'=>'StudentDocuments',
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('StudentInfos', [
            'foreignKey' => 'student_id'
        ])
        ->setConditions(['StudentInfos.session_year_id'=>$session_year_id,'StudentInfos.student_status !='=>'Discontinue']);

        $this->hasMany('SummaryStudentInfos', [
            'className' => 'StudentInfos',
            'foreignKey' => 'student_id'
        ]);

        $this->hasMany('AllStudentInfos', [
            'className' => 'StudentInfos',
            'foreignKey' => 'student_id'
        ])
        ->setConditions(['AllStudentInfos.session_year_id'=>$session_year_id]);

        $this->hasOne('StudentInfoApis', [
            'className' => 'StudentInfos',
            'foreignKey' => 'student_id' 
        ]);

        $this->hasMany('StudentMarks', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('StudentRedDiaries', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('StudentSiblings', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('VehicleFeedbacks', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('VehicleStudentAttendances', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('Visitors', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('OldFees', [
            'foreignKey' => 'student_id'
        ])->setConditions(['OldFees.session_year_id'=>$session_year_id]);
        
        $this->belongsTo('Documents');
        $this->belongsTo('Schools');
        $this->belongsTo('Leaves');
        $this->belongsTo('Feedbacks');
      
        $this->hasMany('DocumentClassMappings', [
            'className' => 'DocumentClassMappings',
            'bindingKey' => 'admission_class_id',
            'foreignKey' => 'student_class_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['DocumentClassMappings.is_deleted'=>'N']);
       

        $this->hasMany('Users', [
            'foreignKey' => 'student_id'
        ]);
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
        $this->hasOne('TransferCertificates', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('StudentFatherProfessions', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('StudentMotherProfessions', [
            'foreignKey' => 'student_id'
        ]);
		
		 $this->belongsTo('Leaves');
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
            ->allowEmpty('name');

       /*  $validator
            ->scalar('father_name')
            ->maxLength('father_name', 100)
            ->allowEmpty('father_name');

        $validator
            ->scalar('mother_name')
            ->maxLength('mother_name', 100)
            ->allowEmpty('mother_name'); */
        $validator
            ->scalar('scholar_no')
            ->maxLength('scholar_no', 100)
            ->allowEmpty('scholar_no');

        $validator
            ->date('registration_date')
            ->requirePresence('registration_date', 'create')
            ->notEmpty('registration_date');
 

        $validator
            ->scalar('parent_mobile_no')
            ->maxLength('parent_mobile_no', 100)
            ->requirePresence('parent_mobile_no', 'create')
            ->notEmpty('parent_mobile_no');

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
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));
        $rules->add($rules->existsIn(['admission_class_id'], 'AdmissionClasses'));
        $rules->add($rules->existsIn(['admission_medium_id'], 'AdmissionMediums'));
       
        //$rules->add($rules->existsIn(['disability_id'], 'Disabilities'));

        return $rules;
    }
}
