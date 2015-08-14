<?php
namespace Chatbox\App\Tests\Repositories;

use Carbon\Carbon;
use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Entity\TokenEntity;
use Chatbox\App\Infrastructure\Mapper\TokenMapper;
use Chatbox\App\Repositories\SimpleToken\SimpleTokenRepository;
use Chatbox\App\Repositories\TokenRepositoryInterface;
use Chatbox\App\Tests\TestCase;
use Chatbox\App\Repositories\AppRepositoryInterface;
use Chatbox\App\Infrastructure\Mapper\AppMapper;
use Chatbox\App\Repositories\SimpleToken\AppSimpleTokenRepository;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/02
 * Time: 15:08
 */

/**
 * Class AppRepositroryTest
 * @group appModule
 * @package Chatbox\App\Tests\Repositories\Illuminate
 */
class TokenRepositroryTest extends TestCase
{

    /** @var  TokenRepositoryInterface */
    protected $repository;
    /**
     * @inheritDoc
     */
    public function setUp()
    {
        $mapper = new TokenMapper("cb_app_token");
        $this->repository = new SimpleTokenRepository($mapper);
    }

    /**
     * @covers \Chatbox\App\Repositories\SimpleToken\SimpleTokenRepository::__construct
     * @covers \Chatbox\App\Repositories\SimpleToken\SimpleTokenRepository::loadToken
     * @covers \Chatbox\App\Repositories\SimpleToken\SimpleTokenRepository::delete
     */
    public function testFind(){

        $appUid = "appuid".sha1(mt_rand());
        $tokenKey = "token".sha1(mt_rand());
        $userUid = "user".sha1(mt_rand());

        // 最初は存在しない
        $rand = sha1(mt_rand());
        $app = $this->repository->loadToken($tokenKey,"password",$rand);
        $this->assertEquals($rand,$app);

        // 作成する
        $name = "mikakane sample app";
        $accessType = "password";
        $expiredAt = Carbon::now();

        $app = new TokenEntity($appUid,$tokenKey,$accessType,$userUid,$expiredAt);
        $this->repository->insert($app);

        //存在確認
        $app = $this->repository->loadToken($tokenKey,"password");
        $this->assertInstanceOf(TokenEntity::class,$app);

        // 削除
        $this->repository->delete($tokenKey);
        $app = $this->repository->loadToken($appUid,"password");
        $this->assertNull($app);

    }

    /**
     * @covers \Chatbox\App\Repositories\SimpleToken\SimpleTokenRepository::insert
     */
    public function testInsert(){

        $appUid = "hogehoge".sha1(mt_rand());
        $tokenKey = "hogehoge".sha1(mt_rand());
        $userUid = "hogehoge".sha1(mt_rand());

        // 作成する
        $name = "mikakane sample app";

        $app = new TokenEntity($appUid,$tokenKey,"password",null,null);
        $this->repository->insert($app);

        $appUid = "hogehoge".sha1(mt_rand());
        $tokenKey = "hogehoge".sha1(mt_rand());
        $userUid = "hogehoge".sha1(mt_rand());

        // 作成する
        $name = "mikakane sample app";
        $accessType = "password";
        $expiredAt = Carbon::now();

        $app = new TokenEntity($appUid,$tokenKey,$accessType,$userUid,$expiredAt);
        $this->repository->insert($app);

        $this->setExpectedException(\Exception::class);
        $this->repository->insert($app);


    }
}