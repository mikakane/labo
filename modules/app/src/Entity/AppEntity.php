<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/08/09
 * Time: 13:19
 */

namespace Chatbox\App\Entity;


class AppEntity
{
    protected $appUid;

    protected $name;

    protected $ownerUid;

    protected $is_frozen;

    protected $config;

    /**
     * App constructor.
     * @param $appUid
     * @param $name
     * @param $ownerUid
     * @param $is_frozen
     * @param $config
     */
    public function __construct($appUid, $name, $ownerUid, $is_frozen,array $config)
    {
        $this->setAppUid($appUid);
        $this->setName($name);
        $this->setOwnerUid($ownerUid);
        $this->setIsFrozen($is_frozen);
        $this->setConfig($config);
    }


    /**
     * @return mixed
     */
    public function getAppUid()
    {
        return $this->appUid;
    }

    /**
     * @param mixed $appUid
     */
    public function setAppUid($appUid)
    {
        $this->appUid = $appUid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getOwnerUid()
    {
        return $this->ownerUid;
    }

    /**
     * @param mixed $ownerUid
     */
    public function setOwnerUid($ownerUid)
    {
        $this->ownerUid = $ownerUid;
    }

    /**
     * @return mixed
     */
    public function getIsFrozen()
    {
        return $this->is_frozen;
    }

    /**
     * @param mixed $is_frozen
     */
    public function setIsFrozen($is_frozen)
    {
        $this->is_frozen = $is_frozen;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }



}