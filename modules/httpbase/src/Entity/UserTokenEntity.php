<?php
namespace Chatbox\HttpBase\Entity;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/29
 * Time: 18:11
 */
use Carbon\Carbon;
use Chatbox\Auth\Entity\UserEntity;

/**
 *
 *
 */
class UserTokenEntity implements \JsonSerializable{

    use TokenEntityTrait;

    protected $userEntity;

    function __construct($tokenKey, Carbon $expiredAt,UserEntity $userEntity)
    {
        parent::__construct($tokenKey,$expiredAt);
        $this->userEntity = $userEntity;
    }


    /**
     * @return UserEntity
     */
    public function getUserEntity(){
        return $this->userEntity;
    }


}