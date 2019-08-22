<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HostelRoomAssets Model
 *
 * @property \App\Model\Table\HostelStudentAssetsTable|\Cake\ORM\Association\HasMany $HostelStudentAssets
 *
 * @method \App\Model\Entity\HostelRoomAsset get($primaryKey, $options = [])
 * @method \App\Model\Entity\HostelRoomAsset newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HostelRoomAsset[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HostelRoomAsset|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HostelRoomAsset|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HostelRoomAsset patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HostelRoomAsset[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HostelRoomAsset findOrCreate($search, callable $callback = null, $options = [])
 */
class HostelRoomAssetsTable extends Table
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

        $this->setTable('hostel_room_assets');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('HostelStudentAssets', [
            'foreignKey' => 'hostel_room_asset_id'
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
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        /*$validator
            ->scalar('default_item')
            ->requirePresence('default_item', 'create')
            ->notEmpty('default_item');

        $validator
            ->scalar('item_code')
            ->maxLength('item_code', 30)
            ->requirePresence('item_code', 'create')
            ->notEmpty('item_code');*/

    /*    $validator
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
            ->notEmpty('is_deleted');*/

        return $validator;
    }
}
