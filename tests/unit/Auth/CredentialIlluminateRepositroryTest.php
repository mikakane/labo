<?php

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/02
 * Time: 15:08
 */
class CredentialIlluminateepositroryTest extends TestCase
{

    /** @var  \Chatbox\Auth\Repositories\CredentialRepositoryInterface */
    protected $repository;
    /**
     * @inheritDoc
     */
    public function setUp()
    {
        parent::setUp();

        $this->repository = new \Chatbox\Auth\Repositories\Illuminate\CredentialIlluminateRepository("cb_user_credential");
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