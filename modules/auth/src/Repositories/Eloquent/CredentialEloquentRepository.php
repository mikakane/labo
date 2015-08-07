<?php
namespace Chatbox\Auth\Repositories\Eloquent;
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

class CredentialEloquentRepository implements CredentialRepositoryInterface{

    protected $credentialEloquent;

    /**
     * CredentialEloquentRepository constructor.
     * @param $userRepository
     * @param $credentialEloquent
     */
    public function __construct(UserCredentialEloquent $credentialEloquent)
    {
        $this->credentialEloquent = $credentialEloquent;
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
        // TODO: Implement findByUser() method.
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
        ]);

        $credentialEloquent = $this->credentialEloquent->newInstance($data);
        $credentialEloquent->save();
    }

    /**
     * @inheritDoc
     */
    public function unbind($uid, CredentialEntity $credentialEntity)
    {
        // TODO: Implement unbind() method.
    }


}