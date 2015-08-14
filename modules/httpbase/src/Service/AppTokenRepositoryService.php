<?php
namespace Chatbox\HttpBase\Service;
use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Repositories\AppRepositoryInterface;
use Chatbox\App\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;
use Chatbox\HttpBase\Exceptions\HttpBadRequestException;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/09
 * Time: 8:30
 */
class AppTokenRepositoryService
{
    protected $appRepository;

    protected $tokenRepository;

    protected $activeToken;
    /**
     * UserRepositoryService constructor.
     * @param $userRepostiory
     * @param $credentialRepository
     */
    public function __construct(
        AppRepositoryInterface $appRepositoryInterface,
        TokenRepositoryInterface $tokenRepositoryInterface,
        ActiveToken $activeToken
    ){
        $this->appRepository = $appRepositoryInterface;
        $this->tokenRepository = $tokenRepositoryInterface;
        $this->activeToken = $activeToken;
    }

    /**
     * @param $token
     * @return void
     */
    public function setAppToken($token){
        $type = "app";
        $token = $this->tokenRepository->loadToken($token,$type);
        if(!$token){
            throw new HttpBadRequestException("token not found");
        }
        $app = $this->appRepository->find($token->getAppUid());
        if(! $app instanceof AppEntity){
            throw new \DomainException("invalid token : missing application");
        }

        $this->activeToken->setAppToken($token,$app);
    }
}