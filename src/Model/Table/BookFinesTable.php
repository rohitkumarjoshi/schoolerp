<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BookFines Model
 *
 * @method \App\Model\Entity\BookFine get($primaryKey, $options = [])
 * @method \App\Model\Entity\BookFine newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BookFine[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BookFine|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookFine|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookFine patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BookFine[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BookFine findOrCreate($search, callable $callback = null, $options = [])
 */
class BookFinesTable extends Table
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

        $this->setTable('book_fines');
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

        $validator
            ->integer('fine_after_days')
            ->requirePresence('fine_after_days', 'create')
            ->notEmpty('fine_after_days');

        $validator
            ->decimal('fine_amount_per_day')
            ->requirePresence('fine_amount_per_day', 'create')
            ->notEmpty('fine_amount_per_day');

        $validator
            ->scalar('fine_for')
            ->maxLength('fine_for', 20)
            ->requirePresence('fine_for', 'create')
            ->notEmpty('fine_for');

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

        return $validator;
    }
}
