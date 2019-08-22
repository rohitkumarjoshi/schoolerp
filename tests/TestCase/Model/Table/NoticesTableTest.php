<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NoticesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NoticesTable Test Case
 */
class NoticesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NoticesTable
     */
    public $Notices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notices',
        'app.session_years',
        'app.notice_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Notices') ? [] : ['className' => NoticesTable::class];
        $this->Notices = TableRegistry::getTableLocator()->get('Notices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Notices);

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
