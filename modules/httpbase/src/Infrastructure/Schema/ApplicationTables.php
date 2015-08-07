<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/30
 * Time: 20:16
 */

namespace Chatbox\HttpBase\Infrastructure\Schema;


use Illuminate\Database\Schema\Blueprint;

class ApplicationTables {

    use BaseSchemaTrait;

    const TABLE_NAME = "app_list";

    protected function createSchema(Blueprint $table)
    {
        // 履歴データの保持の必要が無いのでDELETE INSERT方式
        $table->increments("id"); //
        $table->string("app_uid")->comment("アプリケーションUID"); // イミュータブル
        $table->string("name")->comment("アプリケーション固有名");
        $table->string("owner_uid")->comment("管理者UID");
        $table->string("is_frozen")->comment("管理者UID");
        $table->timestamps();

        $table->unique("app_uid");

    }


}