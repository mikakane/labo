<?php
namespace Chatbox\Auth;

use Chatbox\Auth\Infrastructure\Mapper\CredentialMapper;
use Chatbox\Auth\Infrastructure\Mapper\UserMapper;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\SimpleToken\CredentialSimpleTokenRepository;
use Chatbox\Auth\Repositories\SimpleToken\UserSimpleTokenRepository;
use Chatbox\Auth\Repositories\UserRepositoryInterface;
use Chatbox\HttpBase\Casket\ActiveToken;
use Illuminate\Support\ServiceProvider;

class AuthModuleProvider extends ServiceProvider
{
    protected $userListTable = "cb_user_list";
    protected $userCredentialTable = "cb_user_credential";

    /**
     * @inheritDoc
     */
    public function register(){
        /** @var ActiveToken $activeToken */
        $this->app->singleton(UserRepositoryInterface::class,function(){
            $mapper = new UserMapper($this->userListTable);
            return new UserSimpleTokenRepository($mapper);
        });
        $this->app->singleton(CredentialRepositoryInterface::class,function(){
            $mapper = new CredentialMapper($this->userCredentialTable);
            return new CredentialSimpleTokenRepository($mapper);
        });
    }

}