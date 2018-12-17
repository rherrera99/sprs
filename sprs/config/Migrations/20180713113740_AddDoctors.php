<?php

use Migrations\AbstractMigration;

class AddDoctors extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table("doctors");
        $table->addColumn("first_name", "string", ["limit" => 100, "null" => false])
                ->addColumn("last_name", "string", ["limit" => 100, "null" => false])
                ->addColumn("email", "string", ["limit" => 50, "null" => true])
                ->addColumn("username", "string", ["limit" => 100, "null" => true])
                ->addColumn("password", "string", ["limit" => 500, "null" => true])
                ->addColumn("contact_no", "string", ["limit" => 20, "null" => true])
                ->addColumn("gender", "integer", ["limit" => 4, "null" => true])
                ->addColumn("designation", "string", ["limit" => 500, "null" => false])
                ->addColumn("address", "string", ["limit" => 5000, "null" => true])
                ->addColumn("about", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_TEXT, ["null" => true])
                ->addcolumn("education", "string", ["limit" => 1000, "null" => true])
                ->addcolumn("profile_pic", "string", ["limit" => 1000, "null" => true])
                ->addcolumn("created", "datetime")
                ->addcolumn("modified", "datetime")
                ->create();
    }

}
