<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/30
 * Time: 20:16
 */

namespace Chatbox\Auth\Infrastructure\Schema;

use Illuminate\Database\Schema\Blueprint;

class UserTables {

    protected $listTable;

    protected $credentialTable;

    /**
     * UserInfoTables constructor.
     * @param $listTable
     * @param $credentialTable
     */
    public function __construct($listTable, $credentialTable)
    {
        $this->listTable = $listTable;
        $this->credentialTable = $credentialTable;
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

        $this->getSchema()->create($this->credentialTable,function(Blueprint $blueprint){
            $this->createCredentialTable($blueprint);
        });
    }

    protected function createListTable(Blueprint $table){
        $table->increments("id");
        $table->string("user_uid")->comment("アプリケーションUID");
        $table->string("app_uid")->comment("アプリケーションUID");
        $table->string("name")->comment("認証タイプ");
        $table->string("email")->comment("認証ハッシュ"); //ハッシュは完全にユニーク。パスワードでもユニークになるよう、emailを混ぜる。
        $table->boolean("is_frozen")->comment("認証ハッシュ"); //ハッシュは完全にユニーク。パスワードでもユニークになるよう、emailを混ぜる。
        $table->text("metainfo")->comment("認証ハッシュ"); //ハッシュは完全にユニーク。パスワードでもユニークになるよう、emailを混ぜる。
        $table->timestamps(); //insert only

        $table->unique(["user_uid"]);
    }

    protected function createCredentialTable(Blueprint $table){
        $table->increments("id");
        $table->string("user_uid")->comment("アプリケーションUID");
        $table->string("app_uid")->comment("アプリケーションUID");
        $table->string("type")->comment("認証タイプ");
        $table->string("hash")->comment("認証ハッシュ"); //ハッシュは完全にユニーク。パスワードでもユニークになるよう、emailを混ぜる。
        $table->timestamp("created_at"); //insert only

        $table->unique(["user_uid","type"]);

        $table->foreign("user_uid")->references('user_uid')->on($this->listTable);
    }


    public function drop(){
        $this->getSchema()->drop($this->listTable);
        $this->getSchema()->drop($this->credentialTable);
    }


}