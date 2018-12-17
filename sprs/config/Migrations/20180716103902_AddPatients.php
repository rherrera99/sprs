<?php

use Migrations\AbstractMigration;

class AddPatients extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table("patients");
        $table->addColumn("first_name", "string", ["limit" => 100, "null" => false])
                ->addColumn("last_name", "string", ["limit" => 100, "null" => false])
                ->addcolumn("dob", "datetime")
                ->addColumn("address", "string", ["limit" => 5000, "null" => true])
                ->addColumn("about", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_TEXT, ["null" => true])
                ->addColumn("email", "string", ["limit" => 50, "null" => true])
                ->addColumn("username", "string", ["limit" => 100, "null" => true])
                ->addColumn("password", "string", ["limit" => 500, "null" => true])
                ->addColumn("contact_no", "string", ["limit" => 20, "null" => true])
                ->addColumn("gender", "integer", ["limit" => 4, "null" => true])
                ->addcolumn("profile_pic", "string", ["limit" => 1000, "null" => true])
                ->addColumn("height", "integer", ["limit" => 4, "null" => true])
                ->addColumn("weight", "integer", ["limit" => 3, "null" => true])
                ->addcolumn("created", "datetime")
                ->addcolumn("modified", "datetime")
                ->addColumn('doctor_id', 'integer', ['default' => null, 'limit' => 10, 'null' => true,])
                ->create();
    }

}
