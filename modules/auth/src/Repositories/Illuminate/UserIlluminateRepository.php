<?php
namespace Chatbox\Auth\Repositories\Illuminate;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\Auth\Infrastructure\Eloquent\UserEloquent;
use Chatbox\Auth\Infrastructure\Mapper\UserMapper;
use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryNotFoundException;
use Chatbox\Supports\UidGenerator;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/01
 * Time: 18:13
 */
class UserIlluminateRepository implements UserRepositoryInterface{

    protected $userMapper;

    function __construct(
        UserMapper $userMapper
    ){
        $this->userMapper = $userMapper;
    }

    /**
     * @inheritDoc
     */
    public function getByUid($uid)
    {
        $user = $this->userMapper->find($uid);
        if($user){
            return $user;
        }else{
            throw new UserRepositoryNotFoundException;
        }
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
    public function register(UserEntity $userEntity)
    {
        $this->userMapper->insert($userEntity);
    }

    /**
     * @inheritDoc
     */
    public function deleteUser(UserEntity $userEntity)
    {
        $this->userMapper->delete($userEntity);
    }

    /**
     * @inheritDoc
     */
    public function updateData(UserEntity $userEntity)
    {
        $this->userMapper->update($userEntity);
    }


}
