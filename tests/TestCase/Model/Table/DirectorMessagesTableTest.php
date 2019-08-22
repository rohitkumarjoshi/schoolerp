<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DirectorMessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DirectorMessagesTable Test Case
 */
class DirectorMessagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DirectorMessagesTable
     */
    public $DirectorMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.director_messages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DirectorMessages') ? [] : ['className' => DirectorMessagesTable::class];
        $this->DirectorMessages = TableRegistry::getTableLocator()->get('DirectorMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DirectorMessages);

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
