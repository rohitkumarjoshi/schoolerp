<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * Books Model
 *
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\BelongsTo $StudentClasses
 * @property \App\Model\Table\BookCategoriesTable|\Cake\ORM\Association\BelongsTo $BookCategories
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $Subjects
 * @property \App\Model\Table\BookIssueReturnsTable|\Cake\ORM\Association\HasMany $BookIssueReturns
 *
 * @method \App\Model\Entity\Book get($primaryKey, $options = [])
 * @method \App\Model\Entity\Book newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Book[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Book|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Book|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Book patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Book[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Book findOrCreate($search, callable $callback = null, $options = [])
 */
class BooksTable extends Table
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

        $this->setTable('books');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('StudentClasses', [
            'foreignKey' => 'student_class_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['StudentClasses.is_deleted'=>'N']);
        $this->belongsTo('Mediums', [
            'foreignKey' => 'medium_id',
            'joinType' => 'LEFT'
        ])
        ->setConditions(['Mediums.is_deleted'=>'N']);

        $this->belongsTo('BookCategories', [
            'foreignKey' => 'book_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id'
        ])
        ->setConditions(['Subjects.is_deleted'=>'N']);
        
        $this->hasMany('BookIssueReturns', [
            'foreignKey' => 'book_id'
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

        $validator
            ->scalar('title')
            ->maxLength('title', 50)
            ->allowEmpty('title');

        $validator
            ->scalar('author_name')
            ->maxLength('author_name', 100)
            ->allowEmpty('author_name');

        $validator
            ->scalar('edition')
            ->maxLength('edition', 100)
            ->allowEmpty('edition');

        $validator
            ->scalar('volume')
            ->maxLength('volume', 50)
            ->allowEmpty('volume');

        // $validator
        //     ->scalar('publisher')
        //     ->maxLength('publisher', 50)
        //     ->allowEmpty('publisher');

        $validator
            ->integer('total_page')
            ->requirePresence('total_page', 'create')
            ->notEmpty('total_page');

        $validator
            ->scalar('book_condition')
            ->requirePresence('book_condition', 'create')
            ->notEmpty('book_condition');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->scalar('accession_no')
            ->maxLength('accession_no', 100)
            ->requirePresence('accession_no', 'create')
            ->notEmpty('accession_no');

        $validator
            ->scalar('is_reserved')
            ->requirePresence('is_reserved', 'create')
            ->notEmpty('is_reserved');

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
        $rules->add($rules->existsIn(['book_category_id'], 'BookCategories'));

        return $rules;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['name'])) {
            $data['name'] = ucwords($data['name']);
        }
    }
}
