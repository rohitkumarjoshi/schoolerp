<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * ClassMappings Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\BelongsTo $Streams
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
 * @property |\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\FacultyClassMappingsTable|\Cake\ORM\Association\HasMany $FacultyClassMappings
 *
 * @method \App\Model\Entity\ClassMapping get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClassMapping newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClassMapping[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClassMapping|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassMapping|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClassMapping[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClassMapping findOrCreate($search, callable $callback = null, $options = [])
 */
class ClassMappingsTable extends Table
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
        $session_year_id = (new Session())->read('Auth.User.session_year_id');
        $this->setTable('class_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Mediums', [
            'foreignKey' => 'medium_id',
            'joinType' => 'INNER'
        ])
        ->setConditions(['Mediums.is_deleted'=>'N']);

        $this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'INNER'
        ])
         ->setConditions(['StudentClasses.is_deleted'=>'N']);

        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Streams.is_deleted'=>'N']);

        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Sections.is_deleted'=>'N']);

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('FacultyClassMappings', [
            'foreignKey' => 'class_mapping_id'
        ])
        ->setConditions(['FacultyClassMappings.session_year_id'=>$session_year_id]);

        //-- API 
        $this->belongsTo('StudentClassesApi', [
            'className' => 'StudentClasses',
            'foreignKey' => 'student_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MediumsApi', [
            'className' => 'Mediums',
            'foreignKey' => 'medium_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('SectionsApi', [
            'className' => 'Sections',
            'foreignKey' => 'section_id'
        ]);

        $this->belongsTo('StreamsApi', [
            'className' => 'Streams',
            'foreignKey' => 'stream_id'
        ]);
        $this->hasMany('FacultyClassMappingsApi', [
            'className' => 'FacultyClassMappings',
            'foreignKey' => 'class_mapping_id'
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

        // $validator
        //     ->scalar('is_deleted')
        //     ->requirePresence('is_deleted', 'create')
        //     ->notEmpty('is_deleted');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['medium_id'], 'Mediums'));
        $rules->add($rules->existsIn(['student_class_id'], 'StudentClasses'));
        //$rules->add($rules->existsIn(['stream_id'], 'Streams'));
        //$rules->add($rules->existsIn(['section_id'], 'Sections'));
        //$rules->add($rules->existsIn(['employee_id'], 'Employees'));
        $rules->add($rules->existsIn(['session_year_id'], 'SessionYears'));

        return $rules;
    }
}
