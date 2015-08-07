<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\CredentialRepositoryException;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryInterface;

/**
 * execute login
 *
 * recieve credential and
 * return binded userInfo
 *
 * @package Chatbox\HttpAuth\Http\Controllers
 */
class ControllerRegister{

    use AuthControllerTrait;

    protected $userRepository;
    protected $credentailRepository;
    protected $tokenRepotisotry;

    function __construct(
        CredentialRepositoryInterface $credentialRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface,
        TokenRepositoryInterface $tokenRepositoryInterface
    )
    {
        $this->userRepository = $userRepositoryInterface;
        $this->credentailRepository = $credentialRepositoryInterface;
        $this->tokenRepotisotry = $tokenRepositoryInterface;
    }


    public function handle(){
        try{
            $user = $this->userRepository->create(
                $this->request()->get("userData")
            );
            $credential = $this->credentailRepository->create(
                $this->request()->get("credential")
            );
            $uid = $this->userRepository->register($user,$credential);
            $user = $this->userRepository->getByUid($uid);
            return $this->response()->setUser($user)->setUserToken($credential)->ok();
        }catch (CredentialRepositoryException $e){
            return $this->response()->bad("invalid credential format");
        }
    }
}

