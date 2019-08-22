<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeeTypeStudentMasters Model
 *
 * @property \App\Model\Table\FeeTypeMasterRowsTable|\Cake\ORM\Association\BelongsTo $FeeTypeMasterRows
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\BelongsTo $StudentInfos
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\FeeReceiptRowsTable|\Cake\ORM\Association\HasMany $FeeReceiptRows
 *
 * @method \App\Model\Entity\FeeTypeStudentMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeTypeStudentMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeTypeStudentMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeStudentMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeTypeStudentMaster|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeTypeStudentMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeStudentMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeTypeStudentMaster findOrCreate($search, callable $callback = null, $options = [])
 */
class FeeTypeStudentMastersTable extends Table
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

        $this->setTable('fee_type_student_masters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('FeeTypeMasterRows', [
            'foreignKey' => 'fee_type_master_row_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentInfos', [
            'foreignKey' => 'student_info_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('FeeReceiptRows', [
            'foreignKey' => 'fee_type_student_master_id'
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

        /*$validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
            ->scalar('remarks')
            ->requirePresence('remarks', 'create')
            ->notEmpty('remarks');*/

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
        /*$rules->add($rules->existsIn(['fee_type_master_row_id'], 'FeeTypeMasterRows'));
        $rules->add($rules->existsIn(['student_info_id'], 'StudentInfos'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));*/

        return $rules;
    }
}
