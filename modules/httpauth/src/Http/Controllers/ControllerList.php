<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryNotFoundException;

class ControllerList{

    use AuthControllerTrait;

    protected $userRepository;

    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(){
        try{
            $condition = $this->request()->get("cond",[]);
            $users = $this->userRepository->find($condition);
            return $this->response()->setUsers($users)->ok();
        }catch (UserRepositoryNotFoundException $e){
            return $this->response()->bad("cant find user");
        }
    }
}

