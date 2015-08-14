<?php
$I = new AuthApiTesterEx($scenario);
$I->wantTo('test about login and logout');

$green = $I->haveFriend('green');
$green->does(function(ApiTester $I) {

    $I->amGoingTo("ユーザ削除");
    $I->haveHttpHeader("Content-Type","application/json");
    $I->sendPOST("info");
    $I->SeeResponseCodeIs(200);
    $I->seeResponseIsJson();
    $I->seeResponseContainsJson([
        "status" => "OK"
    ]);

});


