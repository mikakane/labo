<?php
namespace Chatbox\HttpBase\Repositories;
namespace Chatbox\Auth\Repositories;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\HttpBase\Entity\UserTokenEntity;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 18:46
 */

interface TokenRepositoryInterface {

    /**
     * @param UserEntity $credentialEntity
     * @return UserTokenEntity
     */
    public function createUserToken(UserEntity $credentialEntity);

    /**
     * @param UserTokenEntity $userTokenEntity
     * @return void
     */
    public function deleteUserToken(UserTokenEntity $userTokenEntity);

    /**
     * @param UserTokenEntity $userTokenEntity
     * @return UserTokenEntity
     */
    public function rotateUserToken(UserTokenEntity $userTokenEntity);


}

class TokenRepositoryException extends \Exception{}