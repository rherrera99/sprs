<?php

use Migrations\AbstractMigration;

class Addptreadings extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {

        $table = $this->table("ptReadings");
        $table->addColumn("allocated_form_id", "integer", ["limit" => 10, "null" => false])
                //->addColumn("field_name", "string", ["limit" => 200, "null" => false])
                ->addcolumn("created", "datetime")
                ->addcolumn("modified", "datetime")
                ->create();


        $table = $this->table("ptReadingDetails");
        $table->addColumn("ptreading_id", "integer", ["limit" => 10, "null" => false])
                ->addColumn("formdetail_id", "integer", ["limit" => 10, "null" => false])
                ->addColumn("formdetail_name", "string", ["limit" => 500, "null" => false])
                ->addColumn("reading_value", "string", ["limit" => 1000, "null" => false])
                ->addColumn("reading_option", "string", ["limit" => 10, "null" => false])
                ->addColumn("is_dashboard", "string", ["limit" => 10, "default" => 0])
                ->addColumn("is_table", "string", ["limit" => 10, "default" => 0])
                ->addcolumn("created", "datetime")
                ->addcolumn("modified", "datetime")
                ->create();



        $table = $this->table("patients");

        $table->changeColumn("gender", "integer", ["limit" => 4, 'default' => 0])
                ->update();
    }

}
