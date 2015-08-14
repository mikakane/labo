<?php
namespace Chatbox\HttpAuth\Http\Controllers;

use Chatbox\HttpAuth\Http\Request\AuthRequest;
use Chatbox\HttpAuth\Service\UserRepositoryService;

class ControllerDelete{

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

    public function handle()
    {
        try{
            $user = $this->authRequest->getUser();

            $this->userService->delete($user);

            return $this->response()->ok("user deleted");
        }catch (UserRepositoryNotFoundException $e){
            return $this->response()->bad("cant find user");
        }
    }
}

