<?php
namespace Chatbox\HttpBase\Casket;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 19:24
 */

use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Entity\TokenEntity;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Exceptions\HttpBadRequestException;

/**
 * トークン置き場。
 *
 * ミドルウェアからの呼び出しで、シングルトン登録されるべきもの。
 *
 *
 * @package Chatbox\HttpBase\Casket
 */
class ActiveToken {

    /** @var TokenEntity */
    protected $tokenEntity;

    /** @var  AppEntity */
    protected $appEntity;

    public function __construct(TokenEntity $tokenEntity,AppEntity $appEntity){
        $this->tokenEntity = $tokenEntity;
        $this->appEntity = $appEntity;
    }

    /**
     * @return TokenEntity
     */
    public function token()
    {
        if($this->tokenEntity instanceof TokenEntity){
            return $this->tokenEntity;
        }else{
            throw new \DomainException("no token supplied");
        }
    }

    /**
     * @return AppEntity
     */
    public function app()
    {
        if($this->appEntity instanceof AppEntity){
            return $this->appEntity;
        }else{
            throw new \DomainException("no app supplied");
        }
    }

}