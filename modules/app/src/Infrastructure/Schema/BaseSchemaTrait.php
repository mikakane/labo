<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/30
 * Time: 20:16
 */

namespace Chatbox\App\Infrastructure\Schema;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\DatabaseManager;

/**
 * テーブル名の外部注入はもう諦める。
 * 外部キーの登録とか無理ゲーだし,Eloquentでランタイムテーブル名定義できないからあんまり美味しくない。
 * @codeCoverageIgnore
 * @package Chatbox\HttpBase\Infrastructure\Schema
 */
trait BaseSchemaTrait {

    protected $tableName;

    /**
     * @return \Illuminate\Database\Schema\Builder
     */
    protected function getSchema(){
        /** @var DatabaseManager $db */
        $db = app("db");
        return $db->connection()->getSchemaBuilder();
    }


    public function create(){
        $this->getSchema()->create($this->tableName,function(Blueprint $blueprint){
            $this->createSchema($blueprint);
        });
    }

    abstract protected function createSchema(Blueprint $table);

    public function drop(){
        $this->getSchema()->drop($this->tableName);
    }



}