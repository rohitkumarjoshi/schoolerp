<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AchivementCategories Model
 *
 * @property \App\Model\Table\StudentAchivementsTable|\Cake\ORM\Association\HasMany $StudentAchivements
 *
 * @method \App\Model\Entity\AchivementCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\AchivementCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AchivementCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AchivementCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AchivementCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AchivementCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AchivementCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AchivementCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class AchivementCategoriesTable extends Table
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

        $this->setTable('achivement_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('StudentAchivements', [
            'foreignKey' => 'achivement_category_id'
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            //->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        //$rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
