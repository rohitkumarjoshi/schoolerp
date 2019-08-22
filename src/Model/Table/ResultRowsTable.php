<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResultRows Model
 *
 * @property \App\Model\Table\ResultsTable|\Cake\ORM\Association\BelongsTo $Results
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $Subjects
 * @property \App\Model\Table\ExamMastersTable|\Cake\ORM\Association\BelongsTo $ExamMasters
 *
 * @method \App\Model\Entity\ResultRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResultRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResultRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResultRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResultRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResultRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResultRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResultRow findOrCreate($search, callable $callback = null, $options = [])
 */
class ResultRowsTable extends Table
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

        $this->setTable('result_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Results', [
            'foreignKey' => 'result_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExamMasters', [
            'foreignKey' => 'exam_master_id',
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
            ->integer('total')
            ->allowEmpty('total');

        $validator
            ->scalar('obtain')
            ->allowEmpty('obtain');

        $validator
            ->scalar('grade')
            ->maxLength('grade', 5)
            ->allowEmpty('grade');

        $validator
            ->decimal('grace')
            ->allowEmpty('grace');

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
        $rules->add($rules->existsIn(['result_id'], 'Results'));
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        $rules->add($rules->existsIn(['exam_master_id'], 'ExamMasters'));

        return $rules;
    }
}
