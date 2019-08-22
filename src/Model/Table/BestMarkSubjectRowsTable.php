<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BestMarkSubjectRows Model
 *
 * @property \App\Model\Table\BestMarkSubjectsTable|\Cake\ORM\Association\BelongsTo $BestMarkSubjects
 * @property \App\Model\Table\ExamMastersTable|\Cake\ORM\Association\BelongsTo $ExamMasters
 *
 * @method \App\Model\Entity\BestMarkSubjectRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\BestMarkSubjectRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BestMarkSubjectRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BestMarkSubjectRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BestMarkSubjectRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BestMarkSubjectRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BestMarkSubjectRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BestMarkSubjectRow findOrCreate($search, callable $callback = null, $options = [])
 */
class BestMarkSubjectRowsTable extends Table
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

        $this->setTable('best_mark_subject_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('BestMarkSubjects', [
            'foreignKey' => 'best_mark_subject_id',
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
        $rules->add($rules->existsIn(['best_mark_subject_id'], 'BestMarkSubjects'));
        $rules->add($rules->existsIn(['exam_master_id'], 'ExamMasters'));

        return $rules;
    }
}
