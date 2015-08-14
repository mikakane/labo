<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\HttpAuth\Service\UserTokenService;
use Chatbox\HttpBase\Casket\ActiveToken;

class ControllerLogout{

    use AuthControllerTrait;

    /** @var \Chatbox\HttpBase\Entity\UserTokenEntity  */
    protected $token;

    protected $tokenService;

    function __construct(
        ActiveToken $token,
        UserTokenService $userTokenService)
    {
        $this->token = $token->userToken();
        $this->tokenService = $userTokenService;
    }

    public function handle(){
        $this->tokenService->deleteUserToken($this->token);
        return $this->response()->ok("successfully logouted");
    }
}

