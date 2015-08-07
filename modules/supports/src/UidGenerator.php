<?php
namespace Chatbox\Supports;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/01
 * Time: 21:06
 */
class UidGenerator
{

    public function random($n = 24)
    {
        return substr(base_convert(bin2hex(openssl_random_pseudo_bytes($n)),16,36),0,$n);
    }

}