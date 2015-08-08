<?php
namespace Chatbox\Auth\Infrastructure\Mapper;

use Carbon\Carbon;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/08
 * Time: 14:22
 */
class CredentialMapper
{
    use IlluminateMapperTrait;
    protected $table;

    protected $appId;

    /**
     * UserMapper constructor.
     * @param $tableName
     */
    public function __construct($tableName)
    {
        $this->table = $this->getTable($tableName);
        $this->appId = "hogehoge";
    }

    /**
     * @param $uid
     * @return UserEntity
     */
    public function find($uid,$type,$default=null){
        $cond = $this->uidTypeCondition($uid,$type);
        $rowObj = $this->table->where($cond)->first();

        if($rowObj){
            return $this->convToUserEntity($rowObj);
        }else{
            return $default;
        }
    }


    public function insert(CredentialEntity $credentialEntity)
    {
        $rowArray = $this->convToRowArray($credentialEntity);
        $this->table->insert($rowArray);
    }

    public function delete(CredentialEntity $credentialEntity)
    {
        $cond = $this->uidTypeCondition($credentialEntity->getUserUid(),$credentialEntity->getType());
        $this->table->delete()->where($cond);
    }

    protected function uidTypeCondition($uid,$type){
        return [
            "uid" => $uid,
            "type" => $type
        ];
    }


    protected function convToUserEntity($rowObj)
    {
        $user = new CredentialEntity(
            $rowObj->user_uid,
            $rowObj->type,
            $rowObj->hash
        );
        return $user;
    }

    protected function convToRowArray(CredentialEntity $credentialEntity)
    {
        $data = [
            "user_uid" => $credentialEntity->getUserUid(),
            "app_id" => $this->appId,
            "type" => $credentialEntity->getType(),
            "hash" => $credentialEntity->getHash(),
            "created_at" => Carbon::now()
        ];
        return $data;
    }



}