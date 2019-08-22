<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DirectorMessages Model
 *
 * @method \App\Model\Entity\DirectorMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\DirectorMessage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DirectorMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DirectorMessage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DirectorMessage|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DirectorMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DirectorMessage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DirectorMessage findOrCreate($search, callable $callback = null, $options = [])
 */
class DirectorMessagesTable extends Table
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

        $this->setTable('director_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('role_type')
            ->requirePresence('role_type', 'create')
            ->notEmpty('role_type');

        $validator
            ->scalar('message')
            ->maxLength('message', 4294967295)
            ->requirePresence('message', 'create')
            ->notEmpty('message');

        $validator
            ->scalar('message_by')
            ->requirePresence('message_by', 'create')
            ->notEmpty('message_by')
            ->add('message_by', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
            ->scalar('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');*/

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
        $rules->add($rules->isUnique(['message_by','role_type']));

        return $rules;
    }
}
