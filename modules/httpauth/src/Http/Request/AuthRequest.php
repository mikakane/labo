<?php
namespace Chatbox\HttpAuth\Http\Request;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryNotFoundException;
use Chatbox\HttpAuth\Service\UserRepositoryService;
use Chatbox\Supports\UidGenerator;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/09
 * Time: 8:22
 */
class AuthRequest
{
    /** @var  \Illuminate\Http\Request */
    protected $request;

    protected $userService;

    protected $userRepository;

    protected $credentialRepository;

    /**
     * AuthRequest constructor.
     * @param $request
     */
    public function __construct(
        Request $request,
        UserRepositoryService $userRepositoryService,
        UserRepositoryInterface $userRepositoryInterface,
        CredentialRepositoryInterface $credentialRepositoryInterface
    ){
        $this->request = $request;
        $this->userService = $userRepositoryService;
        $this->userRepository = $userRepositoryInterface;
        $this->credentialRepository = $credentialRepositoryInterface;
    }

    public function flag($key){
        return (bool)$this->request()->get($key,false);
    }

    /**
     * @return UserEntity
     */
    public function createUser()
    {
        $userData = $this->request->get("user");
        //バリデーションして...
        $uid = (new UidGenerator())->random();

        $user = new UserEntity(
            $uid,
            $email,
            $isFrozen,
            $registerdAt
        );
        return $user;
    }

    /**
     * @param UserEntity $userEntity
     * @return CredentialEntity
     */
    public function createCredential(UserEntity $userEntity)
    {
        $userData = $this->request->get("credential");
        $credential = new CredentialEntity(
            $userEntity->getUid(),
            $type,
            $hash
        );
        return $credential;
    }


    public function getUser(){
        $uid = $this->request->get("uid");
        return $this->userService->getUserByUid($uid);
    }

    /**
     * 認証情報からユーザ情報を取得する。
     */
    public function getUserByCredential(){
        $type = $this->request->get("credential.type");
        $hash = $this->request->get("credential.hash");
        return $this->userService->getUserByTypeAndHash($type,$hash);
    }

}

class AuthRequestException extends \Exception{}
class AuthRequestUserNotFoundException extends AuthRequestException{}
