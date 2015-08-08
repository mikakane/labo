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
     * Uidからユーザエンティティを取得する
     * @param CredentialEntity $credentialEntity
     * @return UserEntity
     * @throw UserRepositoryNotFoundException
     */
    public function getByUid($uid);

    /**
     * ユーザエンティティの一覧を取得
     * @param array $condition
     * @return UserEntity[]
     */
    public function find(array $condition);

    /**
     * ユーザエンティティを新規挿入する
     * @param UserEntity $credentialEntity
     * @param CredentialEntity $credentialEntity
     * @return CredentialEntity $credentialEntity
     */
    public function register(UserEntity $userEntity);

    /**
     * @param UserEntity $credentialEntity
     * @throw UserRepositoryNotFoundException
     * @return void
     */
    public function deleteUser(UserEntity $credentialEntity);

    /**
     * ユーザエンティティを更新する
     * @param UserEntity $credentialEntity
     * @param $data
     * @throw UserRepositoryNotFoundException
     * @return void
     */
    public function updateData(UserEntity $credentialEntity);

}

class UserRepositoryException extends \Exception{}

class UserRepositoryNotFoundException extends UserRepositoryException{}