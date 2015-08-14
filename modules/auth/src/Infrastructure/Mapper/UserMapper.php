<?php
namespace Chatbox\Auth\Infrastructure\Mapper;

use Carbon\Carbon;
use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Entity\TokenEntity;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\HttpBase\Casket\ActiveToken;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/08
 * Time: 14:22
 */
class UserMapper
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
    public function find($uid,$default = null){
        $rowObj = $this->table->where("uid",$uid)->first();

        if($rowObj){
            return $this->convToUserEntity($rowObj);
        }else{
            return $default;
        }
    }


    public function insert(UserEntity $userEntity)
    {
        $rowArray = $this->convToRowArray($userEntity);
        $this->table->insert($rowArray);
    }

    public function update(UserEntity $userEntity)
    {
        $rowArray = $this->convToRowArray($userEntity);
        $this->table->update($rowArray)->where("uid",$userEntity->getUid());
    }

    public function delete($uid)
    {
        $this->table->delete()->where("uid",$uid);
    }

    protected function convToUserEntity($rowObj)
    {
        $user = new UserEntity(
            $rowObj->uid,
            $rowObj->email,
            (bool) $rowObj->is_frozen,
            Carbon::createFromTimestamp($rowObj->created_at),
            null
        );
        return $user;
    }

    protected function convToRowArray(UserEntity $userEntity)
    {
        $data = [
            "uid" => $userEntity->getUid(),
            "app_id" => $this->getAppId(),
            "email" => $userEntity->getEmail(),
            "is_frozen" => $userEntity->getIsForzen(),
            "created_at" => $userEntity->getRegisterdAt(),
            "updated_at" => Carbon::now()
        ];
        return $data;
    }



}