<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PtreadingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PtreadingsTable Test Case
 */
class PtreadingsTableTest extends TestCase
{

    /**
     * Test subject     *
     * @var \App\Model\Table\PtreadingsTable     */
    public $Ptreadings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Ptreadings') ? [] : ['className' => 'App\Model\Table\PtreadingsTable'];        $this->Ptreadings = TableRegistry::get('Ptreadings', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ptreadings);

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
