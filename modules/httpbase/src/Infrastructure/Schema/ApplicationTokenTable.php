<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/30
 * Time: 20:16
 */

namespace Chatbox\HttpBase\Infrastructure\Schema;


use Illuminate\Database\Schema\Blueprint;

class ApplicationTokenTables {

    use BaseSchemaTrait;

    protected $tableName = "app_list";

    protected function createSchema(Blueprint $table)
    {
        $table->increments("id");
        $table->string("app_id")->comment("アプリケーションUID");
        $table->string("name")->comment("アプリケーション固有名");
        $table->string("owner_uid")->comment("管理者UID");
        $table->string("is_frozen")->comment("管理者UID");
        $table->timestamps();

        $table->foreign("app_uid")->
        $table->unique("app_uid");

    }


}