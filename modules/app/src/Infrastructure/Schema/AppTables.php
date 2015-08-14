<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/30
 * Time: 20:16
 */

namespace Chatbox\App\Infrastructure\Schema;

use Illuminate\Database\Schema\Blueprint;

/**
 * Class AppTables
 * @@codeCoverageIgnore
 * @package Chatbox\App\Infrastructure\Schema
 */
class AppTables {

    protected $listTable;

    protected $tokenTable;

    /**
     * UserInfoTables constructor.
     * @param $listTable
     * @param $credentialTable
     */
    public function __construct($listTable, $tokenTable)
    {
        $this->listTable = $listTable;
        $this->tokenTable = $tokenTable;
    }

    /**
     * @return \Illuminate\Database\Schema\Builder
     */
    protected function getSchema(){
        /** @var DatabaseManager $db */
        $db = app("db");
        return $db->connection()->getSchemaBuilder();
    }

    public function create(){

        $this->getSchema()->create($this->listTable,function(Blueprint $blueprint){
            $this->createListTable($blueprint);
        });

        $this->getSchema()->create($this->tokenTable,function(Blueprint $blueprint){
            $this->createTokenTable($blueprint);
        });
    }

    protected function createListTable(Blueprint $table){
        $table->increments("id"); //
        $table->string("app_uid")->comment("アプリケーションUID"); // イミュータブル
        $table->string("name")->comment("アプリケーション固有名");
        $table->string("owner_uid")->comment("管理者UID");
        $table->boolean("is_frozen")->comment("凍結フラグ");
        $table->text("config")->comment("アプリケーション設定");
        $table->timestamps();

        $table->unique("app_uid");
        $table->index("owner_uid");
    }

    protected function createTokenTable(Blueprint $table){
        $table->increments("id");
        $table->string("app_uid")->comment("アプリケーションUID");
        $table->string("token_key")->comment("トークンキー");
        $table->string("access_type")->comment("アクセスタイプ");
        $table->string("user_uid")->nullable()->comment("ユーザUID");
        $table->timestamp("expired_at")->nullable()->comment("有効期限");
        $table->timestamps();

        $table->unique(["token_key"]);
    }


    public function drop(){
        $this->getSchema()->drop($this->listTable);
        $this->getSchema()->drop($this->credentialTable);
    }


}