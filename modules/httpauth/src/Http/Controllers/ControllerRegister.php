<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\CredentialRepositoryException;
use Chatbox\HttpAuth\Http\Request\AuthRequest;

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

    protected $authRequest;

    protected $userService;

    function __construct(
        AuthRequest $authRequest,
        UserRepositoryService $userRepositoryService
    ){
        $this->authRequest = $authRequest;
        $this->userService = $userRepositoryService;
    }


    public function handle(){
        try{
            $user = $this->authRequest->createUser();
            $credential = $this->authRequest->createCredential();

            $this->userRepository->register($user,$credential);

            return $this->response()->setUser($user)->setUserToken($credential)->ok();
        }catch (CredentialRepositoryException $e){
            return $this->response()->bad("invalid credential format");
        }
    }
}

