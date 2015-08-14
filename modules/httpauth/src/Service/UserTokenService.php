<?php
namespace Chatbox\HttpAuth\Service;
use Carbon\Carbon;
use Chatbox\App\Entity\TokenEntity;
use Chatbox\App\Repositories\TokenRepositoryInterface;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\App\Repositories\UserTokenRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/09
 * Time: 8:30
 */
class UserTokenService
{
    protected $tokenRepository;

    /**
     * UserTokenService constructor.
     * @param $tokenRepository
     */
    public function __construct(TokenRepositoryInterface $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function createUserToken(UserEntity $userEntity){
        $appUid = sha1(mt_rand());
        $tokenKey = sha1(mt_rand());
        $expiredAt = Carbon::now()->addDay(7);
        $token = new TokenEntity($appUid,$tokenKey,"user",$userEntity->getUid(),$expiredAt);
        $this->tokenRepository->insert($token);
        return $token;
    }

    public function deleteUserToken(UserEntity $userEntity){
        $token = $this->tokenRepository->deleteUserToken($userToken);
        return $token;
    }

}