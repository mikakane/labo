<?php
namespace Chatbox\App;

use Chatbox\App\Infrastructure\Mapper\AppMapper;
use Chatbox\App\Repositories\AppRepositoryInterface;
//use Chatbox\App\Repositories\TokenRepositoryInterface;
use Chatbox\App\Repositories\SimpleToken\AppSimpleTokenRepository;
use Chatbox\App\Repositories\SimpleToken\SimpleTokenRepository;
use Chatbox\App\Repositories\TokenRepositoryInterface;
use Chatbox\App\Repositories\UserTokenRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Chatbox\App\Infrastructure\Mapper\TokenMapper;

class AppModuleProvider extends ServiceProvider
{
    protected $appListTable = "cb_app_list";
    protected $appTokenTable = "cb_app_token";

    /**
     * @inheritDoc
     */
    public function register(){
        $this->app->singleton(AppRepositoryInterface::class,function(){
            $mapper = new AppMapper($this->appListTable);
            return new AppSimpleTokenRepository($mapper);
        });
        $this->app->singleton(TokenRepositoryInterface::class,function(){
            $mapper = new TokenMapper($this->appTokenTable);
            return new SimpleTokenRepository($mapper);
        });
    }

}