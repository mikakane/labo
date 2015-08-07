<?php
namespace Chatbox\Auth\Repositories;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 18:46
 */

use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;

interface UserRepositoryInterface {

    /**
     * @param CredentialEntity $credentialEntity
     * @return UserEntity
     */
    public function create(array $userData);

    /**
     * @param CredentialEntity $credentialEntity
     * @return UserEntity
     * @throw UserRepositoryNotFoundException
     */
    public function getByUid($uid);

    /**
     * @param array $condition
     * @return UserEntity[]
     */
    public function find(array $condition);

    /**
     * @param UserEntity $credentialEntity
     * @param CredentialEntity $credentialEntity
     * @return string uid
     */
    public function register(UserEntity $credentialEntity,CredentialEntity $credentialEntity);

    /**
     * @param UserEntity $credentialEntity
     * @throw UserRepositoryNotFoundException
     * @return void
     */
    public function deleteUser(UserEntity $credentialEntity);

    /**
     * @param UserEntity $credentialEntity
     * @throw UserRepositoryNotFoundException
     * @return void
     */
    public function frozenUser(UserEntity $credentialEntity);

    /**
     * @param UserEntity $credentialEntity
     * @param $data
     * @throw UserRepositoryNotFoundException
     * @return void
     */
    public function updateData(UserEntity $credentialEntity,array $data);

}

class UserRepositoryException extends \Exception{}

class UserRepositoryNotFoundException extends UserRepositoryException{}