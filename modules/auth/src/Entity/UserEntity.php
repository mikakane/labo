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
class UserEntity{

    const STATUS_FROZEN = 1;

    protected $uid;
    protected $email;
    protected $is_frozen;
    protected $created_at;
    protected $updated_at;


    function __construct(array $data)
    {
        foreach($this as $key=>$value){
            if(isset($data[$key])){
                $this->{$key} = $value;
            }
        }
    }

    public function getUid(){
        return $this->uid;
    }

    public function toArray(){
        return get_object_vars($this);
    }


}