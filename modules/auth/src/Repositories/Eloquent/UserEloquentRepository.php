<?php
namespace Chatbox\Auth\Repositories\Eloquent;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\Auth\Infrastructure\Eloquent\UserEloquent;
use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Supports\UidGenerator;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/01
 * Time: 18:13
 */

class UserEloquentRepository implements UserRepositoryInterface{

    /** @var CredentialRepositoryInterface  */
    protected $credentialRepository;

    /** @var UserEloquent  */
    protected $userEloquent;

    protected $uidGenerator;

    protected $appUid;

    function __construct(
        CredentialRepositoryInterface $credentialRepository,
        UserEloquent $userEloquent,
        UidGenerator $uidGenerator
    ){
        $this->credentialRepository = $credentialRepository;
        $this->userEloquent = $userEloquent;
        $this->uidGenerator = $uidGenerator;

        $this->appUid = null;
    }

    /**
     * @inheritDoc
     */
    public function create(array $userData)
    {
        return new UserEntity($userData);
    }

    /**
     * @inheritDoc
     */
    public function getByUid($uid)
    {
        return $this->create($this->getEloquentByUid($uid));
    }

    /**
     * @inheritDoc
     */
    public function find(array $condition)
    {
        // TODO: Implement find() method.
    }



    /**
     * @inheritDoc
     */
    public function register(UserEntity $userEntity, CredentialEntity $credentialEntity)
    {
        $uid = $this->uidGenerator->random();
        $data = array_merge([
            "name" => null,
            "email" => null,
            "metainfo" => "{}"
        ],$userEntity->toArray(),[
            "user_uid" => $uid,
            "app_uid" => $this->appUid,
            "is_frozen" => "0",
        ]);

        $userEloquent = $this->userEloquent->newInstance($data);
        $userEloquent->save();


        $this->credentialRepository->bind($uid,$credentialEntity);

        return $uid;
    }

    /**
     * @inheritDoc
     */
    public function deleteUser(UserEntity $credentialEntity)
    {
        $this->getEloquentByUid($credentialEntity->getUid())->delete();
    }

    /**
     * @inheritDoc
     */
    public function frozenUser(UserEntity $credentialEntity)
    {
        $this->getEloquentByUid($credentialEntity->getUid())->enfrozen();
        // TODO: Implement frozenUser() method.
    }

    /**
     * @inheritDoc
     */
    public function updateData(UserEntity $credentialEntity,array $data)
    {
        $this->getEloquentByUid($credentialEntity->getUid())->setMetadata($data)->save();
    }

    /**
     * @param $uid
     * @return UserEloquent
     * @throws UserRepositoryNotFoundException
     */
    protected function getEloquentByUid($uid){
        $user = $this->userEloquent->where("user_uid",$uid)->first();
        if($user){
            return $user;
        }else{
            throw new UserRepositoryNotFoundException();
        }
    }


}