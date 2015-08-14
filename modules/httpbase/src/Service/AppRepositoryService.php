<?php
namespace Chatbox\HttpBase\Service;
use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Repositories\AppRepositoryInterface;
use Chatbox\App\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Exceptions\HttpBadRequestException;

/**
 * アプリケーションオブジェクトの操作に関するサービス
 */
class AppRepositoryService
{
    protected $appRepository;

    protected $tokenRepository;

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

}