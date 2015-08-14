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
 * ユーザ置き場。
 *
 * ミドルウェアからの呼び出しで、シングルトン登録されるべきもの。
 *
 *
 * @package Chatbox\HttpBase\Casket
 */
class AuthenUser {

    /** @var TokenEntity */
    protected $userEntity;

    public function __construct(UserEntity $userEntity){
        $this->userEntity = $userEntity;
    }

    /**
     * @return UserEntity
     */
    public function user()
    {
        if($this->userEntity instanceof UserEntity){
            return $this->userEntity;
        }else{
            throw new \DomainException("no user authen");
        }
    }

}