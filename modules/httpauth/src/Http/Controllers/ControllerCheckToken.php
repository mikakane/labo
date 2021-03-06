<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;

/**
 * recieve userToken and
 * return userData
 * @package Chatbox\HttpAuth\Http\Controllers
 */
class ControllerCheckToken{

    use AuthControllerTrait;

    /** @var \Chatbox\HttpBase\Entity\UserTokenEntity  */
    protected $token;

    protected $tokenRepository;

    function __construct(ActiveToken $token)
    {
        $this->token = $token->userToken();
    }


    public function handle(){
        $user = $this->token->getUserEntity();
        return $this->response()->setUser($user)->ok();
    }
}

