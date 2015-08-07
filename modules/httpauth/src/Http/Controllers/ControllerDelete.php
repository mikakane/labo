<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryNotFoundException;

class ControllerDelete{

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
            $this->userRepository->deleteUser($user);

            return $this->response()->ok("user deleted");
        }catch (UserRepositoryNotFoundException $e){
            return $this->response()->bad("cant find user");
        }
    }
}

