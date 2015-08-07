<?php
namespace Chatbox\Auth\Infrastructure\Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/01
 * Time: 18:23
 */

class UserCredentialEloquent extends Model{

    protected $table = "cb_user_credential";

    protected $fillable = ["user_uid","app_uid","type","hash"];

}