<?php
namespace Chatbox\HttpBase\Http\Response;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/28
 * Time: 23:33
 */

use Illuminate\Http\JsonResponse;

class RestResponse {

    protected $status = 200;

    protected $data = [];

    protected $headers = [];

    protected function setData($dataOrMessage){
        if(is_string($dataOrMessage)){
            $this->setMessage($dataOrMessage);
        }elseif(is_array($dataOrMessage)){
            $this->data = array_merge($this->data,$dataOrMessage);
        }
        return $this;
    }

    protected function setMessage($message){
        $this->data["message"] = $message;
        return $this;
    }

    protected function setStatus($status){
        $this->status = $status;
        if($status >= 200 && $status < 300){
            $this->data["status"] = "OK";
        }else if($status >= 400 && $status < 500){
            $this->data["status"] = "BAD";
        }else if($status >= 500 ){
            $this->data["status"] = "ERROR";
        }
        return $this;
    }

    protected function render(){
        $res = JsonResponse::create($this->data,$this->status,$this->headers);
        return $res;
    }

    public function ok($dataOrMessage=null){
        return $this->setData($dataOrMessage)->setStatus(200)->render();
    }

    public function bad($dataOrMessage=null){
        return $this->setData($dataOrMessage)->setStatus(400)->render();
    }

    public function error($dataOrMessage=null){
        return $this->setData($dataOrMessage)->setStatus(500)->render();
    }

}