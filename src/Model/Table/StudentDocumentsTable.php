<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentDocuments Model
 *
 * @property \App\Model\Table\SessionYearsTable|\Cake\ORM\Association\BelongsTo $SessionYears
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\EnquiryFormStudentsTable|\Cake\ORM\Association\BelongsTo $EnquiryFormStudents
 * @property \App\Model\Table\DocumentClassMappingsTable|\Cake\ORM\Association\BelongsTo $DocumentClassMappings
 *
 * @method \App\Model\Entity\StudentDocument get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentDocument newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudentDocument[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentDocument|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentDocument|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentDocument[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentDocument findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentDocumentsTable extends Table
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

        $this->setTable('student_documents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SessionYears', [
            'foreignKey' => 'session_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id'
        ]);
        $this->belongsTo('EnquiryFormStudents', [
            'foreignKey' => 'enquiry_form_student_id'
        ]);
        $this->belongsTo('DocumentClassMappings', [
            'foreignKey' => 'document_class_mapping_id',
            'joinType' => 'INNER'
        ])->setConditions(['DocumentClassMappings.is_deleted'=>'N']);
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
            ->scalar('image_path')
            ->maxLength('image_path', 100)
            ->requirePresence('image_path', 'create')
            ->notEmpty('image_path');

       /* $validator
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
            ->notEmpty('edited_by');*/

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
        /*$rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['enquiry_form_student_id'], 'EnquiryFormStudents'));*/
        $rules->add($rules->existsIn(['document_class_mapping_id'], 'DocumentClassMappings'));

        return $rules;
    }
}
