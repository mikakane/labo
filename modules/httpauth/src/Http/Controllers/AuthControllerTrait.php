<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/30
 * Time: 11:34
 */

namespace Chatbox\HttpAuth\Http\Controllers;


use Chatbox\HttpAuth\Http\Response\RestResponse;
use Chatbox\HttpBase\Http\Controllers\RestControllerTrait;

trait AuthControllerTrait {

    use RestControllerTrait;


    /**
     * @return RestResponse
     */
    protected function response()
    {
        if(!$this->response){
            $this->response = new RestResponse();
        }
        return $this->response;
    }


}