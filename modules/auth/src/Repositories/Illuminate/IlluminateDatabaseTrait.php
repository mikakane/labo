<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/02
 * Time: 15:44
 */

namespace Chatbox\Auth\Repositories\Illuminate;

use Illuminate\Database\DatabaseManager;

trait IlluminateDatabaseTrait
{

    /**
     * @return \Illuminate\Database\Connection
     */
    protected function db(){
        /** @var DatabaseManager $db */
        $db = app("db");
        return $db->connection();
    }

    protected function table(){
        return $this->db()->table($this->tableName);
    }

}