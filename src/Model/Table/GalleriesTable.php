<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Galleries Model
 *
 * @property \App\Model\Table\EventShedulesTable|\Cake\ORM\Association\HasMany $EventShedules
 * @property \App\Model\Table\GalleryRowsTable|\Cake\ORM\Association\HasMany $GalleryRows
 *
 * @method \App\Model\Entity\Gallery get($primaryKey, $options = [])
 * @method \App\Model\Entity\Gallery newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Gallery[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gallery|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gallery|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Gallery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Gallery[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gallery findOrCreate($search, callable $callback = null, $options = [])
 */
class GalleriesTable extends Table
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

        $this->setTable('galleries');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('EventSchedules', [
            'foreignKey' => 'gallery_id',
            'saveStrategy'=>'replace'
        ]);
        $this->hasMany('GalleryRows', [
            'foreignKey' => 'gallery_id'
        ]); 
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('role_type')
            ->requirePresence('role_type', 'create')
            ->notEmpty('role_type');

       /* $validator
            ->scalar('cover_image')
            ->maxLength('cover_image', 200)
            ->requirePresence('cover_image', 'create')
            ->notEmpty('cover_image');
        */
        $validator
            ->scalar('gallery_type')
            ->requirePresence('gallery_type', 'create')
            ->notEmpty('gallery_type');

        $validator
            ->scalar('function_type')
            ->requirePresence('function_type', 'create')
            ->notEmpty('function_type');

        /*$validator
            ->date('date_from')
            ->requirePresence('date_from', 'create')
            ->notEmpty('date_from');

        $validator
            ->date('date_to')
            ->requirePresence('date_to', 'create')
            ->notEmpty('date_to');

        /*$validator
            ->scalar('event_location')
            ->maxLength('event_location', 100)
            ->requirePresence('event_location', 'create')
            ->notEmpty('event_location');

        $validator
            ->time('time_start')
            ->requirePresence('time_start', 'create')
            ->notEmpty('time_start');
        */
       /* $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        /*$validator
            ->requirePresence('shareable', 'create')
            ->notEmpty('shareable');

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
            ->notEmpty('is_deleted');*/

        return $validator;
    }
}
