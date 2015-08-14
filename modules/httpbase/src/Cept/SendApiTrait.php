<?php
namespace Chatbox\HttpBase\Cept;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/11
 * Time: 22:44
 */
trait SendApiTrait
{

    public function sendAPI($url,array $param=[]){
        $param["token"] = $this->token;
        $I=$this;
        $I->haveHttpHeader("Content-Type","application/json");
        $I->sendPOST($url,$param);
    }

    public function seeOK($data=[],$status=200){
        $data = array_merge($data,[
            "status" => "OK"
        ]);

        $I = $this;
        $I->SeeResponseCodeIs($status);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($data);
    }

    public function seeBAD($data=[],$status=400){
        $data = array_merge($data,[
            "status" => "BAD"
        ]);

        $I = $this;
        $I->SeeResponseCodeIs($status);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($data);
    }

    public function seeERROR($data=[],$status=500){
        $data = array_merge($data,[
            "status" => "ERROR"
        ]);

        $I = $this;
        $I->SeeResponseCodeIs($status);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($data);
    }

    public function grabReponseArray($override = []){
        $I = $this;
        $data = json_decode($I->grabResponse(),true);
        return array_merge($data,$override);
    }

}