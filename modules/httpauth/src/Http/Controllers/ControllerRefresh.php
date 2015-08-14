<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\HttpBase\Casket\ActiveToken;

class ControllerRefresh{

    use AuthControllerTrait;

    /** @var \Chatbox\HttpBase\Entity\UserTokenEntity  */
    protected $token;

//    protected $tokenRepository;

    function __construct(ActiveToken $token)
    {
        $this->token = $token->userToken(true);
    }


    public function handle(){
        $newToken = $this->tokenRepository->rotateUserToken($this->token);
        return $this->response()->setUserToken($newToken)->ok();
    }
}

