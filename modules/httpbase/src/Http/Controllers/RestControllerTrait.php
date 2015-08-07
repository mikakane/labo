<?php
namespace Chatbox\HttpBase\Http\Controllers;

use Chatbox\HttpBase\Http\Response\RestResponse;
use Illuminate\Http\Request;

trait RestControllerTrait{

    /** @var RestResponse */
    protected $response;

    /** @var RestResponse */
    protected $request;

    public function fire(){
        return app()->call([$this, "handle"]);
    }

    /**
     * @return Request
     */
    protected function request(){
        if(!$this->request){
            $this->request = app(Request::class);
        }
        return $this->request;
    }

    /**
     * @return RestResponse
     */
    protected function response(){
        if(!$this->response){
            $this->response = new RestResponse();
        }
        return $this->response;
    }
}

