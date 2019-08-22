<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * Attendances Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\BelongsTo $StudentInfos
 *
 * @method \App\Model\Entity\Attendance get($primaryKey, $options = [])
 * @method \App\Model\Entity\Attendance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Attendance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Attendance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Attendance|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Attendance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Attendance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Attendance findOrCreate($search, callable $callback = null, $options = [])
 */
class AttendancesTable extends Table
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
        $this->setTable('attendances');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        /*$this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'left'
        ])
        ->setConditions(['StudentClasses.session_year_id'=>$session_year_id,'StudentClasses.is_deleted'=>'N']);

        $this->belongsTo('Mediums', [
            'foreignKey' => 'medium_id',
            'joinType' => 'left'
        ])
        ->setConditions(['Mediums.session_year_id'=>$session_year_id,'Mediums.is_deleted'=>'N']);

        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id'
        ])
        ->setConditions(['Sections.session_year_id'=>$session_year_id,'Sections.is_deleted'=>'N']);

        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id'
        ])
        ->setConditions(['Streams.session_year_id'=>$session_year_id,'Streams.is_deleted'=>'N']);*/

        $this->belongsTo('StudentInfos', [
            'foreignKey' => 'student_info_id',
            'joinType' => 'left'
        ])
        ->setConditions(['StudentInfos.session_year_id'=>$session_year_id]);

        $this->belongsTo('StudentInfoApis', [
            'className' => 'StudentInfos',
            'foreignKey' => 'student_info_id'
        ]);
        $this->belongsTo('ClassMappings');
        $this->belongsTo('TotalMeetings');
        $this->belongsTo('FeeMonths');
        $this->belongsTo('AcademicCalenders');
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
            ->scalar('first_half')
            ->requirePresence('first_half', 'create')
            ->notEmpty('first_half');

        $validator
            ->scalar('second_half')
            ->requirePresence('second_half', 'create')
            ->notEmpty('second_half');

        $validator
            ->date('attendance_date')
            ->requirePresence('attendance_date', 'create')
            ->notEmpty('attendance_date');

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
        //$rules->add($rules->existsIn(['medium_id'], 'Mediums'));
        //$rules->add($rules->existsIn(['student_class_id'], 'StudentClasses'));
        //$rules->add($rules->existsIn(['stream_id'], 'Streams'));
        //$rules->add($rules->existsIn(['section_id'], 'Sections'));
        //$rules->add($rules->existsIn(['student_info_id'], 'StudentInfos'));

        return $rules;
    }
}
