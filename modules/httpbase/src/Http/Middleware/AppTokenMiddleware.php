<?php
namespace Chatbox\HttpBase\Http\Middleware;

use Chatbox\HttpBase\Service\AppTokenRepositoryService;
use Closure;
use Illuminate\Http\Request;
use Chatbox\HttpBase\Casket\ActiveToken;

class AppTokenMiddleware
{

    protected $appTokenService;

    /**
     * AppTokenMiddleware constructor.
     * @param $appRepositoryService
     */
    public function __construct(
        AppTokenRepositoryService $appTokenRepositoryService
    ){
        $this->appTokenService = $appTokenRepositoryService;
    }


    /**
     * Filter the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tokenKey = $request->input("token");

        app()->singleton(ActiveToken::class,function()use($tokenKey){
            return $this->appTokenService->createActiveToken($tokenKey);
        });

        return $next($request);
    }

}