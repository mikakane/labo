<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;

class ControllerRefresh{

    use AuthControllerTrait;

    /** @var \Chatbox\HttpBase\Entity\UserTokenEntity  */
    protected $token;

    protected $tokenRepository;

    function __construct(ActiveToken $token,TokenRepositoryInterface $tokenRepositoryInterface)
    {
        $this->token = $token->userToken(true);
        $this->tokenRepository = $tokenRepositoryInterface;
    }


    public function handle(){
        $newToken = $this->tokenRepository->rotateUserToken($this->token);
        return $this->response()->setUserToken($newToken)->ok();
    }
}

