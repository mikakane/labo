<?php
namespace Chatbox\HttpBase\Casket;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 19:24
 */

use Chatbox\Auth\Repositories\TokenRepositoryInterface;
use Chatbox\HttpBase\Entity\UserTokenEntity;


/**
 * Casket for multi token
 * You can retrieve active token object that you intend
 * And catch Exception when what on casket isnt match with what you intend
 *
 * this class only supply getter of token object.
 *
 *
 *
 *
 * @package Chatbox\HttpBase\Casket
 */
class ActiveToken {

    protected $token;

    protected $tokenRepository;

    function __construct(TokenRepositoryInterface $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function authToken(){
        return $this->token;
    }

    /**
     * get user token.
     * @return UserTokenEntity
     */
    public function userToken($withExpiredToken=false){
        return $this->token;
    }

    public function rootToken(){
        return $this->token;
    }
}