<?php
namespace Chatbox\HttpBase\Service;
use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Repositories\AppRepositoryInterface;
use Chatbox\App\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;
use Chatbox\HttpBase\Exceptions\HttpBadRequestException;

/**
 * トークンの操作に関するサービス
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
        TokenRepositoryInterface $tokenRepositoryInterface
    ){
        $this->appRepository = $appRepositoryInterface;
        $this->tokenRepository = $tokenRepositoryInterface;
    }

    /**
     * トークンキーからトークンエンティティを取得する。
     * @param $token
     * @return void
     */
    public function createActiveToken($token){
        $type = "app";
        $token = $this->tokenRepository->loadToken($token,$type);
        if(!$token){
            throw new HttpBadRequestException("token not found");
        }
        $app = $this->appRepository->find($token->getAppUid());
        if(! $app instanceof AppEntity){
            throw new \DomainException("invalid token : missing application");
        }
        return new ActiveToken($token,$app);
    }
}