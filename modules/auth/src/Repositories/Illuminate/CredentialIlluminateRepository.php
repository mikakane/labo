<?php
namespace Chatbox\Auth\Repositories\Illuminate;
use Carbon\Carbon;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\Auth\Infrastructure\Eloquent\UserCredentialEloquent;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/01
 * Time: 18:13
 */

class CredentialIlluminateRepository implements CredentialRepositoryInterface{

    use IlluminateDatabaseTrait;

    protected $tableName;
    /**
     * CredentialEloquentRepository constructor.
     * @param $userRepository
     * @param $credentialEloquent
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->appUid = "mysecretapplicationid";
    }

    /**
     * @inheritDoc
     */
    public function create(array $credential)
    {
        return new CredentialEntity($credential);
    }

    /**
     * @inheritDoc
     */
    public function findByUser($uid)
    {
        $results = $this->table()->where([
            "user_uid" => $uid
        ])->get();

        $rtn = [];
        foreach ($results as $row) {
            $rtn[] = new CredentialEntity((array)$row);
        }
        return $rtn;
    }


    /**
     * @inheritDoc
     */
    public function findByTypeAndHash($type, $hash)
    {
        $credential = $this->credentialEloquent->where([
            "app_uid" => $this->appUid,
            "type" => $type,
            "hash" => $hash,
        ])->first();
        return $this->create($credential->toArray());
    }

    /**
     * @inheritDoc
     */
    public function bind($uid, CredentialEntity $credentialEntity)
    {
        $data = array_merge([
            "type" => null,
            "hash" => null,
        ],$credentialEntity->toArray(),[
            "user_uid" => $uid,
            "app_uid" => $this->appUid,
            "created_at" => Carbon::now()
        ]);

        $this->table()->insert($data);
    }

    /**
     * @inheritDoc
     */
    public function unbind($uid, $type)
    {
        $this->table()->where([
            "user_uid" => $uid,
            "type" => $type
        ])->delete();
    }


}