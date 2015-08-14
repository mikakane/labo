<?php
$I = new AuthApiTesterEx($scenario);
$I->wantTo('test about login and logout');

$I->haveFriend('green')->does(function(AuthApiTesterEx $I) {

    $I->amGoingTo("認証");
    $I->sendAPI("login");
    $I->seeOK();

});


