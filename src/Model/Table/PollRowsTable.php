<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PollRows Model
 *
 * @property \App\Model\Table\PollsTable|\Cake\ORM\Association\BelongsTo $Polls
 * @property \App\Model\Table\PollResultsTable|\Cake\ORM\Association\HasMany $PollResults
 *
 * @method \App\Model\Entity\PollRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\PollRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PollRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PollRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PollRow|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PollRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PollRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PollRow findOrCreate($search, callable $callback = null, $options = [])
 */
class PollRowsTable extends Table
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

        $this->setTable('poll_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Polls', [
            'foreignKey' => 'poll_id',
            'joinType' => 'left'
        ]);
        $this->hasMany('PollResults', [
            'foreignKey' => 'poll_row_id',
            'joinType' => 'left'
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
            ->scalar('objective')
            ->requirePresence('objective', 'create')
            ->notEmpty('objective');

        $validator
            ->scalar('correct_answer')
            ->requirePresence('correct_answer', 'create')
            ->notEmpty('correct_answer');

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
        $rules->add($rules->existsIn(['poll_id'], 'Polls'));

        return $rules;
    }
}
