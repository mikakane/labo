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

    protected $user_uid;
    protected $type;
    protected $hash;

    function __construct(array $data)
    {
        foreach($this->toArray() as $key=>$value){
            if(isset($data[$key])){
                $this->{$key} = $data[$key];
            }
        }
    }

    public function toArray(){
        return get_object_vars($this);
    }



}