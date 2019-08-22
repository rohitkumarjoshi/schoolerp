<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;
/**
 * StudentClasses Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\BestMarkSubjectsTable|\Cake\ORM\Association\HasMany $BestMarkSubjects
 * @property \App\Model\Table\BooksTable|\Cake\ORM\Association\HasMany $Books
 * @property \App\Model\Table\ClassMappingsTable|\Cake\ORM\Association\HasMany $ClassMappings
 * @property \App\Model\Table\EnquiryFormStudentsTable|\Cake\ORM\Association\HasMany $EnquiryFormStudents
 * @property \App\Model\Table\ExamMastersTable|\Cake\ORM\Association\HasMany $ExamMasters
 * @property \App\Model\Table\FeeMonthMappingsTable|\Cake\ORM\Association\HasMany $FeeMonthMappings
 * @property \App\Model\Table\FeeTypeMastersTable|\Cake\ORM\Association\HasMany $FeeTypeMasters
 * @property \App\Model\Table\GradeMastersTable|\Cake\ORM\Association\HasMany $GradeMasters
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\HasMany $StudentInfos
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\HasMany $Subjects
 *
 * @method \App\Model\Entity\StudentClass get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentClass newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudentClass[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentClass|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentClass|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentClass patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentClass[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentClass findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentClassesTable extends Table
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
        $this->setTable('student_classes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('BestMarkSubjects', [
            'foreignKey' => 'student_class_id'
        ]);
        $this->hasMany('Books', [
            'foreignKey' => 'student_class_id'
        ]);
        $this->hasMany('ClassMappings', [
            'foreignKey' => 'student_class_id'
        ]);
        $this->hasMany('EnquiryFormStudents', [
            'foreignKey' => 'student_class_id'
        ]);
        $this->hasMany('ExamMasters', [
            'foreignKey' => 'student_class_id'
        ]);
        $this->hasMany('FeeMonthMappings', [
            'foreignKey' => 'student_class_id'
        ]);
        $this->hasMany('FeeTypeMasters', [
            'foreignKey' => 'student_class_id'
        ]);
        $this->hasMany('GradeMasters', [
            'foreignKey' => 'student_class_id'
        ]);
        $this->hasMany('StudentInfos', [
            'foreignKey' => 'student_class_id'
        ])->setConditions(['StudentInfos.session_year_id'=>$session_year_id,'StudentInfos.student_status !='=>'Discontinue']);
        $this->hasMany('Subjects', [
            'foreignKey' => ['student_class_id','stream_id']
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('roman_name')
            ->maxLength('roman_name', 20)
            ->requirePresence('roman_name', 'create')
            ->notEmpty('roman_name');

        $validator
            ->integer('order_of_class')
            ->requirePresence('order_of_class', 'create')
            ->notEmpty('order_of_class');

        $validator
            ->scalar('grade_type')
            ->requirePresence('grade_type', 'create')
            ->notEmpty('grade_type');

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

        return $rules;
    }
}
