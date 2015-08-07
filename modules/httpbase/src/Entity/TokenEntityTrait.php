<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 22:30
 */

namespace Chatbox\HttpBase\Entity;


use Carbon\Carbon;

/**
 * Token is immutable
 * @package Chatbox\HttpBase\Entity
 */
trait TokenEntityTrait {

    protected $tokenKey;

    protected $expiredAt;

    function __construct($tokenKey,Carbon $expiredAt)
    {
        $this->tokenKey = $tokenKey;
        $this->expiredAt = $expiredAt;
    }

    public function getTokenKey(){
        return $this->tokenKey;
    }

    public function toArray(){
        return [
            "tokenKey" => $this->tokenKey,
            "expiredAt" => $this->expiredAt,
        ];
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return $this->toArray();
    }



}