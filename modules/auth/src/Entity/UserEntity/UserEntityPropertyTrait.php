<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/08
 * Time: 13:58
 */

namespace Chatbox\Auth\Entity\UserEntity;


use Carbon\Carbon;
use Chatbox\Auth\Entity\UserDataEntity;
use Chatbox\Auth\Entity\UserEntity;

trait UserEntityPropertyTrait
{

    protected $uid;

    protected $email;

    protected $isForzen;

    protected $registerdAt;

    /**
     * UserEntityPropertyTrait constructor.
     * @param $uid
     * @param $email
     * @param $isForzen
     * @param $registerdAt
     * @param UserDataEntity $userData
     */
    public function __construct($uid, $email, $isForzen,Carbon $registerdAt)
    {
        $this->setUid($uid);
        $this->setEmail($email);
        $this->setIsForzen($isForzen);
        $this->setRegisterdAt($registerdAt);
    }


    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getIsForzen()
    {
        return $this->isForzen;
    }

    /**
     * @param mixed $isForzen
     */
    public function setIsForzen($isForzen)
    {
        $this->isForzen = (bool)$isForzen;
    }

    /**
     * @return Carbon
     */
    public function getRegisterdAt()
    {
        return $this->registerdAt;
    }

    /**
     * @param Carbon $registerdAt
     */
    public function setRegisterdAt(Carbon $registerdAt)
    {
        $this->registerdAt = $registerdAt;
    }
}