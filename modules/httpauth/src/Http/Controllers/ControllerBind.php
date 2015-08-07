<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Repositories\CredentialRepositoryCantOverwriteException;
use Chatbox\Auth\Repositories\CredentialRepositoryException;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;

class ControllerBind{

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
            $force = $this->request()->get("force",false);
            $userEntity = $this->token->getUserEntity();
            $credential = $this->credentailRepository->create(
                $this->request()->get("credential")
            );
            $this->credentialRepository->bind($userEntity->getUid(),$credential,$force);
            return $this->response()->ok("your credential successfully binded");
        }catch (CredentialRepositoryException $e){
            return $this->response()->bad("cant load credential");
        }catch (CredentialRepositoryCantOverwriteException $e){
            return $this->response()->bad("credential type already exit");
        }

    }
}

