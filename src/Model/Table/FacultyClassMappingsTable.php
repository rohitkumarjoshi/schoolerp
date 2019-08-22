<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FacultyClassMappings Model
 *
 * @property \App\Model\Table\ClassMappingsTable|\Cake\ORM\Association\BelongsTo $ClassMappings
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $Employees
 * @property |\Cake\ORM\Association\BelongsTo $Subjects
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 *
 * @method \App\Model\Entity\FacultyClassMapping get($primaryKey, $options = [])
 * @method \App\Model\Entity\FacultyClassMapping newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FacultyClassMapping[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FacultyClassMapping|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FacultyClassMapping|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FacultyClassMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FacultyClassMapping[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FacultyClassMapping findOrCreate($search, callable $callback = null, $options = [])
 */
class FacultyClassMappingsTable extends Table
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

        $this->setTable('faculty_class_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ClassMappings', [
            'foreignKey' => 'class_mapping_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
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
        $rules->add($rules->existsIn(['class_mapping_id'], 'ClassMappings'));
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));

        return $rules;
    }
}
