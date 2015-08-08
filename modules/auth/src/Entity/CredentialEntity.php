<?php
namespace Chatbox\Auth\Entity;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 18:11
 */

/**
 *
 */
class CredentialEntity {

    const TYPE_PASSWORD="password";

    protected $userUid;
    protected $type;
    protected $hash;

    /**
     * CredentialEntity constructor.
     * @param $userUid
     * @param $type
     * @param $hash
     */
    public function __construct($userUid, $type, $hash)
    {
        $this->setUserUid($userUid);
        $this->setType($type);
        $this->setHash($hash);
    }


    /**
     * @return mixed
     */
    public function getUserUid()
    {
        return $this->userUid;
    }

    /**
     * @param mixed $userUid
     */
    public function setUserUid($userUid)
    {
        $this->userUid = $userUid;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }






}