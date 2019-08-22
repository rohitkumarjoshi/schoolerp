<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Results Model
 *
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\BelongsTo $StudentInfos
 * @property \App\Model\Table\ExamMastersTable|\Cake\ORM\Association\BelongsTo $ExamMasters
 * @property \App\Model\Table\ResultRowsTable|\Cake\ORM\Association\HasMany $ResultRows
 *
 * @method \App\Model\Entity\Result get($primaryKey, $options = [])
 * @method \App\Model\Entity\Result newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Result[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Result|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Result|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Result patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Result[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Result findOrCreate($search, callable $callback = null, $options = [])
 */
class ResultsTable extends Table
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

        $this->setTable('results');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('StudentInfos', [
            'foreignKey' => 'student_info_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExamMasters', [
            'foreignKey' => 'exam_master_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ResultRows', [
            'dependent' => true,
            'cascadeCallbacks' => true,
            'foreignKey' => 'result_id'
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
            ->integer('total')
            ->allowEmpty('total');

        $validator
            ->decimal('obtain')
            ->allowEmpty('obtain');

        $validator
            ->scalar('status')
            ->allowEmpty('status');

        $validator
            ->scalar('division')
            ->maxLength('division', 50)
            ->allowEmpty('division');

        $validator
            ->scalar('grade')
            ->allowEmpty('grade');

        $validator
            ->decimal('percentage')
            ->allowEmpty('percentage');

        $validator
            ->scalar('supplementary')
            ->allowEmpty('supplementary');

        $validator
            ->scalar('fail')
            ->allowEmpty('fail');

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
        $rules->add($rules->existsIn(['student_info_id'], 'StudentInfos'));
        $rules->add($rules->existsIn(['exam_master_id'], 'ExamMasters'));

        return $rules;
    }
}
