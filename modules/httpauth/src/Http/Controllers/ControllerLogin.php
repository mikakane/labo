<?php
namespace Chatbox\HttpAuth\Http\Controllers;

use Chatbox\HttpAuth\Http\Request\AuthRequest;
use Chatbox\HttpAuth\Service\UserPersistanceService;
use Chatbox\HttpAuth\Service\UserRepositoryService;
use Chatbox\HttpAuth\Service\UserTokenService;

class ControllerLogin{

    use AuthControllerTrait;

    protected $authRequest;

    protected $userService;

    protected $tokenService;

    function __construct(
        AuthRequest $authRequest,
        UserRepositoryService $userRepositoryService,
        UserTokenService $userTokenService
    ){
        $this->authRequest = $authRequest;
        $this->userService = $userRepositoryService;
        $this->tokenService = $userTokenService;
    }

    public function handle()
    {
        $user = $this->authRequest->getUserByCredential();

        $response = $this->response()->setUser($user);
        if($this->authRequest->withToken()){
            $token = $this->tokenService->createUserToken($user);
            $response->setUserToken($token);
        }

        return $response;
    }
}