<?php
namespace Chatbox\Auth\Entity;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 18:11
 */
use Carbon\Carbon;
use Chatbox\Auth\Entity\UserEntity\UserEntityPropertyTrait;
use Traversable;

/**
 * 汎用ユーザデータ格納のための汎用的な配列コンテナ
 * Class UserDataEntity
 * @package Chatbox\Auth\Entity
 */
class UserDataEntity implements \JsonSerializable,\IteratorAggregate{

    protected $userData;

    /**
     * UserDataEntity constructor.
     * @param $userData
     */
    public function __construct(array $userData)
    {
        foreach ($userData as $key => $value) {
            $this->setItem($key,$value);
        }
    }

    protected function getItem($key,$default=null)
    {
        return array_get($this->userData,$key,$default);
    }

    protected function setItem($key,$value)
    {
        array_set($this->userData,$key,$value);
    }

    /**
     * @inheritDoc
     */
    public function __get($name)
    {
        return $this->getItem($name);
    }

    /**
     * @inheritDoc
     */
    public function __set($name, $value)
    {
        $this->setItem($name,$value);
    }

    public function toArray()
    {
        return $this->userData;
    }

    /**
     * @inheritDoc
     */
    function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return $this->toArray();
    }


}