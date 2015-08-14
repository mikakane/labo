<?php
namespace Chatbox\Auth\Repositories\SimpleToken;
use Carbon\Carbon;
use Chatbox\Auth\Entity\CredentialEntity;
use Chatbox\Auth\Infrastructure\Mapper\CredentialMapper;
use Chatbox\Auth\Repositories\CredentialRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/01
 * Time: 18:13
 */
class CredentialSimpleTokenRepository implements CredentialRepositoryInterface{

    /** @var  CredentialMapper */
    protected $mapper;
    /**
     * CredentialEloquentRepository constructor.
     * @param $userRepository
     * @param $credentialEloquent
     */
    public function __construct(CredentialMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @inheritDoc
     */
    public function findByUser($uid,$type,$default=null)
    {
        return $this->mapper->find($uid,$type,$default);
    }


    /**
     * @inheritDoc
     */
    public function findByTypeAndHash($type, $hash,$default=null)
    {
        return $this->mapper->find($type,$hash,$default);
    }

    /**
     * @inheritDoc
     */
    public function bind($uid, CredentialEntity $credentialEntity)
    {
        $this->mapper->insert($credentialEntity);
    }

    /**
     * @inheritDoc
     */
    public function unbind($uid, $type)
    {
        $this->mapper->delete($uid,$type);
    }


}