<?php
namespace Chatbox\Auth\Tests\Repositories\Illuminate;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;
use Chatbox\Auth\Repositories\Illuminate\CredentialIlluminateRepository;

use Chatbox\Auth\Entity\CredentialEntity;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/02
 * Time: 15:08
 */
class CredentialIlluminateepositroryTest extends \PHPUnit_Framework_TestCase
{

    /** @var  CredentialRepositoryInterface */
    protected $repository;
    /**
     * @inheritDoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->repository = new CredentialIlluminateRepository("cb_user_credential");
    }

    /**
     *
     */
    public function testBind(){

        $uid = (new \Chatbox\Supports\UidGenerator())->random();

        // 新しいIDで存在しないことを確認
        $cred = $this->repository->findByUser($uid,"password");
        $this->assertNull($cred);

        // 新しい認証情報を作成
        $credential = $this->repository->create(["type" => "password","hash"=>"hogehoge"]);
        $this->repository->bind($uid,$credential);

        $cred = $this->repository->findByUser($uid,"password");
        $this->assertInstanceOf(CredentialEntity::class,$cred);

        $this->repository->unbind($uid,"password");

        $creds = $this->repository->findByUser($uid,"password");
        $this->assertNull($cred);
    }

}