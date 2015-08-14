<?php
namespace Chatbox\HttpAuth\Service;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\HttpBase\Exceptions\HttpBadRequestException;
use Symfony\Component\Security\Core\User\User;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/09
 * Time: 8:30
 */
class UserRepositoryService
{
    protected $userRepostiory;

    protected $credentialRepository;

    /**
     * UserRepositoryService constructor.
     * @param $userRepostiory
     * @param $credentialRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepostiory,
        CredentialRepositoryInterface $credentialRepository
    ){
        $this->userRepostiory = $userRepostiory;
        $this->credentialRepository = $credentialRepository;
    }

    /**
     * ハッシュとタイプからユーザを取得する
     * @param $type
     * @param $hash
     * @throws HttpBadRequestException
     * @return UserEntity
     */
    public function getUserByTypeAndHash($type,$hash){
        $cred = $this->credentialRepository->findByTypeAndHash($type,$hash);
        if (! $cred instanceof CredentialEntity) {
            throw new HttpBadRequestException("invald credential");
        }
        return $this->getUserByUid($cred->getUserUid());
    }

    /**
     * Uidからユーザを取得する
     * @param $type
     * @param $hash
     * @throws HttpBadRequestException
     * @return UserEntity
     */
    public function getUserByUid($uid){
        $user = $this->userRepostiory->getByUid($uid);
        if ($user == null) {
            throw new HttpBadRequestException("invald token");
        }
        return $user;
    }

    public function register(UserEntity $userEntity,CredentialEntity $credentialEntity){
        $this->userRepostiory->register($userEntity);
        $this->credentialRepository->bind($userEntity->getUid(),$credentialEntity);
    }

    public function delete(UserEntity $userEntity){
        $this->userRepostiory->deleteUser($userEntity);
    }


}