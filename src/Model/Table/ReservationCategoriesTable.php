<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReservationCategories Model
 *
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\HasMany $StudentInfos
 *
 * @method \App\Model\Entity\ReservationCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReservationCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReservationCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReservationCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class ReservationCategoriesTable extends Table
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

        $this->setTable('reservation_categories');
        $this->setDisplayField('short_name');
        $this->setPrimaryKey('id');

        $this->hasMany('StudentInfos', [
            'foreignKey' => 'reservation_category_id'
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
            ->scalar('short_name')
            ->maxLength('short_name', 20)
            ->allowEmpty('short_name');
           //->add('short_name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 50)
            ->allowEmpty('full_name');
            //->add('full_name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        

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
        //$rules->add($rules->isUnique(['short_name']));
        //$rules->add($rules->isUnique(['full_name']));

        return $rules;
    }
}
