<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HostelStudentAssets Model
 *
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\HostelRoomAssetsTable|\Cake\ORM\Association\BelongsTo $HostelRoomAssets
 *
 * @method \App\Model\Entity\HostelStudentAsset get($primaryKey, $options = [])
 * @method \App\Model\Entity\HostelStudentAsset newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HostelStudentAsset[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HostelStudentAsset|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HostelStudentAsset|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HostelStudentAsset patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HostelStudentAsset[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HostelStudentAsset findOrCreate($search, callable $callback = null, $options = [])
 */
class HostelStudentAssetsTable extends Table
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

        $this->setTable('hostel_student_assets');
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
        $this->belongsTo('HostelRoomAssets', [
            'foreignKey' => 'hostel_room_asset_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['HostelRoomAssets.is_deleted'=>'N']);

        $this->hasMany('HostelStudentAssetReturns', [
            'className'=>'HostelStudentAssets',
            'joinType' => 'left'
        ])
        ->setForeignKey([
            'hostel_room_asset_id',
            'student_id'
        ])
        ->setBindingKey([
            'hostel_room_asset_id',
            'student_id'
        ])
        ->setConditions(['HostelStudentAssetReturns.is_deleted'=>'N','HostelStudentAssetReturns.status'=>'Return']);
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
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        /*$validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));
        $rules->add($rules->existsIn(['hostel_room_asset_id'], 'HostelRoomAssets'));

        return $rules;
    }
}
