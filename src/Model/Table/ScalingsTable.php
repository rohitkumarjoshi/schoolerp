<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Scalings Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $Subjects
 *
 * @method \App\Model\Entity\Scaling get($primaryKey, $options = [])
 * @method \App\Model\Entity\Scaling newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Scaling[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Scaling|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Scaling|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Scaling patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Scaling[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Scaling findOrCreate($search, callable $callback = null, $options = [])
 */
class ScalingsTable extends Table
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

        $this->setTable('scalings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
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
            ->decimal('scale_no')
            ->requirePresence('scale_no', 'create')
            ->notEmpty('scale_no');

        // $validator
        //     ->dateTime('created_on')
        //     ->requirePresence('created_on', 'create')
        //     ->notEmpty('created_on');

        // $validator
        //     ->integer('created_by')
        //     ->requirePresence('created_by', 'create')
        //     ->notEmpty('created_by');

        // $validator
        //     ->dateTime('edited_on')
        //     ->requirePresence('edited_on', 'create')
        //     ->notEmpty('edited_on');

        // $validator
        //     ->integer('edited_by')
        //     ->requirePresence('edited_by', 'create')
        //     ->notEmpty('edited_by');

        // $validator
        //     ->scalar('is_deleted')
        //     ->requirePresence('is_deleted', 'create')
        //     ->notEmpty('is_deleted');

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
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));

        return $rules;
    }
}
