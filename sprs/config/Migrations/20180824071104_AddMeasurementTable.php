<?php

use Migrations\AbstractMigration;

class AddMeasurementTable extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {

        $table = $this->table("forms");
        $table->addColumn("form_name", "string", ["limit" => 500, "null" => false])
                ->addcolumn("created", "datetime")
                ->addcolumn("modified", "datetime")
                ->create();

        $table = $this->table("formdetails");
        $table->addColumn("form_id", "integer", ["limit" => 10, "null" => false])
        ->addColumn("field_name", "string", ["limit" => 200, "null" => false])
        ->addColumn("field_type", "string", ["limit" => 200, "null" => false])
        ->addcolumn("created", "datetime")
        ->addcolumn("modified", "datetime")
        ->create();

        $table = $this->table("formoptions");
        $table->addColumn("formdetail_id", "integer", ["limit" => 10, "null" => false])
        ->addColumn("option_name", "string", ["limit" => 200, "null" => false])
        ->addcolumn("created", "datetime")
        ->addcolumn("modified", "datetime")
        ->create();

    }

}
