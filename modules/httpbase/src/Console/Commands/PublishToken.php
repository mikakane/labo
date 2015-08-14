<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/14
 * Time: 4:55
 */

namespace Chatbox\HttpBase\Console\Commands;

use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Entity\TokenEntity;
use Chatbox\App\Repositories\AppRepositoryInterface;
use Chatbox\App\Repositories\TokenRepositoryInterface;
use Illuminate\Console\Command;

class PublishToken extends Command{

    protected $name = "publish";
    protected $description = "hogehoge";

    public function handle(
        AppRepositoryInterface $appRepositoryInterface,
        TokenRepositoryInterface $tokenRepositoryInterface
    ){
        $appId = sha1(mt_rand());
        $name = "hogehoge";
        $app = new AppEntity($appId,$name,"000000",false,[]);
        $appRepositoryInterface->insert($app);

        $tokenKey = sha1(mt_rand());
        $token = new TokenEntity($appId,$tokenKey,"app",null,null);
        $tokenRepositoryInterface->insert($token);

        $this->line("token: {$tokenKey}");
    }


}
