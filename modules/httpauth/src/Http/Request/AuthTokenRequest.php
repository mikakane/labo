<?php
namespace Chatbox\HttpAuth\Http\Request;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryNotFoundException;
use Chatbox\HttpAuth\Service\UserRepositoryService;
use Chatbox\Supports\UidGenerator;

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

    protected $userRepository;

    protected $credentialRepository;

    /**
     * AuthRequest constructor.
     * @param $request
     */
    public function __construct(
        \Illuminate\Http\Request $request,
        UserRepositoryInterface $userRepositoryInterface,
        CredentialRepositoryInterface $credentialRepositoryInterface
    ){
        $this->request = $request;
        $this->userRepository = $userRepositoryInterface;
        $this->credentialRepository = $credentialRepositoryInterface;
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
        try{
            return $this->userRepository->getByUid($uid);
        }catch (UserRepositoryNotFoundException $e){
            throw new AuthRequestUserNotFoundException;
        }
    }

    public function getUserByCredential(){
        $type = $this->request->get("credential.type");
        $hash = $this->request->get("credential.hash");
        try{
            $credential = $this->credentialRepository->findByTypeAndHash($type,$hash);
            return $this->userRepository->getByUid($credential->getUserUid());
        }catch (UserRepositoryNotFoundException $e){
            throw new AuthRequestUserNotFoundException;
        }
    }

    public function withToken(){
        return (bool)$this->request()->get("withToken",false);
    }
}

class AuthRequestException extends \Exception{}
class AuthRequestUserNotFoundException extends AuthRequestException{}
