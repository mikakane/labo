<?php
namespace Chatbox\App\Entity;

use Carbon\Carbon;

/**
 * トークンデータ格納エンティティ
 *
 */
class TokenEntity
{
    protected $appUid;
    protected $token_key;
    protected $access_type;
    protected $user_uid;
    /** @var  Carbon */
    protected $expired_at;

    /**
     *
     * @param $token_key
     * @param $access_type
     * @param $user_uid
     * @param $expired_at
     */
    public function __construct($appUid,$token_key, $access_type, $user_uid=null,Carbon $expired_at=null)
    {
        $this->setAppUid($appUid);
        $this->setTokenKey($token_key);
        $this->setAccessType($access_type);
        $this->setUserUid($user_uid);
        $this->setExpiredAt($expired_at);
    }

    /**
     * @return mixed
     */
    public function getAppUid()
    {
        return $this->appUid;
    }

    /**
     * @param mixed $appUid
     */
    public function setAppUid($appUid)
    {
        $this->appUid = $appUid;
    }

    /**
     * @return mixed
     */
    public function getTokenKey()
    {
        return $this->token_key;
    }

    /**
     * トークンをセットする.
     * insert時の自動生成キーの件で必要。
     * @param mixed $token_key
     */
    public function setTokenKey($token_key)
    {
        $this->token_key = $token_key;
    }

    /**
     * @return mixed
     */
    public function getAccessType()
    {
        return $this->access_type;
    }

    /**
     * @param mixed $access_type
     */
    public function setAccessType($access_type)
    {
        $this->access_type = $access_type;
    }

    /**
     * @return mixed
     */
    public function getUserUid()
    {
        return $this->user_uid;
    }

    /**
     * @param mixed $user_uid
     */
    public function setUserUid($user_uid)
    {
        $this->user_uid = $user_uid;
    }

    /**
     * @return Carbon
     */
    public function getExpiredAt()
    {
        return $this->expired_at;
    }

    /**
     * @param Carbon $expired_at
     */
    public function setExpiredAt($expired_at)
    {
        $this->expired_at = $expired_at;
    }

}