<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
/**
 * Hostels Model
 *
 * @property \App\Model\Table\WardensTable|\Cake\ORM\Association\BelongsTo $Wardens
 * @property \App\Model\Table\AssistantWardensTable|\Cake\ORM\Association\BelongsTo $AssistantWardens
 * @property \App\Model\Table\HostelAttendancesTable|\Cake\ORM\Association\HasMany $HostelAttendances
 * @property \App\Model\Table\HostelRegistrationsTable|\Cake\ORM\Association\HasMany $HostelRegistrations
 * @property \App\Model\Table\RoomsTable|\Cake\ORM\Association\HasMany $Rooms
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\HasMany $StudentInfos
 *
 * @method \App\Model\Entity\Hostel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Hostel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Hostel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Hostel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Hostel|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Hostel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Hostel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Hostel findOrCreate($search, callable $callback = null, $options = [])
 */
class HostelsTable extends Table
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

        $this->setTable('hostels');
        $this->setDisplayField('hostel_name');
        $this->setPrimaryKey('id');
        $this->belongsTo('Wardens', [
            'className' => 'Employees',
            'foreignKey' => 'warden_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['Wardens.role_id'=>6,'Wardens.is_deleted'=>'N']); 

         $this->belongsTo('AssistantWardens', [
            'className' => 'Employees',
            'foreignKey' => 'assistant_warden_id',
            'joinType' => 'left'
        ])
        ->setConditions(['AssistantWardens.role_id'=>7,'AssistantWardens.is_deleted'=>'N']);
       
        $this->hasMany('HostelAttendances', [
            'foreignKey' => 'hostel_id'
        ]);
        $this->hasMany('HostelRegistrations', [
            'foreignKey' => 'hostel_id'
        ]);
        $this->hasMany('Rooms', [
            'foreignKey' => 'hostel_id'
        ]);
        $this->hasMany('StudentInfos', [
            'foreignKey' => 'hostel_id'
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
            ->scalar('hostel_name')
            ->maxLength('hostel_name', 100)
            ->requirePresence('hostel_name', 'create')
            ->notEmpty('hostel_name');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->integer('no_of_rooms')
            ->requirePresence('no_of_rooms', 'create')
            ->notEmpty('no_of_rooms');

        /*$validator
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
        $rules->add($rules->existsIn(['warden_id'], 'Wardens'));
        //$rules->add($rules->existsIn(['assistant_warden_id'], 'AssistantWardens'));

        return $rules;
    }
}
