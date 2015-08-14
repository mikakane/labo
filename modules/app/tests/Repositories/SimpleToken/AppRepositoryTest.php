<?php
namespace Chatbox\App\Tests\Repositories;

use Chatbox\App\Entity\AppEntity;
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
class AppRepositroryTest extends TestCase
{

    /** @var  AppRepositoryInterface */
    protected $repository;
    /**
     * @inheritDoc
     */
    public function setUp()
    {
//        parent::setUp();
        $mapper = new AppMapper("cb_app_list");
        $this->repository = new AppSimpleTokenRepository($mapper);
    }

    /**
     * @covers \Chatbox\App\Repositories\SimpleToken\AppSimpleTokenRepository::__construct
     * @covers \Chatbox\App\Repositories\SimpleToken\AppSimpleTokenRepository::find
     * @covers \Chatbox\App\Repositories\SimpleToken\AppSimpleTokenRepository::delete
     */
    public function testFind(){

        $appUid = "hogehoge".sha1(mt_rand());

        // 最初は存在しない
        $rand = sha1(mt_rand());
        $app = $this->repository->find($appUid,$rand);
        $this->assertEquals($rand,$app);

        // 作成する
        $name = "mikakane sample app";
        $ownerUid = "hogepiyo";
        $isFrozen = false;
        $config = [];

        $app = new AppEntity($appUid,$name,$ownerUid,$isFrozen,$config);
        $this->repository->insert($app);

        //存在確認
        $app = $this->repository->find($appUid);
        $this->assertInstanceOf(AppEntity::class,$app);

        // 削除
        $this->repository->delete($appUid);
        $app = $this->repository->find($appUid);
        $this->assertNull($app);

    }

    /**
     * @covers \Chatbox\App\Repositories\SimpleToken\AppSimpleTokenRepository::insert
     */
    public function testInsert(){

        $appUid = "hogehoge".sha1(mt_rand());

        // 作成する
        $name = "mikakane sample app";
        $ownerUid = "hogepiyo";
        $isFrozen = false;
        $config = [];

        $app = new AppEntity($appUid,$name,$ownerUid,$isFrozen,$config);
        $this->repository->insert($app);

        $app = new AppEntity($appUid,$name,$ownerUid,$isFrozen,$config);
        $this->setExpectedException(\Exception::class);
        $this->repository->insert($app);
    }

    /**
     * @covers \Chatbox\App\Repositories\SimpleToken\AppSimpleTokenRepository::update
     */
    public function testUpdate(){

        $appUid = "hogehoge".sha1(mt_rand());

        // 作成する
        $name = "mikakane sample app";
        $ownerUid = "hogepiyo";
        $isFrozen = false;
        $config = [];

        $app = new AppEntity($appUid,$name,$ownerUid,$isFrozen,$config);
        $this->repository->insert($app);

        $newName = "mikakane new name";
        $app->setName($newName);

        $this->repository->update($app);

        $app = $this->repository->find($appUid);
        $this->assertEquals($newName,$app->getName());
    }
}