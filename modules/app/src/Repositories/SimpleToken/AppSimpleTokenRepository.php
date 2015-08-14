<?php
namespace Chatbox\App\Repositories\SimpleToken;
use Chatbox\App\Entity\AppEntity;
use Chatbox\App\Infrastructure\Mapper\AppMapper;
use Chatbox\App\Repositories\AppRepositoryInterface;

/**
 *
 *
 */
class AppSimpleTokenRepository implements AppRepositoryInterface
{
    protected $mapper;

    /**
     * AppIlluminateRepository constructor.
     * @param $mapper
     */
    public function __construct(AppMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function find($appUid,$default=null)
    {
        return $this->mapper->find($appUid,$default);
    }

    public function findByOwner($ownerUid)
    {
        return $this->mapper->findByOwner($ownerUid);
    }

    public function insert(AppEntity $app)
    {
        $this->mapper->insert($app);
    }

    public function update(AppEntity $app)
    {
        $this->mapper->update($app);
    }

    public function delete($appUid)
    {
        $this->mapper->delete($appUid);
    }
}

