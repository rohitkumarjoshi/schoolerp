<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScalingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScalingsTable Test Case
 */
class ScalingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ScalingsTable
     */
    public $Scalings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.scalings',
        'app.session_years',
        'app.subjects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Scalings') ? [] : ['className' => ScalingsTable::class];
        $this->Scalings = TableRegistry::getTableLocator()->get('Scalings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scalings);

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
