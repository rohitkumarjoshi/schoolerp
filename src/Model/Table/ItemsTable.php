<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \App\Model\Table\ItemCategoriesTable|\Cake\ORM\Association\BelongsTo $ItemCategories
 * @property \App\Model\Table\ItemSubcategoriesTable|\Cake\ORM\Association\BelongsTo $ItemSubcategories
 * @property \App\Model\Table\GrnRowsTable|\Cake\ORM\Association\HasMany $GrnRows
 * @property \App\Model\Table\ItemIssueReturnsTable|\Cake\ORM\Association\HasMany $ItemIssueReturns
 * @property \App\Model\Table\PurchaseOrderRowsTable|\Cake\ORM\Association\HasMany $PurchaseOrderRows
 * @property \App\Model\Table\PurchaseReturnRowsTable|\Cake\ORM\Association\HasMany $PurchaseReturnRows
 * @property \App\Model\Table\StockLedgersTable|\Cake\ORM\Association\HasMany $StockLedgers
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemsTable extends Table
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

        $this->setTable('items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
		

        $this->belongsTo('ItemCategories', [
            'foreignKey' => 'item_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ItemSubcategories', [
            'foreignKey' => 'item_subcategory_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('GrnRows', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('ItemIssueReturns', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('PurchaseOrderRows', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('PurchaseReturnRows', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('StockLedgers', [
            'foreignKey' => 'item_id'
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
        $rules->add($rules->existsIn(['item_category_id'], 'ItemCategories'));
        $rules->add($rules->existsIn(['item_subcategory_id'], 'ItemSubcategories'));

        return $rules;
    }
}
