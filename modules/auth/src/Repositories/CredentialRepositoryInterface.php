<?php
namespace Chatbox\Auth\Repositories;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 18:46
 */
interface CredentialRepositoryInterface {

    /**
     * @param array $credential
     * @return CredentialEntity
     */
    public function create(array $credential);

    /**
     * @param UserEntity $userEntity
     * @return CredentialEntity[] with key that showes type
     */
    public function findByUser($uid);

    /**
     * @param string $type
     * @param string $hash
     * @return CredentialEntity
     */
    public function findByTypeAndHash($type,$hash);

    /**
     * @param UserEntity $userEntity
     * @param CredentialEntity $credentialEntity
     * @throw CredentialRepositoryBindException
     * @return void
     */
    public function bind($uid,CredentialEntity $credentialEntity);

    /**
     *
     * @param UserEntity $userEntity
     * @param CredentialEntity $credentialEntity
     * @throw CredentialRepositoryUnbindException
     * @return void
     */
    public function unbind($uid,$type);

}

class CredentialRepositoryException extends \Exception{}

class CredentialRepositoryBindException extends CredentialRepositoryException{}

class CredentialRepositoryUnbindException extends CredentialRepositoryException{}
