<?php
namespace Chatbox\App\Infrastructure\Mapper;

use Carbon\Carbon;
use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Entity\TokenEntity;
use Chatbox\Auth\Entity\UserEntity;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/08
 * Time: 14:22
 */
class TokenMapper
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
     * @return TokenEntity
     */
    public function find($token,$type,$default=null){
        $rowObj = $this->table->where([
            "token_key" => $token,
            "access_type" => $type
        ])->first();

        if($rowObj){
            return $this->convToEntity($rowObj);
        }else{
            return $default;
        }
    }

    public function insert(TokenEntity $tokenEntity)
    {
        $rowArray = $this->convToRowArray($tokenEntity);
        $this->table->insert($rowArray);
    }

    public function delete($token_key)
    {
        $this->table->where("token_key",$token_key)->delete();
    }

    /**
     * @param $rowObj
     * @return AppEntity
     */
    protected function convToEntity($rowObj)
    {
        $token = new TokenEntity(
            $rowObj->app_uid,
            $rowObj->token_key,
            $rowObj->access_type,
            $rowObj->user_uid,
            Carbon::createFromTimestamp($rowObj->expired_at)
        );
        return $token;
    }

    protected function convToRowArray(TokenEntity $tokenEntity)
    {
        $data = [
            "app_uid" => $tokenEntity->getAppUid(),
            "token_key" => $tokenEntity->getTokenKey(),
            "access_type" => $tokenEntity->getAccessType(),
            "user_uid" => $tokenEntity->getUserUid(),
            "expired_at" => $tokenEntity->getExpiredAt()?$tokenEntity->getExpiredAt()->timestamp:null,
            "created_at" => Carbon::now()->timestamp,
            "updated_at" => Carbon::now()->timestamp
        ];
        return $data;
    }



}