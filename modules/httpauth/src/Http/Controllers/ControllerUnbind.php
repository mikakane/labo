<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\CredentialRepositoryCantOverwriteException;
use Chatbox\Auth\Repositories\CredentialRepositoryException;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;

class ControllerUnbind{

    use AuthControllerTrait;

    /** @var \Chatbox\HttpBase\Entity\UserTokenEntity  */
    protected $token;

    /** @var CredentialRepositoryInterface  */
    protected $credentialRepository;

    function __construct(
        ActiveToken $token,
        CredentialRepositoryInterface $credentialRepositoryInterface
    ){
        $this->token = $token->userToken();
        $this->credentialRepository = $credentialRepositoryInterface;
    }

    public function handle(){
        try{
            $userEntity = $this->token->getUserEntity();
            $type = $this->request()->get("credentialType");
            $this->credentialRepository->unbind($userEntity->getUid(),$type);
            return $this->response()->ok("your credential successfully binded");
        }catch (CredentialRepositoryException $e){
            return $this->response()->bad("cant load credential");
        }catch (CredentialRepositoryCantOverwriteException $e){
            return $this->response()->bad("credential type already exit");
        }

    }
}

