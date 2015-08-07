<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;

/**
 * recieve userToken and
 * return userData
 * @package Chatbox\HttpAuth\Http\Controllers
 */
class ControllerUpdate{

    use AuthControllerTrait;

    /** @var \Chatbox\HttpBase\Entity\UserTokenEntity  */
    protected $token;

    protected $userRepository;

    function __construct(ActiveToken $token,UserRepositoryInterface $userRepositoryInterface)
    {
        $this->token = $token->userToken();
        $this->userRepository = $userRepositoryInterface;

    }


    public function handle(){

        $user = $this->token->getUserEntity();
        $data = $this->request()->get("userData",[]);

        $this->userRepository->updateData($user,$data);
        $user = $this->userRepository->getByUid($user->getUid());

        return $this->response()->setUser($user)->ok();
    }
}

