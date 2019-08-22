<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleStudentAttendances Model
 *
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 *
 * @method \App\Model\Entity\VehicleStudentAttendance get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehicleStudentAttendance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehicleStudentAttendance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehicleStudentAttendance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleStudentAttendance|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleStudentAttendance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleStudentAttendance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleStudentAttendance findOrCreate($search, callable $callback = null, $options = [])
 */
class VehicleStudentAttendancesTable extends Table
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

        $this->setTable('vehicle_student_attendances');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER'
        ])->setConditions(['Vehicles.is_deleted'=>'N']);
        
        $this->belongsTo('Conductors', [
            'className' => 'Employees',
            'foreignKey' => 'taken_by',
            'joinType' => 'INNER'
        ])
        ->setConditions(['Conductors.role_id'=>3,'Conductors.is_deleted'=>'N']);
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
            ->time('in_time')
            ->requirePresence('in_time', 'create')
            ->notEmpty('in_time');

        $validator
            ->time('out_time')
            ->requirePresence('out_time', 'create')
            ->notEmpty('out_time');

        $validator
            ->integer('taken_by')
            ->requirePresence('taken_by', 'create')
            ->notEmpty('taken_by');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

      /*  $validator
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
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));

        return $rules;
    }
}
