<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SessionYears Model
 *
 * @property \App\Model\Table\BookIssueReturnsTable|\Cake\ORM\Association\HasMany $BookIssueReturns
 * @property \App\Model\Table\ClassMappingsTable|\Cake\ORM\Association\HasMany $ClassMappings
 * @property \App\Model\Table\EnquiryFormStudentsTable|\Cake\ORM\Association\HasMany $EnquiryFormStudents
 * @property \App\Model\Table\FeeMonthMappingsTable|\Cake\ORM\Association\HasMany $FeeMonthMappings
 * @property \App\Model\Table\FeeReceiptsTable|\Cake\ORM\Association\HasMany $FeeReceipts
 * @property \App\Model\Table\FeeTypeMastersTable|\Cake\ORM\Association\HasMany $FeeTypeMasters
 * @property \App\Model\Table\FeeTypeReceiptsTable|\Cake\ORM\Association\HasMany $FeeTypeReceipts
 * @property \App\Model\Table\FeeTypeStudentMastersTable|\Cake\ORM\Association\HasMany $FeeTypeStudentMasters
 * @property \App\Model\Table\GrnsTable|\Cake\ORM\Association\HasMany $Grns
 * @property \App\Model\Table\HostelAttendancesTable|\Cake\ORM\Association\HasMany $HostelAttendances
 * @property \App\Model\Table\HostelGatePassesTable|\Cake\ORM\Association\HasMany $HostelGatePasses
 * @property \App\Model\Table\HostelRegistrationsTable|\Cake\ORM\Association\HasMany $HostelRegistrations
 * @property \App\Model\Table\ItemIssueReturnsTable|\Cake\ORM\Association\HasMany $ItemIssueReturns
 * @property \App\Model\Table\LibraryStudentInOutsTable|\Cake\ORM\Association\HasMany $LibraryStudentInOuts
 * @property \App\Model\Table\MediumsTable|\Cake\ORM\Association\HasMany $Mediums
 * @property \App\Model\Table\MonthlyFeesTable|\Cake\ORM\Association\HasMany $MonthlyFees
 * @property \App\Model\Table\PurchaseOrdersTable|\Cake\ORM\Association\HasMany $PurchaseOrders
 * @property \App\Model\Table\PurchaseReturnsTable|\Cake\ORM\Association\HasMany $PurchaseReturns
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\HasMany $Sections
 * @property \App\Model\Table\StockLedgersTable|\Cake\ORM\Association\HasMany $StockLedgers
 * @property \App\Model\Table\StreamsTable|\Cake\ORM\Association\HasMany $Streams
 * @property \App\Model\Table\StudentAchivementsTable|\Cake\ORM\Association\HasMany $StudentAchivements
 * @property \App\Model\Table\StudentClassesTable|\Cake\ORM\Association\HasMany $StudentClasses
 * @property \App\Model\Table\StudentDocumentsTable|\Cake\ORM\Association\HasMany $StudentDocuments
 * @property \App\Model\Table\StudentInfosTable|\Cake\ORM\Association\HasMany $StudentInfos
 * @property \App\Model\Table\StudentRedDiariesTable|\Cake\ORM\Association\HasMany $StudentRedDiaries
 * @property \App\Model\Table\StudentSiblingsTable|\Cake\ORM\Association\HasMany $StudentSiblings
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\HasMany $Students
 * @property \App\Model\Table\VehicleStudentAttendancesTable|\Cake\ORM\Association\HasMany $VehicleStudentAttendances
 *
 * @method \App\Model\Entity\SessionYear get($primaryKey, $options = [])
 * @method \App\Model\Entity\SessionYear newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SessionYear[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SessionYear|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SessionYear|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SessionYear patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SessionYear[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SessionYear findOrCreate($search, callable $callback = null, $options = [])
 */
class SessionYearsTable extends Table
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

        $this->setTable('session_years');
        $this->setDisplayField('session_name');
        $this->setPrimaryKey('id');

        $this->hasMany('BookIssueReturns', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('ClassMappings', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('EnquiryFormStudents', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('FeeMonthMappings', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('FeeReceipts', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('FeeTypeMasters', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('FeeTypeReceipts', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('FeeTypeStudentMasters', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('Grns', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('HostelAttendances', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('HostelGatePasses', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('HostelRegistrations', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('ItemIssueReturns', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('LibraryStudentInOuts', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('Mediums', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('MonthlyFees', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('PurchaseOrders', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('PurchaseReturns', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('Sections', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('StockLedgers', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('Streams', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('StudentAchivements', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('StudentClasses', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('StudentDocuments', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('StudentInfos', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('StudentRedDiaries', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('StudentSiblings', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('VehicleStudentAttendances', [
            'foreignKey' => 'session_year_id'
        ]);
        $this->hasMany('Employees', [
            'foreignKey' => 'session_year_id'
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
            ->date('from_date')
            ->allowEmpty('from_date');

        $validator
            ->date('to_date')
            ->allowEmpty('to_date');

        /*$validator
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

        $validator
            ->scalar('session_name')
            ->requirePresence('session_name', 'create')
            ->notEmpty('session_name');
        $validator
            ->scalar('session_year_name')
            ->requirePresence('session_year_name', 'create')
            ->notEmpty('session_year_name');
        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
