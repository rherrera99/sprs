<?php

use Migrations\AbstractMigration;

class AddfieldInDr extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {

        $table=$this->table("drAddpatients");
        $table->drop();
        $table = $this->table("draddpatients");
        $table->addColumn("doctor_id", 'integer', [
                        'default' => null,
                        'limit' => 10,
                        'null' => true,
                    ])
                ->addColumn("patient_id",'integer', [
                        'default' => null,
                        'limit' => 10,
                        'null' => true,
                    ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                    "after" => "patient_id"
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                    "after" => "created"
                ])
                ->create();
    }

}
