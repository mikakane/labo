<?php
namespace Chatbox\App\Infrastructure\Mapper;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;

/**
 *
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/08
 * Time: 14:45
 */

trait IlluminateMapperTrait {


    /**
     * @param $tableName
     * @return Builder
     */
    protected function getTable($tableName)
    {
        /** @var DatabaseManager $db */
        $db = app("db");
        $table = $db->connection()->table($tableName);
        return $table;
    }
}