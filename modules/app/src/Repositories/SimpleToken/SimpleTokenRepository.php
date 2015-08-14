<?php
namespace Chatbox\App\Repositories\SimpleToken;
use Chatbox\App\Entity\TokenEntity;
use Chatbox\App\Entity\UserTokenEntity;
use Chatbox\App\Infrastructure\Mapper\TokenMapper;
use Chatbox\App\Repositories\TokenRepositoryInterface;
use Chatbox\App\Repositories\UserTokenRepositoryInterface;
use Chatbox\Auth\Entity\UserEntity;

/**
 * トークンのCRUDに関するリポジトリ
 */
class SimpleTokenRepository implements TokenRepositoryInterface
{
    protected $mapper;

    /**
     * AppIlluminateRepository constructor.
     * @param $mapper
     */
    public function __construct(TokenMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @inheritDoc
     */
    public function loadToken($tokenKey,$type, $default = null)
    {
        return $this->mapper->find($tokenKey,$type,$default);
    }

    /**
     * @inheritDoc
     */
    public function insert(TokenEntity $tokenEntity)
    {
        return $this->mapper->insert($tokenEntity);
    }

    /**
     * @inheritDoc
     */
    public function delete($tokenKey)
    {
        return $this->mapper->delete($tokenKey);
    }


}

