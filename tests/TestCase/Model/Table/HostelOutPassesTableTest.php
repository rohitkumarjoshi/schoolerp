<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HostelOutPassesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HostelOutPassesTable Test Case
 */
class HostelOutPassesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HostelOutPassesTable
     */
    public $HostelOutPasses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hostel_out_passes',
        'app.session_years',
        'app.students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HostelOutPasses') ? [] : ['className' => HostelOutPassesTable::class];
        $this->HostelOutPasses = TableRegistry::getTableLocator()->get('HostelOutPasses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HostelOutPasses);

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
