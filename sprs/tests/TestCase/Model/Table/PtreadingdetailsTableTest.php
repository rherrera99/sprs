<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PtreadingdetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PtreadingdetailsTable Test Case
 */
class PtreadingdetailsTableTest extends TestCase
{

    /**
     * Test subject     *
     * @var \App\Model\Table\PtreadingdetailsTable     */
    public $Ptreadingdetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ptreadingdetails',
        'app.ptreadings',
        'app.allocated_forms',
        'app.draddpatients',
        'app.doctors',
        'app.patients',
        'app.forms',
        'app.formdetails',
        'app.formoptions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ptreadingdetails') ? [] : ['className' => 'App\Model\Table\PtreadingdetailsTable'];        $this->Ptreadingdetails = TableRegistry::get('Ptreadingdetails', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ptreadingdetails);

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
