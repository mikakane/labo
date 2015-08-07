<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryNotFoundException;

class ControllerBan{

    use AuthControllerTrait;

    protected $userRepository;

    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(){
        try{
            $uid = $this->request()->get("uid");
            $user = $this->userRepository->getByUid($uid);
            $this->userRepository->frozenUser($user);
            return $this->response()->ok("user frozen");
        }catch (UserRepositoryNotFoundException $e){
            return $this->response()->bad("cant find user");
        }
    }
}

