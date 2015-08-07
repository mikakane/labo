<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;

class ControllerLogout{

    use AuthControllerTrait;

    /** @var \Chatbox\HttpBase\Entity\UserTokenEntity  */
    protected $token;

    protected $tokenRepository;

    function __construct(ActiveToken $token,TokenRepositoryInterface $tokenRepositoryInterface)
    {
        $this->token = $token->userToken();
        $this->tokenRepository = $tokenRepositoryInterface;
    }


    public function handle(){
        $this->tokenRepository->deleteUserToken($this->token);
        return $this->response()->ok("successfully logouted");
    }
}

