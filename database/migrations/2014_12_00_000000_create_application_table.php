<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationTable extends Migration
{
    protected $schema;
    public function __construct()
    {
        $this->schema = new \Chatbox\Auth\Infrastructure\Schema\UserTables(
            "cb_user_list",
            "cb_user_credential"
        );
    }


    public function up()
    {
        $this->schema->create();
    }

    public function down()
    {
        $this->schema->drop();
    }
}
