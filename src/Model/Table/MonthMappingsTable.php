<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MonthMappings Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 *
 * @method \App\Model\Entity\MonthMapping get($primaryKey, $options = [])
 * @method \App\Model\Entity\MonthMapping newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MonthMapping[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MonthMapping|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MonthMapping|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MonthMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MonthMapping[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MonthMapping findOrCreate($search, callable $callback = null, $options = [])
 */
class MonthMappingsTable extends Table
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

        $this->setTable('month_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Mediums', [
            'foreignKey' => 'medium_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id',
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
            ->scalar('april')
            ->maxLength('april', 10)
            ->requirePresence('april', 'create')
            ->notEmpty('april');

        $validator
            ->scalar('may')
            ->maxLength('may', 10)
            ->requirePresence('may', 'create')
            ->notEmpty('may');

        $validator
            ->scalar('june')
            ->maxLength('june', 10)
            ->requirePresence('june', 'create')
            ->notEmpty('june');

        $validator
            ->scalar('july')
            ->maxLength('july', 10)
            ->requirePresence('july', 'create')
            ->notEmpty('july');

        $validator
            ->scalar('august')
            ->maxLength('august', 10)
            ->requirePresence('august', 'create')
            ->notEmpty('august');

        $validator
            ->scalar('september')
            ->maxLength('september', 10)
            ->requirePresence('september', 'create')
            ->notEmpty('september');

        $validator
            ->scalar('october')
            ->maxLength('october', 10)
            ->requirePresence('october', 'create')
            ->notEmpty('october');

        $validator
            ->scalar('november')
            ->maxLength('november', 10)
            ->requirePresence('november', 'create')
            ->notEmpty('november');

        $validator
            ->scalar('december')
            ->maxLength('december', 10)
            ->requirePresence('december', 'create')
            ->notEmpty('december');

        $validator
            ->scalar('january')
            ->maxLength('january', 10)
            ->requirePresence('january', 'create')
            ->notEmpty('january');

        $validator
            ->scalar('february')
            ->maxLength('february', 10)
            ->requirePresence('february', 'create')
            ->notEmpty('february');

        $validator
            ->scalar('march')
            ->maxLength('march', 10)
            ->requirePresence('march', 'create')
            ->notEmpty('march');

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
        $rules->add($rules->existsIn(['student_class_id'], 'StudentClasses'));
        $rules->add($rules->existsIn(['medium_id'], 'Mediums'));
        $rules->add($rules->existsIn(['stream_id'], 'Streams'));

        return $rules;
    }
}
