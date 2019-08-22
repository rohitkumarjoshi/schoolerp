<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * FeeTypeMasters Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\FeeCategoriesTable|\Cake\ORM\Association\BelongsTo $FeeCategories
 * @property \App\Model\Table\FeeTypesTable|\Cake\ORM\Association\BelongsTo $FeeTypes
 * @property \App\Model\Table\VehicleStationsTable|\Cake\ORM\Association\BelongsTo $VehicleStations
 * @property \App\Model\Table\GendersTable|\Cake\ORM\Association\BelongsTo $Genders
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 * @property \App\Model\Table\FeeReceiptRowsTable|\Cake\ORM\Association\HasMany $FeeReceiptRows
 * @property \App\Model\Table\FeeTypeMasterRowsTable|\Cake\ORM\Association\HasMany $FeeTypeMasterRows
 *
 * @method \App\Model\Entity\FeeTypeMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeTypeMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeTypeMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeTypeMaster|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeTypeMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeMaster findOrCreate($search, callable $callback = null, $options = [])
 */
class FeeTypeMastersTable extends Table
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
        $this->setTable('fee_type_masters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FeeCategories', [
            'foreignKey' => 'fee_category_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['FeeCategories.is_deleted'=>'N']);

        $this->belongsTo('FeeTypes', [
            'foreignKey' => 'fee_type_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['FeeTypes.session_year_id'=>$session_year_id,'FeeTypes.is_deleted'=>'N']);

        $this->belongsTo('VehicleStations', [
            'foreignKey' => 'vehicle_station_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['VehicleStations.is_deleted'=>'N']);

        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Genders.is_deleted'=>'N']);

        $this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['StudentClasses.is_deleted'=>'N']);

        $this->belongsTo('Mediums', [
            'foreignKey' => 'medium_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Mediums.is_deleted'=>'N']);

        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Streams.is_deleted'=>'N']);

        $this->hasMany('FeeReceiptRows', [
            'foreignKey' => 'fee_type_master_id'
        ])
        ->setConditions(['FeeReceiptRows.is_deleted'=>'N']);

        $this->hasMany('FeeTypeMasterRows', [
            'foreignKey' => 'fee_type_master_id',
            'saveStrategy'=>'replace'
        ]);

        $this->belongsTo('Hostels', [
            'foreignKey' => 'hostel_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Hostels.is_deleted'=>'N']);
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
            ->scalar('optional')
            ->requirePresence('optional', 'create')
            ->notEmpty('optional');*/

       /* $validator
            ->scalar('fee_wise')
            ->requirePresence('fee_wise', 'create')
            ->notEmpty('fee_wise');
            */
        /*$validator
            ->scalar('student_wise')
            ->requirePresence('student_wise', 'create')
            ->notEmpty('student_wise');*/

        /*$validator
            ->scalar('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

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
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));
        $rules->add($rules->existsIn(['fee_category_id'], 'FeeCategories'));
        //$rules->add($rules->existsIn(['fee_type_id'], 'FeeTypes'));

        return $rules;
    }
}
