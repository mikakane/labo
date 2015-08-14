<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/09
 * Time: 13:31
 */

namespace Chatbox\App\Repositories;


use Chatbox\App\Entity\AppEntity;
use Illuminate\Support\Facades\App;

interface AppRepositoryInterface
{

    /**
     * @param $appUid
     * @param null $default
     * @return AppEntity | null
     */
    public function find($appUid,$default=null);

    /**
     * @param $ownerUid
     * @return AppEntity[]
     */
    public function findByOwner($ownerUid);

    /**
     * @param AppEntity $app
     * @return null
     */
    public function insert(AppEntity $app);

    /**
     * @param AppEntity $app
     * @return null
     */
    public function update(AppEntity $app);

    /**
     * @param AppEntity $app
     * @return null
     */
    public function delete($appUid);
}