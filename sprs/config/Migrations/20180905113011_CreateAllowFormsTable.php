<?php

use Migrations\AbstractMigration;

class CreateAllowFormsTable extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table("allocated_forms");
        $table->addColumn("draddpatient_id", "string", ["limit" => 500, "null" => false])
                ->addColumn("form_id", "integer", ["limit" => 10, "null" => false])
                ->addcolumn("created", "datetime")
                ->addcolumn("modified", "datetime")
                ->create();
    }

}
