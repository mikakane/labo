<?php
namespace Chatbox\HttpBase\Http\Controllers;


use Chatbox\HttpBase\Casket\ActiveToken;
use Chatbox\HttpBase\Http\Controllers\RestControllerTrait;
use Chatbox\HttpBase\Http\Response\RestResponse;

class ControllerInfo{

    use RestControllerTrait;

    public function handle(
        ActiveToken $activeToken
    ){
        return $this->response()->setApp($activeToken->app())->ok();
//        try{
//            $uid = $this->request()->get("uid");
//            $user = $this->userRepository->getByUid($uid);
//            $this->userRepository->frozenUser($user);
//            return $this->response()->ok("user frozen");
//        }catch (UserRepositoryNotFoundException $e){
//            return $this->response()->bad("cant find user");
//        }
    }
}

