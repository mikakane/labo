<?php
namespace Chatbox\App\Infrastructure\Mapper;

use Carbon\Carbon;
use Chatbox\App\Entity\AppEntity;
use Chatbox\Auth\Entity\UserEntity;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/08
 * Time: 14:22
 */
class AppMapper
{
    use IlluminateMapperTrait;

    /** @var \Illuminate\Database\Query\Builder  */
    protected $table;

    /**
     * UserMapper constructor.
     * @param $tableName
     */
    public function __construct($tableName)
    {
        $this->table = $this->getTable($tableName);
    }

    /**
     * @param $uid
     * @return UserEntity
     */
    public function find($appUid,$default=null){
        $rowObj = $this->table->where("app_uid",$appUid)->first();

        if($rowObj){
            return $this->convToUserEntity($rowObj);
        }else{
            return $default;
        }
    }


    public function insert(AppEntity $appEntity)
    {
        $rowArray = $this->convToRowArray($appEntity);
        $this->table->insert($rowArray);
    }

    public function update(AppEntity $appEntity)
    {
        $rowArray = $this->convToRowArray($appEntity);
        unset($rowArray["app_uid"]);
        $this->table->where("app_uid",$appEntity->getAppUid())->update($rowArray);
    }

    public function delete($appUid)
    {
        $this->table->where("app_uid",$appUid)->delete();
    }

    /**
     * @param $rowObj
     * @return AppEntity
     */
    protected function convToUserEntity($rowObj)
    {
        $app = new AppEntity(
            $rowObj->app_uid,
            $rowObj->name,
            $rowObj->owner_uid,
            (bool) $rowObj->is_frozen,
            json_decode($rowObj->config,true)
        );
        return $app;
    }

    protected function convToRowArray(AppEntity $app)
    {
        $data = [
            "app_uid" => $app->getAppUid(),
            "name" => $app->getName(),
            "owner_uid" => $app->getOwnerUid(),
            "is_frozen" => $app->getIsFrozen(),
            "config" => json_encode($app->getConfig()),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
        return $data;
    }



}