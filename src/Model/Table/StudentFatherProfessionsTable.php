<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentFatherProfessions Model
 *
 * @property \App\Model\Table\EnquiryFormStudentsTable|\Cake\ORM\Association\BelongsTo $EnquiryFormStudents
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\StudentParentProfessionsTable|\Cake\ORM\Association\BelongsTo $StudentParentProfessions
 * @property \App\Model\Table\EnquiryFormStudentsTable|\Cake\ORM\Association\HasMany $EnquiryFormStudents
 *
 * @method \App\Model\Entity\StudentFatherProfession get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentFatherProfession newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudentFatherProfession[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentFatherProfession|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentFatherProfession|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentFatherProfession patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentFatherProfession[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentFatherProfession findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentFatherProfessionsTable extends Table
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

        $this->setTable('student_father_professions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('EnquiryFormStudents', [
            'foreignKey' => 'enquiry_form_student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StudentParentProfessions', [
            'foreignKey' => 'student_parent_profession_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('EnquiryFormStudents', [
            'foreignKey' => 'student_father_profession_id'
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
        //$rules->add($rules->existsIn(['enquiry_form_student_id'], 'EnquiryFormStudents'));
        //$rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['student_parent_profession_id'], 'StudentParentProfessions'));

        return $rules;
    }
}
