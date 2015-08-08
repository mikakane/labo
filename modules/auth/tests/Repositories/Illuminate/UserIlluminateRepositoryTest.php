<?php
namespace Chatbox\Auth\Tests\Repositories\Illuminate;

use Chatbox\Auth\Repositories\Illuminate\UserIlluminateRepository;
use Chatbox\Auth\Repositories\Illuminate\CredentialIlluminateRepository;


/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/02
 * Time: 15:08
 */
class UserIlluminateRepositroryTest extends \PHPUnit_Framework_TestCase
{

    /** @var  \Chatbox\Auth\Repositories\CredentialRepositoryInterface */
    protected $repository;
    /**
     * @inheritDoc
     */
    public function setUp()
    {
        parent::setUp();

        $credRepository = new CredentialIlluminateRepository("cb_user_credential");

        $this->repository = new UserIlluminateRepositrory("cb_user_list", $credRepository);
    }

    /**
     * hogehoge
     */
    public function testBind(){

        $uid = (new \Chatbox\Supports\UidGenerator())->random();

        $creds = $this->repository->findByUser($uid);
        $this->assertEquals(0,count($creds));

        $credential = $this->repository->create(["type" => "password","hash"=>"hogehoge"]);
        $this->repository->bind($uid,$credential);

        $creds = $this->repository->findByUser($uid);
        $this->assertEquals(1,count($creds));

        $this->repository->unbind($uid,"password");

        $creds = $this->repository->findByUser($uid);
        $this->assertEquals(0,count($creds));
    }

}