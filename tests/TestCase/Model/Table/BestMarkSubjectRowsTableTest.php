<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BestMarkSubjectRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BestMarkSubjectRowsTable Test Case
 */
class BestMarkSubjectRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BestMarkSubjectRowsTable
     */
    public $BestMarkSubjectRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.best_mark_subject_rows',
        'app.best_mark_subjects',
        'app.exam_masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BestMarkSubjectRows') ? [] : ['className' => BestMarkSubjectRowsTable::class];
        $this->BestMarkSubjectRows = TableRegistry::getTableLocator()->get('BestMarkSubjectRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BestMarkSubjectRows);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
