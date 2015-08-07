<?php
namespace Chatbox\Auth\Infrastructure\Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/01
 * Time: 18:23
 */

/**
 * Class UserEloquent
 * @package Chatbox\Auth\Infrastructure\Eloquent
 * @property string $user_uid
 * @property string $app_uid
 * @property string $name
 * @property string $email
 * @property bool $is_frozen
 * @property string $metainfo
 *
 */
class UserEloquent extends Model{

    protected $table = "cb_user_list";

    protected $fillable = ["user_uid","app_uid","name","email","is_frozen","metainfo"];


    public function is_frozen(){
        return (bool)$this->is_frozen;
    }

    public function enfrozen(){
        $this->is_frozen = true;
        $this->save();
        return $this;
    }

    public function defrozen(){
        $this->is_frozen = true;
        $this->save();
        return $this;
    }

    public function setMetadata(array $data){
        $this->metainfo = json_encode($data);
        return $this;
    }

    public function getMetadata(){
        return json_decode($this->metainfo,true);
    }

}