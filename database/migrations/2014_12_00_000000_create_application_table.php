<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationTable extends Migration
{
    protected $appSchema;
    protected $userSchema;


    public function __construct()
    {
        $this->appSchema = new \Chatbox\App\Infrastructure\Schema\AppTables(
            "cb_app_list",
            "cb_app_token"
        );
        $this->userSchema = new \Chatbox\Auth\Infrastructure\Schema\UserTables(
            "cb_user_list",
            "cb_user_credential"
        );
    }


    public function up()
    {
        $this->appSchema->create();
        $this->userSchema->create();
    }

    public function down()
    {
        $this->appSchema->drop();
        $this->userSchema->drop();
    }
}
