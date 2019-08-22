<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SchoolNotices Model
 *
 * @method \App\Model\Entity\SchoolNotice get($primaryKey, $options = [])
 * @method \App\Model\Entity\SchoolNotice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SchoolNotice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SchoolNotice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SchoolNotice|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SchoolNotice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SchoolNotice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SchoolNotice findOrCreate($search, callable $callback = null, $options = [])
 */
class SchoolNoticesTable extends Table
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

        $this->setTable('school_notices');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
		
		$this->belongsTo('Users');
		$this->belongsTo('Notifications');
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
            ->scalar('title')
            ->maxLength('title', 200)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->date('valid_date')
            ->requirePresence('valid_date', 'create')
            ->notEmpty('valid_date');
 
        /*$validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');
 
        $validator
            ->scalar('doc_file')
            ->maxLength('doc_file', 200)
            ->requirePresence('doc_file', 'create')
            ->notEmpty('doc_file');
 
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
            ->notEmpty('is_deleted');
        */
        return $validator;
    }
}
