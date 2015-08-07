<?php
namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\Auth\Entity\UserEntity;
use Chatbox\Auth\Repositories\CredentialRepositoryException;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryException;
use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\Auth\Repositories\UserRepositoryNotFoundException;

/**
 * execute login
 *
 * recieve credential and
 * return binded userInfo
 *
 * @package Chatbox\HttpAuth\Http\Controllers
 */
class ControllerLogin{

    use AuthControllerTrait;

    protected $userRepository;
    protected $credentailRepository;
    protected $tokenRepotisotry;

    function __construct(
        CredentialRepositoryInterface $credentialRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface,
        TokenRepositoryInterface $tokenRepositoryInterface
    )
    {
        $this->userRepository = $userRepositoryInterface;
        $this->credentailRepository = $credentialRepositoryInterface;
        $this->tokenRepotisotry = $tokenRepositoryInterface;
    }


    public function handle(){
        try{
            $withToken = $this->request()->get("withToken",false);

            $credential = $this->credentailRepository->findByTypeAndHash(
                $this->request()->get("type"),
                $this->request()->get("hash")
            );
            $user = $this->userRepository->getByUid($credential->getUid());
            return $this->regularHandler($user,$withToken);
        }catch (CredentialRepositoryException $e){
            return $this->response()->bad("invalid credential format");
        }catch (UserRepositoryNotFoundException $e){
            return $this->response()->bad("cant find user data");
        }
    }

    protected function regularHandler(UserEntity $user,$withToken){
        $response = $this->response()->setUser($user);

        if($withToken){
            $token = $this->tokenRepotisotry->createUserToken($user);
            $response->setUserToken($token);
        }

        return $response;
    }


}

