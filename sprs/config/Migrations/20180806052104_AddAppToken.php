<?php
use Migrations\AbstractMigration;

class AddAppToken extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
          $table=$this->table("doctors");
        
        $table->addColumn("app_token","string",["limit"=>100,"null"=>true,"after"=>"gender"])
                ->update();
        
        $table=$this->table("patients");
        
        $table->addColumn("app_token","string",["limit"=>100,"null"=>true,"after"=>"gender"])
                ->update();
        
    }
}
