<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GradeMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GradeMastersTable Test Case
 */
class GradeMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GradeMastersTable
     */
    public $GradeMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.grade_masters',
        'app.session_years',
        'app.student_classes',
        'app.streams'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GradeMasters') ? [] : ['className' => GradeMastersTable::class];
        $this->GradeMasters = TableRegistry::getTableLocator()->get('GradeMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GradeMasters);

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
