<?php

use Migrations\AbstractMigration;

class AddnewfieldFromdetails extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {

        $table = $this->table("formdetails");

        $table->addColumn("is_dashboard", "string", ["limit" => 100, "null" => true, "after" => "field_type"])
                ->addColumn("is_table", "string", ["limit" => 100, "null" => true, "after" => "is_dashboard"])
                ->update();

        $table = $this->table("draddpatients");
        $table->addColumn("forms_list", "string", ["limit" => 500, "null" => true, "after" => "patient_id"])                
                ->update();
    }

}
