<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransferCertificatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransferCertificatesTable Test Case
 */
class TransferCertificatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TransferCertificatesTable
     */
    public $TransferCertificates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.transfer_certificates',
        'app.students',
        'app.session_years'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TransferCertificates') ? [] : ['className' => TransferCertificatesTable::class];
        $this->TransferCertificates = TableRegistry::getTableLocator()->get('TransferCertificates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TransferCertificates);

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
