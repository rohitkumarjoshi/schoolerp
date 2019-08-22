<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TotalMeetings Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\FeeMonthsTable|\Cake\ORM\Association\BelongsTo $FeeMonths
 *
 * @method \App\Model\Entity\TotalMeeting get($primaryKey, $options = [])
 * @method \App\Model\Entity\TotalMeeting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TotalMeeting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TotalMeeting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TotalMeeting|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TotalMeeting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TotalMeeting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TotalMeeting findOrCreate($search, callable $callback = null, $options = [])
 */
class TotalMeetingsTable extends Table
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

        $this->setTable('total_meetings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Media', [
            'foreignKey' => 'medium_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FeeMonths', [
            'foreignKey' => 'fee_month_id',
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
            ->decimal('total_meeting')
            ->requirePresence('total_meeting', 'create')
            ->notEmpty('total_meeting');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->integer('edited_by')
            ->allowEmpty('edited_by');

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
        $rules->add($rules->existsIn(['medium_id'], 'Media'));
        $rules->add($rules->existsIn(['student_class_id'], 'StudentClasses'));
        $rules->add($rules->existsIn(['stream_id'], 'Streams'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));
        $rules->add($rules->existsIn(['fee_month_id'], 'FeeMonths'));

        return $rules;
    }
}
