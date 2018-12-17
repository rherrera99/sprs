<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DraddpatientsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DraddpatientsTable Test Case
 */
class DraddpatientsTableTest extends TestCase
{

    /**
     * Test subject     *
     * @var \App\Model\Table\DraddpatientsTable     */
    public $Draddpatients;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.draddpatients',
        'app.doctors',
        'app.patients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Draddpatients') ? [] : ['className' => 'App\Model\Table\DraddpatientsTable'];        $this->Draddpatients = TableRegistry::get('Draddpatients', $config);    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Draddpatients);

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
