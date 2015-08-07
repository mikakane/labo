<?php
namespace Chatbox\HttpAuth\Http\Response;
use Chatbox\Auth\Entity\UserEntity;
use Chatbox\HttpBase\Entity\UserTokenEntity;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/28
 * Time: 23:33
 */

class RestResponse extends \Chatbox\HttpBase\Http\Response\RestResponse{

    public function setUser(UserEntity $userEntity){
        $this->data["user"] = $userEntity->toArray();
        return $this;
    }

    public function setUsers(array $userEntityArray){
        $this->data["userList"] = [];
        foreach($userEntityArray as $userEntity){
            $this->data["userList"][] = $userEntity->toArray();
        }
        return $this;
    }

    public function setUserToken(UserTokenEntity $userTokenEntity){
        $this->data["token"] = $userTokenEntity->toArray();
        return $this;
    }

}