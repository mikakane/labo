<?php
$I = new AppApiTesterEx($scenario);
$I->wantTo('test about login and logout');

$I->haveFriend('green')->does(function(AppApiTesterEx $I) {

    $I->amGoingTo("アプリケーション情報");
    $I->sendAPI("info");
    $I->seeOK();

});


