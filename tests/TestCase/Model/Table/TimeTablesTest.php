<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimeTables;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimeTables Test Case
 */
class TimeTablesTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimeTables
     */
    public $TimeTables;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Times') ? [] : ['className' => TimeTables::class];
        $this->TimeTables = TableRegistry::getTableLocator()->get('Times', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TimeTables);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
